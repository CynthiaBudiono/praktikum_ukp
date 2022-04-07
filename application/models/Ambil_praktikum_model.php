<?php

class Ambil_praktikum_model extends CI_Model {

    public function getallopen($semester = null, $tahun_ajaran = null) {

		$this->db->select('ambil_praktikum.*, mahasiswa.nama as nama_mahasiswa, subject.nama as nama_subject');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getclassgroup($semester = null, $tahun_ajaran = null) {

		$this->db->select('count(id) as jumlah_daftar, ambil_praktikum.*');
		// $this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		// $this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
		$this->db->group_by(array("ambil_praktikum.kode_mk", "ambil_praktikum.tipe"));

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getdetailkelas($kode_mk, $tipe, $semester = null, $tahun_ajaran = null){

		$this->db->select('ambil_praktikum.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.angkatan as angkatan, mahasiswa.ips as ips, mahasiswa.ipk as ipk, subject.nama as nama_subject');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		$this->db->where('ambil_praktikum.kode_mk', $kode_mk);
		$this->db->where('ambil_praktikum.tipe', $tipe);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('ambil_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('ambil_praktikum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('ambil_praktikum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('ambil_praktikum');
	}
}