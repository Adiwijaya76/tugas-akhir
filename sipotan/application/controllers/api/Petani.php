<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
class Petani extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function getpropinsi(){
		$dtx=$this->Mpetani->getpropinsi();
        echo json_encode($dtx);
	}

    public function getkabupaten(){
        $idprop = $this->uri->segment(4);
		$dt=$this->Mpetani->getkabupaten($idprop);
        echo json_encode($dt);
	}

    public function getkecamatan()
	{
        $idkab = $this->uri->segment(4);
		$dt=$this->Mpetani->getkecamatan($idkab);
        echo json_encode($dt);
	}


    public function getdesa(){
        $idkec = $this->uri->segment(4);
		$dt=$this->Mpetani->getdesa($idkec);
        echo json_encode($dt);
	}

    public function cari(){
        $id= $this->uri->segment(4);
        $dt=$this->Mpetani->cari($id);
        echo json_encode($dt);
	}
}