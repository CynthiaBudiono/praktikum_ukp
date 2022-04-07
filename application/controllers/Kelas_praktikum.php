<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_praktikum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data['kelas_praktikum_now'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);

		$data['kelas_praktikum'] = $this->kelas_praktikum_model->getallopen();

		$data['title'] = "kelas praktikum";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/kelas_praktikum', $data);

		$this->load->view('general/footer', $data);
	}

    public function adds(){

        $data['title'] = "Add kelas praktikum";

        $this->load->model('informasi_umum_model');
		
        $data['mode'] = 'add';

		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/kelas_praktikum-add', $data);

		$this->load->view('general/footer', $data);

    }

    public function getperiodnow(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        $kelas = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);

        echo json_encode($kelas);
    }

    public function getperiod(){
        $this->load->model('kelas_praktikum_model');

        $semester = $this->input->post('semester');
        $ta = $this->input->post('tahun_ajaran'). "-" . date($this->input->post('tahun_ajaran'), strtotime('+1year')); //'+1year'

        //ini masih error soalnya yearnya gak tambah 1 jdi gakisa get
        var_dump($ta); exit;
        $kelas = $this->kelas_praktikum_model->getallopen($semester, $ta);

        echo json_encode($kelas);
    }

    public function getjadwalforambilprak(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        var_dump($this->input->post('kode_mk')); exit;
        $kelas = $this->kelas_praktikum_model->getjadwalforambilprak($this->input->post('kode_mk'), $this->input->post('tipe'), $this->informasi_umum_model->get(2)[0]['nilai'], $this->informasi_umum_model->get(3)[0]['nilai']);

        echo json_encode($kelas);
    }

    public function updatesall(){
        // $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        $data['title'] = "Edit kelas praktikum";

        $data['mode'] = 'update';

        $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/kelas_praktikum-add', $data);

		$this->load->view('general/footer', $data);
    }

    // public function updates($id = null){ //DIPAKE KALO UPDATE SATU"

    //     // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
	// 	// if ($check == 0) redirect('dashboard');

    //     $id = base64_decode($id);

    //     $this->load->model('kelas_praktikum_model');

	// 	$res = $this->kelas_praktikum_model->get($id);

    //     if ($res == 0) redirect('dashboard');

    //     $data['detil'] = $res;
        
    //     $data['title'] = "Edit kelas praktikum";

    //     $this->load->model('informasi_umum_model');
		
	// 	$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
	// 	$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
	// 	$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
	// 	$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
	// 	$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

	// 	$this->load->view('general/header');

	// 	$this->load->view('general/sidebar', $data);

	// 	$this->load->view('general/navbar', $data);

	// 	$this->load->view('content/kelas_praktikum-add', $data);

	// 	$this->load->view('general/footer', $data);

    // }

    public function add(){
        // var_dump("AAAAAAAAAAAA"); exit;
        $this->load->helper(array('form', 'url'));
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');
        // $this->load->library('form_validation');
        
        // $status = ($this->input->post('status1')=='on') ? 1 : 0;

        // var_dump($this->input->post('status1')); exit;
        $totalrow = 0;
        for ($x = 1; $x <= $this->input->post('total_row'); $x++) {
            if($this->input->post('status_row'.$x) == 'active'){
                $data = array(
                    'kode_kelas_praktikum' => $this->input->post('id_subject'.$x).strtoupper($this->input->post('kelas_paralel'.$x)),
                    'kode_mk' => $this->input->post('id_subject'.$x),
                    'kelas_paralel' => strtoupper($this->input->post('kelas_paralel'.$x)),
                    'kode_lab' => $this->input->post('id_laboratorium'.$x),
                    'hari' => $this->input->post('hari'.$x),
                    'jam' => $this->input->post('jam'.$x),
                    'durasi' => $this->input->post('durasi'.$x),
                    'terisi' => 0,
                    'NIP1' => $this->input->post('id_nip1'.$x),
                    'NIP2' => $this->input->post('id_nip2'.$x),
                    'NIP3' => $this->input->post('id_nip3'.$x),
                    'semester' => $this->informasi_umum_model->get(2)[0]['nilai'],
                    'tahun_ajaran' => $this->informasi_umum_model->get(3)[0]['nilai'],
                    'status' => (($this->input->post('status'.$x)=='on') ? 1 : 0),
                );
                $this->kelas_praktikum_model->add($data);

                // check validasi
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules('kode_mk', 'Mata Kuliah', 'required');

                if ($this->form_validation->run() == FALSE) {
                    $detil[0] = $data;
                    $this->adds(validation_errors(), $detil);
                }
                else {
                    $this->load->helper(array('form', 'url'));

                    $this->kelas_praktikum_model->add($data);

                    // insert log
                    $keterangan = '';
                    $keterangan .= json_encode($data).'.';

                    $logs_insert = array(
                        "id_user" => $this->session->userdata('user_id'),
                        "table_name" => 'kelas_praktikum',
                        "action" => 'CREATE',
                        "keterangan" => "a new record has been created by ".$this->session->userdata('logged_name')." : ".$keterangan,
                        "created" => date('Y-m-d H:i:s')
                    );
                    $this->load->model('user_history_model');
                    $this->user_history_model->add($logs_insert);

                    $totalrow +=1;
                }
            }
        }

        if($this->input->post('total_row') == $totalrow){
            redirect('kelas_praktikum');
        }

        
    }

    public function update(){
        // $id = base64_decode($id);

        $status = ($this->input->post('status')=='on') ? 1 : 0;

        $data = array(
            'id' => $this->input->post('idusergroup'),
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

            $this->load->model('kelas_praktikum_model');
            // var_dump("AAAAA", $data['id']); exit;
            $old_data = $this->kelas_praktikum_model->get($data['id']);

            // var_dump("OLD DATA: ", $old_data); exit;
            $this->kelas_praktikum_model->update($data);

            // insert log
            $keterangan = '';
            $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
            $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
            $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'kelas_praktikum',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            redirect('kelas_praktikum');
        }    
    }
}