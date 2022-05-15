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

    // public function getbypengajar($pengajarid, $semester, $tahunajaran) {

    //     $this->db->select('jadwal_berhalangan.*, dosen.nama as nama_dosen, mahasiswa.nama as nama_mahasiswa');
    //     $this->db->join('dosen', 'dosen.NIP = jadwal_berhalangan.pengajar_id', 'left');
    //     $this->db->join('mahasiswa', 'mahasiswa.NRP = jadwal_berhalangan.pengajar_id', 'left');
    //     $this->db->where('semester', $semester);
    //     $this->db->where('tahun_ajaran', $tahunajaran);
	// 	$query = $this->db->where('pengajar_id', $pengajarid)->where('jadwal_berhalangan.status', 1)->get('jadwal_berhalangan');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;

	// }

	public function getnabrakpengajar($pengajar, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		// parameternya jadwal kelas praktikum yang diinput

		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('jadwal_perkuliahan.*');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->where('jadwal_perkuliahan.hari', $hari);
		// $this->db->where('jadwal_perkuliahan.jam >=', $jam);
		// $this->db->where('jadwal_perkuliahan.jam <=', $jamend);

		$this->db->where('mahasiswa_matakuliah.NRP', $pengajar);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('mahasiswa_matakuliah.semester', $semester);
        	$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('mahasiswa_matakuliah');

		if ($query->num_rows() > 0){ //Mahasiswa
			foreach($query->result_array() as $row){
				$startkuliah = $row['jam'];
				$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

				if(($jam > $startkuliah && $jam < $endkuliah) || ($jamend > $startkuliah && $jamend < $endkuliah)){
					// return 'yes';
					$flag = 1;
				}
			}
		}
		else{ //Dosen
			$this->db->select('jadwal_perkuliahan.*');
			// $this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
			$this->db->where('jadwal_perkuliahan.hari', $hari);
			// $this->db->where('jadwal_perkuliahan.jam >=', $jam);
			// $this->db->where('jadwal_perkuliahan.jam <=', $jamend);

			$this->db->where('jadwal_perkuliahan.NIP1', $pengajar);
			$this->db->or_where('jadwal_perkuliahan.NIP2', $pengajar);

			if($semester != null && $tahun_ajaran != null){
				$this->db->where('jadwal_perkuliahan.semester', $semester);
				$this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
			}

			$query = $this->db->get('jadwal_perkuliahan');

			if ($query->num_rows() > 0){
				foreach($query->result_array() as $row){
					$startkuliah = $row['jam'];
					$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

					if(($jam > $startkuliah && $jam < $endkuliah) || ($jamend > $startkuliah && $jamend < $endkuliah)){
						// return 'yes';
						$flag = 1;
					}
				}
			}
		}

		if($flag == 1)
			return 'yes'; //NABRAK
		
		else
			return 'no';
	}

	public function getnabrakjadwalberhalangan($pengajar, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('jadwal_berhalangan.*');
		$this->db->where('jadwal_berhalangan.hari', $hari);

		$this->db->where('jadwal_berhalangan.pengajar_id', $pengajar);
		$this->db->where('jadwal_berhalangan.status', 1);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('jadwal_berhalangan.semester', $semester);
        	$this->db->where('jadwal_berhalangan.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('jadwal_berhalangan');

		if ($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$startkuliah = $row['jam'];
				$endkuliah = date('H:i:s', strtotime($row['jam']. ' +'.$row['durasi'].' minutes'));

				if(($jam > $startkuliah && $jam < $endkuliah) || ($jamend > $startkuliah && $jamend < $endkuliah)){
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

	public function getbyNIP($pengajarid, $semester, $tahunajaran){
		$this->db->select('jadwal_berhalangan.*');
		$this->db->where('semester', $semester);
        $this->db->where('tahun_ajaran', $tahunajaran);
		$query = $this->db->where('pengajar_id', $pengajarid)->where('jadwal_berhalangan.status', 1)->get('jadwal_berhalangan');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getID($data){
		$this->db->where($data);
		$query = $this->db->get('jadwal_berhalangan');

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