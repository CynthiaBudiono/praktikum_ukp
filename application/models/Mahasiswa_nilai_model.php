<?php

class Mahasiswa_nilai_model extends CI_Model {

    public function getallopen() {
		$this->db->select('mahasiswa_nilai.*');

		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

	// public function getallpertemuanbyidkelasprak($id_kelas_prak){
	// 	// $this->db->select('mahasiswa_nilai.*');
	// 	$this->db->select('mahasiswa_nilai.pertemuan, mahasiswa_nilai.tanggal_pertemuan, mahasiswa_nilai.id_kelas_praktikum');
	// 	$this->db->group_by("pertemuan");
	// 	$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);

	// 	$this->db->order_by('pertemuan','DESC');
	// 	$query = $this->db->get('mahasiswa_nilai');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

	// public function getallpertemuanbyidkelasprak($id_kelas_prak){
	// 	$this->db->distinct();
	// 	$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.tanggal_pertemuan, mahasiswa_nilai.pertemuan');
	// 	// $this->db->group_by("pertemuan");
	// 	$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);

	// 	$this->db->order_by('pertemuan','DESC');
	// 	$query = $this->db->get('mahasiswa_nilai');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }
	public function getallpertemuanbyidkelasprak($id_kelas_prak){
		$this->db->distinct();
		$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.pertemuan');
		// $this->db->group_by("pertemuan");
		$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);

		$this->db->order_by('pertemuan','DESC');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)
		{
			$arr = []; $jum = 0; 
			foreach($query->result_array() as $row) {
				$arr[$jum] = $row; 
				$this->db->select('mahasiswa_nilai.tanggal_pertemuan');
				$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
				$this->db->where('mahasiswa_nilai.pertemuan', $row['pertemuan']);
				$this->db->order_by('mahasiswa_nilai_id_transfer','ASC');
				$query2 = $this->db->get('mahasiswa_nilai');
				
				foreach($query2->result_array() as $row2) {
					$arr[$jum]['tanggal_pertemuan'] = $row2['tanggal_pertemuan'];
					break; 
				}

				$jum++; 
			}

			return $arr; 
		}
		else

			return 0;
	}


	public function getallnilai($id_kelas_prak, $nrp){
		$this->db->select('mahasiswa_nilai.*');

		$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		$this->db->where('mahasiswa_nilai.NRP', $nrp);

		$this->db->order_by('pertemuan','ASC');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function gettransfernilai($id_kelas_prak){
		$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.NRP, mahasiswa.nama as nama_mahasiswa, kelas_praktikum.kode_mk, subject.nama as nama_subject, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan , (SUM(rata_rata)/COUNT(*)) as hasil_akhir');		

		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.mahasiswa_nilai_id_transfer', $id_kelas_prak);
		}

		$this->db->group_by('mahasiswa_nilai.NRP');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getdatamahasiswatransfer($id_kelas_prak){
		$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.NRP, mahasiswa.nama as nama_mahasiswa, kelas_praktikum.kode_mk, subject.nama as nama_subject, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan , (SUM(rata_rata)/COUNT(*)) as hasil_akhir');		

		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
			$this->db->where('mahasiswa_nilai.mahasiswa_nilai_id_transfer != 0');
		}

		$this->db->group_by('mahasiswa_nilai.NRP');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getlastpertemuanbyidkelasprak($id_kelas_prak){
		$this->db->select('mahasiswa_nilai.*');

		$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);

		$this->db->order_by('pertemuan','DESC');
		$query = $this->db->get('mahasiswa_nilai', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getlulustidaklulus($id_kelas_prak = null, $semester = null, $tahun_ajaran = null){ //buat laporan lulus, tidak lulus, transfer_nilai
		$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.NRP, mahasiswa.nama as nama_mahasiswa, kelas_praktikum.kode_mk, subject.nama as nama_subject, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan , (SUM(rata_rata)/COUNT(*)) as hasil_akhir');		

		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		}

		if($semester != null && $tahun_ajaran != null){
			$this->db->where('kelas_praktikum.semester', $semester);
        	$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
		
		$this->db->group_by('mahasiswa_nilai.NRP');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getlulusbynrp($nrp, $id_kelas_prak = null){ //transfer_nilai
		$this->db->select('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.NRP, mahasiswa.nama as nama_mahasiswa, kelas_praktikum.kode_mk, subject.nama as nama_subject, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan , (SUM(rata_rata)/COUNT(*)) as hasil_akhir');		

		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
		$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');

		$this->db->where('mahasiswa_nilai.NRP', $nrp);
		// $this->db->where('SUM(rata_rata)/COUNT(*) > 56');

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		}
		
		$this->db->group_by('mahasiswa_nilai.id_kelas_praktikum, mahasiswa_nilai.NRP, mahasiswa.nama, kelas_praktikum.kode_mk, subject.nama');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		else

			return 0;
	}

	// public function gettransfernilai($kode_mk, $semester = null, $tahun_ajaran = null){
	// 	$this->db->select('mahasiswa_nilai.NRP, mahasiswa.nama as nama_mahasiswa, kelas_praktikum.kode_mk, subject.nama as nama_subject, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan , (SUM(rata_rata)/COUNT(*)) as hasil_akhir');		

	// 	$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
	// 	$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
	// 	$this->db->join('subject', 'subject.kode_mk = kelas_praktikum.kode_mk');
	// 	$this->db->join('mahasiswa_matakuliah', 'mahasiswa_matakuliah.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');
	// 	$this->db->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = mahasiswa_matakuliah.id_jadwal_perkuliahan');

	// 	if($id_kelas_prak != null){
	// 		$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
	// 	}
		
	// 	$this->db->group_by('mahasiswa_nilai.NRP');
	// 	$query = $this->db->get('mahasiswa_nilai');

	// 	if ($query->num_rows() > 0)

	// 		return $query->result_array();

	// 	else

	// 		return 0;
	// }

	public function getdetailmahasiswa($id_kelas_prak = null, $nrp = null){ //buat laporan nilai
		$this->db->select('mahasiswa_nilai.*');		

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		}
		if($nrp != null){
			$this->db->where('mahasiswa_nilai.NRP', $nrp);
		}
	
		$this->db->order_by('pertemuan','ASC');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

	public function getsummary($id_kelas_prak = null, $semester = null, $tahun_ajaran = null){ //buat laporan nilai
		$this->db->select('mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');		
		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		}

		if($semester != null && $tahun_ajaran != null){
			$this->db->join('kelas_praktikum', 'kelas_praktikum.id = mahasiswa_nilai.id_kelas_praktikum');
			$this->db->where('kelas_praktikum.semester', $semester);
        	$this->db->where('kelas_praktikum.tahun_ajaran', $tahun_ajaran);
		}
			
		$this->db->group_by('mahasiswa_nilai.NRP');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0){

			$arr= [];
			$jumarr = 0;
			foreach($query->result_array() as $row){
				$arr[$jumarr] = $row;
				$arr[$jumarr]['nilai'] = $this->getdetailmahasiswa($id_kelas_prak, $row['NRP']);
				$jumarr++;
			}

			return $arr;

			// return $query->result_array();
		}
		else

			return 0;
	}


    public function get($id) {

		$query = $this->db->where('id', $id)->get('mahasiswa_nilai', 1, 0);

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;

	}

    public function add($data) {

        $this->db->trans_start();

        $this->db->insert('mahasiswa_nilai',$data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;

    }

    public function update($data) {

		$array = array('id'=>$data['id']);

		$this->db->where($array)->update('mahasiswa_nilai', $data);

    }

    public function delete($id) {

		$this->db->where('id = '.$id)->delete('mahasiswa_nilai');
	}
}