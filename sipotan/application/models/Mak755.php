<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mak755 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS level FROM akses AS a LEFT JOIN level AS b ON a.id_level = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM akses WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filterusername($a){
		$sql = "SELECT * FROM akses WHERE username='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM log_history WHERE id_user='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($nama, $username, $pass, $level, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO akses VALUES(UNIX_TIMESTAMP(NOW()),'$nama','$username','$pass','$level','$status',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $level, $status){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE akses SET nama='$nama', id_level='$level', status='$status', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM akses WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function reset($id, $pass){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE akses SET password='$pass', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}
}