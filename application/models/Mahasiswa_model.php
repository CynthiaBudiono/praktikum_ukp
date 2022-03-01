<?php

class Mahasiswa_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa.*');

		$query = $this->db->order_by('id', 'asc')->get('mahasiswa');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('mahasiswa', 1, 0);

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

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('mahasiswa', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('mahasiswa');
	}
}