<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->load->database();
    }

	public function index()
	{
		$this->db->select('
            monitoring_unsur_hara.id, 
            monitoring_unsur_hara.nilai, 
            petani.nama,
            petani.alamat,
            lahan.luas_ha,
            lahan.nop');
        $this->db->from('monitoring_unsur_hara');
        $this->db->join('lahan', 'monitoring_unsur_hara.nop = lahan.nop', 'left');
        $this->db->join('petani', 'lahan.nik = petani.nik');
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

    public function tambah()
    {
        $this->form_validation->set_rules('nop', 'Nop', 'required');
        $this->form_validation->set_rules('id_rencana_pola_tanam', 'Id_rencana_pola_tanam', 'required');
        $this->form_validation->set_rules('id_unsur_hara', 'Id_unsur_hara', 'required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('id_buat', 'Id_buat', 'required');
        $this->form_validation->set_rules('id_update', 'Id_update', 'required');

        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Form harus diisi.'
            ]);
        }else{
            $data = [
                'id' => (int)preg_replace('/Y-m-d H:m:s/', '$3$1$2', time()),
                'nop' => $this->input->post('nop', TRUE),
                'id_rencana_pola_tanam' => $this->input->post('id_rencana_pola_tanam', TRUE),
                'id_unsur_hara' => $this->input->post('id_unsur_hara', TRUE),
                'nilai' => $this->input->post('nilai', TRUE),
                'tgl_buat' => date('Y-m-d H:m:s'),   
                'tgl_update' => date('Y-m-d H:m:s'),
                'id_buat' => $this->input->post('id_buat', TRUE),
                'id_update' => $this->input->post('id_update', TRUE),
            ]; 
            $insert = $this->db->insert('monitoring_unsur_hara', $data);
            if ($insert) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sukses tambah data'
                ]);
            }else{
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal tambah data'
                ]);
            }
        }
    }

    public function detail()
    {
        $id = $this->input->get('id');
        $this->db->select('
            monitoring_unsur_hara.id, 
            monitoring_unsur_hara.nilai, 
            petani.nama,
            petani.alamat,
            lahan.luas_ha,
            lahan.nop,');
        $this->db->from('monitoring_unsur_hara');
        $this->db->join('lahan', 'monitoring_unsur_hara.nop = lahan.nop', 'left');
        $this->db->join('petani', 'lahan.nik = petani.nik');

        $this->db->where('monitoring_unsur_hara.id', $id);
        $data = $this->db->get();
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'data' => $data->row(),
                'id' => $this->input->get('id')
            ]);
        }else{
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak tersedia'
            ]);
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        $this->form_validation->set_rules('id_update', 'Id_update', 'required');

        if ($this->form_validation->run() == FALSE) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Form harus diisi.'
            ]);
        }else{
            $data = [
                'nilai' => $this->input->post('nilai', TRUE),
                'tgl_update' => date('Y-m-d H:m:s'),
                'id_update' => $this->input->post('id_update', TRUE),
            ]; 
            $this->db->where('id', $this->input->post('id'));
            $update = $this->db->update('monitoring_unsur_hara', $data);
            if ($update) {
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sukses update data'
                ]);
            }else{
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal update data'
                ]);
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $data = $this->db->delete('monitoring_unsur_hara');
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        }else{
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Data gagal dihapus'
            ]);
        }
    }

}



