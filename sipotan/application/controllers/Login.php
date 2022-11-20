<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    function __construct() {
        parent::__construct();
        $datalogin = $this->Mlogin->cek_login();
        if(is_array($datalogin)){
            if(count($datalogin)>0){
                redirect(base_url('Dashboard'));
            }
        }
    }

    public function index(){
        $this->load->view("v671r");
    }

    public function login(){
        $u = $this->input->post("u");
		$p = md5(base64_encode(enkripsi($this->input->post("p"))));
		$stlogin = $this->Mlogin->login($u, $p);
		if(count($stlogin) > 0){
			foreach ($stlogin as $sl){
        		$id = $sl->id;
                $pas = $sl->password;
        	}
        	$data_session = base64_encode($this->encryption->encrypt(enkripsi($id."|".$pas)));
            $this->session->set_userdata(sesi, $data_session);
            $this->Mlog->log_history("Akses","Login","Login Berhasil");
            echo base64_encode("1");
		}else{
            echo base64_encode("0");
		}
    }

    public function logout(){
        $this->session->unset_userdata(sesi);
        if($this->session->userdata(sesi) == NULL){
            $this->session->set_flashdata("pesan_ops","Berhasil|Logout Berhasil di Lakukan|success");
            echo base64_encode("1");
        }
        else{echo base64_encode("0");}
    }

    // public function pass(){
    //     echo md5(base64_encode(enkripsi("admin")));
    // }
}
