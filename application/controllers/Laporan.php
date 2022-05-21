<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{
		$data['title'] = "Laporan";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan', $data);

		$this->load->view('general/footer', $data);
	}

	public function kelas()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		$data['title'] = "Laporan Kelas Praktikum";

		$data['function'] = "kelas";

		// $data['laporan'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}

	public function lulus()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		$data['title'] = "Laporan Lulus";

		$data['function'] = "lulus";

		$data['ddkelasprak'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}

	public function tidak_lulus()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		$data['title'] = "Laporan Tidak Lulus";

		$data['function'] = "tidak_lulus";

		$data['ddkelasprak'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}

	public function detail_kelas()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		$data['title'] = "Laporan Detail Kelas Praktikum";

		$data['function'] = "detail_kelas";

		// $data['laporan'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		$data['ddkelasprak'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}

	public function mahasiswa()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('jadwal_perkuliahan_model');

		$data['title'] = "Laporan Mahasiswa Praktikum";

		$data['function'] = "mahasiswa";

		$data['ddsubject'] = $this->jadwal_perkuliahan_model->getsubject($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}


	public function mahasiswa_tertolak(){
		$this->load->model('informasi_umum_model');
		$this->load->model('jadwal_perkuliahan_model');

		$data['title'] = "Laporan Mahasiswa Tertolak";

		$data['function'] = "mahasiswa_tertolak";

		// $data['laporan'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		$data['ddsubject'] = $this->jadwal_perkuliahan_model->getsubject($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}

	public function nilai_kelas()
	{
		$this->load->model('informasi_umum_model');
		$this->load->model('kelas_praktikum_model');

		$data['title'] = "Laporan Nilai Kelas Praktikum";

		$data['function'] = "nilai_kelas";

		// $data['laporan'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		$data['ddkelasprak'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/laporan-view', $data);

		$this->load->view('general/footer', $data);
	}
}