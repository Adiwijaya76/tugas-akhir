<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Msi933 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM sistem ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM sistem WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form WHERE id_sistem='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $deskripsi, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO sistem VALUES('$id','$nama','$deskripsi','$icon',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $deskripsi, $icon){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE sistem SET nama='$nama', deskripsi='$deskripsi', icon='$icon', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$user = $this->Mlogin->ambiluser();
		$sql = "DELETE FROM sistem WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}