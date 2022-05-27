<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('user_model');
        $this->load->model('laboratorium_model');
        $this->load->model('dosen_model');

		$data['user'] = $this->user_model->getallopen();

		$data['title'] = "User";

        $data['laboratorium'] = $this->laboratorium_model->getactivelab();
        $data['dosen'] = $this->dosen_model->getallactive();

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/user', $data);

		$this->load->view('general/footer', $data);
	}

    // public function adds(){

    //     // $data['action'] = "add";
    //     $data['title'] = "Add User";

	// 	$this->load->view('general/header');

	// 	$this->load->view('general/sidebar');

	// 	$this->load->view('general/navbar');

	// 	$this->load->view('content/user-add', $data);

	// 	$this->load->view('general/footer');

    // }

    public function updates(){

        $id = $this->input->post('id');

        $this->load->model('user_model');

		$res = $this->user_model->get($id);

        // if ($res == 0) redirect('user');

        $data['detil'] = $res;
        
        $data['title'] = "Edit User";

        echo json_encode($data);

    }

    public function get(){

        $this->load->model('user_model');

		$user = $this->user_model->getallopen();

        echo json_encode($user);
    }

    public function add(){
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'level' => $this->input->post('level'),
            'NIP' => $this->input->post('NIP'),
            'kode_lab' => $this->input->post('kode_lab'),
            'status' => $status
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('user_model');
        //check validasi
        $this->form_validation->set_data($data);
        // $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('level', 'level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->user_model->add($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'user',
                "action" => 'CREATE',
                "keterangan" => "a new record has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            // redirect('user');
            echo 'success';
        }
    }

    public function update(){
        // $id = base64_decode($id);

        // var_dump("AAAAAA", $kodee); exit;
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'id' => $this->input->post('id'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'email' => $this->input->post('email'),
            'level' => $this->input->post('level'),
            'NIP' => $this->input->post('NIP'),
            'kode_lab' => $this->input->post('kode_lab'),
            'status' => $status
        );

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('user_model');
            $old_data = $this->user_model->get($data['id']);

            $this->user_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]. ' to '. $data.'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'user',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            echo 'success';
        }    
    }
}