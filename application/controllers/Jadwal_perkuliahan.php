<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_perkuliahan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{

		$this->load->model('jadwal_perkuliahan_model');

		$data['jadwal_perkuliahan'] = $this->jadwal_perkuliahan_model->getallopen();

		// var_dump("jadwal_perkuliahan ", $data['jadwal_perkuliahan']); exit;
		$data['title'] = "Jadwal Perkuliahan";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/jadwal_perkuliahan', $data);

		$this->load->view('general/footer', $data);
	}

	public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['jadwal_perkuliahan_file']['name'])) {

			$path = $_FILES["jadwal_perkuliahan_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$hari = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$jam = $worksheet->getCellByColumnAndRow(1, $row);
					$sampai = $worksheet->getCellByColumnAndRow(2, $row);
					$kode_mk = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$kelas_paralel = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$for_semester = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$NIP1 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$NIP2 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$ruang = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

					$jam_value = PHPExcel_Style_NumberFormat::toFormattedString($jam->getCalculatedValue(), 'hh:mm:ss');
					$sampai_value = PHPExcel_Style_NumberFormat::toFormattedString($sampai->getCalculatedValue(), 'hh:mm:ss');

					$durasi = (strtotime($sampai_value) - strtotime($jam_value))/60;

					$data[] = array(
						'kode_mk' 		=> $kode_mk,
						'kelas_paralel'	=> $kelas_paralel,
						'hari' 			=> $hari,
						'jam' 			=> $jam_value,
						'durasi' 		=> $durasi,
						'for_semester' 	=> $for_semester,
						'NIP1' 			=> $NIP1,
						'NIP2' 			=> $NIP2,
						'ruang' 		=> $ruang
					);
				}
			}

			$this->addupdatedata($data);
		}
		else{
			echo "Tidak ada file yang masuk";
		}
	}

	private function addupdatedata($data){

		$this->load->model('jadwal_perkuliahan_model');
		$this->load->model('informasi_umum_model');

		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$datavalue = array(
					'kode_mk' 		=> $data[$i]['kode_mk'],
					'kelas_paralel'	=> $data[$i]['kelas_paralel'],
					'hari' 			=> $data[$i]['hari'],
					'jam' 			=> $data[$i]['jam'],
					'durasi' 		=> $data[$i]['durasi'],
					'for_semester' 	=> ($data[$i]['for_semester'] != NULL) ? $data[$i]['for_semester'] : 99,
					'NIP1' 			=> ($data[$i]['NIP1'] != NULL) ? $data[$i]['NIP1'] : 0,
					'NIP2' 			=> ($data[$i]['NIP2'] != NULL) ? $data[$i]['NIP2'] : 0,
					'ruang' 		=> ($data[$i]['ruang'] != NULL) ? $data[$i]['ruang'] : "-",
					"semester"      => $this->informasi_umum_model->getsemester(),
                    "tahun_ajaran"  => $this->informasi_umum_model->gettahunajaran(),
					"status"        => 1
				);

				$this->jadwal_perkuliahan_model->add($datavalue);

			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'jadwal_perkuliahan',
            "action" => 'CREATE',
            "keterangan" => "record per semester have been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

		redirect("jadwal_perkuliahan");
	}
}