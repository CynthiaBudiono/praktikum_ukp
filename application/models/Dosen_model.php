<?php

class Dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('dosen.*, dosen.nama as nama_pengajar, dosen.NIP as kode_pengajar, dosen.NIP as id');

		$query = $this->db->get('dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getprofile($id) {

		$this->db->select('dosen.*');
		// $this->db->join('user_group', 'user_group.id = user.id_user_group', 'left');
		// $this->db->join('laboratorium', 'laboratorium.kode_lab = user.kode_lab', 'left');

		$query = $this->db->where('dosen.NIP', $id)->where('dosen.status', 1)->get('dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getallactive() {
		$this->db->select('dosen.*');
		$this->db->order_by('nama', 'ASC');
		$query = $this->db->where('status', 1)->get('dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($nip) {

		$query = $this->db->where('NIP', $nip)->get('dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('dosen',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('NIP'=>$data['NIP']);

		$this->db->where($array)->update('dosen', $data);

    }

    public function delete($nip) {

		$this->db->where('NIP = '.$nip)->delete('dosen');
	}
}