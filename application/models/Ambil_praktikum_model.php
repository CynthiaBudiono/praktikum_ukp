<?php

class Ambil_praktikum_model extends CI_Model {

    public function getallopen($semester = null, $tahun_ajaran = null) {

		$this->db->select('ambil_praktikum.*, mahasiswa.nama as nama_mahasiswa, subject.nama as nama_subject');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getclassgroup($semester = null, $tahun_ajaran = null) {

		$this->db->select('count(id) as jumlah_daftar, ambil_praktikum.*');
		// $this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		// $this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
		$this->db->group_by(array("ambil_praktikum.kode_mk", "ambil_praktikum.tipe"));

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	public function getnabrak($nrp, $hari, $jam, $durasi, $semester = null, $tahun_ajaran = null){
		// parameternya jadwal kelas praktikum dari pilihan mahasiswa itu

		$flag = 0;
		$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));

		$this->db->select('jadwal_perkuliahan.*');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->where('jadwal_perkuliahan.hari', $hari);
		// $this->db->where('jadwal_perkuliahan.jam >=', $jam);
		// $this->db->where('jadwal_perkuliahan.jam <=', $jamend);

		$this->db->where('mahasiswa_matakuliah.NRP', $nrp);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('mahasiswa_matakuliah.semester', $semester);
        	$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('mahasiswa_matakuliah');

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
		

		
		
		// $this->db->join('mahasiswa_matakuliah', 'mahasiswa_matakuliah.NRP = ambil_praktikum.NRP');
		// $this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		

		// if($hari != null && $jam != null && $durasi != null){
		// 	$jamend = date('H:i:s', strtotime($jam. ' +'.$durasi.' minutes'));
		
		// 	$this->db->where('jadwal_perkuliahan.hari', $hari);
		// 	$this->db->where('jadwal_perkuliahan.jam >=', $jam);
		// 	$this->db->where('jadwal_perkuliahan.jam <=', $jamend);

		// 	// $this->db->where('kelas_praktikum.hari', $hari);
		// 	// $this->db->where('kelas_praktikum.jam >=', $jam);
		// 	// $this->db->where('kelas_praktikum.jam <=', $jamend);

		// }
		// // else{
		// // 	return 'no';
		// // }

		// $this->db->where('mahasiswa_matakuliah.NRP', $nrp);

		// if($semester != null && $tahun_ajaran != null){
		// 	$this->db->where('mahasiswa_matakuliah.semester', $semester);
        // 	$this->db->where('mahasiswa_matakuliah.tahun_ajaran', $tahun_ajaran);
		// }

		// $query = $this->db->get('mahasiswa_matakuliah');

		// if ($query->num_rows() > 0)

		// 	// return $query->result_array();
		// 	return 'yes';

		// else

		// 	return 'no';

		
	}

	public function getmahasiswamatkul($id_mahasiswa_matkul, $tipe, $semester = null, $tahun_ajaran = null){
		$this->db->select('ambil_praktikum.*');
		
		$this->db->where('ambil_praktikum.id_mahasiswa_matakuliah', $id_mahasiswa_matkul);
		$this->db->where('ambil_praktikum.tipe', $tipe);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getdetailkelas($kode_mk, $tipe, $semester = null, $tahun_ajaran = null){

		$this->db->select('ambil_praktikum.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.angkatan as angkatan, mahasiswa.ips as ips, mahasiswa.ipk as ipk, subject.nama as nama_subject');
		
		$this->db->select(' kp1.hari as hari1, kp1.jam as jam1, kp1.durasi as durasi1');
		$this->db->select(' kp2.hari as hari2, kp2.jam as jam2, kp2.durasi as durasi2');
		$this->db->select(' kp3.hari as hari3, kp3.jam as jam3, kp3.durasi as durasi3');
		$this->db->select(' kp4.hari as hari4, kp4.jam as jam4, kp4.durasi as durasi4');

		$this->db->join('kelas_praktikum as kp1', 'kp1.id = ambil_praktikum.pil1', 'left');
		$this->db->join('kelas_praktikum as kp2', 'kp2.id = ambil_praktikum.pil2', 'left');
		$this->db->join('kelas_praktikum as kp3', 'kp3.id = ambil_praktikum.pil3', 'left');
		$this->db->join('kelas_praktikum as kp4', 'kp4.id = ambil_praktikum.pil4', 'left');

		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
		
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		// $this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		$this->db->where('ambil_praktikum.kode_mk', $kode_mk);
		$this->db->where('ambil_praktikum.tipe', $tipe);

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getdetailkelasbyidkelasprak($id_kelas_prak, $pertemuan= null, $semester = null, $tahun_ajaran = null){
		$this->db->select('ambil_praktikum.*, kelas_praktikum.kode_lab as kode_lab, laboratorium.nama as nama_laboratorium, laboratorium.quota_max as quota_max, mahasiswa.nama as nama_mahasiswa, mahasiswa.angkatan as angkatan, mahasiswa.ips as ips, mahasiswa.ipk as ipk, subject.nama as nama_subject');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
		
		
		$this->db->join('kelas_praktikum', 'kelas_praktikum.id = ambil_praktikum.terpilih');
		$this->db->join('laboratorium', 'laboratorium.kode_lab = kelas_praktikum.kode_lab');

		$this->db->where('ambil_praktikum.terpilih', $id_kelas_prak);

		if($pertemuan != null){
			$this->db->select('mahasiswa_nilai.*');
			$this->db->join('mahasiswa_nilai', 'mahasiswa_nilai.id_kelas_praktikum = kelas_praktikum.id');
			$this->db->where('mahasiswa_nilai.pertemuan', $pertemuan);
		}

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getjadwalterpilih(){
		
	}

	// public function getdetailmahasiswa($id_kelas_prak, $pertemuan, $semester = null, $tahun_ajaran = null){
	// 	$this->db->select('ambil_praktikum.*, mahasiswa.nama as nama_mahasiswa, mahasiswa.angkatan as angkatan, mahasiswa.ips as ips, mahasiswa.ipk as ipk');
	// 	$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
	// 	// $this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');
		
		
	// 	// $this->db->join('kelas_praktikum', 'kelas_praktikum.id = ambil_praktikum.terpilih');
	// 	// $this->db->join('laboratorium', 'laboratorium.kode_lab = kelas_praktikum.kode_lab');

	// 	$this->db->join('mahasiswa_nilai', 'mahasiswa_nilai.id_kelas_praktikum = kelas_praktikum.id');

	// 	$this->db->where('ambil_praktikum.terpilih', $id_kelas_prak);


	// 	if($semester != null && $tahun_ajaran != null){
	// 		$this->db->where('ambil_praktikum.semester', $semester);
    //     	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
	// 	}
		
	// 	$query = $this->db->get('ambil_praktikum');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

    public function get($id) {

		$query = $this->db->where('id', $id)->get('ambil_praktikum', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('ambil_praktikum',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('ambil_praktikum', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('ambil_praktikum');
	}
}