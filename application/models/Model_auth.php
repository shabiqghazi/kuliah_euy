<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model {
	public function registration($data){
		$this->db->insert('user',$data);
		return $this->db->affected_rows();
	}
	public function getUserByNI($ni){
		$data = $this->db->get_where('user',['ni' => $ni])->row_array();
		return $data;
	}
	public function getRole(){
		return $this->db->get('user_role')->result_array();
	}
	public function editprofil($data, $user_id){
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);

		return $this->db->affected_rows();
	}
	public function ubahpassword($password, $user_id){
		$this->db->set('password',$password);
		$this->db->where('user_id',$user_id);
		$this->db->update('user');

		return $this->db->affected_rows();
	}
}