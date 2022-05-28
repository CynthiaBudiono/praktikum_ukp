<?php

class Mahasiswa_matakuliah_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa_matakuliah.*, mahasiswa.nama as nama_mahasiswa, subject.nama as nama_subject');
		$this->db->join('subject', 'subject.kode_mk = mahasiswa_matakuliah.kode_mk');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_matakuliah.NRP');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');

		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function viewbylogin($nrp, $semester, $tahun_ajaran){

		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');

		$this->db->where('mahasiswa_matakuliah.NRP', $nrp);

		if($semester != null){
			$this->db->where('mahasiswa_matakuliah.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getidmahasiswamatakuliah($nrp, $kode_mk, $semester, $tahun_ajaran){
		$this->db->where('mahasiswa_matakuliah.NRP', $nrp);
		$this->db->where('mahasiswa_matakuliah.kode_mk', $kode_mk);

		if($semester != null){
			$this->db->where('mahasiswa_matakuliah.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getnabrakmahasiswamatakuliah($pengajar, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('jadwal_perkuliahan.*');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->where('jadwal_perkuliahan.hari', $hari);

		$this->db->where('mahasiswa_matakuliah.NRP', $pengajar);

		$this->db->where('jadwal_perkuliahan.status', 1);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('jadwal_perkuliahan.semester', $semester);
        	$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('mahasiswa_matakuliah');
		// var_dump($query->num_rows()); exit;
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$startkuliah = $row['jam'];
				$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));
				// var_dump("MASUKKKK"); exit;
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

		$query = $this->db->where('id', $id)->get('mahasiswa_matakuliah', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getsubjectbyNRP($nrp, $semester, $tahun_ajaran){
		$this->db->distinct();
		$this->db->select('subject.*');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');
		$this->db->where('mahasiswa_matakuliah.NRP', $nrp);

		if($semester != null){
			$this->db->where('mahasiswa_matakuliah.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getpesertapraktikum($semester, $tahun_ajaran){
		$this->db->select('mahasiswa_matakuliah.*, subject.kode_mk as kode_mk, subject.status_praktikum as status_praktikum, subject.status_responsi as status_responsi');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');

		$this->db->group_start()
		  ->or_where('subject.status_praktikum', 1)
		  ->or_where('subject.status_responsi', 1);
		$this->db->group_end();

		$this->db->where('mahasiswa_matakuliah.semester', $semester);
        $this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getbyNRP($id, $semester, $tahun_ajaran){

		$this->db->select('jadwal_perkuliahan.*');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');

		$this->db->where('jadwal_perkuliahan.semester', $semester);
		$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
        $query = $this->db->where('mahasiswa_matakuliah.NRP', $id)->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

	// public function getbyNRP($id) {

	// 	$query = $this->db->where('id', $id)->get('mahasiswa_matakuliah', 1, 0);

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;

	// }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('mahasiswa_matakuliah',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('mahasiswa_matakuliah', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('mahasiswa_matakuliah');
	}
}