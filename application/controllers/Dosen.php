<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('dosen_model');

		$data['dosen'] = $this->dosen_model->getallopen();

		$data['title'] = "Dosen";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/dosen', $data);

		$this->load->view('general/footer', $data);
	}

	public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['dosen_file']['name'])) {

			$path = $_FILES["dosen_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$nip = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$data[] = array(
						'NIP' 		=> $nip,
						'nama' 		=> $nama,
						'email' 	=> $email
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

		$this->load->model('dosen_model');
		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$cek = $this->dosen_model->get($data[$i]['NIP']);

				$datavalue = array(
					"NIP"		=> $data[$i]['NIP'],
					"nama"		=> $data[$i]['nama'],
					"email"		=> ($data[$i]['email'] != NULL) ? $data[$i]['email'] : "",
					"status" 	=> 1
				);

				if($cek == 0){ //ADD
					$this->dosen_model->add($datavalue);
				}
				else{ //UPDATE
					$this->dosen_model->update($datavalue);
				}
			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'dosen',
            "action" => 'CREATE',
            "keterangan" => "all record have been created/updated by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

		redirect("dosen");
	}

	public function getdosen(){
		$this->load->model('dosen_model');

		$pengajar = $this->dosen_model->getallactive();
		
        echo json_encode($pengajar);
	}

	public function getactivepengajar(){
		$this->load->model('dosen_model');
		$this->load->model('mahasiswa_model');

		$pengajar = $this->dosen_model->getallactive();

		// $pengajar = array_merge($this->dosen_model->getallactive(), $this->asisten_dosen_model->getallactive());
		
        echo json_encode($pengajar);
	}

	public function getjadwalbyNIP(){
		$this->load->model('jadwal_berhalangan_model');
		$this->load->model('jadwal_perkuliahan_model');
		$this->load->model('informasi_umum_model');
		$this->load->model('dosen_model');

		$pengajar = $this->jadwal_perkuliahan_model->getbyNIP($this->input->post('NIP'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		// var_dump($pengajar); exit;
        echo json_encode($pengajar);
	}


}