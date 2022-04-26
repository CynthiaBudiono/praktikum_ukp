<?php

class informasi_umum_model extends CI_Model {

    public function getallopen() {
		$this->db->select('informasi_umum.*');

		$query = $this->db->get('informasi_umum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

  public function getsemester(){
    $this->db->select('nilai');
    $query = $this->db->where('id', 2)->get('informasi_umum', 1, 0);

    if ($query->num_rows() > 0)

			return $query->result_array()[0]['nilai'];

		else

			return 0;

  }

  public function gettahunajaran(){
    $this->db->select('nilai');
    $query = $this->db->where('id', 3)->get('informasi_umum', 1, 0);

    if ($query->num_rows() > 0)

			return $query->result_array()[0]['nilai'];

		else

			return 0;

  }

  public function get($id) {

		$query = $this->db->where('id', $id)->get('informasi_umum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getnama($nama) {
        $query = $this->db->where('LOWER(nama)', strtolower($nama))->get('informasi_umum', 1, 0);
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return 0;
    }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('informasi_umum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('informasi_umum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('informasi_umum');
	}

}