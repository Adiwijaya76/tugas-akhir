<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
class PolaTanam extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->database();
    }

	public function list()
	{
        $data = $this->db->get('rencana_pola_tanam')->result();
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}