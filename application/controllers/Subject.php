<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('subject_model');

		$data['subject'] = $this->subject_model->getallopen();

		$data['title'] = "Subject";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/subject', $data);

		$this->load->view('general/footer');
	}
}