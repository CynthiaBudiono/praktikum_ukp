<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')) redirect('dashboard');
	}

	public function index()
	{

		$this->load->view('general/header');

		$this->load->view('general/login');
	}
}