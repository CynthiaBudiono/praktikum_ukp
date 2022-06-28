<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
		// var_dump($this->session->userdata('user_type')); exit;
		if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'mahasiswa'){
			$model = $this->session->userdata('from_table') . "_model";

			$this->load->model($this->session->userdata('from_table') . '_model');

			$data['profile'] = $this->$model->getprofile($this->session->userdata('user_id'));

			// var_dump($data['profile']); exit;
		}
		else if($this->session->userdata('user_type') == 'asisten_dosen' || $this->session->userdata('user_type') == 'asisten_tetap'){
			$this->load->model('asisten_model');

			$data['profile'] = $this->asisten_model->getprofile($this->session->userdata('user_id'));

		}
		else if($this->session->userdata('user_type') == 'kepala_lab'){

			$this->load->model('user_model');

			$data['profile'] = $this->user_model->getprofilekalab($this->session->userdata('user_id'));

			// var_dump($data['profile']); exit;
		}
        

		$data['title'] = "Profile";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/profile', $data);

		$this->load->view('general/footer', $data);
	}

	public function getactivitiesbydate(){

		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		// var_dump($end_date); exit;
		$this->load->model('user_history_model');

		$activities = $this->user_history_model->getbyfilter($this->session->userdata('user_id'), $start_date, $end_date);

		// var_dump($activities); exit;
		echo json_encode($activities);

	}
}