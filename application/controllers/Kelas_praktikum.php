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

        $data['kelas_praktikum_now'] = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

		$data['kelas_praktikum'] = $this->kelas_praktikum_model->getallopen();

		$data['title'] = "Kelas Praktikum";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/kelas_praktikum', $data);

		$this->load->view('general/footer', $data);
	}

    public function readfile(){
		// var_dump("MASUK READFILEE"); exit;
		$this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['kelas_praktikum_file']['name'])) {

			$path = $_FILES["kelas_praktikum_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$kode_mk = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kelas_paralel = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$hari = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$jam = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$durasi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $kode_lab = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$NIP1 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$NIP2 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$NIP3 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $tipe = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

					$data[] = array(
						'kode_mk' 		=> $kode_mk,
						'kelas_paralel'	=> $kelas_paralel,
						'hari' 	        => $hari,
						'jam' 		    => $jam,
						'durasi' 		=> $durasi,
                        'kode_lab' 		=> $kode_lab,
						'NIP1'	        => $NIP1,
						'NIP2' 	        => $NIP2,
						'NIP3' 		    => $NIP3,
						'tipe' 		    => $tipe
					);
				}
			}

			$this->addupdatedata($data);
			// var_dump($data[0]); exit;
		}
		else{
			echo "Tidak ada file yang masuk";
		}
	}

	private function addupdatedata($data){

		$this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$datavalue = array(
                    "kode_kelas_praktikum"  => $data[$i]['kode_mk'].$data[$i]['kelas_paralel'],
                    "kode_mk" 		        => $data[$i]['kode_mk'],
                    "kelas_paralel"	        => $data[$i]['kelas_paralel'],
                    "hari" 	                => $data[$i]['hari'],
                    "jam"		            => $data[$i]['jam'],
                    "durasi" 		        => $data[$i]['durasi'],
                    "kode_lab" 		        => $data[$i]['kode_lab'],
                    "terisi"                => 0,
                    "NIP1"	                => $data[$i]['NIP1'],
                    "NIP2" 	                => ($data[$i]['NIP2'] != NULL) ? $data[$i]['NIP2'] : "",
                    "NIP3" 		            => ($data[$i]['NIP3'] != NULL) ? $data[$i]['NIP3'] : "",
                    "tipe" 		            => ($data[$i]['tipe'] != NULL) ? $data[$i]['tipe'] : "praktikum",
                    "semester"              => $this->informasi_umum_model->getsemester(),
                    "tahun_ajaran"          => $this->informasi_umum_model->gettahunajaran(),
					"status" 	            => 1
				);

				$this->kelas_praktikum_model->add($datavalue);
			}
		}

		// insert log
        $keterangan = '';
        $keterangan .= json_encode($data).'; ';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'kelas_praktikum',
            "action" => 'CREATE',
            "keterangan" => "record per semester have been created by ". $this->session->userdata('logged_name') ." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

		redirect("kelas_praktikum");
	}

    public function adds(){

        $data['title'] = "Add Kelas Praktikum";

        $this->load->model('informasi_umum_model');
		
        $data['mode'] = 'add';

		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
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

        $kelas = $this->kelas_praktikum_model->getallopen($this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($kelas);
    }

    public function getperiod(){
        $this->load->model('kelas_praktikum_model');

        $semester = $this->input->post('semester');
        // $ta = $this->input->post('tahun_ajaran'). "-" . date($this->input->post('tahun_ajaran'), strtotime('+1year')); //'+1year'
        $ta = $this->input->post('tahun_ajaran'). "-" . intval($this->input->post('tahun_ajaran') + 1); //'+1year'

        $kelas = $this->kelas_praktikum_model->getallopen($semester, $ta);

        // echo $semester. ' - '. $ta;
        echo json_encode($kelas);
    }

    public function getjadwalforambilprak(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        // var_dump($this->input->post('kode_mk')); exit;
        $kelas = $this->kelas_praktikum_model->getjadwalforambilprak($this->input->post('kode_mk'), $this->input->post('tipe'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($kelas);
    }

    public function getbysubject(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        // var_dump($this->input->post('kode_mk')); exit;
        $kelas = $this->kelas_praktikum_model->getbysubject($this->input->post('kode_mk'), $this->input->post('tipe'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($kelas);
    }

    public function getdetailmahasiswa(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');

        // mb_check_encoding($this->input->post('id'))
        $kelas = $this->kelas_praktikum_model->getdetailmahasiswa($this->input->post('id_kelas_praktikum'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        // var_dump($this->input->post('id')); exit;
        echo json_encode($kelas);
    }

    // public function updatesall(){
    //     // $this->load->model('kelas_praktikum_model');
    //     $this->load->model('informasi_umum_model');

    //     $data['title'] = "Edit Kelas Praktikum";

    //     $data['mode'] = 'update';

    //     $data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
	// 	$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
	// 	$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
	// 	$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
	// 	$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

	// 	$this->load->view('general/header');

	// 	$this->load->view('general/sidebar', $data);

	// 	$this->load->view('general/navbar', $data);

	// 	$this->load->view('content/kelas_praktikum-add', $data);

	// 	$this->load->view('general/footer', $data);
    // }

    public function updates($id = null){ //DIPAKE KALO UPDATE SATU"

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        
        $id = base64_decode($id);

        $this->load->model('kelas_praktikum_model');
        $this->load->model('subject_model');
        $this->load->model('laboratorium_model');
        $this->load->model('dosen_model');
        $this->load->model('asisten_model');

		$res = $this->kelas_praktikum_model->get($id);

        if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;

        $data['subject'] = $this->subject_model->gethavepraktikum();
        $data['laboratorium'] = $this->laboratorium_model->getactivelab();

        $datapengajar = array_merge($this->dosen_model->getallactive(), $this->asisten_model->getallactive());

		for($i = 0; $i < count($datapengajar); $i++){
			if(isset($datapengajar[$i]['NIP'])){
				$kode = $datapengajar[$i]['NIP'];
				$jenis = "dosen";
			}
			else if(isset($datapengajar[$i]['NRP'])){
				$kode = $datapengajar[$i]['NRP'];
				$jenis = "asisten";
			}
			$pengajar[] = array(
				"id_pengajar" => $kode,
				"jenis" => $jenis,
				"nama" => $datapengajar[$i]['nama']
			);
		}

        $data['pengajar'] = $pengajar;


        
        $data['title'] = "Edit Kelas Praktikum";

        $data['mode'] = 'update';

        $data['primary'] = $id;

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/kelas_praktikum-update', $data);

		$this->load->view('general/footer', $data);

    }

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
                    'kode_kelas_praktikum' => $this->input->post('subject'.$x).strtoupper($this->input->post('kelas_paralel'.$x)),
                    'kode_mk' => $this->input->post('subject'.$x),
                    'kelas_paralel' => strtoupper($this->input->post('kelas_paralel'.$x)),
                    'kode_lab' => $this->input->post('laboratorium'.$x),
                    'hari' => $this->input->post('hari'.$x),
                    'jam' => $this->input->post('jam'.$x),
                    'durasi' => $this->input->post('durasi'.$x),
                    'terisi' => 0,
                    'NIP1' => $this->input->post('nip1'.$x),
                    'NIP2' => $this->input->post('nip2'.$x),
                    'NIP3' => $this->input->post('nip3'.$x),
                    'tipe' => $this->input->post('tipe'.$x),
                    'semester' => $this->informasi_umum_model->getsemester(),
                    'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
                    'status' => (($this->input->post('status'.$x)=='on') ? 1 : 0),
                );

                // var_dump($data); exit;
                // $this->kelas_praktikum_model->add($data);

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

        // if($this->input->post('total_row') == $totalrow){
            redirect('kelas_praktikum');
        // }

        
    }

    public function update(){
        // $id = base64_decode($id);

        // $status = ($this->input->post('status')=='on') ? 1 : 0;

        $this->load->helper(array('form', 'url'));
        $this->load->model('kelas_praktikum_model');
        $this->load->model('informasi_umum_model');
        

        $data = array(
            'id' => $this->input->post('idkelasprak'),
            'kode_kelas_praktikum' => $this->input->post('subject').strtoupper($this->input->post('kelas_paralel')),
            'kode_mk' => $this->input->post('subject'),
            'kelas_paralel' => strtoupper($this->input->post('kelas_paralel')),
            'kode_lab' => $this->input->post('laboratorium'),
            'hari' => $this->input->post('hari'),
            'jam' => $this->input->post('jam'),
            'durasi' => $this->input->post('durasi'),
            'terisi' => 0,
            'NIP1' => $this->input->post('nip1'),
            'NIP2' => $this->input->post('nip2'),
            'NIP3' => $this->input->post('nip3'),
            'tipe' => $this->input->post('tipe'),
            'semester' => $this->informasi_umum_model->getsemester(),
            'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran(),
            'status' => (($this->input->post('status')=='on') ? 1 : 0),
        );

        var_dump("masuk update ", $data);

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('kode_mk', 'Mata Kuliah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            $this->adds(validation_errors(), $detil);
            // var_dump("LOHH MASUK SINI"); exit;
            echo validation_errors();
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
            $keterangan .= json_encode($old_data). ' to '. json_encode($data).'; ';

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