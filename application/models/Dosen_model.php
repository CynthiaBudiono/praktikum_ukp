<?php

class Dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('dosen.*');

		$query = $this->db->get('dosen');

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