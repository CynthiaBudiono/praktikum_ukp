<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('asisten_dosen_model');

		$data['asisten_dosen'] = $this->asisten_dosen_model->getallopen();

		$data['title'] = "Asisten Dosen";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/asisten_dosen', $data);

		$this->load->view('general/footer');
	}
}