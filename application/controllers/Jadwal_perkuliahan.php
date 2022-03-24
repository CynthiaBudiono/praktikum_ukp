<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_perkuliahan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{

		$this->load->model('jadwal_perkuliahan_model');

		$data['jadwal_perkuliahan'] = $this->jadwal_perkuliahan_model->getallopen();

		// var_dump("jadwal_perkuliahan ", $data['jadwal_perkuliahan']); exit;
		$data['title'] = "mahasiswa matakuliah";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "ganjil" : "genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/jadwal_perkuliahan', $data);

		$this->load->view('general/footer', $data);
	}
}