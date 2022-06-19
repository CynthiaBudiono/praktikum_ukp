<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal_berhalangan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		// $this->load->model('jadwal_berhalangan_model');

		// $data['jadwal_berhalangan'] = $this->jadwal_berhalangan_model->getallopen();
        if($this->session->userdata('user_type') == 'mahasiswa') redirect('dashboard');

        $this->load->model('kelas_praktikum_model');
        $this->load->model('dosen_model');
        $this->load->model('asisten_model');
        $this->load->model('informasi_umum_model');

        $pengajar = array();

        // $data['pengajar'] = $this->kelas_praktikum_model->getpengajar($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        // if($data['pengajar'] != 0){ //kalo kelas praktikum sudah di input
        //     for($i = 0; $i < count($data['pengajar']); $i++){
        //         for($j = 1; $j <= 3; $j++){
        //             if($data['pengajar'][$i]['NIP'.$j] != NULL){
        //                 $kembar = false;
        //                 for($k = 0; $k < count($pengajar); $k++){
        //                     if($pengajar[$k]['kode_pengajar'] == $data['pengajar'][$i]['NIP'.$j]){
        //                         $kembar = true;
        //                     }
        //                 }
                        
        //                 if(!$kembar){
        //                     array_push($pengajar, array(
        //                         'kode_pengajar' => $data['pengajar'][$i]['NIP'.$j],
        //                         'nama' => $data['pengajar'][$i]['nama_dosen'.$j],
        //                         'role' => 'Dosen',
        //                         'status' => $data['pengajar'][$i]['status_dosen'.$j],
        //                         'last_login' => $data['pengajar'][$i]['last_login_dosen'.$j],
        //                     ));
        //                 }
                       
        //             }
        //             if($data['pengajar'][$i]['NRP'.$j] != NULL){

        //                 $kembar = false;
        //                 for($k = 0; $k < count($pengajar); $k++){
        //                     if($pengajar[$k]['kode_pengajar'] == $data['pengajar'][$i]['NRP'.$j]){
        //                         $kembar = true;
        //                     }
        //                 }

        //                 if(!$kembar){
        //                     array_push($pengajar, array(
        //                         'kode_pengajar' => $data['pengajar'][$i]['NRP'.$j],
        //                         'nama' => $data['pengajar'][$i]['nama_mahasiswa'.$j],
        //                         'role' => 'Mahasiswa',
        //                         'status' => $data['pengajar'][$i]['status_mahasiswa'.$j],
        //                         'last_login' => $data['pengajar'][$i]['last_login_mahasiswa'.$j],
        //                     ));
        //                 }
        //             }
        //         }
        //     }
        // }
        // else{
            $data['pengajar'] = $this->dosen_model->getallopen();
            if($data['pengajar'] != 0){
                for($i = 0; $i < count($data['pengajar']); $i++){
                    array_push($pengajar, array(
                        'kode_pengajar' => $data['pengajar'][$i]['NIP'],
                        'nama' => $data['pengajar'][$i]['nama'],
                        'role' => 'Dosen',
                        'status' => $data['pengajar'][$i]['status'],
                        'last_login' => $data['pengajar'][$i]['last_login'],
                    ));     
                } 
            }
            $data['pengajar'] = $this->asisten_model->getallopen();
            if($data['pengajar'] != 0){
                for($i = 0; $i < count($data['pengajar']); $i++){
                    array_push($pengajar, array(
                        'kode_pengajar' => $data['pengajar'][$i]['NRP'],
                        'nama' => $data['pengajar'][$i]['nama_mahasiswa'],
                        'role' => 'Mahasiswa',
                        'status' => $data['pengajar'][$i]['status_mahasiswa'],
                        'last_login' => $data['pengajar'][$i]['last_login_mahasiswa'],
                    ));     
                }
            }
            // var_dump(count($data['pengajar'])); exit;
        // }


        // var_dump($pengajar[0]['nama']); exit;  
        $data['pengajar'] = $pengajar;

		$data['title'] = "Jadwal Berhalangan";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/jadwal_berhalangan', $data);

		$this->load->view('general/footer', $data);
	}

    public function getnabrakpengajar(){
        $this->load->model('jadwal_berhalangan_model');
        $this->load->model('jadwal_perkuliahan_model');
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');
        $this->load->model('dosen_model');
        $this->load->model('mahasiswa_matakuliah_model');
    
        $getdosen = $this->dosen_model->get($this->input->post('pengajar'));
        if($getdosen != 0){ //DOSEN
            $jadwal_perkuliahan = $this->jadwal_perkuliahan_model->getnabrakjadwalperkuliahan($this->input->post('pengajar'), $this->input->post('hari'), $this->input->post('jam'), $this->input->post('durasi'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        }
        else{ //MAHASISWA
            $jadwal_perkuliahan = $this->mahasiswa_matakuliah_model->getnabrakmahasiswamatakuliah($this->input->post('pengajar'), $this->input->post('hari'), $this->input->post('jam'), $this->input->post('durasi'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
            // var_dump($jadwal_perkuliahan); exit;
        }
        
        $jadwal_berhalangan = $this->jadwal_berhalangan_model->getnabrakjadwalberhalangan($this->input->post('pengajar'), $this->input->post('hari'), $this->input->post('jam'), $this->input->post('durasi'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        $jadwal_praktikum = $this->kelas_praktikum_model->getnabrakkelaspraktikum($this->input->post('pengajar'), $this->input->post('hari'), $this->input->post('jam'), $this->input->post('durasi'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        // var_dump($jadwal_berhalangan); exit;
        // var_dump($jadwal_perkuliahan); exit;
        //hasil cuman yes and no
        // kalo 2 2 nya no is no kalo salah satu yes is yes
        $hasil = "";
        if($jadwal_perkuliahan == "yes" || $jadwal_berhalangan == "yes" || $jadwal_praktikum == "yes"){
            $hasil = "yes";
        }
        else{
            $hasil = "no";
        }

        // echo json_encode($hasil);
        echo $hasil;
    }

    public function getjadwal(){
        $this->load->model('jadwal_berhalangan_model');
        $this->load->model('informasi_umum_model');
    
        $this->input->post('id_pengajar');

        $jadwal_berhalangan = $this->jadwal_berhalangan_model->getbypengajar($this->input->post('pengajar'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($jadwal_berhalangan);
    }

    public function getbyNIP(){
        $this->load->model('jadwal_berhalangan_model');
        $this->load->model('informasi_umum_model');
    
        // $this->input->post('id_pengajar');

        // var_dump($this->input->post('NIP')); exit;
        $jadwal_berhalangan = $this->jadwal_berhalangan_model->getbyNIP($this->input->post('pengajar'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($jadwal_berhalangan);
    }

    public function adds($kode_pengajar, $role){
        $kode_pengajar = base64_decode($kode_pengajar);
        $role = base64_decode($role);

        // var_dump($kode_pengajar, $role); exit;

        // jgn lupa pengecekan usergroup SELAIN role hanya mahasiswa bisa masuk 

        $this->load->model('dosen_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('jadwal_berhalangan_model');
        $this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('jadwal_perkuliahan_model');
        $this->load->model('informasi_umum_model');

        if($role == "Mahasiswa"){ //MAHASISWA
            $data['getinfo'] = $this->mahasiswa_model->get($kode_pengajar);
            // $data['jadwal'] = $this->mahasiswa_matakuliah_model->getbyNRP($kode_pengajar);
        }
        else if($role == "Dosen"){ //DOSEN
            $data['getinfo'] = $this->dosen_model->get($kode_pengajar);
            // $data['jadwal'] = $this->jadwal_perkuliahan_model->getbyNIP($kode_pengajar);
        }

        $data['primary'] = $kode_pengajar;
        $data['role'] = $role;

        // var_dump($data['jadwal']);exit;
        $data['title'] = "Add Jadwal Berhalangan";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/jadwal_berhalangan-add', $data);

		$this->load->view('general/footer', $data);

    }

    // public function updates($id = null){

    //     // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
	// 	// if ($check == 0) redirect('dashboard');

    //     $id = base64_decode($id);

    //     $this->load->model('jadwal_berhalangan_model');

	// 	$res = $this->jadwal_berhalangan_model->get($id);

    //     if ($res == 0) redirect('dashboard');

    //     $data['detil'] = $res;
        
    //     $data['title'] = "Edit jadwal_berhalangan";

    //     $this->load->model('informasi_umum_model');
		
	// 	$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
	// 	$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
	// 	$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
	// 	$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
	// 	$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

	// 	$this->load->view('general/header');

	// 	$this->load->view('general/sidebar', $data);

	// 	$this->load->view('general/navbar', $data);

	// 	$this->load->view('content/jadwal_berhalangan-add', $data);

	// 	$this->load->view('general/footer', $data);

    // }

    public function add(){
        // var_dump("AAAAAAAAAAAA"); exit;
        $this->load->helper(array('form', 'url'));
        $this->load->model('informasi_umum_model');
        // $this->load->library('form_validation');
        
        // $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'pengajar_id' => $this->input->post('pengajar_id'),
            'role' => strtolower($this->input->post('role')),
            'hari' => $this->input->post('hari'),
            'jam' => $this->input->post('jam'),
            'durasi' => 60,
            'semester' => $this->informasi_umum_model->getsemester(), 
            'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => 1,
            // 'keterangan' => $this->input->post('keterangan'),
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('jadwal_berhalangan_model');
        
        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('pengajar_id', 'pengajar ID', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->jadwal_berhalangan_model->add($data);

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'jadwal_berhalangan',
                "action" => 'CREATE',
                "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            echo "sukses";
            // redirect('jadwal_berhalangan');
        }
    }

    public function delete(){
        // var_dump("AAAAAAAAAAAA"); exit;
        $this->load->helper(array('form', 'url'));
        $this->load->model('informasi_umum_model');
        // $this->load->library('form_validation');
        
        // $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'pengajar_id' => $this->input->post('pengajar_id'),
            'role' => strtolower($this->input->post('role')),
            'hari' => $this->input->post('hari'),
            'jam' => $this->input->post('jam'),
            'durasi' => 60,
            'semester' => $this->informasi_umum_model->getsemester(), 
            'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => 1,
            // 'keterangan' => $this->input->post('keterangan'),
        );

        // var_dump("masuk add ", $data); exit;

        $this->load->model('jadwal_berhalangan_model');
        
        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('pengajar_id', 'pengajar ID', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');
        $this->form_validation->set_rules('hari', 'Hari', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
        }
        else {
            $this->load->helper(array('form', 'url'));

            $id = $this->jadwal_berhalangan_model->getID($data)[0]['id'];

            // var_dump($id); exit;

            $this->jadwal_berhalangan_model->delete($id); 

            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'.';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'jadwal_berhalangan',
                "action" => 'DELETE',
                "keterangan" => $this->session->userdata('logged_name')." deleted record " . $id . ": ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            echo "sukses";
            // redirect('jadwal_berhalangan');
        }
    }

    // public function update(){
    //     // $id = base64_decode($id);

    //     $status = ($this->input->post('status')=='on') ? 1 : 0;

    //     $data = array(
    //         'id' => $this->input->post('idusergroup'),
    //         'nama' => $this->input->post('nama'),
    //         'status' => $status,
    //         'keterangan' => $this->input->post('keterangan'),
    //         "updated" => date('Y-m-d H:i:s')
    //     );

    //     // var_dump("masuk update ", $data);

    //     //check validasi
    //     $this->form_validation->set_data($data);
    //     $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|max_length[65535]');

    //     if ($this->form_validation->run() == FALSE) {
    //         $detil[0] = $data;
    //         $this->adds(validation_errors(), $detil);
    //         // var_dump("LOHH MASUK SINI"); exit;
    //     }
    //     else {
    //         $this->load->helper(array('form', 'url'));

    //         $this->load->model('jadwal_berhalangan_model');
    //         // var_dump("AAAAA", $data['id']); exit;
    //         $old_data = $this->jadwal_berhalangan_model->get($data['id']);

    //         // var_dump("OLD DATA: ", $old_data); exit;
    //         $this->jadwal_berhalangan_model->update($data);

    //         // insert log
    //         $keterangan = '';
    //         $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
    //         $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
    //         $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

    //         $logs_insert = array(
    //             "id_user" => $this->session->userdata('user_id'),
    //             "table_name" => 'jadwal_berhalangan',
    //             "action" => 'UPDATE',
    //             "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
    //             "created" => date('Y-m-d H:i:s')
    //         );
    //         $this->load->model('user_history_model');
    //         $this->user_history_model->add($logs_insert);

    //         redirect('jadwal_berhalangan');
    //     }    
    // }
}