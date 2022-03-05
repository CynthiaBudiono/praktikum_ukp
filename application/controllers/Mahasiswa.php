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
		// $this->load->database();
	}


	public function index()
	{

		$this->load->model('mahasiswa_model');

		$data['mahasiswa'] = $this->mahasiswa_model->getallopen();

		// var_dump("MAHASISWA ", $data['mahasiswa']); exit;
		$data['title'] = "Mahasiswa";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/mahasiswa', $data);

		$this->load->view('general/footer');
	}
}