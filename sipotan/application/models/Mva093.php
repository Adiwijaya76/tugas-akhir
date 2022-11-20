<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mva093 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS komoditas FROM varietas_tanaman AS a LEFT JOIN komoditas AS b ON a.id_komoditas = b.id ORDER BY a.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM varietas_tanaman WHERE id='$a' ORDER BY id";
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

	public function tambah($id, $komoditas, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO varietas_tanaman VALUES('$id','$komoditas', '$nama',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $komoditas, $nama){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE varietas_tanaman SET id_komoditas='$komoditas', nama='$nama',  tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM varietas_tanaman WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}