<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mahasiswa_matakuliah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
		if($this->session->userdata('user_type') != 'admin') redirect('dashboard');

		$this->load->model('mahasiswa_matakuliah_model');

		$data['mahasiswa_matakuliah'] = $this->mahasiswa_matakuliah_model->getallopen();

		// var_dump("mahasiswa_matakuliah ", $data['mahasiswa_matakuliah']); exit;
		$data['title'] = "mahasiswa matakuliah";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_matakuliah', $data);

		$this->load->view('general/footer', $data);
	}

	public function viewbylogin()
	{

		if($this->session->userdata('user_type') != 'mahasiswa') redirect('dashboard');

		$this->load->model('mahasiswa_matakuliah_model');
		$this->load->model('informasi_umum_model');

		$data['mahasiswa_matakuliah'] = $this->mahasiswa_matakuliah_model->viewbylogin($this->session->userdata('user_id'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

		// var_dump("mahasiswa_matakuliah ", $data['mahasiswa_matakuliah']); exit;
		$data['title'] = "mahasiswa matakuliah";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_matakuliah', $data);

		$this->load->view('general/footer', $data);
	}

	public function getsubjectbyNRP(){
		$this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('informasi_umum_model');

		if($this->session->userdata('user_type') == 'admin'){
        	$subject = $this->mahasiswa_matakuliah_model->getsubjectbyNRP($this->input->post('nrp'),  $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
		else if($this->session->userdata('user_type') == 'mahasiswa'){
			$subject = $this->mahasiswa_matakuliah_model->getsubjectbyNRP($this->session->userdata('user_id'),  $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
        echo json_encode($subject);
	}
}