<?php

class Calon_asisten_dosen_model extends CI_Model {

    public function getallopen() {
		$this->db->select('calon_asisten_dosen.*, mahasiswa.nama as nama_mahasiswa');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		$query = $this->db->get('calon_asisten_dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function get($id) {

		$query = $this->db->where('id', $id)->get('calon_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getbynrp($nrp){
		$this->db->select('calon_asisten_dosen.*, mahasiswa.nama as nama_mahasiswa');

		$this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->where('calon_asisten_dosen.NRP', $nrp)->get('calon_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getlastid() {
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('calon_asisten_dosen', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array()[0]['id'];

		else

			return 0;

	}

	public function getdaftarasdos(){
		$this->db->distinct();
		$this->db->select('calon_asisten_dosen.id as id, mahasiswa.NRP as NRP, mahasiswa.nama as nama');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		$query = $this->db->where('mahasiswa.status', 1)->get('calon_asisten_dosen');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getbelumketerima(){
		return $this->db->query("select calon_asisten_dosen.id as id, mahasiswa.NRP as NRP, mahasiswa.nama as nama from calon_asisten_dosen JOIN mahasiswa on mahasiswa.NRP = calon_asisten_dosen.NRP where mahasiswa.status = 1 and calon_asisten_dosen.NRP not in (select NRP from asisten)")->result_array();


		// $this->db->select('calon_asisten_dosen.id as id, mahasiswa.NRP as NRP, mahasiswa.nama as nama');
		// $this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
		// // $this->db->join('asisten', 'asisten.NRP = calon_asisten_dosen.NRP');

		// // $this->db->where_not_in('calon_asisten_dosen.NRP == asisten.NRP');
		// $query = $this->db->where('mahasiswa.status', 1)->get('calon_asisten_dosen');

		// if ($query->num_rows() > 0)

		// 	return $query->result_array();

		// else

		// 	return 0;
	}

	// public function getactiveperiodnow($idpendaftaran){

	// 	$this->db->select('calon_asisten_dosen.*, mahasiswa.nama as nama_mahasiswa');
    //     $this->db->join('mahasiswa', 'mahasiswa.NRP = calon_asisten_dosen.NRP');
	// 	$query = $this->db->where('calon_asisten_dosen.id_pendaftaran_asdos', $idpendaftaran)->where('calon_asisten_dosen.status', 1)->get('calon_asisten_dosen');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

	// public function getidbyactiveperiod($idpendaftaran, $nrp){
	// 	$this->db->select('calon_asisten_dosen.*');
	// 	$this->db->where('calon_asisten_dosen.id_pendaftaran_asdos', $idpendaftaran);
	// 	$query = $this->db->where('calon_asisten_dosen.nrp', $nrp)->where('calon_asisten_dosen.status', 1)->get('calon_asisten_dosen', 1, 0);

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('calon_asisten_dosen',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('calon_asisten_dosen', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('calon_asisten_dosen');
	}
}