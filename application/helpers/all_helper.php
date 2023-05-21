<?php 

// Untuk menampilkan menu sidebar
function sidebar_menu($role_id){
	$ci = get_instance();
	$ci->load->model('Model_menu','menu');
	return  $ci->menu->getSidebarMenu($role_id);
}
// Untuk menampilkan submenu sidebar
function sidebar_submenu($menu_id){
	$ci = get_instance();
	$ci->load->model('Model_menu','menu');
	return $ci->menu->getSidebarSubmenu($menu_id);
}
// Untuk menampilkan view selain controller auth
function loadview($main, $data){
	$ci = get_instance();
	$ci->load->view('template/header',$data);
	$ci->load->view('template/sidebar',$data);
	$ci->load->view('template/topbar', $data);
	$ci->load->view($main, $data);
	$ci->load->view('template/footer', $data);
}
// Untuk menyesuaikan role dengan menu yang dapat diakses
function is_logged_in() {
	$ci = get_instance();
	if(!$ci->session->userdata('logindata')){
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('logindata')['role_id'];
		$menu = $ci->uri->segment(1);

		$menu_id = $ci->db->get_where('menu', ['menu' => $menu])->row_array()['menu_id'];

		$result = $ci->db->get_where('akses_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

		if($result->num_rows() < 1){
			redirect('auth/blocked');
		}

		// if($ci->uri->segment(2)){
			$submenu = $ci->uri->segment(2);
			$result = $ci->db->get_where('submenu', ['url' => $menu.'/'.$submenu, 'is_active' => 0]);

			if($result->num_rows() > 0){
				redirect('auth/blocked');
			}
		// }
	}
}
// untuk menentukan kelas yang sudah diambil pada krs
function cek_krs($mhs_id, $mks_id){
	$ci = get_instance();
	$result = $ci->db->get_where('mahasiswa_akses_kelas',['user_id' => $mhs_id, 'kelas_id' => $mks_id]);
	if($result->num_rows() > 0){
		return "checked";
	}
}
// untuk cek apakah mahasiswa punya akses ke sebuah kelas
function cekAksesKelasMahasiswa($user_id, $kelas_id){
	$ci = get_instance();
	$result = $ci->db->get_where('mahasiswa_akses_kelas', ['user_id' => $user_id, 'kelas_id' => $kelas_id]);
	if($result->num_rows() > 0){
		return true;
	} else {
		return false;
	}
}
// untuk cek apakah dosen punya akses ke sebuah kelas
function cekAksesKelasDosen($user_id, $kelas_id){
	$ci = get_instance();
	$result = $ci->db->get_where('dosen_kelas', ['user_id' => $user_id, 'kelas_id' => $kelas_id]);
	if($result->num_rows() > 0){
		return true;
	} else {
		return false;
	}
}
// untuk cek akses tugas
function cekAksesTugas($user_id, $kelas_id, $tugas_id){
	$ci = get_instance();
	$query = "SELECT * FROM tugas
			  JOIN mahasiswa_akses_kelas ON mahasiswa_akses_kelas.kelas_id = tugas.kelas_id
			  JOIN user ON user.user_id = mahasiswa_akses_kelas.user_id
			  WHERE mahasiswa_akses_kelas.user_id = '$user_id' AND mahasiswa_akses_kelas.kelas_id = '$kelas_id' AND tugas.tugas_id = '$tugas_id'";
	$result = $ci->db->query($query);
	return $result->num_rows();
}
// untuk cek akses materi
// function cekAksesMateri($user_id, $kelas_id){
// 	$ci = get_instance();
// 	$query = "SELECT * FROM kelas
// 			  JOIN mahasiswa_akses_kelas ON mahasiswa_akses_kelas.kelas_id = tugas.kelas_id
// 			  JOIN user ON user.user_id = mahasiswa_akses_kelas.user_id
// 			  WHERE mahasiswa_akses_kelas.user_id = '$user_id' AND mahasiswa_akses_kelas.kelas_id = '$kelas_id' AND tugas.tugas_id = '$tugas_id'";
// 	$result = $ci->db->query($query);
// 	return $result->num_rows();
// }