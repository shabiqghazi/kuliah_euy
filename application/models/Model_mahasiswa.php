<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_mahasiswa extends CI_Model {
	public function getTugas_belum($mhs_id){
		$query1 = "SELECT kelas.* FROM kelas 
				   JOIN mahasiswa_akses_kelas ON kelas.kelas_id = mahasiswa_akses_kelas.kelas_id 
				   WHERE mahasiswa_akses_kelas.user_id = " . $mhs_id;
		$kelas = $this->db->query($query1);

		$row = $kelas->num_rows();
		$kelas = $kelas->result_array();

		if($kelas){
			$query2 = "SELECT tugas.*,kelas.kelas,sesi.sesi FROM tugas
					   JOIN kelas ON kelas.kelas_id = tugas.kelas_id
					   JOIN sesi ON sesi.sesi_id = tugas.sesi_id
					   WHERE NOT EXISTS (SELECT * FROM tugas_selesai WHERE user_id = " . $mhs_id . " AND tugas_selesai.tugas_id = tugas.tugas_id) AND (tugas.kelas_id = " . $kelas[0]['kelas_id'];
			
			for($i = 0; $i < $row; $i++){
				$query2 .= " OR tugas.kelas_id = " . $kelas[$i]['kelas_id'];
			}
			$query2 .= ") AND tugas.deadline > ". time(). " ORDER BY tugas.deadline ASC";
			
			$row_tugas = $this->db->query($query2)->num_rows();
			$tugas = $this->db->query($query2)->result_array();
			return $tugas;
		}
	}
	public function insertTugasSelesai($tugas){
		$this->db->insert_batch($tugas);
	}
	public function getSesi(){
		return $this->db->get('sesi')->result_array();
	}
	public function getTugasByID($tugas_id){
		$query = "SELECT tugas.*, kelas.*, sesi.* FROM tugas
				  JOIN kelas ON tugas.kelas_id = kelas.kelas_id
				  JOIN sesi ON tugas.sesi_id = sesi.sesi_id
				  WHERE tugas.tugas_id = '$tugas_id'";
		return $this->db->query($query)->row_array();
	}
	public function getMateriById($materi_id){
		$query = "SELECT * FROM materi
				  JOIN sesi ON materi.sesi_id = sesi.sesi_id
				  JOIN kelas ON materi.kelas_id = kelas.kelas_id
				  WHERE materi.materi_id = '$materi_id'";
		return $this->db->query($query)->row_array();
	}
	public function hapusTugasSelesai($tugas_selesai_id){
		$this->db->where('tugas_selesai_id', $tugas_selesai_id);
		$this->db->delete('tugas_selesai');
		return $this->db->affected_rows();
	}
	public function getTugasSelesaiByTugasId($tugas_id,$user_id){
		$query = "SELECT tugas_selesai.*,tugas.*,user.nama,user.ni,kelas.kelas FROM tugas_selesai
				  JOIN tugas ON tugas_selesai.tugas_id = tugas.tugas_id
				  JOIN mahasiswa_akses_kelas ON tugas.kelas_id = mahasiswa_akses_kelas.kelas_id
				  JOIN user ON tugas_selesai.user_id = user.user_id
				  JOIN kelas ON tugas.kelas_id = kelas.kelas_id
				  WHERE tugas_selesai.tugas_id = '$tugas_id'
				  AND tugas_selesai.user_id = '$user_id'";
		return $this->db->query($query)->row_array();
	}
	public function getKRSmhs($user_id){
		$query = "SELECT * FROM mahasiswa_akses_kelas
				  JOIN kelas ON mahasiswa_akses_kelas.kelas_id = kelas.kelas_id
				  JOIN dosen_kelas ON mahasiswa_akses_kelas.kelas_id = dosen_kelas.kelas_id
				  JOIN hari_kelas ON dosen_kelas.hari_id = hari_kelas.hari_id
				  JOIN jam_kelas ON dosen_kelas.jam_id = jam_kelas.jam_id
				  WHERE mahasiswa_akses_kelas.user_id = '$user_id'";
		return $this->db->query($query)->result_array();
	}
}