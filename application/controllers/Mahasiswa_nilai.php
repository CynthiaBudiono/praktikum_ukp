<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa_nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') == 'mahasiswa') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('mahasiswa_nilai_model');

		$this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data['kelas_praktikum_now'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        if($data['kelas_praktikum_now'] != 0){
            for($i = 0; $i < count($data['kelas_praktikum_now']); $i++ ){
                // var_dump($data['kelas_praktikum_now'][$i]['id']);
                $data['kelas_praktikum_now'][$i]['detail_kelas'] = $this->ambil_praktikum_model->getdetailkelasbyidkelasprak($data['kelas_praktikum_now'][$i]['id']);
                $data['kelas_praktikum_now'][$i]['all_pertemuan'] = $this->mahasiswa_nilai_model->getallpertemuanbyidkelasprak($data['kelas_praktikum_now'][$i]['id']);
                $data['kelas_praktikum_now'][$i]['detail_nilai'] = $this->mahasiswa_nilai_model->getlastpertemuanbyidkelasprak($data['kelas_praktikum_now'][$i]['id']);
            }
        }
       

        // exit;
        // var_dump($data['kelas_praktikum_now'][7]['all_pertemuan']); exit;
        

		$data['title'] = "Mahasiswa Nilai";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai', $data);

		$this->load->view('general/footer', $data);
	}

    public function viewdetail($nrp, $kode_mk){
        // var_dump($kode_mk);
        // var_dump($nrp); exit;

        $this->load->model('mahasiswa_nilai_model');

		$this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data['kelas_praktikum_now'] = $this->ambil_praktikum_model->getkelaspraktikummahasiswa($nrp, $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran(), $kode_mk);

        // var_dump($data['kelas_praktikum_now']); exit;

        for($i = 0; $i < count($data['kelas_praktikum_now']); $i++ ){
            // var_dump($data['kelas_praktikum_now'][$i]['id']);

            $data['kelas_praktikum_now'][0]['detail_nilai'] = $this->mahasiswa_nilai_model->getallnilai($data['kelas_praktikum_now'][$i]['id_kelas_praktikum'], $nrp);
        }

        // var_dump($data['kelas_praktikum_now']); exit;

		$data['title'] = "Mahasiswa Nilai";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai-view', $data);

		$this->load->view('general/footer', $data);

    }

    public function addtransfernilai($nrp, $kode_mk){

        $this->load->model('mahasiswa_nilai_model');

		$this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data = $this->ambil_praktikum_model->getkelaspraktikummahasiswa($nrp, $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran(), $kode_mk);

        // var_dump($data); exit;

        for($i = 0; $i < count($data); $i++ ){ //DATA NYA PASTI 1
            $insert = $this->mahasiswa_nilai_model->getallnilai($data[$i]['id_kelas_praktikum'], $nrp);

            for($j = 0; $j < count($insert); $j++){ 
                $isidata = array(
                    'id_kelas_praktikum' => $data[$i]['id_kelas_praktikum'],
                    'NRP' => $data[$i]['NRP'],
                    'tanggal_pertemuan' => $insert[$j]['tanggal_pertemuan'],
                    'pertemuan' => $insert[$j]['pertemuan'],
                    'status_absensi' => $insert[$j]['status_absensi'],
                    'nilai_awal' => $insert[$j]['nilai_awal'],
                    'nilai_materi' => $insert[$j]['nilai_materi'],
                    'nilai_tugas' => $insert[$j]['nilai_tugas'],
                    'rata_rata' => (float)(($insert[$j]['nilai_awal'] + $insert[$j]['nilai_materi'] + $insert[$j]['nilai_tugas'])/3),
                    'mahasiswa_nilai_id_transfer' => $insert[$j]['id'],
                );
    
                // var_dump($isidata); //exit;
                $this->mahasiswa_nilai_model->add($isidata);
            }
        }
        // exit;
        
        // insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'mahasiswa_nilai',
            "action" => 'CREATE',
            "keterangan" => "record TRANSFER NILAI have been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

        echo 'sukses';
        redirect('transfer_nilai');

    }

    public function viewbylogin(){
        $this->load->model('mahasiswa_nilai_model');

		$this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data['kelas_praktikum_now'] = $this->ambil_praktikum_model->getkelaspraktikummahasiswa($this->session->userdata('user_id'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        // var_dump($this->session->userdata('user_id'));
        // var_dump($data['kelas_praktikum_now']); exit;
        if($data['kelas_praktikum_now'] != 0){
            for($i = 0; $i < count($data['kelas_praktikum_now']); $i++ ){
                // var_dump($data['kelas_praktikum_now'][$i]['id']);
                $data['kelas_praktikum_now'][$i]['detail_nilai'] = $this->mahasiswa_nilai_model->getallnilai($data['kelas_praktikum_now'][$i]['id_kelas_praktikum'], $this->session->userdata('user_id'));
            }
        }
        // exit;
        // var_dump($data['kelas_praktikum_now']); exit;
        

		$data['title'] = "Mahasiswa Nilai";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai-view', $data);

		$this->load->view('general/footer', $data);
    }

    public function tambah_pertemuan($id, $pertemuan){
        $id = base64_decode($id);

        $this->load->model('mahasiswa_nilai_model');
        $this->load->model('ambil_praktikum_model');

		// $res = $this->mahasiswa_nilai_model->get($id);
        // var_dump($id);

        $data['detail_kelas'] = $this->ambil_praktikum_model->getdetailkelasbyidkelasprak($id);

        // var_dump($data['detail_kelas']); exit;

        $data['primary'] = $id;

        $data['pertemuan'] = (int)$pertemuan+1;

        $data['mode'] = 'add';
        
        $data['title'] = "Tambah Mahasiswa Nilai";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai-add', $data);

		$this->load->view('general/footer', $data);
    }

    public function getdetailmahasiswa(){
        $this->load->model('mahasiswa_nilai_model');

        if($this->input->post('id') == 'all' && $this->input->post('nrp') == 'all'){
            $mahasiswa_nilai = $this->mahasiswa_nilai_model->getdetailmahasiswa();
        }
        else if ($this->input->post('id') != 'all' && $this->input->post('nrp') == 'all'){
            $mahasiswa_nilai = $this->mahasiswa_nilai_model->getdetailmahasiswa($this->input->post('id'));
        }
        // else if ($this->input->post('id') == 'all' && $this->input->post('nrp') != 'all'){
        //     $mahasiswa_nilai = $this->mahasiswa_nilai_model->getdetailmahasiswa(null, $this->input->post('id'));
        // }
        else if ($this->input->post('id') != 'all' && $this->input->post('nrp') != 'all'){
            $mahasiswa_nilai = $this->mahasiswa_nilai_model->getdetailmahasiswa($this->input->post('id'), $this->input->post('nrp'));
        }
        

        echo json_encode($mahasiswa_nilai);
    }

    public function getlulustidaklulus(){
        $this->load->model('mahasiswa_nilai_model');

        $mahasiswa_nilai = $this->mahasiswa_nilai_model->getlulustidaklulus($this->input->post('id_kelas_praktikum'));

        echo json_encode($mahasiswa_nilai);
    }

    public function getsummary(){
        $this->load->model('mahasiswa_nilai_model');

        $mahasiswa_nilai = $this->mahasiswa_nilai_model->getsummary($this->input->post('id'));

        echo json_encode($mahasiswa_nilai);
    }

    public function adds(){

        $data['mode'] = 'add';

        $data['title'] = "Add Mahasiswa Nilai";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function updates($id = null, $pertemuan = null){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $id = base64_decode($id);

        if($pertemuan == null) redirect('dashboard');


        $this->load->model('mahasiswa_nilai_model');
        $this->load->model('ambil_praktikum_model');

		// $res = $this->mahasiswa_nilai_model->get($id);


        $data['detail_kelas'] = $this->ambil_praktikum_model->getdetailkelasbyidkelasprak($id, $pertemuan);

        // var_dump($id." ".$pertemuan);
        // var_dump($data['detail_kelas']);exit;
        // if ($data['detail_kelas'] == 0) redirect('dashboard');

        $data['primary'] = $id;

        $data['mode'] = 'update';
        
        $data['title'] = "Edit Mahasiswa Nilai";

        $data['pertemuan'] = (int)$pertemuan;

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/mahasiswa_nilai-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function add(){
        
        $this->load->model('mahasiswa_nilai_model');

        $id = $this->input->post('id_kelas_prak');
        $pertemuan = $this->input->post('pertemuan'); 
        $data = $this->input->post('data');
        // var_dump($data); exit;
        if($data != NULL){
            for($i = 0; $i < count($data); $i++){
                $isidata = array(
                    'id_kelas_praktikum' => $id,
                    'NRP' => $data[$i]['NRP'],
                    'pertemuan' => $pertemuan,
                    'status_absensi' => $data[$i]['status_absensi'],
                    'nilai_awal' => ($data[$i]['nilai_awal'] != "") ? $data[$i]['nilai_awal'] : 0,
                    'nilai_materi' => ($data[$i]['nilai_materi'] != "") ? $data[$i]['nilai_materi'] : 0,
                    'nilai_tugas' => ($data[$i]['nilai_tugas'] != "") ? $data[$i]['nilai_tugas'] : 0,
                    'rata_rata' => (float)(((($data[$i]['nilai_awal'] != "") ? $data[$i]['nilai_awal'] : 0) + (($data[$i]['nilai_materi'] != "") ? $data[$i]['nilai_materi'] : 0) + (($data[$i]['nilai_tugas'] != "") ? $data[$i]['nilai_tugas'] : 0))/3),
                );
    
                // var_dump($isidata); exit;
                $this->mahasiswa_nilai_model->add($isidata);
            }
            
            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data).'; ';
    
            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'mahasiswa_nilai',
                "action" => 'CREATE',
                "keterangan" => "a new meeting has been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);
    
            echo 'sukses';  
        }
        else{
            echo 'tidak ada mahasiswa dalam kelas ini';
        }
          
    }

    public function update(){
        // $id = base64_decode($id);

        // $idkelasprak = $this->input->post('id_kelas_prak');

        $this->load->model('mahasiswa_nilai_model');

        $data = $this->input->post('data');
        // var_dump($data); exit;
        for($i = 0; $i < count($data); $i++){
            $isidata = array(
                'id' => $data[$i]['id_mahasiswa_nilai'],
                'NRP' => $data[$i]['NRP'],
                'status_absensi' => $data[$i]['status_absensi'],
                'nilai_awal' => $data[$i]['nilai_awal'],
                'nilai_materi' => $data[$i]['nilai_materi'],
                'nilai_tugas' => $data[$i]['nilai_tugas'],
                'rata_rata' => (float)(($data[$i]['nilai_awal'] + $data[$i]['nilai_materi'] + $data[$i]['nilai_tugas'])/3),
            );

            // var_dump($isidata); exit;
            $this->mahasiswa_nilai_model->update($isidata);
        }
        
        // insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'mahasiswa_nilai',
            "action" => 'UPDATE',
            "keterangan" => $this->session->userdata('logged_name')." updated record # : 1 pertemuan: ". $keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

        echo 'sukses';    
    }
}