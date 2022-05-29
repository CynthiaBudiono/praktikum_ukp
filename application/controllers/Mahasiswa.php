<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	// public function __construct(){
	// 	parent::__construct();
	// 	//if($this->session->userdata('logged_in')) redirect('dashboard');
	// 	if($this->session->userdata('user_type') == 'karyawan') redirect('dashboard');
	// 	if($this->session->userdata('user_type') == 'sponsor') redirect('sponsor_area');
	// 	if($this->session->userdata('user_type') == 'fasilitator') redirect('fasilitator_area');
	// }

	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{

		$this->load->model('mahasiswa_model');

		$data['mahasiswa'] = $this->mahasiswa_model->getallopen();

		// var_dump("MAHASISWA ", $data['mahasiswa']); exit;
		$data['title'] = "Mahasiswa";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa', $data);

		$this->load->view('general/footer', $data);
	}

	public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['mahasiswa_file']['name'])) {

			$path = $_FILES["mahasiswa_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$nrp = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$angkatan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$ipk = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$ips = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$data[] = array(
						'NRP' 		=> $nrp,
						'nama' 		=> $nama,
						'angkatan' 	=> $angkatan,
						'ipk' 		=> $ipk,
						'ips' 		=> $ips
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

		$this->load->model('mahasiswa_model');
		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$cek = $this->mahasiswa_model->get($data[$i]['NRP']);

				$datavalue = array(
					"NRP"		=> $data[$i]['NRP'],
					"nama"		=> $data[$i]['nama'],
					"angkatan"	=> $data[$i]['angkatan'],
					"ips"		=> ($data[$i]['ips'] != NULL) ? $data[$i]['ips'] : 0,
					"ipk"		=> ($data[$i]['ipk'] != NULL) ? $data[$i]['ipk'] : 0,
					"email"		=> $data[$i]['NRP']."@john.petra.ac.id",
					"status" 	=> 1
				);

				if($cek == 0){ //ADD
					$this->mahasiswa_model->add($datavalue);
				}
				else{ //UPDATE
					$this->mahasiswa_model->update($datavalue);
				}

			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'mahasiswa',
            "action" => 'CREATE',
            "keterangan" => "all record have been created/updated by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);
		
		$this->session->set_flashdata('msg', "Sukses Menambahkan Data");
		redirect("mahasiswa");
	}

	public function getpesertapraktikum(){
		$this->load->model('mahasiswa_model');
		$this->load->model('informasi_umum_model');

		$mahasiswa = $this->mahasiswa_model->getpesertapraktikum($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
        echo json_encode($mahasiswa);
	}

	public function getallactive(){ //di pke di asisten.php
		$this->load->model('mahasiswa_model');

		$mahasiswa = $this->mahasiswa_model->getallactive();
		
        echo json_encode($mahasiswa);
	}
}