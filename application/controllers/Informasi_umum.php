<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi_umum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}

	public function index()
	{
		$this->load->model('informasi_umum_model');

		$data['informasi_umum'] = $this->informasi_umum_model->getallopen();

		// var_dump($data['informasi_umum']); exit;
        // $data['start_year'] = date("Y");

        // $data['end_year'] = date('Y', strtotime("1 year"));

		$data['title'] = "Informasi Umum";
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->get(2)[0]['nilai'] == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->get(3)[0]['nilai'];
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/informasi_umum', $data);

		$this->load->view('general/footer', $data);
	}

	public function update(){
        $this->load->helper(array('form', 'url'));
		// var_dump($this->input->post('nama_link_footer')); exit;

		$data = array(
            'logo' => $_FILES['logo_web']['name'],
            'semester' => $this->input->post('semester'),
            'tahun_ajaran' => $this->input->post('tahun_ajaran'),
            'nama_footer' => $this->input->post('nama_link_footer'),
            'link_footer' => $this->input->post('link_footer')
        );

        //check validasi
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('nama_footer', 'nama footer', 'required|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $detil[0] = $data;
            echo validation_errors();
            // var_dump("loh masuk sini kah", validation_errors()); exit;
        }
        else {
            $this->load->helper(array('form', 'url'));

            $this->load->model('informasi_umum_model');

            $old_data = $this->informasi_umum_model->getallopen();


            // var_dump($_FILES['logo_web']['name']);
            if((!empty($_FILES)) && !empty($_FILES['logo_web']['name'])) {
				$this->load->helper(array('form', 'url'));
	            $nama_logo = "logo-".date('YmdHis');
		        $config['upload_path']          = './assets/images/';
		        $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp';
		        $config['file_name']            = $nama_logo;
		        $config['overwrite']            = true;
		        // $config['max_size']             = 1024; // 1MB

		       	$this->load->library('upload', $config);
		        $this->upload->initialize($config);

                // var_dump($this->upload->data('is_image'));
                // $name_foto_logo = "";
			  	if ( ! $this->upload->do_upload('logo_web')){
	                // $this->session->set_flashdata('logo_web','Ukuran Foto Tidak Sesuai');
                    // var_dump("bah masuk if");
                    // var_dump($this->upload->display_errors()); exit;
                    echo $this->upload->display_errors();
	                // redirect("informasi_umum");
	            }
                else{
	                $name_foto_logo = $this->upload->data('file_name');
                    // var_dump("bah masuk elseif");

                    delete_files('./assets/images/'.$old_data[0]['nilai'], true);
	            }
                // else{
	            //     $name_foto_logo = "";
                //     var_dump("bah masuk else");
	            // }

                $data_insert1 = array(
                    "id" => 1,
                    "nilai" => $name_foto_logo
                );

                $data['logo'] = $name_foto_logo;

				$this->informasi_umum_model->update($data_insert1);
                // var_dump("berhasil ", $name_foto_logo, " aaa ", $this->upload->data('file_name')); exit;
	        }
                        

            $data_insert2 = array(
                "id" => 2,
                "nilai" => $this->input->post('semester')
            );

            $data_insert3 = array(
                "id" => 3,
                "nilai" => $this->input->post('tahun_ajaran')
            );

            $data_insert4 = array(
                "id" => 4,
                "nilai" => $this->input->post('nama_link_footer')
            );

            $data_insert5 = array(
                "id" => 5,
                "nilai" => $this->input->post('link_footer')
            );

            $this->informasi_umum_model->update($data_insert2);
            $this->informasi_umum_model->update($data_insert3);
            $this->informasi_umum_model->update($data_insert4);
            $this->informasi_umum_model->update($data_insert5);

            // insert log
            $keterangan = '';
    
            if((!empty($_FILES)) && !empty($_FILES['logo_web']['name'])){
                $keterangan .= $old_data[0]['nilai']. ' to '. $data['logo'].'; ';
            }
            if($old_data[1]['nilai'] != $data['semester']){
                $keterangan .= $old_data[1]['nilai']. ' to '. $data['semester'].'; ';
            }
            if($old_data[2]['nilai'] != $data['tahun_ajaran']){
                $keterangan .= $old_data[2]['nilai']. ' to '. $data['tahun_ajaran'].'; ';
            }
            if($old_data[3]['nilai'] != $data['nama_footer']){
                $keterangan .= $old_data[3]['nilai']. ' to '. $data['nama_footer'].'; ';
            }
            if($old_data[4]['nilai'] != $data['link_footer']){
                $keterangan .= $old_data[4]['nilai']. ' to '. $data['link_footer'].'; ';
            }

            $logs_insert = array(
                "id_user" => $this->session->userdata('user_id'),
                "table_name" => 'informasi_umum',
                "action" => 'UPDATE',
                "keterangan" => $this->session->userdata('logged_name')." updated record # : ". $keterangan,
                "created" => date('Y-m-d H:i:s')
            );
            $this->load->model('user_history_model');
            $this->user_history_model->add($logs_insert);

            redirect('informasi_umum');
        }
		
	}
}