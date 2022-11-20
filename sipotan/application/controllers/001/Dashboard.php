<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public $idsc = "001";
	function __construct() {
		parent::__construct();
		$data["datalogin"] = $this->Mlogin->cek_login();
        if(is_array($data["datalogin"])){
			$idsistem = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem, $dl->id_sistem);
			}
			if(array_search($this->idsc, $idsistem) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($this->idsc, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($this->idsc, $idlevel);
			$data["ids"] = $this->idsc;
        	$this->load->view($this->idsc.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$data["dtsistem"] = $this->Mdata->jumlahsistem();
		$data["dtform"] = $this->Mdata->jumlahform();
		$data["dtakun"] = $this->Mdata->jumlahakun();
		$data["fill"] = "d500";
		$this->load->view($this->idsc.'/basis', $data);
	}
}
