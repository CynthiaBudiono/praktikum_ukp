<?php

class Mahasiswa_matakuliah_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa_matakuliah.*');

		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('mahasiswa_matakuliah', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getpesertapraktikum($semester, $tahun_ajaran){
		$this->db->select('mahasiswa_matakuliah.*, subject.status_praktikum as status_praktikum, subject.status_responsi as status_responsi');
		$this->db->join('subject', 'subject.kode_mk = mahasiswa_matakuliah.kode_mk');
		$this->db->where('subject.status_praktikum', 1);
		$this->db->or_where('subject.status_responsi', 1);
		$this->db->where('mahasiswa_matakuliah.semester', $semester);
        $this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	// public function getbyNRP($id) {

	// 	$query = $this->db->where('id', $id)->get('mahasiswa_matakuliah', 1, 0);

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;

	// }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('mahasiswa_matakuliah',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('mahasiswa_matakuliah', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('mahasiswa_matakuliah');
	}
}