<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran_praktikum extends CI_Controller {

	public function index()
	{

        $data['start_date'] = date("m/d/Y");

        $data['end_date'] = date('m/d/Y', strtotime("2 days"));

		$this->load->view('general/header');

		$this->load->view('general/sidebar');

		$this->load->view('general/navbar');

		$this->load->view('content/pendaftaran_praktikum', $data);

		$this->load->view('general/footer');
	}
}