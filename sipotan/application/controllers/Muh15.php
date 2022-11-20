<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Muh15 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "muh15";
		$this->load->model('Mmuh15');
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
		$data["rencana_pola_tanam"] = $this->Mdata->rpt();
		$data["unsur_hara"] = $this->Mdata->unsur_hara();
		$data["fill"] = "muh15v";
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mmuh15->data();
        foreach ($dt as $k){
            $id 			= $k->id;
            $rpt 			= $k->masa_tanam;
            $uh 			= $k->nama_unsur_hara;
            $vari 			= $k->nama_varietas;
            $nilai			= $k->nilai;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$rpt.'","'.$uh.'","'.$vari.'","'.$nilai.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mmuh15->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id 					= $k->id;
					$id_rencana_pola_tanam  = $k->id_rencana_pola_tanam;
					$id_unsur_hara 			= $k->id_unsur_hara;
					$nilai 					= $k->nilai;
				}
				echo base64_encode("1|".$id."|".$id_rencana_pola_tanam."|".$id_unsur_hara."|".$nilai);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id 					= trim(str_replace("'","''",$this->input->post("id")));
			$id_rencana_pola_tanam  = trim(str_replace("'","''",$this->input->post("id_rencana_pola_tanam")));
			$id_unsur_hara 			= trim(str_replace("'","''",$this->input->post("id_unsur_hara")));
			$nilai 					= trim(str_replace("'","''",$this->input->post("nilai")));
			$operasi = $this->Mmuh15->tambah($id, $id_rencana_pola_tanam, $id_unsur_hara, 
			$nilai);
			if($operasi == "1"){
				$ket = "ID Monitoring Unsur Hara: $id,\n id_recana_pola_tanam Monitoring Unsur Hara: $id";
				$this->Mlog->log_history("Monitoring Unsur Hara","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id 	   = trim(str_replace("'","''",$this->input->post("id")));
			$rpt 		= trim(str_replace("'","''",$this->input->post("id_rpt")));
			$uh 		   = trim(str_replace("'","''",$this->input->post("id_uh")));
			$nilai 				   = trim(str_replace("'","''",$this->input->post("nilai")));
			$operasi = $this->Mmuh15->update($id, $rpt, $uh, $nilai);
			if($operasi == "1"){
				$ket = "ID Monitoring Unsur Hara: $id,\n id_recana_pola_tanam Monitoring Unsur Hara: $id";
				$this->Mlog->log_history("Monitoring Unsur Hara","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$td = $this->Mmuh15->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mmuh15->filter($id);
					$operasi = $this->Mmuh15->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id 	= $k->id;
							$nilai 	= $k->nilai;
						}
						$ket = "ID Monitoring Unsur Hara: $id,\nid_recana_pola_tanam Monitoring Unsur Hara: $id";
						$this->Mlog->log_history("Monitoring Unsur Hara","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}
}