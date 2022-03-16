<?php

class Kelas_praktikum_model extends CI_Model {

    public function getallopen() {
		$this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getkelasnow($semester, $tahun_ajaran){
        $this->db->select('kelas_praktikum.*, subject.nama as nama_subject');
        $this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
        $this->db->where('kelas_praktikum.semester', $semester);
        $this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		$query = $this->db->get('kelas_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

    public function get($id) {

		$query = $this->db->where('id', $id)->get('kelas_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('kelas_praktikum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('kelas_praktikum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('kelas_praktikum');
	}
}