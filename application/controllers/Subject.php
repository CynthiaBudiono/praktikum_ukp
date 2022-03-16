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

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "ganjil" : "genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/subject', $data);

		$this->load->view('general/footer', $data);
	}

	public function gethavepraktikum(){
		$this->load->model('subject_model');

		$subject = $this->subject_model->gethavepraktikum();
		
        echo json_encode($subject);
	}
}