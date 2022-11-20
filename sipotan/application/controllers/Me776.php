<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Me776 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "me776";
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
		$data["iccon"] = $this->Mdata->icon();
		$data["fill"] = "me776v";
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mme776->data();
        foreach ($dt as $k){
            $id = $k->id;
            $nama = $k->nama;
			$ic = $k->icon;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
			$icon = "<i class='".$ic."' style='font-size: 20px;'></i>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$nama.'","'.$ic.'","'.$icon.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mme776->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$nama = $k->nama;
					$ic = $k->icon;
				}
				echo base64_encode("1|".$id."|".$nama."|".$ic);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$icon = trim(str_replace("'","''",$this->input->post("icon")));
			$operasi = $this->Mme776->tambah($id, $nama, $icon);
			if($operasi == "1"){
				$ket = "ID Menu: $id,\nNama Menu: $nama,\nIcon Menu: $icon";
				$this->Mlog->log_history("Menu","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$nama = trim(str_replace("'","''",$this->input->post("nama")));
			$icon = trim(str_replace("'","''",$this->input->post("icon")));
			$operasi = $this->Mme776->update($id, $nama, $icon);
			if($operasi == "1"){
				$ket = "ID Menu: $id,\nNama Menu: $nama,\nIcon Menu: $icon";
				$this->Mlog->log_history("Menu","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mme776->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mme776->filter($id);
					$operasi = $this->Mme776->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$nama = $k->nama;
							$icon = $k->icon;
						}
						$ket = "ID Menu: $id,\nNama Menu: $nama,\nIcon Menu: $icon";
						$this->Mlog->log_history("Menu","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}
