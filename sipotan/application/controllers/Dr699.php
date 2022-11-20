<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dr699 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		$idformini = "dr699";
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
		$data["fill"] = "dr699v";
		$data["dtlevel"] = $this->Mle409->data();
		$data["dtform"] = $this->Mfo110->data();
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function json(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mdr699->data();
        foreach ($dt as $k){
            $id = $k->id;
            $level = $k->level;
			$form = $k->form;
			if($k->akses_tambah == "1"){$atambah = "Ya";}else{$atambah = "Tidak";}
			if($k->akses_update == "1"){$aedit = "Ya";}else{$aedit = "Tidak";}
			if($k->akses_hapus == "1"){$ahapus = "Ya";}else{$ahapus = "Tidak";}
			if($k->akses_cetak == "1"){$acetak = "Ya";}else{$acetak = "Tidak";}
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-id='".$id."' onclick='filter(this)'><i class='icon wb-pencil'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$id.'","'.$level.'","'.$form.'","'.$atambah.'","'.$aedit.'","'.$ahapus.'","'.$acetak.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mdr699->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$level = $k->id_level;
					$form = $k->id_form;
					$atambah = $k->akses_tambah;
					$aupdate = $k->akses_update;
					$ahapus = $k->akses_hapus;
					$acetak = $k->akses_cetak;
				}
				echo base64_encode("1|".$id."|".$level."|".$form."|".$atambah."|".$aupdate."|".$ahapus."|".$acetak);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$level = trim(str_replace("'","''",$this->input->post("level")));
			$form = trim(str_replace("'","''",$this->input->post("form")));
			$atambah = trim(str_replace("'","''",$this->input->post("atambah")));
			$aupdate = trim(str_replace("'","''",$this->input->post("aupdate")));
			$ahapus = trim(str_replace("'","''",$this->input->post("ahapus")));
			$acetak = trim(str_replace("'","''",$this->input->post("acetak")));
			$operasi = $this->Mdr699->tambah($level, $form, $atambah, $aupdate, $ahapus, $acetak);
			if($operasi == "1"){
				$ket = "ID Level: $level,\nID Form: $form,\nAkses Tambah: $atambah,\nAkses Update: $aupdate,\nAkses Hapus: $ahapus,\nAkses Cetak: $acetak";
				$this->Mlog->log_history("Form Level","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$level = trim(str_replace("'","''",$this->input->post("level")));
			$form = trim(str_replace("'","''",$this->input->post("form")));
			$atambah = trim(str_replace("'","''",$this->input->post("atambah")));
			$aupdate = trim(str_replace("'","''",$this->input->post("aupdate")));
			$ahapus = trim(str_replace("'","''",$this->input->post("ahapus")));
			$acetak = trim(str_replace("'","''",$this->input->post("acetak")));
			$operasi = $this->Mdr699->update($id, $level, $form, $atambah, $aupdate, $ahapus, $acetak);
			if($operasi == "1"){
				$ket = "ID: $id,\nID Level: $level,\nID Form: $form,\nAkses Tambah: $atambah,\nAkses Update: $aupdate,\nAkses Hapus: $ahapus,\nAkses Cetak: $acetak";
				$this->Mlog->log_history("Form Level","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","''",$this->input->post("id")));
			$dt = $this->Mdr699->filter($id);
			$operasi = $this->Mdr699->hapus($id);
			if($operasi == "1"){
				foreach ($dt as $k){
					$id = $k->id;
					$level = $k->id_level;
					$form = $k->id_form;
					$atambah = $k->akses_tambah;
					$aupdate = $k->akses_update;
					$ahapus = $k->akses_hapus;
					$acetak = $k->akses_cetak;
				}
				$ket = "ID: $id,\nID Level: $level,\nID Form: $form,\nAkses Tambah: $atambah,\nAkses Update: $aupdate,\nAkses Hapus: $ahapus,\nAkses Cetak: $acetak";
				$this->Mlog->log_history("Form Level","Hapus",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}
}
