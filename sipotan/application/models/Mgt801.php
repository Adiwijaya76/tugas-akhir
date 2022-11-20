<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mgt801 extends CI_Model {
	public function data($key1, $key2){
		$sql = "SELECT a.*, (SELECT COUNT(*) FROM arsip_surat_keluar WHERE id_surat = a.id) AS jumlah_doc FROM surat_keluar AS a WHERE a.tgl_surat BETWEEN '$key1' AND '$key2' ORDER BY a.tgl_surat DESC";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function datajenis(){
		$sql = "SELECT * FROM jenis_surat ORDER BY kode";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function kodesurat(){
		$sql = "SELECT * FROM pengaturan WHERE id = '001'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function nootomatis(){
		$sql = "SELECT * FROM surat_keluar WHERE YEAR(tgl_surat) = YEAR(CURDATE()) ORDER BY no_surat DESC LIMIT 1";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM surat_keluar WHERE id='$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM arsip_surat_keluar WHERE id_surat = '$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $tglsurat, $kodejenis, $nosurat, $kodekec, $thsurat, $kepada, $perihal, $pengolah, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO surat_keluar VALUES('$id','$kodejenis','$nosurat','$kodekec','$thsurat','$kepada','$tglsurat','$perihal','$pengolah','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $tglsurat, $kodejenis, $nosurat, $kodekec, $thsurat, $kepada, $perihal, $pengolah, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE surat_keluar SET kode_surat='$kodejenis', no_surat='$nosurat', kode_surat_kecamatan='$kodekec', tahun_surat='$thsurat', kepada='$kepada', tgl_surat='$tglsurat', isi_surat='$perihal', pengolah='$pengolah', keterangan='$keterangan', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM surat_keluar WHERE id = '$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	//----------------------------------------------------

	public function filterdoc($a){
		$sql = "SELECT * FROM arsip_surat_keluar WHERE id = '$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function datadoc($key){
		$sql = "SELECT * FROM arsip_surat_keluar WHERE id_surat = '$key'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambahdoc($id, $idsm, $namafile){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO arsip_surat_keluar VALUES('$id','$idsm','$namafile',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapusdoc($id){
		$sql = "DELETE FROM arsip_surat_keluar WHERE id = '$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}