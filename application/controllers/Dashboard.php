<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	}

	public function index()
	{

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/dashboard');

		$this->load->view('general/footer');
	}
}