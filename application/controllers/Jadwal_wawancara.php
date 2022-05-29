<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_wawancara extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('jadwal_wawancara_model');

		$data['jadwal_wawancara'] = $this->jadwal_wawancara_model->getallopen();

		$data['title'] = "Jadwal Wawancara";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/jadwal_wawancara', $data);

		$this->load->view('general/footer', $data);
	}

    // public function adds(){

    //     // $data['action'] = "add";
    //     $data['title'] = "Add Jadwal Wawancara";

	// 	$this->load->view('general/header');

	// 	$this->load->view('general/sidebar');

	// 	$this->load->view('general/navbar');

	// 	$this->load->view('content/jadwal_wawancara-add', $data);

	// 	$this->load->view('general/footer');

    // }

    public function updates(){

        $id = $this->input->post('id');

        $this->load->model('jadwal_wawancara_model');

		$res = $this->jadwal_wawancara_model->get($id);

        // if ($res == 0) redirect('jadwal_wawancara');

        $data['detil'] = $res;
        
        $data['title'] = "Edit Jadwal Wawancara";

        echo json_encode($data);

    }

    // public function get(){

    //     $this->load->model('jadwal_wawancara_model');

	// 	$jadwal_wawancara = $this->jadwal_wawancara_model->getwithjoin("", "");

    //     echo json_encode($jadwal_wawancara);
    // }

    public function getallbelumketerima(){
        $this->load->model('jadwal_wawancara_model');

		$jadwal_wawancara = $this->jadwal_wawancara_model->getallbelumketerima();

        echo json_encode($jadwal_wawancara);
    }

    public function getallhistory(){
        $this->load->model('jadwal_wawancara_model');

		$jadwal_wawancara = $this->jadwal_wawancara_model->getallhistory();

        echo json_encode($jadwal_wawancara);
    }

    // public function getperiodnow(){

    //     $this->load->model('informasi_umum_model');
    //     $this->load->model('jadwal_wawancara_model');

	// 	$jadwal_wawancara = $this->jadwal_wawancara_model->getwithjoin($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

    //     echo json_encode($jadwal_wawancara);
    // }

    public function add(){
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $data = array(
            'NIP' => $this->input->post('id_dosen'),
            'id_calon_asisten_dosen' => $this->input->post('id_calon'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan')
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('jadwal_wawancara_model');
        
        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('NIP', 'Dosen', 'required');
        $this->form_validation->set_rules('id_calon_asisten_dosen', 'Calon Dosen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->jadwal_wawancara_model->add($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'jadwal_wawancara',
                "action" => 'CREATE',
                "keterangan" => "a new record has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            // redirect('jadwal_wawancara');
            echo 'success';
        }
    }

    public function update(){
        // $id = base64_decode($id);

        // var_dump("AAAAAA", $kodee); exit;
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'id' => $this->input->post('id'),
            'NIP' => $this->input->post('id_dosen'),
            'id_calon_asisten_dosen' => $this->input->post('id_calon'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan')
        );

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('NIP', 'Dosen', 'required');
        $this->form_validation->set_rules('id_calon_asisten_dosen', 'Calon Dosen', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('jadwal_wawancara_model');
            $old_data = $this->jadwal_wawancara_model->get($data['id']);

            $this->jadwal_wawancara_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($old_data). ' to '. json_encode($data).'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'jadwal_wawancara',
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