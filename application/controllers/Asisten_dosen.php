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

		$this->load->model('informasi_umum_model');
		$this->load->model('asisten_dosen_model');

		$data['asisten_dosen'] = $this->asisten_dosen_model->getallopen();

		$data['title'] = "Asisten Dosen";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/asisten_dosen', $data);

		$this->load->view('general/footer', $data);
	}
}