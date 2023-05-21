<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public $controller = 'Mahasiswa';
	
	public function __construct(){
		parent::__construct();
		is_logged_in();
		$this->load->model('Model_auth','auth');
		$this->load->model('Model_menu','menu');
		$this->load->model('Model_kelas','kelas');
		$this->load->model('Model_mahasiswa','mahasiswa');
	}
	public function index(){
		$data['controller'] = $this->controller;
		$data['title'] = 'Dashboard';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		loadview('mahasiswa/dashboard', $data);
	}
	public function tugas($tugas_id = NULL){
		$data['title'] = 'Tugas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		
		if($tugas_id == NULL){
			$data['tugas'] = $this->mahasiswa->getTugas_belum($data['user']['user_id']);
			loadview('mahasiswa/tugas', $data);
		} else {
			$tugas = $this->mahasiswa->getTugasByID($tugas_id);
			if(cekAksesKelasMahasiswa($data['user']['user_id'], $tugas['kelas_id']) > 0){
				$data['tugas'] = $tugas;

				$this->form_validation->set_rules('text', 'Text', 'required');
				// $this->form_validation->set_rules('file', 'File', 'required');

				if($this->form_validation->run() == false){
					$tugas_selesai = $this->mahasiswa->getTugasSelesaiByTugasId($tugas_id, $data['user']['user_id']);
					if($tugas_selesai){
						$data['tugas_selesai'] = $tugas_selesai;
					}
					loadview('mahasiswa/dotugas',$data);
				} else {
					$ori_filename = [''];
					$file = '';
					$waktu_selesai = time();
					if($_FILES['file']['name'][0] != ''){
						$uploaded_file = $_FILES['file']['name'];
						$ori_filename = [];
						$file = [];
						for($i = 0 ; $i < count($uploaded_file); $i++){
							if(!empty($_FILES['file']['name'][$i])){
								$kelas = $this->kelas->getKelasById($tugas['kelas_id']);

								$_FILES['file[]']['name'] = $_FILES['file']['name'][$i];
						        $_FILES['file[]']['type'] = $_FILES['file']['type'][$i];
						        $_FILES['file[]']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
						        $_FILES['file[]']['error'] = $_FILES['file']['error'][$i];
						        $_FILES['file[]']['size'] = $_FILES['file']['size'][$i];
						        $ori_filename[] = $_FILES['file']['name'][$i];

								$config['upload_path']		= './file/tugas-mahasiswa';
								$config['allowed_types']	= 'pdf|doc|docx|ppt|pptx|xls|xlsx|rar|zip';
								$config['max_size']			= '8192';
								$config['file_name']		= $kelas . '_' . $tugas_id . '_' . $data['user']['ni'];

								$this->load->library('upload', $config);

								if ($this->upload->do_upload('file[]')){
									$file[] = $this->upload->data('file_name');
								} else {
									echo $this->upload->display_errors();
								}
							}
						}
					}
					$ori_filenames = '';
					$files = '';
					for($i = 0 ; $i < count($ori_filename) ; $i++){
						$ori_filenames .= $ori_filename[$i].'/';
						$files .= $file[$i].'/';
					}
					$data_tugas = [
						'user_id' => $data['user']['user_id'],
						'tugas_id' => $tugas_id,
						'text' => $this->input->post('text'),
						'file' => $files,
						'ori_filename' => $ori_filenames,
						'waktu_selesai' => $waktu_selesai
					];
					$this->db->insert('tugas_selesai', $data_tugas);
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Tugas telah selesai!</div>');
					}
						redirect('mahasiswa/tugas');
				}
			}
			else {
				redirect('mahasiswa/tugas');
			}
		}
	}
	public function ubahdotugas($tugas_selesai_id){
		if(isset($_POST['submit'])){
			$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
			$tugas_selesai = $this->db->get_where('tugas_selesai', ['tugas_selesai_id' => $tugas_selesai_id])->row_array();
			$tugas_id = $tugas_selesai['tugas_id'];
			$tugas_selesai = $this->mahasiswa->getTugasSelesaiByTugasId($tugas_id, $data['user']['user_id']);
			if(cekAksesKelasMahasiswa($data['user']['user_id'], $tugas_selesai['kelas_id'])){
				$ori_filename = [''];
				$file = '';
				$waktu_selesai = time();
				$tugas = $this->mahasiswa->getTugasByID($tugas_selesai['tugas_id']);
				if($_FILES['file']['name'][0] != ''){
					$uploaded_file = $_FILES['file']['name'];
					$ori_filename = [];
					$file = [];
					for($i = 0 ; $i < count($uploaded_file); $i++){
						if(!empty($_FILES['file']['name'][$i])){
							$kelas = $this->kelas->getKelasById($tugas['kelas_id']);

							$_FILES['file[]']['name'] = $_FILES['file']['name'][$i];
					        $_FILES['file[]']['type'] = $_FILES['file']['type'][$i];
					        $_FILES['file[]']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
					        $_FILES['file[]']['error'] = $_FILES['file']['error'][$i];
					        $_FILES['file[]']['size'] = $_FILES['file']['size'][$i];
					        $ori_filename[] = $_FILES['file']['name'][$i];

							$config['upload_path']		= './file/tugas-mahasiswa';
							$config['allowed_types']	= 'pdf|doc|docx|ppt|pptx|xls|xlsx|rar|zip';
							$config['max_size']			= '8192';
							$config['file_name']		= $kelas . '_' . $tugas['tugas_id'] . '_' . $data['user']['ni'];

							$this->load->library('upload', $config);

							if ($this->upload->do_upload('file[]')){
								$file[] = $this->upload->data('file_name');
								$oldfiles = explode('/',trim($tugas_selesai['file'],'/'));
								foreach($oldfiles as $oldfile){
									unlink(FCPATH . './file/tugas-mahasiswa/' . $oldfile);
								}
							} else {
								echo $this->upload->display_errors();
							}
						}
					}
				}
				$ori_filenames = '';
				$files = '';
				for($i = 0 ; $i < count($ori_filename) ; $i++){
					$ori_filenames .= $ori_filename[$i].'/';
					$files .= $file[$i].'/';
				}
				if(!$uploaded_file){
					$data_tugas = [
						'text' => $this->input->post('text'),
						'waktu_selesai' => $waktu_selesai
					];
				} else {
					$data_tugas = [
						'text' => $this->input->post('text'),
						'file' => $files,
						'ori_filename' => $ori_filenames,
						'waktu_selesai' => $waktu_selesai
					];
				}
				$this->db->where('tugas_selesai_id', $tugas_selesai_id);
				$this->db->update('tugas_selesai', $data_tugas);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Tugas telah selesai!</div>');
				}
			}
			redirect('mahasiswa/tugas');
		}
	}
	public function hapusdotugas($tugas_selesai_id = NULL){
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		if($tugas_selesai_id == NULL){
			redirect('mahasiswa/tugas');
		}
		$tugas_selesai = $this->db->get_where('tugas_selesai', ['tugas_selesai_id' => $tugas_selesai_id])->row_array();
		$tugas_id = $tugas_selesai['tugas_id'];
		$tugas_selesai = $this->mahasiswa->getTugasSelesaiByTugasId($tugas_id, $data['user']['user_id']);
		if(cekAksesKelasMahasiswa($data['user']['user_id'], $tugas_selesai['kelas_id'])){
			$oldfiles = explode('/',trim($tugas_selesai['file'],'/'));
			foreach($oldfiles as $oldfile){
				unlink(FCPATH . './file/tugas-mahasiswa/' . $oldfile);
			}
			if($this->mahasiswa->hapusTugasSelesai($tugas_selesai_id) > 0){
				$this->session->set_flashdata('message','<div class="alert alert-success col-12" role="alert">Berhasil menghapus submission!</div>');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger col-12" role="alert">Gagal menghapus submission!</div>');
			}
		}
		redirect('mahasiswa/tugas');
	}
	public function krs($semester = NULL){
		$data['title'] = 'KRS';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);

		if($semester == NULL){
			loadview('mahasiswa/krs',$data);
		} else {
			$data['kelas_semester'] = $this->kelas->getKelasBySemester($semester);
			loadview('mahasiswa/krs2',$data);
		}
	}
	public function changekrs(){
		$data['controller'] = $this->controller;
		$user_id = $this->input->post('userId');
		$kelas_id = $this->input->post('mkId');

		$this->kelas->mhs_krs($user_id, $kelas_id);
	}
	public function kelas($id_kelas = NULL){
		$data['controller'] = $this->controller;
		$data['title'] = 'Kelas';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['kelas'] = $this->kelas->getKelasMahasiswa($data['user']['user_id']);
		$data['sesi'] = $this->mahasiswa->getSesi();

		if ($id_kelas == NULL){
			loadview('mahasiswa/kelas', $data);
		} else {
			if(cekAksesKelasMahasiswa($data['user']['user_id'], $id_kelas) == true){
				$data['kelas_id'] = $id_kelas;
				loadview('mahasiswa/kelas2', $data);
			} else {
				redirect('mahasiswa/kelas');
			}
		}
	}
	public function materi($materi_id){
		$data['title'] = 'Materi';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		
		if($materi_id == NULL){
			redirect('mahasiswa/kelas');
		} else {
			$data['materi'] = $this->mahasiswa->getMateriByID($materi_id);
			if(cekAksesKelasMahasiswa($data['user']['user_id'], $data['materi']['kelas_id'])){
				loadview('mahasiswa/materi',$data);
			}
		}
	}
	public function cetak_krs(){
		$data['title'] = 'Cetak KRS';
		$data['user'] = $this->auth->getUserByNI($this->session->userdata('logindata')['ni']);
		$data['krs'] = $this->mahasiswa->getKRSmhs($data['user']['user_id']);

		$this->load->view('template/header', $data);
		$this->load->view('mahasiswa/cetak_krs', $data);
		// $this->load->view('template/footer', $data);
	}
}