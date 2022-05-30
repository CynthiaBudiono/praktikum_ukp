<?php

class User_model extends CI_Model {

    public function getallopen() {
		$this->db->select('user.*, dosen.nama as nama_dosen, laboratorium.nama as nama_laboratorium');
		$this->db->join('dosen', 'dosen.NIP = user.NIP', 'left');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = user.kode_lab', 'left');
		$query = $this->db->get('user');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('user', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getbyusername($username) {

		$query = $this->db->where('username', $username)->where('status', 1)->get('user', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getbynip($nip){
		$this->db->select('user.username as username, user.email, user.level, user.NIP, user.kode_lab, user.last_login, user.status, dosen.nama as nama_dosen, user.id as id_user, dosen.password as password');
		$this->db->join('dosen', 'dosen.NIP = user.NIP', 'left');
		$query = $this->db->where('user.NIP', $nip)->where('user.status', 1)->get('user', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getprofile($id) {

		$this->db->select('user.*, dosen.*, laboratorium.nama as nama_laboratorium');
		// $this->db->join('user_group', 'user_group.id = user.id_user_group', 'left');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = user.kode_lab', 'left');
		$this->db->join('dosen', 'dosen.NIP = user.NIP', 'left');

		$query = $this->db->where('user.id', $id)->where('user.status', 1)->get('user', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getprofilekalab($id) {

		$this->db->select('user.*, dosen.*, laboratorium.nama as nama_laboratorium');
		// $this->db->join('user_group', 'user_group.id = user.id_user_group', 'left');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = user.kode_lab', 'left');
		$this->db->join('dosen', 'dosen.NIP = user.NIP', 'left');

		$query = $this->db->where('user.NIP', $id)->where('user.status', 1)->get('user', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('user',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('user', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('user');
	}
}