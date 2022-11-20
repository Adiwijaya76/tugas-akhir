<?php
header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: GET, OPTIONS');
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
      	$id = $this->input->get('id');
		
            $this->db->select('*');
            $this->db->from('akses');
            $this->db->where('akses.id' ,$id);
			$user = $this->db->get();

        if ($user) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
				'data' => $user->row()
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak tersedia'
            ]);
        }
    }
}
