<?php

class Pendaftaran_praktikum_model extends CI_Model {

    public function getallopen() {
		$this->db->select('pendaftaran_praktikum.*');

		$query = $this->db->order_by('id', 'DESC')->get('pendaftaran_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('pendaftaran_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getlastrecord() {

		$query = $this->db->where('status', 1)->order_by('id','desc')->get('pendaftaran_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getperiodpendaftaranthissemester($ppke, $semester, $tahun_ajaran){
		
		$this->db->where('pendaftaran_praktikum.PP', $ppke);

		if($semester != null){
			$this->db->where('pendaftaran_praktikum.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('pendaftaran_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('pendaftaran_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('pendaftaran_praktikum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('pendaftaran_praktikum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('pendaftaran_praktikum');
	}
}