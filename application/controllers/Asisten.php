<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asisten extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('informasi_umum_model');
		$this->load->model('asisten_model');

		// $data['asisten'] = $this->asisten_model->getallopen();

		$data['title'] = "Asisten";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/asisten', $data);

		$this->load->view('general/footer', $data);
	}

    public function getallopen(){
        $this->load->model('asisten_model');

        $asisten = $this->asisten_model->getallopen();

        echo json_encode($asisten);
    }

    public function getdetail(){

        $this->load->model('asisten_model');

        var_dump($this->input->post('nrp')); exit;
		$asisten = $this->asisten_model->getlastrecord($this->input->post('nrp'));

        echo json_encode($asisten);
    }

	public function adds(){

        $data['title'] = "Add asisten";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/asisten-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function updates(){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $id = $this->input->post('id');

        $this->load->model('asisten_model');

		$res = $this->asisten_model->get($id);

        // if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;
        
        $data['title'] = "Edit asisten";

        echo json_encode($data);
        
    }

    public function add(){
        // var_dump("AAAAAAAAAAAA"); exit;
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $this->load->model('calon_asisten_dosen_model');
        $get = $this->calon_asisten_dosen_model->getbynrp($this->input->post('nrp'));

        $data = array(
            'NRP' => $this->input->post('nrp'),
            'id_calon_asisten_dosen' => $get[0]['id'],
            'tipe' => $this->input->post('tipe'),
            'tanggal_diterima' => $this->input->post('tanggal_diterima'),
            'status' => $status,
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('asisten_model');
        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('NRP', 'nrp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->asisten_model->add($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'asisten',
                "action" => 'CREATE',
                "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            echo 'success';
        }
    }

    public function update(){
        // $id = base64_decode($id);

        $status = ($this->input->post('status')=='true') ? 1 : 0;

        $this->load->model('calon_asisten_dosen_model');
        $get = $this->calon_asisten_dosen_model->getbynrp($this->input->post('nrp'));

        $data = array(
            'id' => (int)$this->input->post('id'),
            'id_calon_asisten_dosen' => $get[0]['id'],
            'NRP' => $this->input->post('nrp'),
            'tipe' => $this->input->post('tipe'),
            'tanggal_diterima' => $this->input->post('tanggal_diterima'),
            'status' => $status,
        );

        // var_dump("masuk update ", $data['id']); //exit;

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('id', 'id', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('asisten_model');
            // var_dump("AAAAA", $data['id']); exit;
            $old_data = $this->asisten_model->get($data['id']);

            // var_dump("OLD DATA: ", $old_data); exit;
            $this->asisten_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['NRP']. ' to '. $data['NRP'].'; ';
            $keterangan .= $old_data[0]['tipe']. ' to '. $data['tipe'].'; ';
            $keterangan .= $old_data[0]['tanggal_diterima']. ' to '. $data['tanggal_diterima'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'asisten',
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