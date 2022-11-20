<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mrpt18 extends CI_Model {
	public function data(){
		$sql = "SELECT rencana_pola_tanam.id as id, 
		varietas_tanaman.nama as nama,rencana_pola_tanam.id_varietas as id_varietas,
		rencana_pola_tanam.masa_tanam as masa_tanam  FROM rencana_pola_tanam 
		LEFT JOIN varietas_tanaman
		ON rencana_pola_tanam.id_varietas = varietas_tanaman.id
		ORDER BY rencana_pola_tanam.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM rencana_pola_tanam WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM form_level WHERE id_level='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $id_varietas, $masa_tanam){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO rencana_pola_tanam VALUES('$id','$masa_tanam','$id_varietas',NOW(),'0000-00-00','$user');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $id_varietas, $masa_tanam){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE rencana_pola_tanam SET id_varietas='$id_varietas', 
		masa_tanam='$masa_tanam', tgl_update=NOW(), id_buat='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM rencana_pola_tanam WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}