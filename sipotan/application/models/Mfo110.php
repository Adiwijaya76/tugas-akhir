<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mfo110 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS menu, c.nama AS sistem FROM form AS a LEFT JOIN menu AS b ON a.id_menu = b.id LEFT JOIN sistem AS c ON a.id_sistem = c.id ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM form WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form_level WHERE id_form='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $menu, $sistem, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO form VALUES('$id','$nama','$menu','$sistem','$icon',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $menu, $sistem, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE form SET nama='$nama', id_menu='$menu', id_sistem='$sistem', icon='$icon', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM form WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}