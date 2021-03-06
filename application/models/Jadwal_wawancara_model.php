<?php

class jadwal_wawancara_model extends CI_Model {

    public function getallopen() {
		$this->db->select('jadwal_wawancara.*');

		$query = $this->db->get('jadwal_wawancara');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	// public function getwithjoin($semester, $tahunajaran){
	// 	$this->db->select('jadwal_wawancara.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa');
    //     $this->db->join('dosen', 'dosen.NIP = jadwal_wawancara.NIP');
	// 	$this->db->join('calon_asisten_dosen', 'calon_asisten_dosen.id = jadwal_wawancara.id_calon_asisten_dosen');
    //     $this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');

	// 	if($semester != "" && $tahunajaran != ""){
	// 		$this->db->join('pendaftaran_asisten_dosen', 'pendaftaran_asisten_dosen.id = calon_asisten_dosen.id_pendaftaran_asdos');
	// 		$this->db->where('pendaftaran_asisten_dosen.semester', $semester);
	// 		$this->db->where('pendaftaran_asisten_dosen.tahun_ajaran', $tahunajaran);
	// 	}
	// 	$query = $this->db->get('jadwal_wawancara');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

	public function getallbelumketerima($semester = null, $tahun_ajaran= null){
		return $this->db->query("select jadwal_wawancara.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa, mahasiswa.NRP, calon_asisten_dosen.created from jadwal_wawancara, dosen, calon_asisten_dosen, mahasiswa where dosen.NIP = jadwal_wawancara.NIP and calon_asisten_dosen.id = jadwal_wawancara.id_calon_asisten_dosen and mahasiswa.NRP = calon_asisten_dosen.NRP and calon_asisten_dosen.NRP not in (select NRP from asisten)")->result_array();

		// $this->db->select('jadwal_wawancara.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa, calon_asisten_dosen.created');
        
		// $this->db->join('dosen', 'dosen.NIP = jadwal_wawancara.NIP');
		// $this->db->join('calon_asisten_dosen', 'calon_asisten_dosen.id = jadwal_wawancara.id_calon_asisten_dosen');
        // $this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		// // $this->db->join('asisten', 'asisten.NRP = calon_asisten_dosen.NRP'. 'left');

		// // $this->db->where_not_in('calon_asisten_dosen.NRP', $names);

		// if($semester != null){
		// 	$this->db->where('calon_asisten_dosen.semester', $semester);
		// }
		// if($tahun_ajaran != null){
		// 	$this->db->where('calon_asisten_dosen.tahun_ajaran', $tahun_ajaran);
		// }
		// $query = $this->db->get('jadwal_wawancara');

		// if ($query->num_rows() > 0)

		// 	return $query->result_array();

		// else

		// 	return 0;
	}

	public function getallhistory($semester = null, $tahun_ajaran= null){
		$this->db->select('jadwal_wawancara.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa, calon_asisten_dosen.created, asisten.tanggal_diterima, mahasiswa.NRP');
        
		$this->db->join('dosen', 'dosen.NIP = jadwal_wawancara.NIP');
		$this->db->join('calon_asisten_dosen', 'calon_asisten_dosen.id = jadwal_wawancara.id_calon_asisten_dosen');
        $this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		$this->db->join('asisten', 'asisten.NRP = calon_asisten_dosen.NRP');

		if($semester != null){
			$this->db->where('calon_asisten_dosen.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('calon_asisten_dosen.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('jadwal_wawancara');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('jadwal_wawancara', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('jadwal_wawancara',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('jadwal_wawancara', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('jadwal_wawancara');
	}
}