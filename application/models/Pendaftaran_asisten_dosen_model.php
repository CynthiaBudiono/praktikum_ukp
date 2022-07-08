<?php

class Pendaftaran_asisten_dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('pendaftaran_asisten_dosen.*');

		$query = $this->db->order_by('id', 'DESC')->get('pendaftaran_asisten_dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function cekbukapendaftaran() {
		$this->db->where('waktu_start <=',date("Y-m-d 00:00:00"));
		$this->db->where('waktu_end >=',date("Y-m-d 00:00:00"));
		$query = $this->db->where('status', 1)->get('pendaftaran_asisten_dosen');

		if ($query->num_rows() > 0)
			return "buka";

		else
			return "tutup";
	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('pendaftaran_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getlastrecord() {

		$query = $this->db->where('status', 1)->order_by('id','desc')->get('pendaftaran_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getlastactive($semester, $tahunajaran) {

        $this->db->where('semester', $semester);
        $this->db->where('tahun_ajaran', $tahunajaran);
        $query = $this->db->where('status', 1)->order_by('id','desc')->get('pendaftaran_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('pendaftaran_asisten_dosen',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('pendaftaran_asisten_dosen', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('pendaftaran_asisten_dosen');
	}
}