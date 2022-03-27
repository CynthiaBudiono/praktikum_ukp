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
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa', $data);

		$this->load->view('general/footer', $data);
	}
}