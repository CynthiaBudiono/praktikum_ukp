<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('login');
	    if($this->session->userdata('user_type') != 'admin') redirect('dashboard');
	}


	public function index()
	{

		$this->load->model('user_history_model');

		$data['user_history'] = $this->user_history_model->getbackup();

		$data['title'] = "Backup";

        $this->load->model('informasi_umum_model');
		
		$data['logo']=$this->informasi_umum_model->get(1)[0]['nilai'];
		$data['semester']=($this->informasi_umum_model->getsemester() == 1) ? "Ganjil" : "Genap" ;
		$data['tahun_ajaran']=$this->informasi_umum_model->gettahunajaran();
		$data['nama_footer']=$this->informasi_umum_model->get(4)[0]['nilai'];
		$data['link_footer']=$this->informasi_umum_model->get(5)[0]['nilai'];

		$this->load->view('general/header');

		$this->load->view('general/sidebar', $data);

		$this->load->view('general/navbar', $data);

		$this->load->view('content/backup', $data);

		$this->load->view('general/footer', $data);
	}

	public function dobackup(){
		// var_dump("masuk"); exit;

		// $url = $_GET['path'];
		$namefile = 'db-praktikum_ukp-backup-' . date("Y-m-d-H-i-s") . '.sql';
		
		// exec('mysqldump c14180210 -uc14180210 -pGFH457 > '.$namefile);

		// readfile($url, $namefile);


		// getenv('HOMEDRIVE')."/Downloads/".

		 // insert log
		 $logs_insert = array(
			 "id_user" => $this->session->userdata('user_id'),
			 "table_name" => 'all',
			 "action" => 'CREATE',
			 "keterangan" => "backup data has been created by ".$this->session->userdata('logged_name'),
			 "created" => date('Y-m-d H:i:s')
		 );
		 $this->load->model('user_history_model');
		 $this->user_history_model->add($logs_insert);

		 redirect('backup');
	}
}