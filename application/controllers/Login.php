<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')) redirect('dashboard');
	}

	public function index()
	{

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		
		$this->load->view('general/header');

		$this->load->view('general/login', $data);
	}
}