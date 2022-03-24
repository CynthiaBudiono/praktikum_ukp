<?php

class Berita_model extends CI_Model {

    public function getallopen() {
		$this->db->select('berita.*');

		$query = $this->db->get('berita');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('berita', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getshowberita() {

		$this->db->where('tanggal_start <=',date("Y-m-d H:i:s"));
		$this->db->where('tanggal_end >=',date("Y-m-d H:i:s"));
		$query = $this->db->where('status', 1)->get('berita');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('berita',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('berita', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('berita');
	}
}