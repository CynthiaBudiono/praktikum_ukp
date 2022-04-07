<?php

class Mahasiswa_nilai_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa_nilai.*');

		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('mahasiswa_nilai', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('mahasiswa_nilai',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('mahasiswa_nilai', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('mahasiswa_nilai');
	}
}