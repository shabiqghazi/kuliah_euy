<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct() {
		parent::__construct();
		is_logged_in();
		$this->load->model('Model_auth','auth');
		$this->load->model('Model_menu','menu');
		$this->load->model('Model_kelas','kelas');
		$this->load->model('Model_mahasiswa','mahasiswa');
	}
	public function index(){
		$data['title'] = 'Menu Management';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['menu'] = $this->menu->getMenu();
		loadview('menu/index',$data);
	}
	public function tambahmenu(){
		$data['title'] = 'Tambah Menu';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if($this->form_validation->run() == false){
			loadview('menu/tambahmenu',$data);
		} else {
			$menu = [
				'menu' => $this->input->post('menu')
			];
			if($this->menu->tambahMenu($menu) > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambah menu!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah menu!</div>');
			}
			redirect('menu');
		}
	}
	public function ubahmenu($menu_id = NULL){
		$data['title'] = 'Ubah Menu';
		if($menu_id == NULL){
			redirect('menu');
		}
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['menu'] = $this->menu->getMenuById($menu_id);

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if($this->form_validation->run() == false){
			loadview('menu/ubahmenu',$data);
		} else {
			$menu = [
				'menu' => $this->input->post('menu')
			];
			if($this->menu->ubahMenu($menu, $data['menu']['menu_id']) > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah menu!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah menu!</div>');
			}
			redirect('menu');
		}
	}
	public function hapusmenu($menu_id = NULL){
		if($menu_id == NULL){
			redirect('menu');
		}
		if($this->menu->hapusMenu($menu_id) > 0){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus menu!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus menu!</div>');
		}
		redirect('menu');
	}
	public function submenu(){
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['menu'] = $this->menu->getMenu();
		$data['submenu'] = $this->menu->getSubmenu();

		loadview('menu/submenu',$data);
	}
	public function tambahsubmenu(){
		$data['title'] = 'Tambah Submenu';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['menu'] = $this->menu->getMenu();

		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if($this->form_validation->run() == false){
			loadview('menu/tambahsubmenu',$data);
		} else {
			$is_active = $this->input->post('is_active') ? 1 : 0;
			$submenu = [
				'menu_id' => $this->input->post('menu_id'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $is_active
			];
			if($this->menu->tambahSubmenu($submenu) > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambah submenu!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah submenu!</div>');
			}
			redirect('menu/submenu');
		}
	}
	public function ubahsubmenu($submenu_id){
		$data['title'] = 'Ubah Submenu';
		if($submenu_id == NULL){
			redirect('menu/submenu');
		}
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['menu'] = $this->menu->getMenu();
		$data['submenu'] = $this->menu->getSubmenuById($submenu_id);

		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if($this->form_validation->run() == false){
			loadview('menu/ubahsubmenu',$data);
		} else {
			$is_active = $this->input->post('is_active') ? 1 : 0;
			$submenu = [
				'menu_id' => $this->input->post('menu_id'),
				'title' => $this->input->post('title'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $is_active
			];
			if($this->menu->ubahSubmenu($submenu, $submenu_id) > 0){
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah submenu!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah submenu!</div>');
			}
			redirect('menu/submenu');
		}
	}
	public function hapussubmenu($submenu_id = NULL){
		if($submenu_id == NULL){
			redirect('menu/submenu');
		}
		if($this->menu->hapusSubmenu($submenu_id) > 0){
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus submenu!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus submenu!</div>');
		}
		redirect('menu/submenu');
	}
}