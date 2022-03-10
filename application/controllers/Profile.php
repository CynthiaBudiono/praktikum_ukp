<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
        $model = $this->session->userdata('from_table') . "_model";

        // var_dump($model); exit;
		$this->load->model($this->session->userdata('from_table') . '_model');
        $this->load->model('user_history_model');

		$data['profile'] = $this->$model->getprofile($this->session->userdata('user_id'));

        $data['activities'] = $this->user_history_model->getbyIDuser($this->session->userdata('user_id'));

        // var_dump($data['profile']); exit;

		$data['title'] = "Profile";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/profile', $data);

		$this->load->view('general/footer');
	}
}