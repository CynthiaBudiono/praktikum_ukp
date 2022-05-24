<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer_nilai extends CI_Controller {
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

		$this->load->model('mahasiswa_nilai_model');
		$this->load->model('jadwal_perkuliahan_model');
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		// $getsubjecttransfernilai = $this->jadwal_perkuliahan_model->getsubjecttransfernilai($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$getsubjecttransfernilai = $this->kelas_praktikum_model->getallopen();
		
		$transfer_nilai = [];
		// var_dump($getsubjecttransfernilai); exit;
		if($getsubjecttransfernilai != 0){
			for($i = 0; $i < count($getsubjecttransfernilai); $i++){
				$laporan = $this->mahasiswa_nilai_model->getlulustidaklulus($getsubjecttransfernilai[$i]['id']);
				if($laporan != 0){
					for($j = 0; $j < count($laporan); $j ++){
						array_push($transfer_nilai, $laporan[$j]);
					}
					// array_push($transfer_nilai, $laporan);
				}
			}
		}

		$data['mahasiswa'] = $transfer_nilai;

		// var_dump("MAHASISWA ", $data['mahasiswa']); exit;
		$data['title'] = "Transfer Nilai";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/transfer_nilai', $data);

		$this->load->view('general/footer', $data);
	}
}