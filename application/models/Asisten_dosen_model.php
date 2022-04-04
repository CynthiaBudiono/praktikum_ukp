<?php

class Asisten_dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('asisten_dosen.*, mahasiswa.nama as nama_mahasiswa, pendaftaran_asisten_dosen.semester as semester_pendaftaran_asdos, pendaftaran_asisten_dosen.tahun_ajaran as tahun_ajaran_pendaftaran_asdos');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = asisten_dosen.NRP');
		$this->db->join('pendaftaran_asisten_dosen', 'pendaftaran_asisten_dosen.id = asisten_dosen.id_pendaftaran_asisten_dosen');
		$query = $this->db->get('asisten_dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getallactive() {
		$this->db->select('asisten_dosen.*, mahasiswa.nama as nama');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = asisten_dosen.NRP');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->where('asisten_dosen.status', 1)->get('asisten_dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getbyNIP($nip) {

		$query = $this->db->where('NIP', $nip)->get('asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('asisten_dosen',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('asisten_dosen', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('asisten_dosen');
	}
}