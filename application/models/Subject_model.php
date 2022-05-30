<?php

class Subject_model extends CI_Model {

    public function getallopen() {
		$this->db->select('subject.*');

		$query = $this->db->get('subject');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($kode_mk) {

		$query = $this->db->where('kode_mk', $kode_mk)->get('subject', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function gethavepraktikum(){

		// $this->db->select('DISTINCT kode_mk, subject.*');
		$this->db->group_by("kode_mk");
		$this->db->order_by('kode_mk', 'ASC');
		$query = $this->db->where('status_praktikum', 1)->where('status', 1)->get('subject');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getpraktikumnresponsi(){

		// $this->db->select('DISTINCT kode_mk, subject.*');
		// $this->db->group_by("kode_mk");
		$this->db->select('subject.*');
		$this->db->order_by('kode_mk', 'ASC');

		$this->db->group_start()
		  ->or_where('status_praktikum', 1)
		  ->or_where('status_responsi', 1);
		$this->db->group_end();

		$query = $this->db->where('status', 1)->get('subject');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('subject',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('kode_mk'=>$data['kode_mk']);

		$this->db->where($array)->update('subject', $data);

    }

    public function delete($kode_mk) {

		$this->db->where('kode_mk = '.$kode_mk)->delete('subject');
	}
}