<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public $controller = 'Admin';
	
	public function __construct() {
		parent::__construct();
		is_logged_in();
		$this->load->model('Model_auth', 'auth');
		$this->load->model('Model_admin', 'admin');
		$this->load->model('Model_kelas', 'kelas');
	}
	public function index(){
		$data['title'] = 'Dashboard';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		loadview('admin/dashboard',$data);
	}
	public function tambahkelas(){
		$data['title'] = 'Tambah Kelas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['dosen'] = $this->admin->getDosen();

		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('kode', 'Kode', 'required');
		$this->form_validation->set_rules('semester', 'Semester', 'required');
		$this->form_validation->set_rules('dosen', 'Dosen', 'required');

		if ($this->form_validation->run() == false){
			loadview('admin/tambahkelas', $data);
		} else {
			$kelas = [
				'kelas' => $this->input->post('kelas'),
				'kode' => $this->input->post('kode'),
				'semester' => $this->input->post('semester')
			];
			$result = $this->admin->insertKelas($kelas);
			$dosen_kelas = [
				'user_id' => $this->input->post('dosen'),
				'kelas_id' => $result['kelas_id'],
				'hari_id' => 1,
				'jam_id' => 1
			];
			$feedback = $this->admin->insertDosenKelas($dosen_kelas);
			if($feedback > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menambah kelas!</div>');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal menambah kelas!</div>');
			}
			redirect('admin/tambahkelas');
		}
	}
	public function manajemenkelas($semester = NULL){
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['title'] = 'Manajemen Kelas';
	
		if($semester == NULL){
			loadview('admin/manajemenkelas', $data);
		} else {
			$data['kelas_semester'] = $this->admin->getManajemenKelas($semester);
			$data['dosen'] = $this->admin->getDosen();
			$data['hari'] = $this->admin->getHari();
			$data['jam'] = $this->admin->getJam();
			$data['semester'] = $semester;
			loadview('admin/manajemenkelas2', $data);
		}
	}
	public function changemanajemenkelas(){
		$utama_id = $this->input->post('utamaId');
		$dm_id = $this->input->post('dmId');
		$type = $this->input->post('type');
		
		if($this->kelas->change_manajemen_kelas($type, $utama_id, $dm_id) > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Update berhasil!</div>');
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Update gagal!</div>');
		}
	}
	public function krsmhs($start = 0){
		$data['title'] = 'KRS Mahasiswa';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		$data['keyword'] = '';
		if($this->input->post('submit')){
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('mhs_keyword', $data['keyword']);
		}
		$data['keyword'] = $this->session->userdata('mhs_keyword');

		$data['mhs'] = $this->admin->getMahasiswa($start,$data['keyword'])->result_array();

		$this->load->library('pagination');

		$config['base_url'] = base_url('admin/krsmhs/');
		$config['total_rows'] = $this->admin->getAllMahasiswa($data['keyword'])->num_rows();

		$config['per_page'] = 3;

		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');


		$data['start'] = $start;
		$data['pagination'] = $this->pagination->initialize($config);

		loadview('admin/krsmhs', $data);
	}
	public function mhskrs($user_id = NULL){
		$data['title'] = 'KRS Mahasiswa';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		if($user_id == NULL){
			redirect('admin/krsmhs');
		}
		$data['mhskrs'] = $this->admin->getMhsKRS($user_id);

		loadview('admin/mhskrs',$data);
	}
	public function batalkrs($mam_id = NULL){
		if($mam_id == NULL){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} 

		if($this->admin->batalKRS($mam_id) > 0){
			$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil membatalkan KRS!</div>');
		} else {
			$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal membatalkan KRS!</div>');
		}
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}