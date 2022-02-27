<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	// public function __construct(){
	// 	parent::__construct();
	// 	//if($this->session->userdata('logged_in')) redirect('dashboard');
	// 	if($this->session->userdata('user_type') == 'karyawan') redirect('dashboard');
	// 	if($this->session->userdata('user_type') == 'sponsor') redirect('sponsor_area');
	// 	if($this->session->userdata('user_type') == 'fasilitator') redirect('fasilitator_area');
	// }

	public function index()
	{

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/dashboard');

		$this->load->view('general/footer');
	}
}