<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pagesystem extends CI_Controller {
    function __construct() {
        parent::__construct();
        $data["datalogin"] = $this->Mlogin->cek_login();
        if(is_array($data["datalogin"])){
            if(count($data["datalogin"])>0){
                $this->load->view('b416k', $data, true);
            }else{
                redirect(base_url('Login'));
            }
        }else{redirect(base_url('Login'));}
    }

	public function index(){
		$this->output->set_status_header('404');
		$this->load->view('pg404v');
	}
}
