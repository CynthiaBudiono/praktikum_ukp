<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	}

	public function index()
	{

		$this->load->model('informasi_umum_model');
		$this->load->model('berita_model');
		$this->load->model('kelas_praktikum_model');
		$this->load->model('ambil_praktikum_model');

		$data['berita'] = $this->berita_model->getshowberita();

		
		if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'kepala_lab' || $this->session->userdata('user_type') == 'asisten_tetap'){
			$data['count_mahasiswa_daftar'] = $this->ambil_praktikum_model->countpendaftar($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
			$data['count_mahasiswa_ikut_praktikum'] = $this->ambil_praktikum_model->countpeserta($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
		else if($this->session->userdata('user_type') == 'mahasiswa' || $this->session->userdata('user_type') == 'asisten_dosen'){
			$data['kelas_praktikum_mahasiswa'] = $this->ambil_praktikum_model->getkelaspraktikummahasiswa($this->session->userdata('user_id'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
			$data['mahasiswa_tertolak'] = $this->ambil_praktikum_model->getmahasiswatertolakall($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		}
		

		// var_dump($data['count_mahasiswa_daftar']);
		// var_dump($data['count_mahasiswa_ikut_praktikum']); exit;
		$data['recent_activities_lab'] = $this->kelas_praktikum_model->getrecentactivitieslab($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/dashboard', $data);

		$this->load->view('general/footer', $data);
	}
}