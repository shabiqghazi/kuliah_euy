<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model {
	public function getMenu(){
		return $this->db->get('menu')->result_array();
	}
	public function getMenuById($menu_id){
		return $this->db->get_where('menu',['menu_id' => $menu_id])->row_array();
	}
	public function ubahMenu($menu, $menu_id){
		$this->db->where('menu_id', $menu_id);
		$this->db->update('menu', $menu);
		return $this->db->affected_rows();
	}
	public function tambahMenu($menu){
		$this->db->insert('menu',$menu);
		return $this->db->affected_rows();
	}
	public function hapusMenu($menu_id){
		$this->db->where('menu_id', $menu_id);
		$this->db->delete('menu');
		return $this->db->affected_rows();
	}
	public function getSubmenu(){
		$query = "SELECT menu.*,submenu.* FROM submenu
				  JOIN menu ON submenu.menu_id = menu.menu_id";
		return $this->db->query($query)->result_array();
	}
	public function getSubmenuById($submenu_id){
		return $this->db->get_where('submenu', ['submenu_id' => $submenu_id])->row_array();
	}
	public function tambahSubmenu($submenu){
		$this->db->insert('submenu', $submenu);
		return $this->db->affected_rows();
	}
	public function ubahSubmenu($submenu, $submenu_id){
		$this->db->where('submenu_id',$submenu_id);
		$this->db->update('submenu', $submenu);
		return $this->db->affected_rows();
	}
	public function hapusSubmenu($submenu_id){
		$this->db->where('submenu_id', $submenu_id);
		$this->db->delete('submenu');
		return $this->db->affected_rows();
	}
	public function getSidebarMenu($role_id){
		$query = ("SELECT menu.menu_id, menu.menu FROM menu JOIN akses_menu ON menu.menu_id = akses_menu.menu_id WHERE akses_menu.role_id = " . $role_id);
		return $this->db->query($query)->result_array();
	}
	public function getSidebarSubmenu($menu_id){
		$query = ("SELECT submenu.* FROM menu JOIN submenu ON menu.menu_id = submenu.menu_id WHERE submenu.is_active = 1 AND submenu.menu_id = " . $menu_id);
		return $this->db->query($query)->result_array();
	}
}