<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mtb277 extends CI_Model {
	public function data($key1, $key2){
		$sql = "SELECT a.*, (SELECT COUNT(*) FROM arsip_surat_masuk WHERE id_surat = a.id) AS jumlah_doc FROM surat_masuk AS a WHERE a.tgl_terima BETWEEN '$key1' AND '$key2' ORDER BY a.tgl_terima DESC";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function nootomatis(){
		$sql = "SELECT * FROM surat_masuk WHERE YEAR(tgl_terima) = YEAR(CURDATE()) ORDER BY no_register DESC LIMIT 1";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function filter($a){
		$sql = "SELECT * FROM surat_masuk WHERE id='$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function cekform($a){
		$sql = "SELECT * FROM arsip_surat_masuk WHERE id_surat = '$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambah($id, $reg, $no, $tglsurat, $pengirim, $tglterima, $perihal, $disposisi, $kepada, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO surat_masuk VALUES('$id','$reg','$no','$pengirim','$tglsurat','$perihal','$tglterima','$kepada','$disposisi','$keterangan',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function update($id, $reg, $no, $tglsurat, $pengirim, $tglterima, $perihal, $disposisi, $kepada, $keterangan){
		$user = $this->Mlogin->ambiluser();
		$sql = "UPDATE surat_masuk SET no_register='$reg', no_surat='$no', pengirim='$pengirim', tgl_surat='$tglsurat', perihal='$perihal', tgl_terima='$tglterima', diteruskan_kepada='$kepada', disposisi='$disposisi', keterangan='$keterangan', tgl_update=NOW(), id_update='$user' WHERE id='$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapus($id){
		$sql = "DELETE FROM surat_masuk WHERE id = '$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	//----------------------------------------------------

	public function filterdoc($a){
		$sql = "SELECT * FROM arsip_surat_masuk WHERE id = '$a'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function datadoc($key){
		$sql = "SELECT * FROM arsip_surat_masuk WHERE id_surat = '$key'";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function tambahdoc($id, $idsm, $namafile){
		$user = $this->Mlogin->ambiluser();
		$sql = "INSERT INTO arsip_surat_masuk VALUES('$id','$idsm','$namafile',NOW(),'0000-00-00','$user','');";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

	public function hapusdoc($id){
		$sql = "DELETE FROM arsip_surat_masuk WHERE id = '$id';";
		$querySQL = $this->db->query($sql);
		if($querySQL){return "1";}
		else{return "0";}	
	}

}