<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct(); 
	}
	public function index(){
		if($this->session->userdata('logindata')){
			$role_id = $this->session->userdata('logindata')['role_id'];
			if ($role_id == 1){
				redirect('dosen');
			} else if ($role_id == 2){
				redirect('mahasiswa');
			} else if ($role_id == 3){
				redirect('admin');
			}
		}
		$data['title'] = 'Kuliah Euy | E-Learning';
		$this->load->view('template/auth_header',$data);
		$this->load->view('auth/index',$data);
		$this->load->view('template/auth_footer',$data);
	}
	public function login(){
		if($this->session->userdata('logindata')){
			$role_id = $this->session->userdata('logindata')['role_id'];
			if ($role_id == 1){
				redirect('dosen');
			} else if ($role_id == 2){
				redirect('mahasiswa');
			} else if ($role_id == 3){
				redirect('admin');
			}
		}
		$data['title'] = 'Halaman Login';

		$this->form_validation->set_rules('ni', 'Nomor Induk', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('template/auth_header',$data);
			$this->load->view('auth/login');
			$this->load->view('template/auth_footer');
		} else {
			$this->_login();
		}
	}
	public function registration(){
		if($this->session->userdata('logindata')){
			$role_id = $this->session->userdata('logindata')['role_id'];
			if ($role_id == 1){
				redirect('dosen');
			} else if ($role_id == 2){
				redirect('mahasiswa');
			} else if ($role_id == 3){
				redirect('admin');
			}
		}
		$data['title'] = 'Halaman Registrasi';

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ni', 'Nomor Induk', 'required|is_unique[user.ni]',[
				'is_unique' => 'Nomor Induk telah digunakan sebelumnya'
			]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]',[
				'min_length' => 'Minimal password 5 karakter!'
			]);
		$this->form_validation->set_rules('role_id', 'Role', 'required');

		if($this->form_validation->run() == false){
			$this->load->view('template/auth_header',$data);
			$this->load->view('auth/registration',$data);
			$this->load->view('template/auth_footer',$data);
		} else {
			$user = [
				'nama' => $this->input->post('nama'),
				'ni' => $this->input->post('ni'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'foto' => 'foto_default.jpg',
				'role_id' => $this->input->post('role_id'),
				'is_active' => 1
			];
			$this->load->model('Model_auth','auth');
			if($this->auth->registration($user) > 0){
				$this->session->set_flashdata('message', 'berhasil daftar! silahkan login');
			}
			redirect('auth/login');
		}
	}
	private function _login(){
		$ni = $this->input->post('ni');
		$password = $this->input->post('password');

		$this->load->model('Model_auth','auth');
		$user = $this->auth->getUserByNI($ni);

		if($user){
			if($user['is_active'] == 1){
				if(password_verify($password, $user['password'])){
					$data = [
						'ni' => $user['ni'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata('logindata',$data);
					if($user['role_id'] == 1){
						redirect('dosen');
					} else if($user['role_id'] == 2){
						redirect('mahasiswa');
					} else if($user['role_id'] == 3){
						redirect('admin');
					}
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password Salah!</div>');
					redirect('auth/login');
				}
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akun belum terverifikasi!</div>');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Akun tidak ditemukan!</div>');
			redirect('auth/login');
		}
	}
	public function logout(){
		$this->session->unset_userdata('logindata');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
			redirect('');
	}
	public function blocked(){
		$this->load->view('auth/blocked');
	}
}