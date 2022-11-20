<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');


class Petani2 extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->database();
    }

    public function index(){
        $this->db->select('
           lahan.nop,
           petani.nik,
           
           monitoring_unsur_hara.nop

        ',);
        $this->db->from('lahan ');
        $this->db->join('monitoring_unsur_hara', 'lahan.nop = monitoring_unsur_hara.nop');
        $this->db->join('petani', 'lahan.nik = petani.nik');
        //$this->db->order_by("id", "desc");
        $data = $this->db->get();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $data->result()
            ]);
        }else{
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Email atau Password salah'
            ]);
        }
    }
}
