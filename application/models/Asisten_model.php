<?php

class Asisten_model extends CI_Model {

    public function getallopen() {
		$this->db->select('asisten.*, mahasiswa.nama as nama_mahasiswa, pendaftaran_asisten_dosen.semester as semester_pendaftaran_asdos, pendaftaran_asisten_dosen.tahun_ajaran as tahun_ajaran_pendaftaran_asdos');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = asisten.NRP');
		$this->db->join('pendaftaran_asisten_dosen', 'pendaftaran_asisten_dosen.id = asisten.id_pendaftaran_asisten_dosen');
		$query = $this->db->get('asisten');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getallactive() {
		$this->db->select('asisten.*, mahasiswa.nama as nama');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = asisten.NRP');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->where('asisten.status', 1)->get('asisten');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('asisten', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getbyNRP($nrp) {

		$query = $this->db->where('NRP', $nrp)->get('asisten', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getlastrecord($nrp){
		$this->db->where('NRP', $nrp);
		$this->db->where('tanggal_diterima != NULL');
		$this->db->where('status', 1);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('asisten', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('asisten',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('asisten', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('asisten');
	}
}