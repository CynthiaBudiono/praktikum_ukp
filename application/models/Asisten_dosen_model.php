<?php

class Asisten_dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('asisten_dosen.*');

		$query = $this->db->get('asisten_dosen');

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