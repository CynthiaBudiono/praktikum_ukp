<?php

class Laboratorium_model extends CI_Model {

    public function getallopen() {
		$this->db->select('laboratorium.*');

		$query = $this->db->get('laboratorium');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($kode_lab) {

		$query = $this->db->where('kode_lab', $kode_lab)->get('laboratorium', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getactivelab() {

		$this->db->order_by('nama', 'ASC');
		$query = $this->db->where('status', 1)->get('laboratorium');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('laboratorium',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('kode_lab'=>$data['kode_lab']);

		$this->db->where($array)->update('laboratorium', $data);

    }

    public function delete($kode_lab) {

		$this->db->where('kode_lab = '.$kode_lab)->delete('laboratorium');
	}
}