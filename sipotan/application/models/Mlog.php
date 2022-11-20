<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mlog extends CI_Model {
	public function log_history($data, $operasi, $keterangan){
		$ayy = dekripsi($this->encryption->decrypt(base64_decode($this->session->userdata(sesi))));
		$dtl = explode("|", $ayy);
		$id = $dtl[0];
		$sql = "INSERT INTO log_history VALUES((SELECT UNIX_TIMESTAMP(NOW(6)))*1000000,'$data','$operasi','$keterangan','$id',(SELECT NOW()))";
		$this->db->query($sql);	
	}
}