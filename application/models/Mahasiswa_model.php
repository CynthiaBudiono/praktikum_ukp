<?php

class Mahasiswa_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa.*');

		$query = $this->db->get('mahasiswa');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($nrp) {

		$query = $this->db->where('NRP', $nrp)->get('mahasiswa', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getprofile($nrp) {

		$query = $this->db->where('NRP', $nrp)->get('mahasiswa', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('mahasiswa',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('NRP'=>$data['NRP']);

		$this->db->where($array)->update('mahasiswa', $data);

    }

    public function delete($nrp) {

		$this->db->where('NRP = '.$nrp)->delete('mahasiswa');
	}
}