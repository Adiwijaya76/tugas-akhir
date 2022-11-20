<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mme776 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM menu ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM menu WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form WHERE id_menu='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO menu VALUES('$id','$nama','$icon',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE menu SET nama='$nama', icon='$icon', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM menu WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}