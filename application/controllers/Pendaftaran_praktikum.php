<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran_praktikum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
        // var_dump($this->session->userdata('user_type')); exit;
	    if($this->session->userdata('user_type') != 'admin' && $this->session->userdata('user_type') != 'asisten_tetap') redirect('dashboard');
	}
	
	public function index()
	{

		$this->load->model('pendaftaran_praktikum_model');

        // $data['start_date'] = date("m/d/Y");

        // $data['end_date'] = date('m/d/Y', strtotime("2 days"));

		$data['pendaftaran_praktikum'] = $this->pendaftaran_praktikum_model->getallopen();

		$data['title'] = "Pendaftaran Praktikum";

		$this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/pendaftaran_praktikum', $data);

		$this->load->view('general/footer', $data);
	}

	public function updates(){

        $id = $this->input->post('id');

        $this->load->model('pendaftaran_praktikum_model');

		$res = $this->pendaftaran_praktikum_model->get($id);

        // if ($res == 0) redirect('pendaftaran_praktikum');

        $data['detil'] = $res;
        
        $data['title'] = "Edit Pendaftaran Praktikum";

        echo json_encode($data);

    }

    public function get(){

        $this->load->model('pendaftaran_praktikum_model');

		$pendaftaran_praktikum = $this->pendaftaran_praktikum_model->getallopen();

        echo json_encode($pendaftaran_praktikum);
    }

    public function getlastrecord(){

        $this->load->model('pendaftaran_praktikum_model');

		$pendaftaran_praktikum = $this->pendaftaran_praktikum_model->getlastrecord();

        echo json_encode($pendaftaran_praktikum);
    }

    public function add(){
        $this->load->helper(array('form', 'url'));

		$this->load->model('pendaftaran_praktikum_model');
		$this->load->model('informasi_umum_model');
        
        // $status = ($this->input->post('status')=='true') ? 1 : 0;
        $getperiodpendaftaranthissemester = $this->pendaftaran_praktikum_model->getperiodpendaftaranthissemester((int)$this->input->post('ppke'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        if($getperiodpendaftaranthissemester != 0){
            echo "Periode Pendaftaran telah ada, silahkan melakukan edit pendaftaran";
            // $this->session->set_flashdata('msg', "Periode Pendaftaran telah ada, silahkan melakukan edit pendaftaran");
        }
        else{
            $data = array(
                'waktu_start' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_start'))),
                'waktu_end' => date("Y-m-d H:i:s", strtotime($this->input->post('waktu_end'))),
                'PP' => (int)$this->input->post('ppke'),
                'semester' => $this->informasi_umum_model->getsemester(),
                'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
                'status' => 1,
                // 'keterangan' => $this->input->post('keterangan')
            );
    
            // var_dump("masuk add ", $data); exit;
    
            //check validasi
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('PP', 'periode pendaftaran', 'required');
            // $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');
    
            if ($this->form_validation->run() == FALSE) {
                $detil[0] = $data;
                echo validation_errors();
            }
            else {
    
                $this->pendaftaran_praktikum_model->add($data);
    
                // insert log
                $keterangan = '';
                $keterangan .= json_encode($data).'.';
    
                $logs_insert = array(
                    "id_user" => $this->session->userdata('user_id'),
                    "table_name" => 'pendaftaran_praktikum',
                    "action" => 'CREATE',
                    "keterangan" => "a new record has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
                    "created" => date('Y-m-d H:i:s')
                );
                $this->load->model('user_history_model');
                $this->user_history_model->add($logs_insert);
    
                // redirect('pendaftaran_praktikum');
                echo 'success';
            }
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
			'PP' => (int) $this->input->post('ppke'),
			'semester' => $this->informasi_umum_model->getsemester(),
			'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => 1,
			// 'keterangan' => $this->input->post('keterangan')
        );

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('PP', 'periode pendaftaran', 'required');
		// $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('pendaftaran_praktikum_model');
            $old_data = $this->pendaftaran_praktikum_model->get($data['id']);

            $this->pendaftaran_praktikum_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['waktu_start']. ' to '. $data['waktu_start'].'; ';
            $keterangan .= $old_data[0]['waktu_end']. ' to '. $data['waktu_end'].'; ';
            $keterangan .= $old_data[0]['PP']. ' to '. $data['PP'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
            // $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'pendaftaran_praktikum',
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