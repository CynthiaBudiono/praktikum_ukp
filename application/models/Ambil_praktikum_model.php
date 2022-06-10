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

	public function sortbypilnipk($id_kelas_prak, $pil){
		
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');

		$this->db->where('ambil_praktikum.terpilih = 0');

		if($pil == "pil1"){
			$this->db->where('ambil_praktikum.pil1', $id_kelas_prak);
		}
		elseif($pil == "pil2"){
			$this->db->where('ambil_praktikum.pil2', $id_kelas_prak);
		}
		elseif($pil == "pil3"){
			$this->db->where('ambil_praktikum.pil3', $id_kelas_prak);
		}
		elseif($pil == "pil4"){
			$this->db->where('ambil_praktikum.pil4', $id_kelas_prak);
		}
		// $this->db->group_start()
		//   ->or_where('ambil_praktikum.pil1', $id_kelas_prak)
		//   ->or_where('ambil_praktikum.pil2', $id_kelas_prak)
		//   ->or_where('ambil_praktikum.pil3', $id_kelas_prak)
		//   ->or_where('ambil_praktikum.pil4', $id_kelas_prak);
		// $this->db->group_end();

		$this->db->order_by('mahasiswa.ipk', 'DESC');
		// $this->db->order_by('mahasiswa.NRP', 'DESC');

		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getidwhere($nrp, $kode_mk, $tipe, $semester = null, $tahun_ajaran = null){
		$this->db->where('ambil_praktikum.NRP', $nrp);
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

		$this->db->order_by('ambil_praktikum.pil1', 'ASC');
		$this->db->order_by('mahasiswa.ipk', 'DESC');

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

		if($pertemuan != null){ //EDIT
			$this->db->select('mahasiswa_nilai.*');
			$this->db->join('mahasiswa_nilai', 'mahasiswa_nilai.id_kelas_praktikum = kelas_praktikum.id and mahasiswa_nilai.NRP = ambil_praktikum.NRP');
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
			// $this->db->where('mahasiswa_nilai.mahasiswa_nilai_id_transfer', 0);
			$this->db->where('mahasiswa_nilai.pertemuan', $pertemuan);

			// $this->db->group_start()
			// 	->or_where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak)
			// 	->or_where('mahasiswa_nilai.mahasiswa_nilai_id_transfer', $id_kelas_prak);
			// $this->db->group_end();			
		}

		$this->db->where('ambil_praktikum.terpilih', $id_kelas_prak);


		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0){

			// $arr= $query->result_array();
			// $jumarr = count($query->result_array());

			// if($pertemuan != null){
			// $this->db->select('mahasiswa_nilai.*, mahasiswa.nama as nama_mahasiswa');
			// $this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');

			// $this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
			// $this->db->where('mahasiswa_nilai.mahasiswa_nilai_id_transfer != 0');

			
			// $this->db->where('mahasiswa_nilai.pertemuan', $pertemuan);
			// }
			// $query2 = $this->db->get('mahasiswa_nilai');

			// if ($query2->num_rows() > 0){
			// 	foreach($query2->result_array() as $row) {
			// 		$arr[$jumarr] = $row;
			// 		$arr[$jumarr]['transfer'] = "yes";
			// 	}
			// 	// var_dump("MASUK");
			// }
			// var_dump($arr); exit;
			// return $arr;
			return $query->result_array();

		}

		else

			return 0;
	}

	public function getjadwalterpilih(){
		
	}

	public function countpendaftar($semester = null, $tahun_ajaran = null){
		// $this->db->distinct();
		$this->db->select('COUNT(NRP) as hasil');

		$this->db->where('ambil_praktikum.pil1 IS NOT NULL');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array()[0]['hasil'];

		else

			return 0;
	}

	public function countpeserta($semester = null, $tahun_ajaran = null){
		// $this->db->distinct();
		$this->db->select('COUNT(NRP) as hasil');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array()[0]['hasil'];

		else

			return 0;
	}

	public function getmahasiswaambil($kode_mk = null, $semester = null, $tahun_ajaran = null){
		$this->db->select('ambil_praktikum.*, mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa, subject.nama as nama_subject');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		$this->db->select(' kp1.hari as hari1, kp1.jam as jam1, kp1.durasi as durasi1');
		$this->db->select(' kp2.hari as hari2, kp2.jam as jam2, kp2.durasi as durasi2');
		$this->db->select(' kp3.hari as hari3, kp3.jam as jam3, kp3.durasi as durasi3');
		$this->db->select(' kp4.hari as hari4, kp4.jam as jam4, kp4.durasi as durasi4');
		$this->db->select(' terpilihdata.hari as hariterpilih, terpilihdata.jam as jamterpilih, terpilihdata.durasi as durasiterpilih');

		$this->db->join('kelas_praktikum as kp1', 'kp1.id = ambil_praktikum.pil1', 'left');
		$this->db->join('kelas_praktikum as kp2', 'kp2.id = ambil_praktikum.pil2', 'left');
		$this->db->join('kelas_praktikum as kp3', 'kp3.id = ambil_praktikum.pil3', 'left');
		$this->db->join('kelas_praktikum as kp4', 'kp4.id = ambil_praktikum.pil4', 'left');

		$this->db->join('kelas_praktikum as terpilihdata', 'terpilihdata.id = ambil_praktikum.terpilih', 'left');
		// return $kode_mk;
		// if($kode_mk != 0){
			$this->db->where('ambil_praktikum.kode_mk', $kode_mk);
		// }

		$this->db->where('ambil_praktikum.pil1 is not null');

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

	public function getmahasiswatertolak($kode_mk, $semester = null, $tahun_ajaran = null){
		$this->db->select('
			ambil_praktikum.*,
			jadwal_perkuliahan.kode_mk,
			mahasiswa_matakuliah.id as id_mahasiswa_matakuliah, 
			mahasiswa_matakuliah.NRP, 
			mahasiswa.nama as nama_mahasiswa, 
			subject.nama as nama_subject');

		$this->db->select(' kp1.hari as hari1, kp1.jam as jam1, kp1.durasi as durasi1');
		$this->db->select(' kp2.hari as hari2, kp2.jam as jam2, kp2.durasi as durasi2');
		$this->db->select(' kp3.hari as hari3, kp3.jam as jam3, kp3.durasi as durasi3');
		$this->db->select(' kp4.hari as hari4, kp4.jam as jam4, kp4.durasi as durasi4');


		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_matakuliah.nrp');
		$this->db->join('ambil_praktikum', 'ambil_praktikum.id_mahasiswa_matakuliah = mahasiswa_matakuliah.id');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
		$this->db->join('subject', 'subject.kode_mk = jadwal_perkuliahan.kode_mk');
	 

		$this->db->join('kelas_praktikum as kp1', 'kp1.id = ambil_praktikum.pil1', 'left');
		$this->db->join('kelas_praktikum as kp2', 'kp2.id = ambil_praktikum.pil2', 'left');
		$this->db->join('kelas_praktikum as kp3', 'kp3.id = ambil_praktikum.pil3', 'left');
		$this->db->join('kelas_praktikum as kp4', 'kp4.id = ambil_praktikum.pil4', 'left');
		
		$this->db->where('jadwal_perkuliahan.kode_mk', $kode_mk);

		$this->db->group_start()
		  ->or_where('ambil_praktikum.pil1 != ambil_praktikum.terpilih')
		  ->or_where('ambil_praktikum.pil1 is NULL');
		$this->db->group_end();

		$this->db->group_start()
		  ->or_where('ambil_praktikum.pil2 != ambil_praktikum.terpilih')
		  ->or_where('ambil_praktikum.pil2 is NULL');
		$this->db->group_end();

		$this->db->group_start()
		  ->or_where('ambil_praktikum.pil3 != ambil_praktikum.terpilih')
		  ->or_where('ambil_praktikum.pil3 is NULL');
		$this->db->group_end();

		$this->db->group_start()
		  ->or_where('ambil_praktikum.pil4 != ambil_praktikum.terpilih')
		  ->or_where('ambil_praktikum.pil4 is NULL');
		$this->db->group_end();
	 
		if($semester != null){
		 $this->db->where('jadwal_perkuliahan.semester', $semester);
		}
		if($tahun_ajaran != null){
		 $this->db->where('jadwal_perkuliahan.tahun_ajaran', $tahun_ajaran);
		}
	 
		// $this->db->where('mahasiswa.NRP = "C14180210"');

		$query = $this->db->get('mahasiswa_matakuliah');
	  
		if ($query->num_rows() > 0)
	  
			return $query->result_array();
	  
		else
	  
			return 0;
	 
	   // $this->db->select('ambil_praktikum.*, mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');
	   // $this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		
	   // $this->db->where('ambil_praktikum.id_mahasiswa_matakuliah', $id);
	 
	   // $this->db->group_start()
	   //   ->or_where('ambil_praktikum.pil1 != ambil_praktikum.terpilih')
	   //   ->or_where('ambil_praktikum.pil1 is NULL');
	   // $this->db->group_end();
		
	   // // $this->db->where('ambil_praktikum.pil1 != ambil_praktikum.terpilih');
	   // // $this->db->where('ambil_praktikum.pil2 != ambil_praktikum.terpilih');
	   // // $this->db->where('ambil_praktikum.pil3 != ambil_praktikum.terpilih');
	   // // $this->db->where('ambil_praktikum.pil4 != ambil_praktikum.terpilih');
		
	   // if($semester != null && $tahun_ajaran != null){
	   //  $this->db->where('ambil_praktikum.semester', $semester);
	   //     $this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
	   // }
		
	   // $query = $this->db->get('ambil_praktikum');
		
	   // if ($query->num_rows() > 0)
		
	   //  return $query->result_array();
		
	   // else
		
	   //  return 0;
	}

	public function getkelaspraktikummahasiswa($nrp, $semester = null, $tahun_ajaran = null, $kode_mk = null){
		$this->db->select('mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa, subject.nama as nama_subject');
		$this->db->select('kelas_terpilih.kode_lab, ambil_praktikum.terpilih as id_kelas_praktikum, kelas_terpilih.kode_mk, kelas_terpilih.kelas_paralel, kelas_terpilih.hari as hariterpilih, kelas_terpilih.jam as jamterpilih, kelas_terpilih.durasi as durasiterpilih');

		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');
		$this->db->join('kelas_praktikum as kelas_terpilih', 'kelas_terpilih.id = ambil_praktikum.terpilih', 'left');
		$this->db->join('subject', 'subject.kode_mk = kelas_terpilih.kode_mk');

		$this->db->where('ambil_praktikum.NRP', $nrp);
		$this->db->where('ambil_praktikum.terpilih !=', 0);

		if($kode_mk != null){
			$this->db->where('ambil_praktikum.kode_mk', $kode_mk);
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

	public function getmahasiswatertolak2($kode_mk, $semester = null, $tahun_ajaran = null){ //GAK DIPAKE
		$this->db->select('ambil_praktikum.*, mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');

		$this->db->join('mahasiswa_matakuliah', 'mahasiswa_matakuliah.id = ambil_praktikum.id_mahasiswa_matakuliah');
		$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');

		$this->db->where('jadwal_perkuliahan.kode_mk', $kode_mk);

		$this->db->group_start()
				->or_where('ambil_praktikum.pil1 != ambil_praktikum.terpilih')
				->or_where('ambil_praktikum.pil1 is NULL');
		$this->db->group_end();

		// $this->db->where('ambil_praktikum.pil1 != ambil_praktikum.terpilih');
		// $this->db->where('ambil_praktikum.pil2 != ambil_praktikum.terpilih');
		// $this->db->where('ambil_praktikum.pil3 != ambil_praktikum.terpilih');
		// $this->db->where('ambil_praktikum.pil4 != ambil_praktikum.terpilih');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('ambil_praktikumm');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getterpilihkelas($id_kelas_prak){
		$this->db->select('mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');
		$this->db->join('mahasiswa', 'mahasiswa.NRP = ambil_praktikum.NRP');

		$this->db->where('ambil_praktikum.terpilih', $id_kelas_prak);

		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

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

	public function getambilprakbynrp($nrp, $semester, $tahun_ajaran) {

		$this->db->select(' ambil_praktikum.*, subject.kode_mk as kode_mk, subject.nama as nama_subject');
		$this->db->select(' kp1.hari as hari1, kp1.jam as jam1, kp1.durasi as durasi1, kp1.kelas_paralel as kelas_paralel1');
		$this->db->select(' kp2.hari as hari2, kp2.jam as jam2, kp2.durasi as durasi2, kp2.kelas_paralel as kelas_paralel2');
		$this->db->select(' kp3.hari as hari3, kp3.jam as jam3, kp3.durasi as durasi3, kp3.kelas_paralel as kelas_paralel3');
		$this->db->select(' kp4.hari as hari4, kp4.jam as jam4, kp4.durasi as durasi4, kp4.kelas_paralel as kelas_paralel4');
		$this->db->select(' kpterpilih.hari as hariterpilih, kpterpilih.jam as jamterpilih, kpterpilih.durasi as durasiterpilih, kpterpilih.kelas_paralel as kelas_paralelterpilih');

		$this->db->join('kelas_praktikum as kp1', 'kp1.id = ambil_praktikum.pil1', 'left');
		$this->db->join('kelas_praktikum as kp2', 'kp2.id = ambil_praktikum.pil2', 'left');
		$this->db->join('kelas_praktikum as kp3', 'kp3.id = ambil_praktikum.pil3', 'left');
		$this->db->join('kelas_praktikum as kp4', 'kp4.id = ambil_praktikum.pil4', 'left');
		$this->db->join('kelas_praktikum as kpterpilih', 'kpterpilih.id = ambil_praktikum.terpilih', 'left');

		$this->db->join('subject', 'subject.kode_mk = ambil_praktikum.kode_mk');

		$this->db->where('nrp', $nrp);

		// mhs telah memilih jadwal praktikum
		$this->db->where('(pil1 IS NOT null');
		$this->db->or_where('pil2 IS NOT null');
		$this->db->or_where('pil3 IS NOT null)');

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('ambil_praktikum.semester', $semester);
        	$this->db->where('ambil_praktikum.tahun_ajaran', $tahun_ajaran);
		}

		$query = $this->db->get('ambil_praktikum');

		if ($query->num_rows() > 0){

			$arr= [];
			$jumarr = 0;
			foreach($query->result_array() as $row){
				$arr[$jumarr] = $row;
				$arr[$jumarr]['pil1_berhalangan'] = $this->getnabrak($nrp, $row['hari1'], $row['jam1'], $row['durasi1'], $semester, $tahun_ajaran);
				$arr[$jumarr]['pil2_berhalangan'] = $this->getnabrak($nrp, $row['hari2'], $row['jam2'], $row['durasi2'], $semester, $tahun_ajaran);
				$arr[$jumarr]['pil3_berhalangan'] = $this->getnabrak($nrp, $row['hari3'], $row['jam3'], $row['durasi3'], $semester, $tahun_ajaran);
				$jumarr++;
			}

			return $arr;
			// return $query->result_array();
		}
		else

			return 0;

	}

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