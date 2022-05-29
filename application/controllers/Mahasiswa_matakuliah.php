<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mahasiswa_matakuliah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
		if($this->session->userdata('user_type') != 'admin') redirect('dashboard');

		$this->load->model('mahasiswa_matakuliah_model');

		$data['mahasiswa_matakuliah'] = $this->mahasiswa_matakuliah_model->getallopen();

		// var_dump("mahasiswa_matakuliah ", $data['mahasiswa_matakuliah']); exit;
		$data['title'] = "Mahasiswa Matakuliah";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_matakuliah', $data);

		$this->load->view('general/footer', $data);
	}

	public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['mahasiswa_matakuliah_file']['name'])) {

			$path = $_FILES["mahasiswa_matakuliah_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$periode = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$nrp = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$kode_mk = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$kelas_paralel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$ipk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$ips = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

					$splitperiod = explode("S",$periode);
					$semester = $splitperiod[1];
					$tahun_ajaran = $splitperiod[0] . "-" . intval($splitperiod[0] + 1);;

					$data[] = array(
						'NRP' 			=> $nrp,
						'nama'			=> $nama,
						'kode_mk' 		=> $kode_mk,
						'kelas_paralel'	=> $kelas_paralel,
						'semester'		=> $semester,
						'tahun_ajaran'	=> $tahun_ajaran,
						'ipk'			=> $ipk,
						'ips'			=> $ips
					);
				}
			}
			// var_dump($data); exit;
			$this->addupdatedata($data);
		}
		else{
			echo "Tidak ada file yang masuk";
		}
	}

	private function addupdatedata($data){

		$this->load->model('mahasiswa_matakuliah_model');
		$this->load->model('jadwal_perkuliahan_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('informasi_umum_model');

		if($data != null){
			for($i = 0; $i < count($data); $i++){
				if(($data[$i]['kode_mk'] != "" || $data[$i]['kode_mk'] != null)  && ($data[$i]['kelas_paralel'] != "" || $data[$i]['kelas_paralel'] != null)){

					$getidjadwalperkuliahan = $this->jadwal_perkuliahan_model->getjadwalperkuliahan($data[$i]['kode_mk'], $data[$i]['kelas_paralel'], $data[$i]['semester'], $data[$i]['tahun_ajaran']);

					if($getidjadwalperkuliahan != 0){
						$idjadwalperkuliahan = $getidjadwalperkuliahan[0]['id'];
					}
					else{
						$idjadwalperkuliahan = 0;
					}

					// ADD UPDATE MAHASISWA
					$datamahasiswa = array(
						'NRP' 	=> $data[$i]['NRP'],
						'nama'	=> $data[$i]['nama'],
						'ipk'	=> $data[$i]['ipk'],
						'ips'	=> $data[$i]['ips']
					);

					$getmahasiswa = $this->mahasiswa_model->get($data[$i]['NRP']);
					if($getmahasiswa == 0){ //ADD
						$datamahasiswa['angkatan'] = "20" .substr($data[$i]['NRP'], 3, 2);
						$datamahasiswa['email'] = $data[$i]['NRP']. "@john.petra.ac.id";
						$this->mahasiswa_model->add($datamahasiswa);
					}
					else{ //UPDATE
						$this->mahasiswa_model->update($datamahasiswa);
					}
					
					$datavalue = array(
						'NRP' 					=> $data[$i]['NRP'],
						'id_jadwal_perkuliahan'	=> $idjadwalperkuliahan,
						'kode_mk' 				=> $data[$i]['kode_mk'],
						'kelas_paralel'			=> $data[$i]['kelas_paralel'],
						"semester"      		=> $data[$i]['semester'],
						"tahun_ajaran"  		=> $data[$i]['tahun_ajaran'],
					);

					$getidmahasiswamatakuliah = $this->mahasiswa_matakuliah_model->getidmahasiswamatakuliah($data[$i]['NRP'], $data[$i]['kode_mk'], $data[$i]['semester'], $data[$i]['tahun_ajaran']);
					if($getidmahasiswamatakuliah == 0){ //ADD
						$this->mahasiswa_matakuliah_model->add($datavalue);
					}
					else{ //UPDATE
						$datavalue['id'] = $getidmahasiswamatakuliah[0]['id'];
						$this->mahasiswa_matakuliah_model->update($datavalue);
					}
				}
			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'mahasiswa_matakuliah',
            "action" => 'CREATE',
            "keterangan" => "record per semester have been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

		$this->session->set_flashdata('msg', "Sukses Menambahkan Data");
		redirect("mahasiswa_matakuliah");
	}

	public function viewbylogin()
	{

		if($this->session->userdata('user_type') != 'mahasiswa') redirect('dashboard');

		$this->load->model('mahasiswa_matakuliah_model');
		$this->load->model('informasi_umum_model');

		$data['mahasiswa_matakuliah'] = $this->mahasiswa_matakuliah_model->viewbylogin($this->session->userdata('user_id'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

		// var_dump("mahasiswa_matakuliah ", $data['mahasiswa_matakuliah']); exit;
		$data['title'] = "Mahasiswa Matakuliah";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_matakuliah', $data);

		$this->load->view('general/footer', $data);
	}

	public function getsubjectbyNRP(){
		$this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('informasi_umum_model');

		if($this->session->userdata('user_type') == 'admin'){
        	$subject = $this->mahasiswa_matakuliah_model->getsubjectbyNRP($this->input->post('nrp'),  $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
		else if($this->session->userdata('user_type') == 'mahasiswa'){
			$subject = $this->mahasiswa_matakuliah_model->getsubjectbyNRP($this->session->userdata('user_id'),  $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
        echo json_encode($subject);
	}

	public function getjadwalbyNRP(){
		$this->load->model('informasi_umum_model');
		$this->load->model('mahasiswa_matakuliah_model');

		$pengajar = $this->mahasiswa_matakuliah_model->getbyNRP($this->input->post('NRP'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		// var_dump($pengajar); exit;
        echo json_encode($pengajar);
	}
}