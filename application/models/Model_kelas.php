<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_kelas extends CI_Model {
	public function getKelasMahasiswa($mhs_id){
		$query = "SELECT kelas.* FROM kelas
				  JOIN mahasiswa_akses_kelas ON kelas.kelas_id = mahasiswa_akses_kelas.kelas_id
				  WHERE mahasiswa_akses_kelas.user_id = ". $mhs_id;
		return $this->db->query($query)->result_array();
	}
	public function getKelasById($kelas_id){
		$kelas = $this->db->get_where('kelas', ['kelas_id' => $kelas_id])->row_array();
		return $kelas['kelas'];
	}
	public function getSesiById($sesi_id){
		$sesi = $this->db->get_where('sesi', ['sesi_id' => $sesi_id])->row_array();
		return $sesi['sesi'];
	}	
	public function getKelasBySemester($smt){
		$query = "SELECT kelas.*, dosen_kelas.user_id, user.nama FROM kelas
				  JOIN dosen_kelas ON kelas.kelas_id = dosen_kelas.kelas_id
				  JOIN user ON dosen_kelas.user_id = user.user_id
				  WHERE semester = " . $smt .
				" ORDER BY kelas.kode ASC";
		return $this->db->query($query)->result_array();
	}
	public function mhs_krs($mhs_id,$kelas_id){
		$data = [
			'user_id' => $mhs_id,
			'kelas_id' => $kelas_id
		];

		$result = $this->db->get_where('mahasiswa_akses_kelas',$data);
		$kuota = $this->db->get_where('mahasiswa_akses_kelas', ['kelas_id' => $kelas_id]);

		if($result->num_rows() < 1){
			if($kuota->num_rows() <= 20){
				$this->db->insert('mahasiswa_akses_kelas',$data);
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">berhasil memilih kelas!</div>');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Kelas sudah penuh!</div>');
			}
		} else {
			$this->db->where($data);
			$this->db->delete('mahasiswa_akses_kelas');
			$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">berhasil mencabut kelas!</div>');
		}
	}
	public function change_manajemen_kelas($type, $data_id, $dm_id){
		if($type == 'dosen'){
			$data = [
				'user_id' => $data_id
			];
		} else if($type == 'hari'){
			$data = [
				'hari_id' => $data_id
			];
		} else if($type == 'jam'){
			$data = [
				'jam_id' => $data_id
			];
		}

		$this->db->where('dm_id', $dm_id);
		$this->db->update('dosen_kelas', $data);
		return $this->db->affected_rows();
	}
	public function getKelasDosen($dsn_id){
		$query = "SELECT kelas.* FROM kelas
				  JOIN dosen_kelas ON dosen_kelas.kelas_id = kelas.kelas_id
				  WHERE dosen_kelas.user_id = " . $dsn_id;
		$kelas = $this->db->query($query)->result_array();
		return $kelas;
	}
}