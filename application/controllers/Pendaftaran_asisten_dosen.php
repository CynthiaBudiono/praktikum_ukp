<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pendaftaran_asisten_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}
	
	public function index()
	{

		$this->load->model('pendaftaran_asisten_dosen_model');

        // $data['start_date'] = date("m/d/Y");

        // $data['end_date'] = date('m/d/Y', strtotime("2 days"));

		$data['pendaftaran_asisten_dosen'] = $this->pendaftaran_asisten_dosen_model->getallopen();

		$data['title'] = "Lowongan Asisten Dosen";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/pendaftaran_asisten_dosen', $data);

		$this->load->view('general/footer', $data);
	}

	public function updates(){

        $id = $this->input->post('id');

        $this->load->model('pendaftaran_asisten_dosen_model');

		$res = $this->pendaftaran_asisten_dosen_model->get($id);

        // if ($res == 0) redirect('pendaftaran_asisten_dosen');

        $data['detil'] = $res;
        
        $data['title'] = "Edit Periode Lowongan Asisten Dosen";

        echo json_encode($data);

    }

    public function get(){

        $this->load->model('pendaftaran_asisten_dosen_model');

		$pendaftaran_asisten_dosen = $this->pendaftaran_asisten_dosen_model->getallopen();

        echo json_encode($pendaftaran_asisten_dosen);
    }

    public function getlastrecord(){

        $this->load->model('pendaftaran_asisten_dosen_model');

		$pendaftaran_asisten_dosen = $this->pendaftaran_asisten_dosen_model->getlastrecord();

        echo json_encode($pendaftaran_asisten_dosen);
    }

    public function add(){
        $this->load->helper(array('form', 'url'));

		$this->load->model('pendaftaran_asisten_dosen_model');
		$this->load->model('informasi_umum_model');
        
        // $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'waktu_start' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_start'))),
            'waktu_end' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_end'))),
			'semester' => $this->informasi_umum_model->getsemester(),
			'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => 1,
			'keterangan' => $this->input->post('keterangan')
        );

        // var_dump("masuk add ", $data); exit;

		//check validasi
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

		if ($this->form_validation->run() == FALSE) {
			$detil[0] = $data;
			echo validation_errors();
		}
		else {

			$this->pendaftaran_asisten_dosen_model->add($data);

			// insert log
			$keterangan = '';
			$keterangan .= json_encode($data).'.';

			$logs_insert = array(
				"id_user" => $this->session->userdata('user_id'),
				"table_name" => 'pendaftaran_asisten_dosen',
				"action" => 'CREATE',
				"keterangan" => "a new record has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
				"created" => date('Y-m-d H:i:s')
			);
			$this->load->model('user_history_model');
			$this->user_history_model->add($logs_insert);

			// redirect('pendaftaran_asisten_dosen');
			echo 'success';
		}
    }

    public function update(){
        // $id = base64_decode($id);

        // var_dump("AAAAAA", $kodee); exit;
        $this->load->model('informasi_umum_model');

        // $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'id' => strtoupper($this->input->post('id')),
            'waktu_start' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_start'))),
            'waktu_end' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_end'))),
			'semester' => $this->informasi_umum_model->getsemester(),
			'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => 1,
			'keterangan' => $this->input->post('keterangan')
        );

        //check validasi
        $this->form_validation->set_data($data);
		$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('pendaftaran_asisten_dosen_model');
            $old_data = $this->pendaftaran_asisten_dosen_model->get($data['id']);

            $this->pendaftaran_asisten_dosen_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['waktu_start']. ' to '. $data['waktu_start'].'; ';
            $keterangan .= $old_data[0]['waktu_end']. ' to '. $data['waktu_end'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
            $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'pendaftaran_asisten_dosen',
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