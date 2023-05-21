<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dosen extends CI_Model {
	public function insertTugas($tugas){
		$this->db->insert('tugas', $tugas);
	
		return $this->db->affected_rows();
	}
	public function insertMateri($materi){
		$this->db->insert('materi', $materi);
	
		return $this->db->affected_rows();
	}
	public function updateMateri($materi,$materi_id){
		$this->db->where('materi_id', $materi_id);
		$this->db->update('materi', $materi);
		return $this->db->affected_rows();
	}
	public function updateTugas($tugas_id,$tugas){
		$this->db->where('tugas_id', $tugas_id);
		$this->db->update('tugas', $tugas);
	
		return $this->db->affected_rows();
	}
	public function hapusTugas($tugas_id){
		$this->db->where('tugas_id', $tugas_id);
		$this->db->delete('tugas');
		
		return $this->db->affected_rows();
	}
	public function hapusMateri($materi_id){
		$this->db->where('materi_id', $materi_id);
		$this->db->delete('materi');
		
		return $this->db->affected_rows();
	}
	public function getTugas($user_id){
		$query = "SELECT tugas.*,kelas.kelas,sesi.* FROM tugas
				  JOIN dosen_kelas ON tugas.kelas_id = dosen_kelas.kelas_id
				  JOIN kelas ON tugas.kelas_id = kelas.kelas_id
				  JOIN sesi ON sesi.sesi_id = tugas.sesi_id
				  WHERE dosen_kelas.user_id = ". $user_id . "
				  AND tugas.deadline > " . time();

		$tugas = $this->db->query($query)->result_array();
		return $tugas;
	}
	public function getSesi(){
		return $this->db->get('sesi')->result_array();
	}
	public function getTugasById($tugas_id){
		$query = "SELECT tugas.*,kelas.* FROM tugas
				  JOIN kelas ON tugas.kelas_id = kelas.kelas_id
				  WHERE tugas.tugas_id = ". $tugas_id;
		$tugas = $this->db->query($query)->row_array();
		return $tugas;
	}
	public function getTugasSelesaiByTugasId($tugas_id, $user_id){
		$query = "SELECT tugas_selesai.*,tugas.*,dosen_kelas.*,user.nama FROM tugas_selesai
				  JOIN tugas ON tugas_selesai.tugas_id = tugas.tugas_id
				  JOIN dosen_kelas ON tugas.kelas_id = dosen_kelas.kelas_id
				  JOIN user ON tugas_selesai.user_id = user.user_id
				  WHERE tugas_selesai.tugas_id = '$tugas_id'
				  AND dosen_kelas.user_id = '$user_id'";
		return $this->db->query($query)->result_array();
	}
	public function getTugasSelesaiByTugasIdTugasSelesaiId($tugas_id, $tugas_selesai_id, $user_id){
		$query = "SELECT tugas_selesai.*,tugas.*,dosen_kelas.*,user.nama,user.ni,kelas.kelas FROM tugas_selesai
				  JOIN tugas ON tugas_selesai.tugas_id = tugas.tugas_id
				  JOIN dosen_kelas ON tugas.kelas_id = dosen_kelas.kelas_id
				  JOIN user ON tugas_selesai.user_id = user.user_id
				  JOIN kelas ON tugas.kelas_id = kelas.kelas_id
				  WHERE tugas_selesai.tugas_id = '$tugas_id'
				  AND dosen_kelas.user_id = '$user_id'
				  AND tugas_selesai.tugas_selesai_id = '$tugas_selesai_id'";
		return $this->db->query($query)->row_array();
	}
	public function getMateriById($materi_id){
		$query = "SELECT * FROM materi
				  JOIN sesi ON materi.sesi_id = sesi.sesi_id
				  JOIN kelas ON materi.kelas_id = kelas.kelas_id
				  WHERE materi.materi_id = '$materi_id'";
		return $this->db->query($query)->row_array();
	}
}