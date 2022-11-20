<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mmuh15 extends CI_Model {
	public function data(){
		$sql = "SELECT monitoring_unsur_hara.id as id,
		monitoring_unsur_hara.id_rencana_pola_tanam as id_rencana_pola_tanam,
		monitoring_unsur_hara.id_unsur_hara as id_unsur_hara,
		rencana_pola_tanam.masa_tanam as masa_tanam,
		unsur_hara.nama as nama_unsur_hara,
		varietas_tanaman.nama as nama_varietas,
		monitoring_unsur_hara.nilai as nilai  
		FROM monitoring_unsur_hara 
		LEFT JOIN rencana_pola_tanam
		ON monitoring_unsur_hara.id_rencana_pola_tanam = rencana_pola_tanam.id
		LEFT JOIN unsur_hara
		ON monitoring_unsur_hara.id_unsur_hara = unsur_hara.id
		LEFT JOIN varietas_tanaman
		ON rencana_pola_tanam.id_varietas = varietas_tanaman.id
		ORDER BY monitoring_unsur_hara.id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM monitoring_unsur_hara WHERE id='$a' ORDER BY id";
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

	public function tambah($id, $id_rencana_pola_tanam, $id_unsur_hara, $nilai){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO monitoring_unsur_hara VALUES('$id','$id_rencana_pola_tanam','$id_unsur_hara','$nilai',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $rpt, $uh, $nilai){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE monitoring_unsur_hara SET id_rencana_pola_tanam='$rpt', 
		id_unsur_hara='$uh', nilai='$nilai', tgl_update=NOW() WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM monitoring_unsur_hara WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	
	}

}