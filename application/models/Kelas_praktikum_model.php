<?php

class Kelas_praktikum_model extends CI_Model {

    public function getallopen($semester = null, $tahun_ajaran = null) { //klo update ini update juga func getjadwalforambilprak
		$this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1');
		$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2');
		$this->db->select(' d3.NIP as NIP3, d3.nama as nama_dosen3');
		$this->db->select(' m1.NRP as NRP1, m1.nama as nama_mahasiswa1');
		$this->db->select(' m2.NRP as NRP2, m2.nama as nama_mahasiswa2');
		$this->db->select(' m3.NRP as NRP3, m3.nama as nama_mahasiswa3');

		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject, laboratorium.nama as nama_lab, laboratorium.quota_max');

        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = kelas_praktikum.kode_lab');

		$this->db->join('dosen as d1', 'd1.NIP = kelas_praktikum.NIP1', 'left');
		$this->db->join('dosen as d2', 'd2.NIP = kelas_praktikum.NIP2', 'left');
		$this->db->join('dosen as d3', 'd3.NIP = kelas_praktikum.NIP3', 'left');
		$this->db->join('mahasiswa as m1', 'm1.NRP = kelas_praktikum.NIP1', 'left');
		$this->db->join('mahasiswa as m2', 'm2.NRP = kelas_praktikum.NIP2', 'left');
		$this->db->join('mahasiswa as m3', 'm3.NRP = kelas_praktikum.NIP3', 'left');

		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getrecentactivitieslab($semester = null, $tahun_ajaran = null){

		$hari = date('l');
		if($hari == 'Monday'){
			$hari = 'Senin';
		}
		else if($hari == 'Tuesday'){
			$hari = 'Selasa';
		}
		else if($hari == 'Wednesday'){
			$hari = 'Rabu';
		}
		else if($hari == 'Thursday'){
			$hari = 'Kamis';
		}
		else if($hari == 'Friday'){
			$hari = 'Jumat';
		}
		else if($hari == 'Saturday'){
			$hari = 'Sabtu';
		}

		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		$this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1');
		$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2');
		$this->db->select(' d3.NIP as NIP3, d3.nama as nama_dosen3');
		$this->db->select(' m1.NRP as NRP1, m1.nama as nama_mahasiswa1');
		$this->db->select(' m2.NRP as NRP2, m2.nama as nama_mahasiswa2');
		$this->db->select(' m3.NRP as NRP3, m3.nama as nama_mahasiswa3');

		$this->db->join('dosen as d1', 'd1.NIP = kelas_praktikum.NIP1', 'left');
		$this->db->join('dosen as d2', 'd2.NIP = kelas_praktikum.NIP2', 'left');
		$this->db->join('dosen as d3', 'd3.NIP = kelas_praktikum.NIP3', 'left');
		$this->db->join('mahasiswa as m1', 'm1.NRP = kelas_praktikum.NIP1', 'left');
		$this->db->join('mahasiswa as m2', 'm2.NRP = kelas_praktikum.NIP2', 'left');
		$this->db->join('mahasiswa as m3', 'm3.NRP = kelas_praktikum.NIP3', 'left');

		$this->db->where('kelas_praktikum.hari', $hari);
		$this->db->where('kelas_praktikum.jam <= ', date('H:i:s'));
		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getjadwalforambilprak($kode_mk, $tipe, $semester = null, $tahun_ajaran = null){ //sama kayak get all open beda where
		$this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1');
		$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2');
		$this->db->select(' d3.NIP as NIP3, d3.nama as nama_dosen3');
		$this->db->select(' m1.NRP as NRP1, m1.nama as nama_mahasiswa1');
		$this->db->select(' m2.NRP as NRP2, m2.nama as nama_mahasiswa2');
		$this->db->select(' m3.NRP as NRP3, m3.nama as nama_mahasiswa3');

		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$this->db->join('dosen as d1', 'd1.NIP = kelas_praktikum.NIP1', 'left');
		$this->db->join('dosen as d2', 'd2.NIP = kelas_praktikum.NIP2', 'left');
		$this->db->join('dosen as d3', 'd3.NIP = kelas_praktikum.NIP3', 'left');
		$this->db->join('mahasiswa as m1', 'm1.NRP = kelas_praktikum.NIP1', 'left');
		$this->db->join('mahasiswa as m2', 'm2.NRP = kelas_praktikum.NIP2', 'left');
		$this->db->join('mahasiswa as m3', 'm3.NRP = kelas_praktikum.NIP3', 'left');

		$this->db->where('kelas_praktikum.kode_mk', $kode_mk);
		$this->db->where('kelas_praktikum.tipe', $tipe);
		
		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getbysubject($kode_mk, $tipe, $semester = null, $tahun_ajaran = null){ //sama kayak get all open beda where
	
		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject, laboratorium.quota_max as quota_max');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = kelas_praktikum.kode_lab');

		$this->db->order_by('kelas_paralel', 'ASC');

		if($kode_mk != ""){
			$this->db->where('kelas_praktikum.kode_mk', $kode_mk);
		}
		if($tipe != ""){
			$this->db->where('kelas_praktikum.tipe', $tipe);
		}
		
		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    // public function getkelasnow($semester, $tahun_ajaran){
	// 	$this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1');
	// 	$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2');
	// 	$this->db->select(' d3.NIP as NIP3, d3.nama as nama_dosen3');
	// 	$this->db->select(' m1.NRP as NRP1, m1.nama as nama_mahasiswa1');
	// 	$this->db->select(' m2.NRP as NRP2, m2.nama as nama_mahasiswa2');
	// 	$this->db->select(' m3.NRP as NRP3, m3.nama as nama_mahasiswa3');

    //     $this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
    //     $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
	// 	$this->db->join('dosen as d1', 'd1.NIP = kelas_praktikum.NIP1', 'left');
	// 	$this->db->join('dosen as d2', 'd2.NIP = kelas_praktikum.NIP2', 'left');
	// 	$this->db->join('dosen as d3', 'd3.NIP = kelas_praktikum.NIP3', 'left');
	// 	$this->db->join('mahasiswa as m1', 'm1.NRP = kelas_praktikum.NIP1', 'left');
	// 	$this->db->join('mahasiswa as m2', 'm2.NRP = kelas_praktikum.NIP2', 'left');
	// 	$this->db->join('mahasiswa as m3', 'm3.NRP = kelas_praktikum.NIP3', 'left');
    //     $this->db->where('kelas_praktikum.semester', $semester);
    //     $this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
	// 	$query = $this->db->get('kelas_praktikum');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
    // }

	// new get class group
	public function getactive_subject($semester, $tahun_ajaran){
		$this->db->distinct();
		$this->db->select('subject.*');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		$this->db->where('kelas_praktikum.status', 1);

		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)
			return $query->result_array();
		else
			return 0;
	}

	public function getactive_kelaspraktikum($kode_mk, $tipe, $semester, $tahun_ajaran){
		$this->db->distinct();
		$this->db->select('kelas_praktikum.*, laboratorium.nama as nama_laboratorium, laboratorium.quota_max as quota_max');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = kelas_praktikum.kode_lab');

		$this->db->where('kelas_praktikum.kode_mk', $kode_mk);
		$this->db->where('kelas_praktikum.tipe', $tipe);
		$this->db->where('kelas_praktikum.status', 1);

		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)
			return $query->result_array();
		else
			return 0;
	}

	public function getpengajar($semester, $tahun_ajaran){ //untuk jadwal berhalangan
		$this->db->distinct();
        $this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1, d1.status as status_dosen1, d1.last_login as last_login_dosen1');
		$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2, d2.status as status_dosen2, d2.last_login as last_login_dosen2');
		$this->db->select(' d3.NIP as NIP3, d3.nama as nama_dosen3, d3.status as status_dosen3, d3.last_login as last_login_dosen3');
		$this->db->select(' m1.NRP as NRP1, m1.nama as nama_mahasiswa1, m1.status as status_mahasiswa1, m1.last_login as last_login_mahasiswa1');
		$this->db->select(' m2.NRP as NRP2, m2.nama as nama_mahasiswa2, m2.status as status_mahasiswa2, m1.last_login as last_login_mahasiswa2');
		$this->db->select(' m3.NRP as NRP3, m3.nama as nama_mahasiswa3, m3.status as status_mahasiswa3, m1.last_login as last_login_mahasiswa3');

        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$this->db->join('dosen as d1', 'd1.NIP = kelas_praktikum.NIP1', 'left');
		$this->db->join('dosen as d2', 'd2.NIP = kelas_praktikum.NIP2', 'left');
		$this->db->join('dosen as d3', 'd3.NIP = kelas_praktikum.NIP3', 'left');
		$this->db->join('mahasiswa as m1', 'm1.NRP = kelas_praktikum.NIP1', 'left');
		$this->db->join('mahasiswa as m2', 'm2.NRP = kelas_praktikum.NIP2', 'left');
		$this->db->join('mahasiswa as m3', 'm3.NRP = kelas_praktikum.NIP3', 'left');
		// $this->db->join('mahasiswa', 'subject.kode_mk = kelas_praktikum.kode_mk');
        $this->db->where('kelas_praktikum.semester', $semester);
        $this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

	public function getactive($semester, $tahun_ajaran){
		$this->db->distinct();
		$this->db->select('subject.*');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		$this->db->where('kelas_praktikum.status', 1);

		if($semester != null){
			$this->db->where('kelas_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getmahasiswa($id){
		$this->db->select('ambil_praktikum.*, subject.nama as nama_subject, mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
        $this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$query = $this->db->where('terpilih', $id)->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getdetailmahasiswa($id, $semester = null, $tahun_ajaran= null){

		$query = '';
		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		if($id != 0){ // FLITER BY ID KELAS
			$this->db->where('id', $id); //->get('kelas_praktikum', 1, 0);
		}
		else{ //GET ALL KELAS
			if($semester != null){
				$this->db->where('kelas_praktikum.semester', $semester);
			}
			if($tahun_ajaran != null){
				$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
			}
		}
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0){

			$arr= [];
			$jumarr = 0;
			foreach($query->result_array() as $row){
				$arr[$jumarr] = $row;
				$arr[$jumarr]['mahasiswa'] = $this->getmahasiswa($row['id']);
				$jumarr++;
			}
			return $arr;
			// return $query->result_array();
		}
		
		else

			return 0;

	}

	public function getnabrakkelaspraktikum($pengajar, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('kelas_praktikum.*');
		$this->db->where('kelas_praktikum.hari', $hari);

		$this->db->group_start()
		  ->or_where('kelas_praktikum.NIP1', $pengajar)
		  ->or_where('kelas_praktikum.NIP2', $pengajar)
		  ->or_where('kelas_praktikum.NIP3', $pengajar);
		$this->db->group_end();

		$this->db->where('kelas_praktikum.status', 1);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('kelas_praktikum.semester', $semester);
        	$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$startkuliah = $row['jam'];
				$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

				if(($jam >= $startkuliah && $jam <= $endkuliah) || ($jamend >= $startkuliah && $jamend <= $endkuliah)){
					// return 'yes';
					$flag = 1;
				}
			}
		}
		
		if($flag == 1)
			return 'yes'; //NABRAK
		
		else
			return 'no';
	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('kelas_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('kelas_praktikum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('kelas_praktikum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('kelas_praktikum');
	}
}