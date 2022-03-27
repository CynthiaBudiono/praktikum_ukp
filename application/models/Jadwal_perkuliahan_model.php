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
    
    public function getbyNIP($id, $semester, $tahun_ajaran){
		$this->db->where('semester', $semester);
		$this->db->where('tahun_ajaran', $tahun_ajaran);
        $query = $this->db->where('NIP1', $id)->or_where('NIP2', $id)->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
    }

	// public function getjadwalperkuliahanbyNIP($nip) {
		// $query = $this->db->where('NIP1', $id)->or_where('NIP2', $id)->get('jadwal_perkuliahan');

		// $this->db->select('dosen.nama as nama_dosen, jp1.*');
		// $this->db->join('jadwal_perkuliahan as jp1', 'jp1.NIP1 = dosen.NIP');
		// $this->db->where('jp1.NIP1', $nip);
		// $this->db->where('jp1.status', 1);
		// $query1 = $this->db->where('dosen.status', 1)->get('dosen');

		// $this->db->select('dosen.nama as nama_dosen, jp2.*');
		// $this->db->join('jadwal_perkuliahan as jp2', 'jp2.NIP2 = dosen.NIP');
		// $this->db->where('jp2.NIP2', $nip);
		// $this->db->where('jp2.status', 1);
		// $query2 = $this->db->where('dosen.status', 1)->get('dosen');

		// $this->db->order_by('hari', 'ASC');
		// $query = $this->db->query($query1." UNION ".$query2);
	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;

	// }

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