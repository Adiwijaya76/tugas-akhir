<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fo110 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "fo110";
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
		$data["fill"] = "fo110v";
		$data["dtmenu"] = $this->Mme776->data();
		$data["dtsistem"] = $this->Msi933->data();
		$data["iccon"] = $this->Mdata->icon();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mfo110->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
			$menu = $k->menu;
			$sistem = $k->sistem;
			$ic = $k->icon;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$icon = "<i class='".$ic."' style='font-size: 20px;'></i>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$menu.'","'.$sistem.'","'.$ic.'","'.$icon.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mfo110->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$nama = $k->nama;
					$menu = $k->id_menu;
					$sistem = $k->id_sistem;
					$icon = $k->icon;
				}
				echo base64_encode("1|".$id."|".$nama."|".$menu."|".$sistem."|".$icon);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$menu = trim(str_replace("'","''",$this->input->post("menu")));
			$sistem = trim(str_replace("'","''",$this->input->post("sistem")));
			$icon = trim(str_replace("'","''",$this->input->post("icon")));
			$operasi = $this->Mfo110->tambah($id, $nama, $menu, $sistem, $icon);
			if($operasi == "1"){
				$ket = "ID Form: $id,\nNama Form: $nama,\nID Menu: $menu,\nID Sistem: $sistem,\nIcon Form: $icon";
				$this->Mlog->log_history("Form","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$menu = trim(str_replace("'","''",$this->input->post("menu")));
			$sistem = trim(str_replace("'","''",$this->input->post("sistem")));
			$icon = trim(str_replace("'","''",$this->input->post("icon")));
			$operasi = $this->Mfo110->update($id, $nama, $menu, $sistem, $icon);
			if($operasi == "1"){
				$ket = "ID Form: $id,\nNama Form: $nama,\nID Menu: $menu,\nID Sistem: $sistem,\nIcon Form: $icon";
				$this->Mlog->log_history("Form","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mfo110->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mfo110->filter($id);
					$operasi = $this->Mfo110->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$nama = $k->nama;
							$menu = $k->id_menu;
							$sistem = $k->id_sistem;
							$icon = $k->icon;
						}
						$ket = "ID Form: $id,\nNama Form: $nama,\nID Menu: $menu,\nID Sistem: $sistem,\nIcon Form: $icon";
						$this->Mlog->log_history("Form","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}
