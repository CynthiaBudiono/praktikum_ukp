<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ambil_praktikum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('ambil_praktikum_model');

		$data['ambil_praktikum'] = $this->ambil_praktikum_model->getallopen();

		$data['title'] = "Ambil Praktikum";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/ambil_praktikum', $data);

		$this->load->view('general/footer', $data);
	}

    public function generateadd(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('informasi_umum_model');

        $peserta = $this->mahasiswa_matakuliah_model->getpesertapraktikum($this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);

        if($peserta > 0){
            for($i = 0; $i < count($peserta); $i++){
                // cek kalo udah ada jgn ditambah datanya
                $kembar = $this->ambil_praktikum_model->get($peserta[$i]['id']);

                if($kembar == 0){
                    //ADD Ambil Praktikum

                    if($peserta[$i]['status_praktikum'] == 1){
                        $data = array(
                            'id_mahasiswa_matakuliah' => $peserta[$i]['id'],
                            'NRP' => $peserta[$i]['NRP'],
                            'kode_mk' => $peserta[$i]['kode_mk'],
                            'status' => 1,
                            'tipe' => 'praktikum',
                            'semester' => $this->informasi_umum_model->get(2)[0]['nilai'],
                            'tahun_ajaran' => $this->informasi_umum_model->get(3)[0]['nilai'],
                        );
        
                        $this->ambil_praktikum_model->add($data);
        
                        // insert log
                        $keterangan = '';
                        $keterangan .= json_encode($data).'.';
        
                        $logs_insert = array(
                            "id_user" => $this->session->userdata('user_id'),
                            "table_name" => 'ambil_praktikum',
                            "action" => 'CREATE',
                            "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                            "created" => date('Y-m-d H:i:s')
                        );
                        $this->load->model('user_history_model');
                        $this->user_history_model->add($logs_insert);
                    }

                    if($peserta[$i]['status_responsi'] == 1){
                        $data = array(
                            'id_mahasiswa_matakuliah' => $peserta[$i]['id'],
                            'NRP' => $peserta[$i]['NRP'],
                            'kode_mk' => $peserta[$i]['kode_mk'],
                            'status' => 1,
                            'tipe' => 'responsi',
                            'semester' => $this->informasi_umum_model->get(2)[0]['nilai'],
                            'tahun_ajaran' => $this->informasi_umum_model->get(3)[0]['nilai'],
                        );
        
                        $this->ambil_praktikum_model->add($data);
        
                        // insert log
                        $keterangan = '';
                        $keterangan .= json_encode($data).'.';
        
                        $logs_insert = array(
                            "id_user" => $this->session->userdata('user_id'),
                            "table_name" => 'ambil_praktikum',
                            "action" => 'CREATE',
                            "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                            "created" => date('Y-m-d H:i:s')
                        );
                        $this->load->model('user_history_model');
                        $this->user_history_model->add($logs_insert);
                    }
                    

                }
            }
            echo 'sukses';
        }
        else{
            echo 'data sudah terupdate';
        }

    }

    public function adds(){

        $data['title'] = "Add Ambil Praktikum";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/ambil_praktikum-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function updates($id = null){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $id = base64_decode($id);

        $this->load->model('ambil_praktikum_model');

		$res = $this->ambil_praktikum_model->get($id);

        if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;
        
        $data['title'] = "Edit ambil_praktikum";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/ambil_praktikum-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function add(){
        // var_dump("AAAAAAAAAAAA"); exit;
        $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');
        
        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'nama' => $this->input->post('nama'),
            'status' => $status,
            'keterangan' => $this->input->post('keterangan'),
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('ambil_praktikum_model');
       
        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->ambil_praktikum_model->add($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'ambil_praktikum',
                "action" => 'CREATE',
                "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            redirect('ambil_praktikum');
        }
    }

    public function update(){
        // $id = base64_decode($id);

        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'id' => $this->input->post('idambilpraktikum'),
            'nama' => $this->input->post('nama'),
            'status' => $status,
            'keterangan' => $this->input->post('keterangan'),
            "updated" => date('Y-m-d H:i:s')
        );

        // var_dump("masuk update ", $data);

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
            // var_dump("LOHH MASUK SINI"); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('ambil_praktikum_model');
            // var_dump("AAAAA", $data['id']); exit;
            $old_data = $this->ambil_praktikum_model->get($data['id']);

            // var_dump("OLD DATA: ", $old_data); exit;
            $this->ambil_praktikum_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
            $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'ambil_praktikum',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            redirect('ambil_praktikum');
        }    
    }
}