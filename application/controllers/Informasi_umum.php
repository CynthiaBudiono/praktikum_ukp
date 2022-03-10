<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_umum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
		$this->load->model('informasi_umum_model');

		$data['informasi_umum'] = $this->informasi_umum_model->getallopen();

        $data['start_year'] = date("Y");

        $data['end_year'] = date('Y', strtotime("1 year"));

		$data['title'] = "Informasi Umum";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/informasi_umum', $data);

		$this->load->view('general/footer');
	}
}