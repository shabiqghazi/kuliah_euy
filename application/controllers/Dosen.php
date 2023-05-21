<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
	public $controller = 'Dosen';
	
	public function __construct() {
		parent::__construct();
		is_logged_in();
		$this->load->model('Model_auth','auth');
		$this->load->model('Model_menu','menu');
		$this->load->model('Model_kelas','kelas');
		$this->load->model('Model_dosen','dosen');
	}
	public function index(){
		$data['controller'] = $this->controller;
		$data['title'] = 'Dashboard';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		loadview('dosen/dashboard',$data);
	}
	public function tugas(){
		$data['title'] = 'Tugas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['tugas'] = $this->dosen->getTugas($data['user']['user_id']);

		loadview('dosen/tugas',$data);
	}
	public function tugasbaru(){
		$data['title'] = 'Tugas Baru';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas_dosen'] = $this->kelas->getKelasDosen($data['user']['user_id']);
		$data['sesi'] = $this->dosen->getSesi();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('deadline', 'Tanggal Deadline', 'required');
		$this->form_validation->set_rules('kelas_id[]', 'Mata Kuliah', 'required');
		$this->form_validation->set_rules('sesi_id', 'Sesi', 'required');

		if($this->form_validation->run() == false){
			loadview('dosen/tugasbaru',$data);
		} else {
			foreach($this->input->post('kelas_id[]') as $kelas_id){
				$tugas = [
					'title' => $this->input->post('title'),
					'deskripsi' => $this->input->post('deskripsi'),
					'sesi_id' => $this->input->post('sesi_id'),
					'deadline' => strtotime($this->input->post('deadline')),
					'kelas_id' => $kelas_id
				];
				$feedback = $this->dosen->insertTugas($tugas);
				if($feedback > 0){
					$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menambah tugas!</div>');
				}
			}
			redirect('dosen/tugasbaru');
		}
	}
	public function hapustugas($tugas_id){
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['tugas'] = $this->dosen->getTugasById($tugas_id);
		if (cekAksesKelasDosen($data['user']['user_id'], $data['tugas']['kelas_id']) == true) {
			if($this->dosen->hapusTugas($tugas_id) > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menghapus tugas!</div>');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal menghapus tugas!</div>');
			}
		}
		redirect('dosen/tugas');
	}
	public function ubahtugas($tugas_id){
		$data['title'] = 'Ubah Tugas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas_dosen'] = $this->kelas->getKelasDosen($data['user']['user_id']);
		$data['sesi'] = $this->dosen->getSesi();
		$data['tugas'] = $this->dosen->getTugasById($tugas_id);

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('deadline', 'Tanggal Deadline', 'required');
		$this->form_validation->set_rules('kelas_id', 'Mata Kuliah', 'required');
		$this->form_validation->set_rules('sesi_id', 'Sesi', 'required');

		if(cekAksesKelasDosen($data['user']['user_id'], $data['tugas']['kelas_id']) == true){
			if($this->form_validation->run() == false){
				loadview('dosen/ubahtugas',$data);
			} else {
				$tugas = [
					'title' => $this->input->post('title'),
					'deskripsi' => $this->input->post('deskripsi'),
					'sesi_id' => $this->input->post('sesi_id'),
					'deadline' => strtotime($this->input->post('deadline')),
					'kelas_id' => $this->input->post('kelas_id')
				];
				$feedback = $this->dosen->updateTugas($tugas_id,$tugas);
				if($feedback > 0){
					$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil mengubah tugas!</div>');
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal mengubah tugas!</div>');
				}
				redirect('dosen/tugas');
			}
		} else {
			redirect('dosen/tugas');
		}
	}
	public function kelas($id_kelas = NULL){
		$data['title'] = 'Kelas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas'] = $this->kelas->getKelasDosen($data['user']['user_id']);
		$data['sesi'] = $this->dosen->getSesi();
		
		if ($id_kelas == NULL){
			loadview('dosen/kelas', $data);
		} else {
			if(cekAksesKelasDosen($data['user']['user_id'], $id_kelas) == true){
				$data['kelas_id'] = $id_kelas;
				loadview('dosen/kelas2', $data);
			} else {
				redirect('dosen/kelas');
			}
		}
	}
	public function manajementugas($tugas_id = NULL, $tugas_selesai_id = NULL){
		$data['title'] = 'Manajemen Tugas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['tugas'] = $this->dosen->getTugasById($tugas_id);

		if($tugas_id == NULL){
			redirect('dosen/tugas');
		} else {
			if(cekAksesKelasDosen($data['user']['user_id'], $data['tugas']['kelas_id'])){
				if($tugas_selesai_id == NULL){
					$data['tugas_selesai'] = $this->dosen->getTugasSelesaiByTugasId($tugas_id, $data['user']['user_id']);
					loadview('dosen/manajementugas', $data);
				} else {
					$data['tugas_selesai'] = $this->dosen->getTugasSelesaiByTugasIdTugasSelesaiId($tugas_id, $tugas_selesai_id, $data['user']['user_id']);
					loadview('dosen/manajementugas2', $data);
				}
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Blocked!</div>');
				redirect('dosen/tugas');
			}
		}
	}
	public function tambahmateri(){
		$data['title'] = 'Tambah Materi';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas_dosen'] = $this->kelas->getKelasDosen($data['user']['user_id']);
		$data['sesi'] = $this->dosen->getSesi();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('teks', 'Teks', 'required');
		$this->form_validation->set_rules('kelas_id[]', 'Mata Kuliah', 'required');
		$this->form_validation->set_rules('sesi_id', 'Sesi', 'required');

		if($this->form_validation->run() == FALSE){
			loadview('dosen/tambahmateri', $data);
		} else {
			foreach($this->input->post('kelas_id') as $kelas_id):
				$uploaded_file = $_FILES['file']['name'];
				$kelas = $this->kelas->getKelasById($kelas_id);
				$sesi = $this->kelas->getSesiById($this->input->post('sesi_id'));
				$file = '';
				if($uploaded_file){
					if(!empty($_FILES['file']['name'])){
						$config['upload_path']		= './file/materi';
						$config['allowed_types']	= 'pdf|doc|docx|ppt|pptx|xls|xlsx|rar|zip';
						$config['max_size']			= '8192';
						$config['file_name']		= $kelas.'_'.$sesi.'_'.$this->input->post('title');

						$this->load->library('upload', $config);

						if ($this->upload->do_upload('file')){
							$file = $this->upload->data('file_name');			
						} else {
							echo $this->upload->display_errors();
						}
					}
				}
				$materi = [
					'title' => $this->input->post('title'),
					'teks' => $this->input->post('teks'),
					'sesi_id' => $this->input->post('sesi_id'),
					'file' => $file,
					'ori_filename' => $_FILES['file']['name'],
					'kelas_id' => $kelas_id,
				];
				$feedback = $this->dosen->insertMateri($materi);
			endforeach;
			if($feedback > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menambah materi!</div>');
				redirect('dosen/tambahmateri');
			}
		}
	}
	public function ubahmateri($materi_id = NULL){
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas_dosen'] = $this->kelas->getKelasDosen($data['user']['user_id']);
		$data['sesi'] = $this->dosen->getSesi();
		$data['materi'] = $this->dosen->getMateriById($materi_id);

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('teks', 'Teks', 'required');
		$this->form_validation->set_rules('sesi_id', 'Sesi', 'required');

		if($this->form_validation->run() == FALSE){
			redirect('dosen/materi/'.$materi_id);
		} else {
			if(!cekAksesKelasDosen($data['user']['user_id'],$data['materi']['kelas_id'])){
				redirect('dosen/materi/'.$materi_id);
			}
			$uploaded_file = $_FILES['file']['name'];
			$kelas = $this->kelas->getKelasById($data['materi']['kelas_id']);
			$sesi = $this->kelas->getSesiById($this->input->post('sesi_id'));
			$file = $data['materi']['file'];
			$ori_filename = $data['materi']['ori_filename'];
			if($uploaded_file){
				if(!empty($_FILES['file']['name'])){
					$config['upload_path']		= './file/materi';
					$config['allowed_types']	= 'pdf|doc|docx|ppt|pptx|xls|xlsx|rar|zip';
					$config['max_size']			= '8192';
					$config['file_name']		= $kelas.'_'.$sesi.'_'.$this->input->post('title');
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('file')){
						$file = $this->upload->data('file_name');
						$ori_filename = $_FILES['file']['name'];
						$oldfile = $data['materi']['file'];
						unlink(FCPATH . './file/tugas-mahasiswa/' . $oldfile);
					} else {
						echo $this->upload->display_errors();
					}
				}
			}
			$materi = [
				'title' => $this->input->post('title'),
				'teks' => $this->input->post('teks'),
				'sesi_id' => $this->input->post('sesi_id'),
				'file' => $file,
				'ori_filename' => $ori_filename,
			];
			$feedback = $this->dosen->updateMateri($materi, $data['materi']['materi_id']);

			if($feedback > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil mengubah materi!</div>');
				redirect('dosen/kelas/'.$data['materi']['kelas_id']);
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal mengubah materi!</div>');
				redirect('dosen/kelas/'.$data['materi']['kelas_id']);
			}
		}
	}
	public function hapusmateri($materi_id = NULL){
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		if($materi_id == NULL){
			redirect('dosen/kelas');
		} else {
			$data['materi'] = $this->dosen->getMateriById($materi_id);
			if(cekAksesKelasDosen($data['user']['user_id'], $data['materi']['kelas_id'])){
				if ($this->dosen->hapusMateri($materi_id) > 0){
					$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menghapus materi!</div>');
				} else {
					$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menghapus materi!</div>');
				}
			}
			redirect('dosen/kelas/' . $data['materi']['kelas_id']);
		}
	}
	public function materi($materi_id = NULL){
		$data['title'] = 'Materi';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['sesi'] = $this->dosen->getSesi();

		if($materi_id == NULL){
			redirect('dosen/kelas');
		} else {
			$data['materi'] = $this->dosen->getMateriById($materi_id);
			if(cekAksesKelasDosen($data['user']['user_id'], $data['materi']['kelas_id'])){
				loadview('dosen/materi',$data);
			}
		}
	}
}