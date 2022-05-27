<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('subject_model');

		$data['subject'] = $this->subject_model->getallopen();

		$data['title'] = "Subject";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/subject', $data);

		$this->load->view('general/footer', $data);
	}

	public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['subject_file']['name'])) {

			$path = $_FILES["subject_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$kode_mk = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$informatika = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$sib = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$dsa = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$kelulusan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$for_semester = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$status_praktikum = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$status_responsi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$status_transfer_nilai = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

					$data[] = array(
						'kode_mk' 				=> $kode_mk,
						'nama' 					=> $nama,
						'semester'				=> $for_semester,
						'status_praktikum' 		=> $status_praktikum,
						'status_responsi' 		=> $status_responsi,
						'status_transfer_nilai' => $status_transfer_nilai,
						'informatika'			=> $informatika,
						'sib'					=> $sib,
						'dsa'					=> $dsa,
						'kelulusan'				=> $kelulusan,
					);
				}
			}

			$this->addupdatedata($data);
			// var_dump($data[0]); exit;
		}
		else{
			echo "Tidak ada file yang masuk";
		}
	}

	private function addupdatedata($data){

		$this->load->model('subject_model');
		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$cek = $this->subject_model->get($data[$i]['kode_mk']);
				$datavalue = array(
					"kode_mk" 				=> $data[$i]['kode_mk'],
					"nama" 					=> $data[$i]['nama'],
					"semester"				=> $data[$i]['semester'],
					"status_praktikum" 		=> ($data[$i]['status_praktikum'] != NULL) ? $data[$i]['status_praktikum'] : 0,
					"status_responsi" 		=> ($data[$i]['status_responsi'] != NULL) ? $data[$i]['status_responsi'] : 0,
					"status_transfer_nilai" => ($data[$i]['status_transfer_nilai'] != NULL) ? $data[$i]['status_transfer_nilai'] : 0,
					"informatika"			=> ($data[$i]['informatika'] != NULL) ? $data[$i]['informatika'] : 0,
					"sib"					=> ($data[$i]['sib'] != NULL) ? $data[$i]['sib'] : 0,
					"dsa"					=> ($data[$i]['dsa'] != NULL) ? $data[$i]['dsa'] : 0,
					"kelulusan"				=> $data[$i]['kelulusan'],
					// "prasyarat"				=> ($data[$i]['prasyarat'] != NULL) ? $data[$i]['prasyarat'] : "",
					"status" 				=> 1
				);


				if($cek == 0){ //ADD
					$this->subject_model->add($datavalue);
				}
				else{ //UPDATE
					$this->subject_model->update($datavalue);
				}

			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'subject',
            "action" => 'CREATE',
            "keterangan" => "all record have been created/updated by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

		redirect("subject");
	}

	public function gethavepraktikum(){ //buat kelas_praktikum-add.php
		$this->load->model('subject_model');
		// $subject = "";
		// if($this->session->userdata('user_type') == 'admin'){
		// 	$subject = $this->subject_model->gethavepraktikum($this->input->post('nrp'));
		// }
		// else if($this->session->userdata('user_type') == 'mahasiswa'){
		// 	$subject = $this->subject_model->gethavepraktikum($this->session->userdata('user_id'));
		// }
		$subject = $this->subject_model->gethavepraktikum();
		
        echo json_encode($subject);
	}

	public function get(){
		$this->load->model('subject_model');

		$subject = $this->subject_model->get($this->input->post('kode_mk'));
		
        echo json_encode($subject);
	}
}