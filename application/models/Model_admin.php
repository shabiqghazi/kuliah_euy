<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model {
	public function insertKelas($kelas){
		$this->db->insert('kelas', $kelas);
		return $this->db->get_where('kelas', $kelas)->row_array(); 
	}
	public function insertDosenKelas($dosen_kelas){
		$this->db->insert('dosen_kelas', $dosen_kelas);
		return $this->db->affected_rows();
	}
	public function getAllMahasiswa($keyword){
		$query = "SELECT user_id FROM user WHERE role_id = 2
				  AND (ni LIKE '%" . $keyword . "%' OR nama LIKE '%" . $keyword . "%')";
		return $this->db->query($query);
	}
	public function getMahasiswa($start,$keyword){
		// $this->db->limit(3,$start);
		// return $this->db->get_where('user',['role_id' => 2])->result_array();
		$query = "SELECT user_id,ni,nama FROM user WHERE role_id = 2
				  AND (ni LIKE '%" . $keyword . "%' OR nama LIKE '%" . $keyword . "%') ORDER BY user.ni ASC
				  LIMIT 3 OFFSET $start";
		return $this->db->query($query);
	}
	public function getDosen(){
		return $this->db->get_where('user',['role_id' => 1])->result_array();
	}
	public function getHari(){
		return $this->db->get('hari_kelas')->result_array();
	}
	public function getJam(){
		return $this->db->get('jam_kelas')->result_array();
	}
	public function getManajemenKelas($semester){
		$query = "SELECT dosen_kelas.*, kelas.*, user.nama, user.user_id, hari_kelas.hari, jam_kelas.jam FROM dosen_kelas
				  JOIN kelas ON dosen_kelas.kelas_id = kelas.kelas_id
				  JOIN user ON dosen_kelas.user_id = user.user_id
				  JOIN hari_kelas ON dosen_kelas.hari_id = hari_kelas.hari_id
				  JOIN jam_kelas ON dosen_kelas.jam_id = jam_kelas.jam_id
				  WHERE user.role_id = 1 AND kelas.semester = '$semester' ORDER BY kelas.kode ASC";
		$result = $this->db->query($query)->result_array();
		return $result;
	}
	public function getMhsKRS($user_id){
		$query = "SELECT user.nama,user.ni,mahasiswa_akses_kelas.*,kelas.* FROM mahasiswa_akses_kelas
				  JOIN user ON mahasiswa_akses_kelas.user_id = user.user_id
				  JOIN kelas ON mahasiswa_akses_kelas.kelas_id = kelas.kelas_id
				  WHERE mahasiswa_akses_kelas.user_id = " . $user_id;
		return $this->db->query($query)->result_array();
	}
	public function batalKRS($mam_id){
		$this->db->where('mam_id',$mam_id);
		$this->db->delete('mahasiswa_akses_kelas');
		return $this->db->affected_rows();
	}
}