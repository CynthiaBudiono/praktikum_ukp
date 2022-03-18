<?php

class Jadwal_berhalangan_model extends CI_Model {

    public function getallopen() {
		$this->db->select('jadwal_berhalangan.*');

		$query = $this->db->get('jadwal_berhalangan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('jadwal_berhalangan', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function getbypengajar($pengajarid, $semester, $tahunajaran) {

        $this->db->select('jadwal_berhalangan.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa');
        $this->db->join('dosen', 'dosen.NIP = jadwal_berhalangan.pengajar_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.NRP = jadwal_berhalangan.pengajar_id', 'left');
        $this->db->where('semester', $semester);
        $this->db->where('tahun_ajaran', $tahunajaran);
		$query = $this->db->where('pengajar_id', $pengajarid)->where('jadwal_berhalangan.status', 1)->get('jadwal_berhalangann');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('jadwal_berhalangan',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('jadwal_berhalangan', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('jadwal_berhalangan');
	}
}