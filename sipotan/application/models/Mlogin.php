<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mlogin extends CI_Model {
	public function cek_login(){
		if($this->session->userdata(sesi)){
			$ayy = dekripsi($this->encryption->decrypt(base64_decode($this->session->userdata(sesi))));
			$dtl = explode("|", $ayy);
			$id = $dtl[0];
			$pas = $dtl[1];
			$dx = $this->login($id, $pas);
			if(is_array($dx)){
				if(count($dx)>0){
					foreach($dx as $t){$idlevel = $t->id_level;}
				}else{$idlevel = "";}
			}else{$idlevel = "";}
			if($idlevel == ""){
				return 0;
			}else{
				if($idlevel == "00"){
					$sql = "SELECT a.id, a.nama, a.username, a.id_level, a.status, b.id AS id_sistem, (SELECT nama FROM level WHERE id = a.id_level) AS level, b.nama AS sistem, b.icon, b.deskripsi FROM akses AS a, sistem AS b WHERE a.id = '$id' AND a.password = '$pas' AND a.status = 'Y' GROUP BY a.id, a.username, b.id";
				}else{
					$sql = "SELECT a.id, a.nama, a.username, a.id_level, a.status, c.id_sistem, d.nama AS level, e.nama AS sistem, e.icon, e.deskripsi FROM akses AS a LEFT JOIN form_level AS b ON a.id_level = b.id_level LEFT JOIN form AS c ON b.id_form = c.id LEFT JOIN level AS d ON a.id_level = d.id LEFT JOIN sistem AS e ON c.id_sistem = e.id WHERE a.id = '$id' AND a.password = '$pas' AND a.status = 'Y' GROUP BY a.id, a.username, c.id_sistem";
				}
				$querySQL = $this->db->query($sql);
				return $querySQL->result();
			}
		}else{return 0;}
	}

	public function cek_menu($idsistem, $idlevel){
		if($idlevel == "00"){
			$sql = "SELECT a.id AS id_menu, a.nama AS menu, a.icon AS icon_menu FROM menu AS a JOIN form AS b ON a.id = b.id_menu WHERE b.id_sistem = '$idsistem' GROUP BY a.id ORDER BY a.id";
		}else{
			$sql = "SELECT a.id AS id_menu, a.nama AS menu, a.icon AS icon_menu FROM menu AS a JOIN form AS b ON a.id = b.id_menu JOIN form_level AS c ON b.id = c.id_form WHERE b.id_sistem = '$idsistem' AND c.id_level = '$idlevel' GROUP BY a.id ORDER BY a.id";
		}
		$querySQL = $this->db->query($sql);
		if($querySQL){
			return $querySQL->result();
		}else{return 0;}
	}

	public function cek_form($idsistem, $idlevel){
		if($idlevel == "00"){
			$sql = "SELECT id AS id_form, nama AS nama_form, id_menu, id_sistem, icon AS icon_form, '00' AS id_level, '1' AS akses_tambah, '1' AS akses_update, '1' AS akses_hapus, '1' AS akses_cetak FROM form WHERE id_sistem = '$idsistem' ORDER BY id_menu, id";
		}else{
			$sql = "SELECT b.id AS id_form, b.nama AS nama_form, b.id_menu, b.id_sistem, b.icon AS icon_form, c.id_level, c.akses_tambah, c.akses_update, c.akses_hapus, c.akses_cetak FROM menu AS a JOIN form AS b ON a.id = b.id_menu JOIN form_level AS c ON b.id = c.id_form WHERE b.id_sistem = '$idsistem' AND c.id_level = '$idlevel' ORDER BY b.id";
		}
		$querySQL = $this->db->query($sql);
		if($querySQL){
			return $querySQL->result();
		}else{return 0;}
	}

	public function cek_sistem($idform){
		$sql = "SELECT * FROM form WHERE id = '$idform'";
		$querySQL = $this->db->query($sql);
		if($querySQL){
			return $querySQL->result();
		}else{return 0;}
	}

	public function login($u, $p){
		$sql = "SELECT * FROM akses WHERE (id = '$u' OR username = '$u') AND password = '$p' AND status = 'Y'";
		$querySQL = $this->db->query($sql);
		if($querySQL){
			return $querySQL->result();
		}else{return 0;}
	}

	public function update_password($id, $pass){
		$sql = "UPDATE akses SET password = '$pass' WHERE id = '$id'";
		$querySQL = $this->db->query($sql);
        if($querySQL){return "1";}
		else{return "0";}
	}

	public function ambiluser(){
		$ayy = dekripsi($this->encryption->decrypt(base64_decode($this->session->userdata(sesi))));
		$dtl = explode("|", $ayy);
		return $dtl[0];
	}
}