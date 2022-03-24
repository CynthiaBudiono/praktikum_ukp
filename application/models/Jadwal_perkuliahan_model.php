<?php

class Jadwal_perkuliahan_model extends CI_Model {

    public function getallopen() {
		$this->db->select('jadwal_perkuliahan.*, subject.nama as nama_matakuliah');
        $this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');
		$query = $this->db->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('jadwal_perkuliahan', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}
    
    public function getbyNIP($id){
        $query = $this->db->where('NIP1', $id)->or_where('NIP2', $id)->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('jadwal_perkuliahan',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('jadwal_perkuliahan', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('jadwal_perkuliahan');
	}
}