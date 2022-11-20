<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mdata extends CI_Model {
	public function icon(){
		$sql = "SELECT * FROM icon ORDER BY nama";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function rpt(){
		$sql = "SELECT * FROM rencana_pola_tanam ORDER BY masa_tanam";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}

	}
	public function unsur_hara(){
		$sql = "SELECT * FROM unsur_hara ORDER BY nama";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}
	public function varietas(){
		$sql = "SELECT * FROM varietas_tanaman ORDER BY nama";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}
	public function jumlahsistem(){
		$sql = "SELECT COUNT(*) AS jumlah FROM sistem";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function jumlahform(){
		$sql = "SELECT COUNT(*) AS jumlah FROM form";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function jumlahakun(){
		$sql = "SELECT COUNT(*) AS jumlah FROM akses";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function jumlahkeluar(){
		$sql = "SELECT COUNT(*) AS jumlah FROM surat_keluar WHERE YEAR(tgl_surat) = YEAR(CURDATE())";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function jumlahmasuk(){
		$sql = "SELECT COUNT(*) AS jumlah FROM surat_masuk WHERE YEAR(tgl_terima) = YEAR(CURDATE())";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function grafikmingguan($jenis, $kolom){
		$sql = "SELECT $kolom, COUNT(*) AS jumlah FROM $jenis WHERE YEARWEEK($kolom, 1) = YEARWEEK(CURDATE(), 1) GROUP BY $kolom";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function grafikbulanan($jenis, $kolom){
		$bulanskr = date("Y-m");
		$sql = "SELECT CONCAT('Minggu Ke ',(WEEK($kolom,5)-WEEK(DATE_SUB($kolom, INTERVAL DAYOFMONTH($kolom)-1 DAY),5)+1)) AS minggu_ke, COUNT(*) AS jumlah FROM $jenis WHERE $kolom LIKE '%$bulanskr%' GROUP BY (WEEK($kolom,5)-WEEK(DATE_SUB($kolom, INTERVAL DAYOFMONTH($kolom)-1 DAY),5)+1) ORDER BY (WEEK($kolom,5)-WEEK(DATE_SUB($kolom, INTERVAL DAYOFMONTH($kolom)-1 DAY),5)+1) ASC";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}

	public function grafiktahunan($jenis, $kolom){
		$sql = "SELECT YEAR($kolom) AS tahun, MONTH($kolom) AS bulan, COUNT(*) AS jumlah FROM $jenis WHERE YEAR($kolom) = YEAR(CURDATE()) GROUP BY MONTH($kolom)";
		$querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
	}
}