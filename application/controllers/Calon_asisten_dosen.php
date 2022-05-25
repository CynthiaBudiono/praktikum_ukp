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
        $this->load->model('asisten_model');

		$data['calon_asisten_dosen'] = $this->calon_asisten_dosen_model->getallopen();

        for($i = 0; $i < count($data['calon_asisten_dosen']); $i++){
            $cek = $this->asisten_model->getbyNRP($data['calon_asisten_dosen'][$i]['NRP']);

            if($cek != 0){
                $data['calon_asisten_dosen'][$i]['asisten'] = "ada";
            }
            else{
                $data['calon_asisten_dosen'][$i]['asisten'] = "tidak_ada";
            }

        }
        
		$data['title'] = "calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/calon_asisten_dosen', $data);

		$this->load->view('general/footer', $data);
	}

    public function getdetail($nrp = null){
        // if($this->session->userdata('user_type') != 'mahasiswa') redirect('dashboard');

        $this->load->model('informasi_umum_model');
		$this->load->model('calon_asisten_dosen_model');

        if($nrp != null){
            $res = $this->calon_asisten_dosen_model->getbynrp($nrp);
        }
        else{
            $res = $this->calon_asisten_dosen_model->getbynrp($this->session->userdata('user_id'));
        }
        
        if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;

        $data['primary'] = $res[0]['id'];

		$data['title'] = "Data calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/calon_asisten_dosen-view', $data);

		$this->load->view('general/footer', $data);
    }

    public function getdaftarasdos(){
        $this->load->model('calon_asisten_dosen_model');
        
        $calon_asisten_dosen = $this->calon_asisten_dosen_model->getdaftarasdos();

        echo json_encode($calon_asisten_dosen);
    }

    public function getactiveperiodnow(){
        $this->load->model('informasi_umum_model');
        $this->load->model('pendaftaran_asisten_dosen_model');
        $this->load->model('calon_asisten_dosen_model');
        
        $idpendaftaran = $this->pendaftaran_asisten_dosen_model->getlastactive($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
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
        
        $idpendaftaran = $this->pendaftaran_asisten_dosen_model->getlastactive($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        $calon_asisten_dosen = $this->calon_asisten_dosen_model->getidbyactiveperiod($idpendaftaran[0]['id'], $this->input->post('nrp'));

        echo json_encode($calon_asisten_dosen);
    }

    public function adds(){

        if($this->session->userdata('user_type') == 'dosen' || $this->session->userdata('user_type') == 'asisten_tetap') redirect('dashboard');

        $this->load->model('informasi_umum_model');
        $this->load->model('pendaftaran_asisten_dosen_model');

        if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'kepala_lab'){
            $data["bukapendaftaran"] = "buka";
        }
        else{ //MAHASISWA / DOSEN
            $data["bukapendaftaran"] = $this->pendaftaran_asisten_dosen_model->cekbukapendaftaran();
        }

        // var_dump($data["bukapendaftaran"]); exit;

        $data['title'] = "Add calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
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

        $data['primary'] = $id;
        
        $data['title'] = "Edit calon asisten dosen";

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
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
        $this->load->model('calon_asisten_dosen_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('informasi_umum_model');

        $getmahasiswa = $this->mahasiswa_model->get(strtoupper($this->input->post('nrp')));

        if($getmahasiswa != 0){
            $data = array(
                'NRP' => strtoupper($this->input->post('nrp')),
                // 'id_pendaftaran_praktikum' => $this->input->post('id_pendaftaran_praktikum'),
                'gender' => $this->input->post('gender'),
                'alamat' => $this->input->post('alamat'),
                'no_hp' => $this->input->post('nohp'),
                'line_id' => $this->input->post('lineid'),
                // 'ipk' => $getmahasiswa[0]['ipk'],
                'motivasi' => $this->input->post('motivasi'),
                'komitmen' => $this->input->post('komitmen'),
                'kelebihan' => $this->input->post('kelebihan'),
                'kekurangan' => $this->input->post('kekurangan'),
                'pengalaman' => $this->input->post('pengalaman'),
                'status' => 1,
                // 'keterangan' => $this->input->post('keterangan'),
                'created' => date('Y-m-d H:i:s'),
                "semester"      => $this->informasi_umum_model->getsemester(),
                "tahun_ajaran"  => $this->informasi_umum_model->gettahunajaran(),
            );
    
            // var_dump("masuk add ", $data); exit;
    
            
            //check validasi
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('NRP', 'NRP', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                $detil[0] = $data;
                $data['error_msg'] = validation_errors();
            }
            else {
                $this->load->helper(array('form', 'url'));
    
                $this->calon_asisten_dosen_model->add($data);
    
                $lastid = $this->calon_asisten_dosen_model->getlastid();
                // var_dump($_FILES['logo_web']['name']);
                if((!empty($_FILES)) && !empty($_FILES['berkas']['name'])) {
                    $this->load->helper(array('form', 'url'));
                    $nama_berkas = "berkas-".$data['NRP']."-".date('YmdHis');
                    $config['upload_path']          = './assets/berkas/';
                    $config['allowed_types']        = 'pdf';
                    $config['file_name']            = $nama_berkas;
                    $config['overwrite']            = true;
                    // $config['max_size']             = 1024; // 1MB
    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
    
                    if ( ! $this->upload->do_upload('berkas')){
                        echo $this->upload->display_errors();
                    }
                    else{
                        $name_berkas = $this->upload->data('file_name');
    
                        // unlink('./assets/berkas/'.$old_data[0]['nilai']);
                    }
    
                    $data_insert = array(
                        "id" => $lastid,
                        "upload_berkas" => $name_berkas
                    );
    
                    $this->calon_asisten_dosen_model->update($data_insert);
                    // var_dump("berhasil ", $name_foto_logo, " aaa ", $this->upload->data('file_name')); exit;
                }
    
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
            echo "NRP TIDAK VALID";
        }
        
    }

    public function update(){
        // $id = base64_decode($id);

        // $getmahasiswa = $this->mahasiswa_model->get(strtoupper($this->input->post('nrp')));

        $data = array(
            'id' => $this->input->post('idcalon'),
            'NRP' => strtoupper($this->input->post('nrp')),
            // 'id_pendaftaran_praktikum' => $this->input->post('id_pendaftaran_praktikum'),
            'gender' => $this->input->post('gender'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('nohp'),
            'line_id' => $this->input->post('lineid'),
            // 'ipk' => $getmahasiswa[0]['ipk'],
            'motivasi' => $this->input->post('motivasi'),
            'komitmen' => $this->input->post('komitmen'),
            'kelebihan' => $this->input->post('kelebihan'),
            'kekurangan' => $this->input->post('kekurangan'),
            'pengalaman' => $this->input->post('pengalaman'),
            'status' => 1,
            // 'keterangan' => $this->input->post('keterangan'),
            'created' => date('Y-m-d H:i:s'),
            "semester"      => $this->informasi_umum_model->getsemester(),
            "tahun_ajaran"  => $this->informasi_umum_model->gettahunajaran(),
        );

        // var_dump("masuk update ", $data);

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('NRP', 'NRP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $data['error_msg'] = validation_errors();
        }
        else {
            $this->load->helper(array('form', 'url'));
            $this->load->helper(array('form', 'url'));

            $this->load->model('calon_asisten_dosen_model');
            // var_dump("AAAAA", $data['id']); exit;
            $old_data = $this->calon_asisten_dosen_model->get($data['id']);

            // var_dump("OLD DATA: ", $old_data); exit;
            $this->calon_asisten_dosen_model->update($data);

            // var_dump($_FILES['logo_web']['name']);
            if((!empty($_FILES)) && !empty($_FILES['berkas']['name'])) {
                $this->load->helper(array('form', 'url'));
                $nama_berkas = "berkas-".$data['NRP']."-".date('YmdHis');
                $config['upload_path']          = './assets/berkas/';
                $config['allowed_types']        = 'pdf';
                $config['file_name']            = $nama_berkas;
                $config['overwrite']            = true;
                // $config['max_size']             = 1024; // 1MB

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('berkas')){
                    echo $this->upload->display_errors();
                }
                else{
                    $name_berkas = $this->upload->data('file_name');

                    unlink('./assets/berkas/'.$old_data[0]['nilai']);
                }

                $data_insert = array(
                    "id" => $data['id'],
                    "upload_berkas" => $name_berkas
                );

                $this->calon_asisten_dosen_model->update($data_insert);
                // var_dump("berhasil ", $name_foto_logo, " aaa ", $this->upload->data('file_name')); exit;
            }
            

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]. ' to '. $data.'; ';

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