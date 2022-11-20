<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdr699 extends CI_Model {
	public function data(){
		$sql = "SELECT a.*, b.nama AS level, c.nama AS form FROM form_level AS a LEFT JOIN level AS b ON a.id_level = b.id LEFT JOIN form AS c ON a.id_form = c.id ORDER BY b.nama, c.nama";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM form_level WHERE id='$a' ORDER BY id";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($level, $form, $atambah, $aupdate, $ahapus, $acetak){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO form_level VALUES(UNIX_TIMESTAMP(NOW()),'$level','$form','$atambah','$aupdate','$ahapus','$acetak',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $level, $form, $atambah, $aupdate, $ahapus, $acetak){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE form_level SET id_level='$level', id_form='$form', akses_tambah='$atambah', akses_update='$aupdate', akses_hapus='$ahapus', akses_cetak='$acetak', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM form_level WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}