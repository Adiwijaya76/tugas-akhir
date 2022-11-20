<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mkj540 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM pengaturan ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM pengaturan WHERE id='$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function update($id, $nilai, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE pengaturan SET nilai='$nilai', keterangan='$keterangan', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}