<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	public function __construct(){
		parent::__construct();
		is_logged_in();
		
		$this->load->model('Model_auth','auth');
		$this->load->model('Model_menu','menu');
		$this->load->model('Model_kelas','kelas');
		$this->load->model('Model_mahasiswa','mahasiswa');
	} 
	public function index(){
		$data['title'] = 'Profil';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		loadview('profil/profil', $data);
	}
	public function edit(){
		$data['title'] = 'Edit Profil';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ni', 'Nomor Induk', 'required');

		if($this->form_validation->run() == false){
			loadview('profil/edit', $data);
		} else {
			$user = [
				'nama' => $this->input->post('nama',TRUE),
				'ni' => $this->input->post('ni')
			];

			// gambar
			$uploaded_img = $_FILES['foto']['name'];
			if($uploaded_img){
				$filename = 'display-picture_'.$data['user']['user_id'];
				$config['file_name'] = $filename;
				$config['upload_path'] = './assets/img/profile';
				$config['allowed_types'] = 'png|jpg|jpeg|gif';
				$config['max_size'] = '4096';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('foto')){
					$old_image = $data['user']['foto'];
					if($old_image != 'foto_default.jpg'){
						unlink(FCPATH . './assets/img/profile/' . $old_image);
					}
					$user['foto'] = $this->upload->data('file_name');
				} else {
					$error = $this->upload->display_errors();
				}
			}
			if($this->auth->editprofil($user, $data['user']['user_id']) > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah profil!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah profil!</div>');
				if(isset($error)){
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">'.$error.'</div>');
				}
			}
			redirect('profil');
		}
	}
	public function ubahpassword(){
		$data['title'] = 'Ubah Password';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		$this->form_validation->set_rules('current_pass','Current Password','required|trim');
		$this->form_validation->set_rules('new_pass1','New Password','required|trim|min_length[5]|matches[new_pass2]');
		$this->form_validation->set_rules('new_pass2','New Password','required|trim|min_length[5]|matches[new_pass1]');

		if($this->form_validation->run() == false){
			loadview('profil/ubahpassword',$data);
		} else {
			$current_pass = $this->input->post('current_pass');
			$new_pass = $this->input->post('new_pass2');

			if(!password_verify($current_pass,$data['user']['password'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('profil/ubahpassword');
			} else {
				if($current_pass == $new_pass){
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama dengan password lama!</div>');
					redirect('profil/ubahpassword');
				} else {
					$password_hash = password_hash($new_pass, PASSWORD_DEFAULT);
					if($this->auth->ubahpassword($password_hash, $data['user']['user_id']) > 0){
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password diubah!</div>');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password gagal diubah!</div>');
					}
					redirect('profil/ubahpassword');
				}
			}
		}
	}
}