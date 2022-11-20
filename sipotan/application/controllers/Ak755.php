<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ak755 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "ak755";
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
        if(is_array($data["datalogin"])){
			foreach($dataform as $cx){
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if(array_search($idsistem_sistem, $idsistem_user) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array(); $akses = array();
			foreach ($data["dataform"] as $dx){
				array_push($idform, $dx->id_form);
				if($dx->id_form == $idformini){array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);}
			}
			if(array_search($idformini, $idform) !== false){
				$data["akses"] = $akses;
				$this->aksesc = $akses; 
			}else{redirect(base_url());}
        	$this->load->view($idsistem_sistem.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$data["fill"] = "ak755v";
		$data["dtlevel"] = $this->Mle409->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mak755->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
			$username = $k->username;
			$level = $k->level;
			if($k->status == "Y"){$status = "Aktif";}else{$status = "Tak Aktif";}
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>&nbsp<button class='btn btn-icon btn-round btn-danger' data-id='".$id."' onclick='reset(this)'><i class='icon wb-replay'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$username.'","'.$level.'","'.$status.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mak755->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$nama = $k->nama;
					$username = $k->username;
					$idlevel = $k->id_level;
					$status = $k->status;
				}
				echo base64_encode("1|".$id."|".$nama."|".$username."|".$idlevel."|".$status);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$username = trim(str_replace("'","''",$this->input->post("username")));
			$level = trim(str_replace("'","''",$this->input->post("level")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$pass =  md5(base64_encode(enkripsi($username)));
			$dt = $this->Mak755->filterusername($username);
			if(is_array($dt)){
				if(count($dt) > 0){
					echo base64_encode("80");
					return;
				}
			}
			$operasi = $this->Mak755->tambah($nama, $username, $pass, $level, $status);
			if($operasi == "1"){
				$ket = "Nama Akun: $nama,\nUsername: $username,\nPassword: *****,\nID Level: $level,\nStatus: $status";
				$this->Mlog->log_history("Akses","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$level = trim(str_replace("'","''",$this->input->post("level")));
			$status = trim(str_replace("'","''",$this->input->post("status")));
			$operasi = $this->Mak755->update($id, $nama, $level, $status);
			if($operasi == "1"){
				$ket = "ID Akun: $id,\nNama Akun: $nama,\nID Level: $level,\nStatus: $status";
				$this->Mlog->log_history("Akses","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mak755->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mak755->filter($id);
					$operasi = $this->Mak755->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$nama = $k->nama;
							$username = $k->username;
							$idlevel = $k->id_level;
							$status = $k->status;
						}
						$ket = "ID Akun: $id,\nNama Akun: $nama,\nUsername: $username,\nID Level: $idlevel,\nStatus: $status";
						$this->Mlog->log_history("Akses","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}

	public function reset(){
		$id = trim(str_replace("'","''",$this->input->post("id")));
		$td = $this->Mak755->filter($id);
		if(is_array($td)){
			if(count($td) > 0){
				foreach ($td as $k){
					$id = $k->id;
					$nama = $k->nama;
					$username = $k->username;
				}
				$pass =  md5(base64_encode(enkripsi($username)));
				$operasi = $this->Mak755->reset($id, $pass);
				if($operasi == "1"){
					$ket = "ID Akun: $id,\nNama Akun: $nama,\nUsername: $username";
					$this->Mlog->log_history("Akses","Reset Password",$ket);
				}
				echo base64_encode($operasi);
			}else{echo base64_encode("90");}
		}else{echo base64_encode("80");}
	}
}
