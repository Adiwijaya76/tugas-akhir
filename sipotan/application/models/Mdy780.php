<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdy780 extends CI_Model {
	public function data(){
		$sql = "SELECT * FROM jenis_surat ORDER BY kode";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM jenis_surat WHERE kode='$a' ORDER BY kode";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM surat_keluar WHERE kode_surat='$a' ORDER BY kode_surat";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO jenis_surat VALUES('$id','$nama','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $nama, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE jenis_surat SET nama_jenis_surat='$nama', keterangan='$keterangan', tgl_update=NOW(), id_update='$user' WHERE kode='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM jenis_surat WHERE kode='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}