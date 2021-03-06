<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ambil_praktikum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    // if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
        if($this->session->userdata('user_type') == 'dosen') redirect('dashboard');
        if($this->session->userdata('user_type') == 'kepala_lab') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('ambil_praktikum_model');

		// $data['ambil_praktikum'] = $this->ambil_praktikum_model->getallopen();
        // if($this->session->userdata('user_type') != 'admin' || $this->session->userdata('user_type') != 'asisten_tetap') redirect('dashboard');

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

    public function readfiledatalama(){
        $this->load->library('excel');

		if((!empty($_FILES)) && !empty($_FILES['ambil_prak_file']['name'])) {

			$path = $_FILES["ambil_prak_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for($row = 2; $row <= $highestRow; $row++){
					$nrp = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kode_mk = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$pil1 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $pil2 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $pil3 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $pil4 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$data[] = array(
						'NRP' 		=> $nrp,
						'kode_mk' 	=> $kode_mk,
						'pil1' 	    => $pil1,
                        'pil2' 	    => $pil2,
                        'pil3' 	    => $pil3,
                        'pil4' 	    => $pil4,
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

		$this->load->model('ambil_praktikum_model');
        $this->load->model('kelas_praktikum_model');
		if($data != null){
			for($i = 0; $i < count($data); $i++){
				$get = $this->ambil_praktikum_model->getbynrpnkodemkntipe($data[$i]['NRP'], $data[$i]['kode_mk'], "praktikum");

                $pil1 = $this->kelas_praktikum_model->getbykodekelas($data[$i]['pil1'])[0]['id'];
                $pil2 = $this->kelas_praktikum_model->getbykodekelas($data[$i]['pil2'])[0]['id'];
                $pil3 = $this->kelas_praktikum_model->getbykodekelas($data[$i]['pil3'])[0]['id'];
                $pil4 = $this->kelas_praktikum_model->getbykodekelas($data[$i]['pil4'])[0]['id'];

				$datavalue = array(
					"id"		=> $get[0]['id'],
					"pil1"		=> $pil1,
                    "pil2"		=> $pil2,
                    "pil3"		=> $pil3,
                    "pil4"		=> $pil4,
				);

				$this->ambil_praktikum_model->update($datavalue);
			}
		}
		redirect("ambil_praktikum");
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
                if($getsubject[$i]['data_mahasiswa'] != 0){
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
                        // var_dump($getsubject[$i]['data_mahasiswa']); exit;
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
            }
            

            $getsubject[$i]['kelas_responsi']  = $this->kelas_praktikum_model->getactive_kelaspraktikum($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            if($getsubject[$i]['status_responsi'] == 1){
                $getsubject[$i]['data_mahasiswa_responsi'] = $this->ambil_praktikum_model->getdetailkelas($getsubject[$i]['kode_mk'], "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                if($getsubject[$i]['data_mahasiswa_responsi'] != 0){
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

        }
        // exit;
        echo json_encode($getsubject);
    }

    public function pemilihankelas(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');
        $this->load->model('kelas_praktikum_model');

        $kode_mk = $this->input->post('kode_mk');

        //ambil kelas praktikum berdasar kode_mk
        //di sorting kelas praktikum dari pilihannya mahasiswa di ambil praktikum berdasar ipk dan kuota kelas
        // selama kuota ada masuk kelas itu sampai kuota memenuhi kelas
        // kuota max penuh di sort lagi by piihan 2
        $data_log= [];
        //KELAS PRAKTIKUM
        $kelas = $this->kelas_praktikum_model->getbysubject($kode_mk, "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        if($kelas != 0){
            for($k = 0; $k < 4; $k++){

                $kelas = $this->kelas_praktikum_model->getbysubject($kode_mk, "praktikum", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

                for($i = 0; $i < count($kelas); $i++){
                
                    $ambil_praktikum = $this->ambil_praktikum_model->sortbypilnipk($kelas[$i]['id'], "pil".(int)($k+1)); //GET SELAMA TERPILIH = 0 (BELUM TERPILIH)
                    // var_dump($ambil_praktikum); exit;
                    if($ambil_praktikum != 0){
                        $jumygambil = count($ambil_praktikum);
                        $sisaquotakelas = (int)$kelas[$i]['quota_max'] - (int)$kelas[$i]['terisi'];

                        for($j = 0; $j < $jumygambil && $j < $sisaquotakelas; $j++){
                            $dataupdateterpilih = array(
                                'id' => $ambil_praktikum[$j]['id'],
                                'terpilih' => $kelas[$i]['id']
                            );
                            $this->ambil_praktikum_model->update($dataupdateterpilih);
                            // $this->db->query("update kelas_praktikum set terisi = terisi + 1 where id = ". $kelas[$i]['id']);
                        }
                        
                        //UPDATE QUOTA
                        $dataupdatequota = array(
                            'id' => $kelas[$i]['id'],
                            'terisi' => (int)$kelas[$i]['terisi'] + $j
                        );
                        $this->kelas_praktikum_model->update($dataupdatequota);

                        // if($jumygambil <= $sisaquotakelas){ //SELAMA YG AMBIL MENCUKUPI QUOTA
                        //     //update smw data ambil prak     
                        //     for($j = 0; $j < $jumygambil; $j++){
                        //         $dataupdateterpilih = array(
                        //             'id' => $ambil_praktikum[$j]['id'],
                        //             'terpilih' => $kelas[$i]['id']
                        //         );
                        //         $this->ambil_praktikum_model->update($dataupdateterpilih);
                        //     }
                        //     //UPDATE QUOTA
                        //     $dataupdatequota = array(
                        //         'id' => $kelas[$i]['id'],
                        //         'terisi' => (int)$kelas[$i]['terisi'] + $jumygambil
                        //     );
                        //     $this->kelas_praktikum_model->update($dataupdatequota);
                        // }
                        // else { //MELEBIHI QUOTA
                        //     //update dta sbyk yg cukup

                        //     for($j = 0; $j < $sisaquotakelas; $j++){
                        //         $dataupdateterpilih = array(
                        //             'id' => $ambil_praktikum[$j]['id'],
                        //             'terpilih' => $kelas[$i]['id']
                        //         );
                        //         $this->ambil_praktikum_model->update($dataupdateterpilih);
                        //     }
                        //     //UPDATE QUOTA
                        //     $dataupdatequota = array(
                        //         'id' => $kelas[$i]['id'],
                        //         'terisi' => (int)$kelas[$i]['terisi'] + $sisaquotakelas
                        //     );
                        //     $this->kelas_praktikum_model->update($dataupdatequota);
                        // }
                    }
                    $data_log[] = $ambil_praktikum;
                }
                
            }
        }

        //KELAS RESPONSI
        $kelas = $this->kelas_praktikum_model->getbysubject($kode_mk, "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        if($kelas != 0){
            for($k = 0; $k < 4; $k++){

                $kelas = $this->kelas_praktikum_model->getbysubject($kode_mk, "responsi", $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
                
                for($i = 0; $i < count($kelas); $i++){
                    $ambil_praktikum = $this->ambil_praktikum_model->sortbypilnipk($kelas[$i]['id'], "pil".(int)($k+1)); //GET SELAMA TERPILIH = 0 (BELUM TERPILIH)
                    // var_dump($ambil_praktikum); exit;
                    if($ambil_praktikum != 0){
                        $jumygambil = count($ambil_praktikum);
                        $sisaquotakelas = (int)$kelas[$i]['quota_max'] - (int)$kelas[$i]['terisi'];

                        for($j = 0; $j < $jumygambil && $j < $sisaquotakelas; $j++){
                            $dataupdateterpilih = array(
                                'id' => $ambil_praktikum[$j]['id'],
                                'terpilih' => $kelas[$i]['id']
                            );
                            $this->ambil_praktikum_model->update($dataupdateterpilih);
                        }
                        //UPDATE QUOTA
                        $dataupdatequota = array(
                            'id' => $kelas[$i]['id'],
                            'terisi' => (int)$kelas[$i]['terisi'] + $j
                        );
                        $this->kelas_praktikum_model->update($dataupdatequota);
                        // if($jumygambil <= $sisaquotakelas){ //SELAMA YG AMBIL MENCUKUPI QUOTA
                        //     //update smw data ambil prak     
                        //     for($j = 0; $j < $jumygambil; $j++){
                        //         $dataupdateterpilih = array(
                        //             'id' => $ambil_praktikum[$j]['id'],
                        //             'terpilih' => $kelas[$i]['id']
                        //         );
                        //         $this->ambil_praktikum_model->update($dataupdateterpilih);
                        //     }
                        //     //UPDATE QUOTA
                        //     $dataupdatequota = array(
                        //         'id' => $kelas[$i]['id'],
                        //         'terisi' => (int)$kelas[$i]['terisi'] + $jumygambil
                        //     );
                        //     $this->kelas_praktikum_model->update($dataupdatequota);
                        // }
                        // else { //MELEBIHI QUOTA
                        //     //update dta sbyk yg cukup

                        //     for($j = 0; $j < $sisaquotakelas; $j++){
                        //         $dataupdateterpilih = array(
                        //             'id' => $ambil_praktikum[$j]['id'],
                        //             'terpilih' => $kelas[$i]['id']
                        //         );
                        //         $this->ambil_praktikum_model->update($dataupdateterpilih);
                        //     }
                        //     //UPDATE QUOTA
                        //     $dataupdatequota = array(
                        //         'id' => $kelas[$i]['id'],
                        //         'terisi' => (int)$kelas[$i]['terisi'] + $sisaquotakelas
                        //     );
                        //     $this->kelas_praktikum_model->update($dataupdatequota);
                        // }
                    }
                    $data_log[] = $ambil_praktikum;
                }
                
            }
        }

        // var_dump($ambil_praktikum); exit;


        // insert log
        $keterangan = '';
        $keterangan .= json_encode($data_log).'.';

        $logs_insert = array(
            "id_user" => $this->session->userdata('user_id'),
            "table_name" => 'ambil_praktikum',
            "action" => 'CREATE',
            "keterangan" => "pemilihan kelas have been updated by ".$this->session->userdata('logged_name')." : ".$keterangan,
            "created" => date('Y-m-d H:i:s')
        );
        $this->load->model('user_history_model');
        $this->user_history_model->add($logs_insert);

        
        echo "sukses";
        //langsung redirect buat refresh kalik
        // $this->session->set_flashdata('msg', "Sukses pemilihan kelas");
        // redirect('ambil_praktikum');
        // var_dump($kode_mk); exit;
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

        // var_dump($peserta); exit;
        if($peserta != 0){

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
    public function getterpilihkelas(){
		$this->load->model('ambil_praktikum_model');

		$mahasiswa = $this->ambil_praktikum_model->getterpilihkelas($this->input->post('id'));
		
        echo json_encode($mahasiswa);
	}

    
    public function terpilih(){
        $this->load->model('kelas_praktikum_model');
        $this->load->model('ambil_praktikum_model');

        // var_dump($this->input->post("data_ambil_praktikum")); exit;

        $kelas_praktikum = $this->input->post("data_kelas_praktikum");
        $ambil_praktikum = $this->input->post("data_ambil_praktikum");

        // var_dump($kelas_praktikum); exit;
        for($i = 0; $i < count($kelas_praktikum); $i++){
            $this->kelas_praktikum_model->update($kelas_praktikum[$i]);
        }

        for($i = 0; $i < count($ambil_praktikum); $i++){
            $this->ambil_praktikum_model->update($ambil_praktikum[$i]);
        }

        //CEK NGULANG QUOTA
        for($i = 0; $i < count($kelas_praktikum); $i++){
            $getcountmahasiswa = $this->ambil_praktikum_model->getcountterpilih($kelas_praktikum[$i]);
            $data = array(
                'id' => $kelas_praktikum[$i],
                'terisi' => $getcountmahasiswa[0]['jumlah_terpilih']
            );
            $this->kelas_praktikum_model->update($data);
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
        $this->load->model('mahasiswa_matakuliah_model');
        $this->load->model('jadwal_berhalangan_model');
        $this->load->model('informasi_umum_model');

        if($this->input->post('idkelasprak') == "placeholder_text") { 
            echo ""; 
        }
        else {
            $kelas_praktikum = $this->kelas_praktikum_model->get($this->input->post('idkelasprak'));
            $nrp = $this->input->post('nrp');
            // var_dump($kelas_praktikum); exit;
            // var_dump($this->input->post('nrp')); exit;
            // $getnabrak = $this->ambil_praktikum_model->getnabrak($this->input->post('nrp'), $kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            // var_dump($getnabrak); exit;
            // echo $getnabrak;
            // var_dump($kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

            $jadwal_perkuliahan = $this->mahasiswa_matakuliah_model->getnabrakmahasiswamatakuliah($nrp, $kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        
            $jadwal_berhalangan = $this->jadwal_berhalangan_model->getnabrakjadwalberhalangan($nrp, $kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
            $jadwal_praktikum = $this->kelas_praktikum_model->getnabrakkelaspraktikum($nrp, $kelas_praktikum[0]['hari'], $kelas_praktikum[0]['jam'], $kelas_praktikum[0]['durasi'], $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

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
            // var_dump($jadwal_perkuliahan); exit;
            echo $hasil;
        }
    }

    public function getambilprakbynrp(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $ambil_praktikum = $this->ambil_praktikum_model->getambilprakbynrp($this->input->post('nrp'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($ambil_praktikum);
    }

    public function cekambilprak(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        $ambil_praktikum = $this->ambil_praktikum_model->getambilprakbynrpnkodemk($this->input->post('nrp'), $this->input->post('kode_mk'), $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());

        echo json_encode($ambil_praktikum);
    }

    public function getmahasiswaambil(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');

        // $this->input->post('id_subject');
        // var_dump($this->input->post('id'));exit;
        $tahun_ajaran = $this->input->post('tahun_ajaran'). "-" . intval($this->input->post('tahun_ajaran') + 1);
        if($this->input->post('id') != null || $this->input->post('id') != 0){
            $ambil_praktikum = $this->ambil_praktikum_model->getmahasiswaambil($this->input->post('id'), $this->input->post('semester'), $tahun_ajaran);
        }
        // else{
        //     $ambil_praktikum = $this->ambil_praktikum_model->getmahasiswaambil(0, $this->informasi_umum_model->getsemester(), $this->informasi_umum_model->gettahunajaran());
        // }
        
        echo json_encode($ambil_praktikum);
    }

    public function getmahasiswatertolak(){
        $this->load->model('ambil_praktikum_model');
        $this->load->model('informasi_umum_model');
        $this->load->model('mahasiswa_matakuliah_model');

        $tahun_ajaran = $this->input->post('tahun_ajaran'). "-" . intval($this->input->post('tahun_ajaran') + 1); //'+1year'

        // $kode_mk = $this->input->post('id');

        // $getjadwal_perkuliahan = $this->mahasiswa_matakuliah_model->getbysubject($this->input->post('semester'), $tahun_ajaran);

        // $ambil_praktikum = $this->ambil_praktikum_model->getdetailkelas($kode_mk, "praktikum", $this->input->post('semester'), $tahun_ajaran);

        $ambil_praktikum = $this->ambil_praktikum_model->getmahasiswatertolak($this->input->post('id'), $this->input->post('semester'), $tahun_ajaran);

        echo json_encode($ambil_praktikum);
    }

    public function adds(){

        $this->load->model('pendaftaran_praktikum_model');

        if($this->session->userdata('user_type') != 'admin' && $this->session->userdata('user_type') != 'asisten_dosen' && $this->session->userdata('user_type') != 'asisten_tetap' && $this->session->userdata('user_type') != 'mahasiswa') redirect('dashboard');
        
        if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'kepala_lab'){
            $data["bukapendaftaran"] = "buka";
        }
        else{ //MAHASISWA / DOSEN
            $data["bukapendaftaran"] = $this->pendaftaran_praktikum_model->cekbukapendaftaran();
            // $data["bukapendaftaran"] = "buka";
            // var_dump("MASUKKKKKK");
            // var_dump($data['bukapendaftaran']); exit;
        }

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

    public function getterpilihbyid(){
        $this->load->model('ambil_praktikum_model');

        $ambil_praktikum = $this->ambil_praktikum_model->get($this->input->post('idambilprak'));

        echo $ambil_praktikum[0]['terpilih'];
    }

    public function updates($id = null){

        // $check = $this->access_group_model->getbynama($this->session->userdata('user_level'));
		// if ($check == 0) redirect('dashboard');

        $id = base64_decode($id);

        $this->load->model('ambil_praktikum_model');
        $this->load->model('pendaftaran_praktikum_model');

        if($this->session->userdata('user_type') == 'admin' || $this->session->userdata('user_type') == 'kepala_lab'){
            $data["bukapendaftaran"] = "buka";
        }
        else{ //MAHASISWA / DOSEN
            $data["bukapendaftaran"] = $this->pendaftaran_praktikum_model->cekbukapendaftaran();
        }

		$res = $this->ambil_praktikum_model->get($id);

        if ($res == 0) redirect('dashboard');

        $data['detil'] = $res;
        
        $data['title'] = "Edit Ambil Praktikum";

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

        $this->load->model('ambil_praktikum_model');
        $this->load->model('pendaftaran_praktikum_model');
        $this->load->model('informasi_umum_model');

        // var_dump($this->input->post('data')); exit;
        // $this->load->library('form_validation');
        
        // $status = ($this->input->post('status')=='on') ? 1 : 0;
        $data_jadwal = $this->input->post('data');

        // var_dump(($data_jadwal[0]['NRP'])); exit;
        if(count($data_jadwal) > 0){
            for($i = 0; $i < count($data_jadwal); $i++){

                // var_dump($data_jadwal[$i]['NRP'], $data_jadwal[$i]['kode_mk'], $data_jadwal[$i]['tipe'], $this->informasi_umum_model->getsemester(),$this->informasi_umum_model->gettahunajaran()); exit;
    
                $getidwhere = $this->ambil_praktikum_model->getidwhere($data_jadwal[$i]['NRP'], $data_jadwal[$i]['kode_mk'], $data_jadwal[$i]['tipe'], $this->informasi_umum_model->getsemester(),$this->informasi_umum_model->gettahunajaran());
    
                if($getidwhere != 0){
                    $ppactive = $this->pendaftaran_praktikum_model->getbukapendaftaran();
    
                    if($ppactive != 0){
                        $ppke = $ppactive[0]['PP'];
                    }
                    else{
                        $ppke = 9; //pendaftaran lagi gak buka
                    }
                    $data = array(
                        'id' => $getidwhere[0]['id'],
                        'pil1' => $data_jadwal[$i]['pil1'],
                        'pil2' => $data_jadwal[$i]['pil2'],
                        'pil3' => $data_jadwal[$i]['pil3'],
                        'PP' => $ppke
                    );
                    $this->ambil_praktikum_model->update($data);
                    $data_insert[] = $data;
                }
                else{
                    $ppactive = $this->pendaftaran_praktikum_model->getbukapendaftaran();
    
                    if($ppactive != 0){
                        $ppke = $ppactive[0]['PP'];
                    }
                    else{
                        $ppke = 9; //pendaftaran lagi gak buka
                    }
                    $data = array(
                        'NRP'  => $data_jadwal[$i]['NRP'],
                        'kode_mk' => $data_jadwal[$i]['kode_mk'],
                        'tipe' => $data_jadwal[$i]['tipe'],
                        'pil1' => $data_jadwal[$i]['pil1'],
                        'pil2' => $data_jadwal[$i]['pil2'],
                        'pil3' => $data_jadwal[$i]['pil3'],
                        'PP' => $ppke,
                        'semester' => $this->informasi_umum_model->getsemester(),
                        'tahun_ajaran' => $this->informasi_umum_model->gettahunajaran()
                    );
                    $this->ambil_praktikum_model->add($data);
                    $data_insert[] = $data;
                }
            }
            
            // insert log
            $keterangan = '';
            $keterangan .= json_encode($data_insert).'.';
    
            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'ambil_praktikum',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);
    
            // redirect('ambil_praktikum/adds');
            // $this->session->set_flashdata('msg', "Sukses Menambahkan Data");
            // redirect($_SERVER['HTTP_REFERER']);
            echo "success";
        }
        else{
            // $this->session->set_flashdata('msg', "Tidak ada data yang dipilih");
            // redirect($_SERVER['HTTP_REFERER']);
            echo "Tidak ada data yang dipilih";
        }
        
    }

    // public function update(){
    //     // $id = base64_decode($id);

    //     $status = ($this->input->post('status')=='on') ? 1 : 0;

    //     $data = array(
    //         'id' => $this->input->post('idambilpraktikum'),
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

    //         $this->load->model('ambil_praktikum_model');
    //         // var_dump("AAAAA", $data['id']); exit;
    //         $old_data = $this->ambil_praktikum_model->get($data['id']);

    //         // var_dump("OLD DATA: ", $old_data); exit;
    //         $this->ambil_praktikum_model->update($data);

    //         // insert log
    //         $keterangan = '';
    //         $keterangan .= $old_data[0]['nama']. ' to '. $data['nama'].'; ';
    //         $keterangan .= $old_data[0]['status']. ' to '. $data['status'].';';
    //         $keterangan .= $old_data[0]['keterangan']. ' to '. $data['keterangan'].'; ';

    //         $logs_insert = array(
    //             "id_user" => $this->session->userdata('user_id'),
    //             "table_name" => 'ambil_praktikum',
    //             "action" => 'UPDATE',
    //             "keterangan" => $this->session->userdata('logged_name')." updated record # : ".$data['id']. ": ". $keterangan,
    //             "created" => date('Y-m-d H:i:s')
    //         );
    //         $this->load->model('user_history_model');
    //         $this->user_history_model->add($logs_insert);

    //         redirect('ambil_praktikum');
    //     }    
    // }
}