<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
class Mpetani extends CI_Model {

    public function getpropinsi(){
        $sql ="SELECT * FROM propinsi";
        $querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
    }

    public function getkabupaten($idprop){
        $sql ="SELECT * FROM kabupaten WHERE id_propinsi='$idprop'";
        $querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
    }

    public function getkecamatan($idkab){
        $sql ="SELECT * FROM kecamatan WHERE id_kabupaten='$idkab'";
        $querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
    }

    public function getdesa($idkec){
        $sql ="SELECT * FROM desa WHERE id_kecamatan='$idkec'";
        $querySQL = $this->db->query($sql);
		if($querySQL){return $querySQL->result();}
		else{return 0;}
    }

    public function cari($id){
      //$sql ="SELECT a.*, b.nama, b.alamat from lahan AS a left join petani AS b on a.nik = b.nik where b.nama LIKE '%$n%' OR a.nik LIKE '%$n%' OR a.nop LIKE '%$n%' OR b.alamat LIKE '%$n%'";
      $sql ="SELECT nik, nama, alamat FROM petani where id_desa='$id'";
      $querySQL = $this->db->query($sql);
		if($querySQL)
    {return $querySQL->result();}
		else{return 0;}
    }



}