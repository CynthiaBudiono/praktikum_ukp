<?php

class User_history_model extends CI_Model {

    public function getallopen() {
		$this->db->select('user_history.*');

		$query = $this->db->get('user_history');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('user_history', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getbyiduser($id) {

		$query = $this->db->where('id_user', $id)->get('user_history');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getbackup() {

		$query = $this->db->where('table_name', "all")->get('user_history');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getbyfilter($id_user, $start_date, $end_date){

		$this->db->where('created >=',$start_date. ' 00:00:00');
		$this->db->where('created <=',$end_date. ' 23:59:59');
		$query = $this->db->where('id_user', $id_user)->get('user_history');
		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('user_history',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('user_history', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('user_history');
	}
}