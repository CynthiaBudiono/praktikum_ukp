<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('berita_model');

		$data['berita'] = $this->berita_model->getallopen();

		$data['title'] = "Berita";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "ganjil" : "genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/berita', $data);

		$this->load->view('general/footer', $data);
	}

    public function updates(){

        $id = $this->input->post('id');

        $this->load->model('berita_model');

		$res = $this->berita_model->get($id);

        // if ($res == 0) redirect('berita');

        $data['detil'] = $res;
        
        $data['title'] = "Edit berita";

        echo json_encode($data);

    }

    public function get(){

        $this->load->model('berita_model');

		$berita = $this->berita_model->getallopen();

        echo json_encode($berita);
    }

    public function add(){
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'id' => strtoupper($this->input->post('kodelab')),
            'nama' => $this->input->post('nama'),
            'quota_max' => (int) $this->input->post('quota'),
            'status' => $status
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('berita_model');
        if($this->berita_model->get($data['id']) == 0){
            // var_dump("masuk tak kembar"); exit;

        
            //check validasi
            $this->form_validation->set_data($data);
            // $this->form_validation->set_rules('id', 'ID', 'trim|required|max_length[5]');

            if ($this->form_validation->run() == FALSE) {
                $detil[0] = $data;
                echo validation_errors();
            }
            else {
                $this->load->helper(array('form', 'url'));

                $this->berita_model->add($data);

                // insert log
                $keterangan = '';
                $keterangan .= json_encode($data).'.';

                $logs_insert = array(
                    "id_user" => $this->session->userdata('user_id'),
                    "table_name" => 'berita',
                    "action" => 'CREATE',
                    "keterangan" => "a new record has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
                    "created" => date('Y-m-d H:i:s')
                );
                $this->load->model('user_history_model');
                $this->user_history_model->add($logs_insert);

                // redirect('berita');
                echo 'success';
            }
        }
        else{
            echo 'data kembar';
        }
    }

    public function update(){
        // $id = base64_decode($id);

        // var_dump("AAAAAA", $kodee); exit;
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $data = array(
            'id' => strtoupper($this->input->post('kodelab')),
            'nama' => $this->input->post('nama'),
            'quota_max' => (int) $this->input->post('quota'),
            'status' => $status
        );

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('id', 'kode lab', 'trim|required|max_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('berita_model');
            $old_data = $this->berita_model->get($data['id']);

            $this->berita_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
            $keterangan .= $old_data[0]['quota_max']. ' to '. $data['quota_max'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'berita',
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