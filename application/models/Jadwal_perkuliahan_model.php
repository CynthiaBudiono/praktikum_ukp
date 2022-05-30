<?php

class Jadwal_perkuliahan_model extends CI_Model {

    public function getallopen() {
		$this->db->select('jadwal_perkuliahan.*, subject.nama as nama_matakuliah');

		$this->db->select(' d1.NIP as NIP1, d1.nama as nama_dosen1, d1.status as status_dosen1, d1.last_login as last_login_dosen1');
		$this->db->select(' d2.NIP as NIP2, d2.nama as nama_dosen2, d2.status as status_dosen2, d2.last_login as last_login_dosen2');

        $this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');
		$this->db->join('dosen as d1', 'd1.NIP = jadwal_perkuliahan.NIP1', 'left');
		$this->db->join('dosen as d2', 'd2.NIP = jadwal_perkuliahan.NIP2', 'left');

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

	public function getsubject($semester, $tahun_ajaran){
		$this->db->distinct();
		$this->db->select('subject.*, subject.nama as nama_subject');
		$this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');

		$this->db->group_start()
		  ->or_where('subject.status_praktikum', 1)
		  ->or_where('subject.status_responsi', 1);
		$this->db->group_end();

		$this->db->where('jadwal_perkuliahan.status', 1);
		if($semester != null){
			$this->db->where('jadwal_perkuliahan.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getsubjecttransfernilai($semester = null, $tahun_ajaran = null){
		$this->db->distinct();
		$this->db->select('subject.*, subject.nama as nama_subject');
		$this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');

		$this->db->where('jadwal_perkuliahan.status', 1);
		$this->db->where('subject.status_transfer_nilai', 1);
		if($semester != null){
			$this->db->where('jadwal_perkuliahan.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getjadwalperkuliahan($kode_mk, $kelas_paralel, $semester = null, $tahun_ajaran = null){

		$this->db->where('jadwal_perkuliahan.kode_mk', $kode_mk);
		$this->db->where('jadwal_perkuliahan.kelas_paralel', $kelas_paralel);

		$this->db->where('jadwal_perkuliahan.status', 1);
		
		if($semester != null){
			$this->db->where('jadwal_perkuliahan.semester', $semester);
		}
		if($tahun_ajaran != null){
			$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}
		$query = $this->db->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getnabrakjadwalperkuliahan($pengajar, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('jadwal_perkuliahan.*');
		$this->db->where('jadwal_perkuliahan.hari', $hari);

		$this->db->group_start()
		  ->or_where('jadwal_perkuliahan.NIP1', $pengajar)
		  ->or_where('jadwal_perkuliahan.NIP2', $pengajar);
		$this->db->group_end();

		$this->db->where('jadwal_perkuliahan.status', 1);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('jadwal_perkuliahan.semester', $semester);
        	$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('jadwal_perkuliahan');

		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$startkuliah = $row['jam'];
				$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

				if(($jam >= $startkuliah && $jam <= $endkuliah) || ($jamend >= $startkuliah && $jamend <= $endkuliah)){
					// return 'yes';
					$flag = 1;
				}
			}
		}
		
		if($flag == 1)
			return 'yes'; //NABRAK
		
		else
			return 'no';
	}

	// public function getnabrakdosen($nip, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
	// 	// parameternya jadwal kelas praktikum dari pilihan mahasiswa itu

	// 	$flag = 0;
	// 	$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

	// 	$this->db->select('jadwal_perkuliahan.*');
	// 	$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
	// 	$this->db->where('jadwal_perkuliahan.hari', $hari);
	// 	// $this->db->where('jadwal_perkuliahan.jam >=', $jam);
	// 	// $this->db->where('jadwal_perkuliahan.jam <=', $jamend);

	// 	$this->db->where('jadwal_perkuliahan.NIP1', $nip);

	// 	if($semester != null && $tahun_ajaran != null){
	// 		$this->db->where('mahasiswa_matakuliah.semester', $semester);
    //     	$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
	// 	}

	// 	$query = $this->db->get('mahasiswa_matakuliah');

	// 	if ($query->num_rows() > 0){
	// 		foreach($query->result_array() as $row){
	// 			$startkuliah = $row['jam'];
	// 			$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

	// 			if(($jam > $startkuliah && $jam < $endkuliah) || ($jamend > $startkuliah && $jamend < $endkuliah)){
	// 				// return 'yes';
	// 				$flag = 1;
	// 			}
	// 		}
	// 	}

	// 	if($flag == 1)
	// 		return 'yes'; //NABRAK
		
	// 	else
	// 		return 'no';
	// }

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