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

	public function getallpertemuanbyidkelasprak($id_kelas_prak){
		$this->db->select('mahasiswa_nilai.*');

		$this->db->group_by("pertemuan");
		$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);

		$this->db->order_by('pertemuan','DESC');
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

	public function getlulustidaklulus($id_kelas_prak = null){ //buat laporan lulus, tidak lulus
		$this->db->select('mahasiswa_nilai.*, mahasiswa.nama as nama_mahasiswa, SUM(nilai_awal) as sum_nilai_awal, SUM(nilai_materi) as sum_nilai_materi, SUM(nilai_tugas) as sum_nilai_tugas, SUM(rata_rata) as sum_rata_rata, COUNT(*) as jumlah_pertemuan');		

		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');

		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
		}
		
		$this->db->group_by('mahasiswa_nilai.NRP');
		$query = $this->db->get('mahasiswa_nilai');

		if ($query->num_rows() > 0)

			return $query->result_array();

		else

			return 0;
	}

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

	public function getsummary($id_kelas_prak = null){ //buat laporan nilai
		$this->db->select('mahasiswa.NRP as NRP, mahasiswa.nama as nama_mahasiswa');		
		$this->db->join('mahasiswa', 'mahasiswa.NRP = mahasiswa_nilai.NRP');
		if($id_kelas_prak != null){
			$this->db->where('mahasiswa_nilai.id_kelas_praktikum', $id_kelas_prak);
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