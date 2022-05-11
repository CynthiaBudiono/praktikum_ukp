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

		// $data['ambil_praktikum'] = $this->ambil_praktikum_model->getallopen();

		$data['title'] = "Ambil Praktikum";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/ambil_praktikum', $data);

		$this->load->view('general/footer', $data);
	}

    public function getclassgroup(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');
        $this->load->model('kelas_praktikum_model');

        $getsubject = $this->kelas_praktikum_model->getactive_subject($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        // var_dump(count($getsubject));
        // $ambil_praktikum = $getsubject;
        for($i = 0; $i < count($getsubject); $i++){
            $getsubject[$i]['kelas_praktikum']  = $this->kelas_praktikum_model->getactive_kelaspraktikum($getsubject[$i]['kode_mk'], "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            if($getsubject[$i]['status_praktikum'] == 1){
                $getsubject[$i]['data_mahasiswa'] = $this->ambil_praktikum_model->getdetailkelas($getsubject[$i]['kode_mk'], "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                // $nyoba = $this->ambil_praktikum_model->getnabrak('C14180210', 'Senin', '19:35:00', '110', '2', '2021-2022');
                // var_dump($nyoba); exit;
               
                for($j = 0; $j < count($getsubject[$i]['data_mahasiswa']); $j++){

                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['data_mahasiswa'][$j]['hari1'], $getsubject[$i]['data_mahasiswa'][$j]['jam1'], $getsubject[$i]['data_mahasiswa'][$j]['durasi1'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    // exit;

                    // if($getsubject[$i]['data_mahasiswa'][$j]['pil1'] != null){
                        $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak1'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['data_mahasiswa'][$j]['hari1'], $getsubject[$i]['data_mahasiswa'][$j]['jam1'], $getsubject[$i]['data_mahasiswa'][$j]['durasi1'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    // }
                    // else{
                        //bandingin jadwal kelas praktikum yang dilooping sama jadwal kuliah mahasiswa
                        // $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak1']
                    // }
                    
                    $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak2'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['data_mahasiswa'][$j]['hari2'], $getsubject[$i]['data_mahasiswa'][$j]['jam2'], $getsubject[$i]['data_mahasiswa'][$j]['durasi2'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak3'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['data_mahasiswa'][$j]['hari3'], $getsubject[$i]['data_mahasiswa'][$j]['jam3'], $getsubject[$i]['data_mahasiswa'][$j]['durasi3'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak4'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['data_mahasiswa'][$j]['hari4'], $getsubject[$i]['data_mahasiswa'][$j]['jam4'], $getsubject[$i]['data_mahasiswa'][$j]['durasi4'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    
                    for($k = 0; $k < count($getsubject[$i]['kelas_praktikum']); $k++){
                        $getsubject[$i]['data_mahasiswa'][$j]['nabrak_kelas_praktikum'.$getsubject[$i]['kelas_praktikum'][$k]['id'].$getsubject[$i]['data_mahasiswa'][$j]['NRP']] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa'][$j]['NRP'], $getsubject[$i]['kelas_praktikum'][$k]['hari'], $getsubject[$i]['kelas_praktikum'][$k]['jam'], $getsubject[$i]['kelas_praktikum'][$k]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                    }
                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak1']);
                    
                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak1']);
                    // if($getsubject[$i]['data_mahasiswa'][$j]['NRP'] == 'C14180210' && $getsubject[$i]['data_mahasiswa'][$j]['hari1'] == "Senin" && $getsubject[$i]['data_mahasiswa'][$j]['jam1'] == "19:35:00" && $getsubject[$i]['data_mahasiswa'][$j]['durasi1'] == "110"){
                    //     var_dump("MASUKKKKKKKKKKK" . $getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak1']); exit;
                    // }
                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak2']);
                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak3']);
                    // var_dump($getsubject[$i]['data_mahasiswa'][$j]['jadwalnabrak4']);
                    // exit;
                }
            }
            

            $getsubject[$i]['kelas_responsi']  = $this->kelas_praktikum_model->getactive_kelaspraktikum($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            if($getsubject[$i]['status_responsi'] == 1){
                $getsubject[$i]['data_mahasiswa_responsi'] = $this->ambil_praktikum_model->getdetailkelas($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                for($j = 0; $j < count($getsubject[$i]['data_mahasiswa_responsi']); $j++){
                    
                    $getsubject[$i]['data_mahasiswa_responsi'][$j]['jadwalnabrak1'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['hari1'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['jam1'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['durasi1'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());                    
                    $getsubject[$i]['data_mahasiswa_responsi'][$j]['jadwalnabrak2'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['hari2'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['jam2'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['durasi2'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    $getsubject[$i]['data_mahasiswa_responsi'][$j]['jadwalnabrak3'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['hari3'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['jam3'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['durasi3'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    $getsubject[$i]['data_mahasiswa_responsi'][$j]['jadwalnabrak4'] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['hari4'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['jam4'], $getsubject[$i]['data_mahasiswa_responsi'][$j]['durasi4'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                    
                    for($k = 0; $k < count($getsubject[$i]['kelas_responsi']); $k++){
                        $getsubject[$i]['data_mahasiswa_responsi'][$j]['nabrak_kelas_praktikum'.$getsubject[$i]['kelas_responsi'][$k]['id'].$getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP']] = $this->ambil_praktikum_model->getnabrak($getsubject[$i]['data_mahasiswa_responsi'][$j]['NRP'], $getsubject[$i]['kelas_responsi'][$k]['hari'], $getsubject[$i]['kelas_responsi'][$k]['jam'], $getsubject[$i]['kelas_responsi'][$k]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                    }
                }
            }

        }
        // exit;
        echo json_encode($getsubject);
    }


    public function getclassgroup2(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');
        $this->load->model('kelas_praktikum_model');

        // $ambil_praktikum = array();
        // $getkelas = $this->ambil_praktikum_model->getclassgroup($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        
        // if ($getkelas > 0){
        //     for($i = 0; $i < count($getkelas); $i++){
        //         $getdetail = $this->ambil_praktikum_model->getdetailkelas($getkelas[$i]['kode_mk'], $getkelas[$i]['tipe'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran()); 

        //         array_push($ambil_praktikum, $getdetail);
        //     }
        // }

        // echo json_encode($ambil_praktikum);
        $getsubject = $this->kelas_praktikum_model->getactive($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        // $ambil_praktikum = $getsubject;
        // $ambil_praktikum = array();
        for($i = 0; $i < count($getsubject); $i++){
            // var_dump(count($getsubject)); 
            $getsubject[$i]["data_kelas_praktikum"] = array();
            $getsubject[$i]["data_mahasiswa_praktikum"] = array();
            $getsubject[$i]["data_kelas_responsi"] = array();
            $getsubject[$i]["data_mahasiswa_responsi"] = array();

            if($getsubject[$i]['status_praktikum'] == 1){
                
                // var_dump("masukkkkkkkk prak");
                $getsubject[$i]['data_kelas_praktikum'] = $this->kelas_praktikum_model->getjadwalforambilprak($getsubject[$i]['kode_mk'], "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                $getsubject[$i]['data_mahasiswa_praktikum'] = $this->ambil_praktikum_model->getdetailkelas($getsubject[$i]['kode_mk'], "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
            }
            if($getsubject[$i]['status_responsi'] == 1){
                // var_dump("masukkkkkkkk resp");
                $getsubject[$i]['data_kelas_responsi'] = $this->kelas_praktikum_model->getjadwalforambilprak($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                $getsubject[$i]['data_mahasiswa_responsi'] = $this->ambil_praktikum_model->getdetailkelas($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
            }
            
        }
      
        echo json_encode($getsubject);
    }


    

    public function generateadd(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('informasi_umum_model');

        $peserta = $this->mahasiswa_matakuliah_model->getpesertapraktikum($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        if($peserta > 0){

            // var_dump($peserta); exit;
            for($i = 0; $i < count($peserta); $i++){
                // cek kalo udah ada jgn ditambah datanya
                // $kembar = $this->ambil_praktikum_model->getwithtipe($peserta[$i]['id']);
                if($peserta[$i]['status_praktikum'] == 1){

                    $kembarpraktikum = $this->ambil_praktikum_model->getmahasiswamatkul($peserta[$i]['id'], 'praktikum', $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                    // var_dump($peserta[$i]['id'], $kembarpraktikum); exit;
                    if($kembarpraktikum == 0){
                        //ADD Ambil Praktikum

                        $data = array(
                            'id_mahasiswa_matakuliah' => $peserta[$i]['id'],
                            'NRP' => $peserta[$i]['NRP'],
                            'kode_mk' => $peserta[$i]['kode_mk'],
                            'status' => 1,
                            'tipe' => 'praktikum',
                            'semester' => $this->informasi_umum_model->getsemester(),
                            'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
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
                
                if($peserta[$i]['status_responsi'] == 1){
                    $kembarresponsi = $this->ambil_praktikum_model->getmahasiswamatkul($peserta[$i]['id'], 'responsi', $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());


                    if($kembarresponsi == 0){

                        $data = array(
                            'id_mahasiswa_matakuliah' => $peserta[$i]['id'],
                            'NRP' => $peserta[$i]['NRP'],
                            'kode_mk' => $peserta[$i]['kode_mk'],
                            'status' => 1,
                            'tipe' => 'responsi',
                            'semester' => $this->informasi_umum_model->getsemester(),
                            'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
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

    // public function getjadwalterpilih(){

    // }
    
    public function terpilih(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');

        // var_dump($this->input->post("data_ambil_praktikum")); exit;

        $kelas_praktikum = $this->input->post("data_kelas_praktikum");
        $ambil_praktikum = $this->input->post("data_ambil_praktikum");

        for($i = 0; $i < count($kelas_praktikum); $i++){
            $this->kelas_praktikum_model->update($kelas_praktikum[$i]);
        }

        for($i = 0; $i < count($ambil_praktikum); $i++){
            $this->ambil_praktikum_model->update($ambil_praktikum[$i]);
        }

        //insertlogs
        $keterangan = '';
        $keterangan .= json_encode($kelas_praktikum).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'kelas_praktikum',
            "action" => 'UPDATE',
            "keterangan" => $this->session->userdata('logged_name')." updated record : ". $keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

        $keterangan = '';
        $keterangan .= json_encode($ambil_praktikum).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'ambil_praktikum',
            "action" => 'UPDATE',
            "keterangan" => $this->session->userdata('logged_name')." updated record : ". $keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->user_history_model->add($logs_insert);

        echo "sukses";
    }

    public function getnabrak(){ // kembalian dari getnabrak ==> "", "yes", "no"
        $this->load->model('ambil_praktikum_model');
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        if($this->input->post('idkelasprak') == "placeholder_text") { 
            echo ""; 
        }
        else {
            $kelas_praktikum = $this->kelas_praktikum_model->get($this->input->post('idkelasprak'));

            $getnabrak = $this->ambil_praktikum_model->getnabrak($this->input->post('nrp'), $kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            echo $getnabrak;
        }
    }

    public function getambilprakbynrp(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $ambil_praktikum = $this->ambil_praktikum_model->getambilprakbynrp($this->input->post('nrp'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($ambil_praktikum);
    }

    public function adds(){

        $data['title'] = "Add Ambil Praktikum";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
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
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
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