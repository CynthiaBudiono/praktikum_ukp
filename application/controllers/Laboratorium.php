<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laboratorium extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        //if($this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('laboratorium_model');

		$data['laboratorium'] = $this->laboratorium_model->getallopen();

		$data['title'] = "Laboratorium";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/laboratorium', $data);

		$this->load->view('general/footer');
	}

    public function adds(){

        // $data['action'] = "add";
        $data['title'] = "Add Laboratorium";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/laboratorium-add', $data);

		$this->load->view('general/footer');

    }

    public function updates($kode_lab = null){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $kode_lab = base64_decode($kode_lab);

        $this->load->model('laboratorium_model');

		$res = $this->laboratorium_model->get($kode_lab);

        if ($res == 0) redirect('dashboard');

        $data['primary'] = $kode_lab;

        $data['detil'] = $res;
        
        $data['title'] = "Edit Laboratorium";

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/laboratorium-add', $data);

		$this->load->view('general/footer');

    }

    public function add(){
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'kode_lab' => strtoupper($this->input->post('kodelab')),
            'nama' => $this->input->post('nama'),
            'quota_max' => (int) $this->input->post('quota'),
            'status' => $status
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('laboratorium_model');
        if($this->laboratorium_model->get($data['kode_lab']) == 0){
            // var_dump("masuk tak kembar"); exit;

        
            //check validasi
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('kode_lab', 'kode lab', 'trim|required|max_length[5]');

            if ($this->form_validation->run() == FALSE) {
                $detil[0] = $data;
                $this->adds(validation_errors(), $detil);
            }
            else {
                $this->load->helper(array('form', 'url'));

                $this->laboratorium_model->add($data);

                // insert log
                $keterangan = '';
                $keterangan .= json_encode($data).'.';

                $logs_insert = array(
                    "id_user" => 1,
                    "table_name" => 'laboratorium',
                    "action" => 'CREATE',
                    "keterangan" => "a new record has been created by admin : ".$keterangan,
                    "created" => date('Y-m-d H:i:s')
                );
                $this->load->model('user_history_model');
                $this->user_history_model->add($logs_insert);

                redirect('laboratorium');
            }
        }
        else{
            var_dump("DATA KEMBAR"); exit;
        }
    }
}