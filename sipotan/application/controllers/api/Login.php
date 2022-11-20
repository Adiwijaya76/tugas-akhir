<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->database();
    }

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Form harus diisi.'
            ]);
        }else{
            $username = $this->input->post('username', TRUE);
            $password = md5($this->input->post('password', TRUE));

            $this->db->select('*');
            $this->db->from('akses');
            $this->db->where('akses.username', $username);
            $this->db->where('akses.password', $password);

            $data = $this->db->get();
            if ($data->num_rows() > 0) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'data' => $data->row()
                ]);
            }else{
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' =>'Password salah'
                ]);
            }
        }
	}

}