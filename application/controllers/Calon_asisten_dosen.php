<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calon_asisten_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	}


	public function index()
	{
        if($this->session->userdata('user_type') != 'admin') redirect('dashboard');

        $this->load->model('informasi_umum_model');
		$this->load->model('calon_asisten_dosen_model');

		$data['calon_asisten_dosen'] = $this->calon_asisten_dosen_model->getallopen();

		$data['title'] = "calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/calon_asisten_dosen', $data);

		$this->load->view('general/footer', $data);
	}

    public function getactiveperiodnow(){
        $this->load->model('informasi_umum_model');
        $this->load->model('pendaftaran_asisten_dosen_model');
        $this->load->model('calon_asisten_dosen_model');
        
        $idpendaftaran = $this->pendaftaran_asisten_dosen_model->getlastactive($this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);
        // var_dump($idpendaftaran); exit;
        if($idpendaftaran != null){
            $calon_asisten_dosen = $this->calon_asisten_dosen_model->getactiveperiodnow($idpendaftaran[0]['id']);
            echo json_encode($calon_asisten_dosen);
        }
        else{
            echo "";
        }
        
        
    }

    public function getidbyactiveperiod(){
        $this->load->model('informasi_umum_model');
        $this->load->model('pendaftaran_asisten_dosen_model');
        $this->load->model('calon_asisten_dosen_model');
        
        $idpendaftaran = $this->pendaftaran_asisten_dosen_model->getlastactive($this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);
        $calon_asisten_dosen = $this->calon_asisten_dosen_model->getidbyactiveperiod($idpendaftaran[0]['id'], $this->input->post('nrp'));

        echo json_encode($calon_asisten_dosen);
    }

    public function adds(){

        $this->load->model('informasi_umum_model');

        $data['title'] = "Add calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/calon_asisten_dosen-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function updates($id = null){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $this->load->model('informasi_umum_model');

        $id = base64_decode($id);

        $this->load->model('calon_asisten_dosen_model');

		$res = $this->calon_asisten_dosen_model->get($id);

        if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;
        
        $data['title'] = "Edit calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/calon_asisten_dosen-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function add(){
        
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'NRP' => $this->input->post('nrp'),
            'id_pendaftaran_praktikum' => $this->input->post('id_pendaftaran_praktikum'),
            'upload_transkrip' => $this->input->post('upload_transkrip'),
            'upload_foto' => $this->input->post('upload_foto'),
            'gender' => $this->input->post('gender'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'line_id' => $this->input->post('line_id'),
            'ipk' => $this->input->post('ipk'),
            'motivasi' => $this->input->post('motivasi'),
            'komitmen' => $this->input->post('komitmen'),
            'kelebihan' => $this->input->post('kelebihan'),
            'kekurangan' => $this->input->post('kekurangan'),
            'pengalaman' => $this->input->post('pengalaman'),
            'status' => $status,
            'keterangan' => $this->input->post('keterangan'),
            'created' => date('Y-m-d H:i:s'),
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('calon_asisten_dosen_model');
        if($this->calon_asisten_dosen_model->get($data['id']) == 0){
            // var_dump("masuk tak kembar"); exit;

        
            //check validasi
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

            if ($this->form_validation->run() == FALSE) {
                $detil[0] = $data;
                $data['error_msg'] = validation_errors();
            }
            else {
                $this->load->helper(array('form', 'url'));

                $this->calon_asisten_dosen_model->add($data);

                // insert log
                $keterangan = '';
                $keterangan .= json_encode($data).'.';

                $logs_insert = array(
                    "id_user" => $this->session->userdata('user_id'),
                    "table_name" => 'calon_asisten_dosen',
                    "action" => 'CREATE',
                    "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                    "created" => date('Y-m-d H:i:s')
                );
                $this->load->model('user_history_model');
                $this->user_history_model->add($logs_insert);

                redirect('calon_asisten_dosen');
            }
        }
        else{
            var_dump("DATA KEMBAR"); exit;
        }
    }

    public function update(){
        // $id = base64_decode($id);

        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'id' => $this->input->post('idcalon'),
            'NRP' => $this->input->post('nrp'),
            'id_pendaftaran_praktikum' => $this->input->post('id_pendaftaran_praktikum'),
            'upload_transkrip' => $this->input->post('upload_transkrip'),
            'upload_foto' => $this->input->post('upload_foto'),
            'gender' => $this->input->post('gender'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'line_id' => $this->input->post('line_id'),
            'ipk' => $this->input->post('ipk'),
            'motivasi' => $this->input->post('motivasi'),
            'komitmen' => $this->input->post('komitmen'),
            'kelebihan' => $this->input->post('kelebihan'),
            'kekurangan' => $this->input->post('kekurangan'),
            'pengalaman' => $this->input->post('pengalaman'),
            'status' => $status,
            'keterangan' => $this->input->post('keterangan'),
            'created' => date('Y-m-d H:i:s'),
        );

        // var_dump("masuk update ", $data);

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $data['error_msg'] = validation_errors();
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('calon_asisten_dosen_model');
            // var_dump("AAAAA", $data['id']); exit;
            $old_data = $this->calon_asisten_dosen_model->get($data['id']);

            // var_dump("OLD DATA: ", $old_data); exit;
            $this->calon_asisten_dosen_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
            $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'calon_asisten_dosen',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            redirect('calon_asisten_dosen');
        }    
    }
}