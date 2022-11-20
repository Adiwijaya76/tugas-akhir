<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
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

	public function apiCURL($url, $data){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT,30);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($curl, CURLOPT_HTTPHEADER,'Content-Type: application/x-www-form-urlencoded');
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	public function index(){
		$data["fill"] = "b416k";
		$this->load->view('basis', $data);
	}

	public function whatsapp(){
		$data["dtgrup"] = $this->Mgr780->data();
		$data["fill"] = "wa861v";
		$this->load->view('basis', $data);
	}

	public function broadcast(){
		$data["fill"] = "bc557";
		$this->load->view('basis', $data);
	}

	public function qrcodewa(){
		$data["fill"] = "qr812";
		$this->load->view('basis', $data);
	}

	public function kirimpesan(){
		$telp = trim($this->input->post("telp"));
		$isi = trim($this->input->post("isi"));
		$url = apiruangWA.'send_message';
		$data = array('token' => tokenwa, 'number' => $telp, 'message' => $isi.str_replace("||","\n",footerpesan));
		$hasil = $this->apiCURL($url, $data);
        $x = json_decode($hasil, true);
        if($x["result"] == true){
            echo base64_encode("1|".$x["message"]);
        }else{
            echo base64_encode("0|".$x["message"]);
        }
	}

	public function kirimbroadcast(){
		$dt = $this->Mdata->databroadcast("1");
		if(is_array($dt)){
			if(count($dt)>0){
				foreach($dt as $k){
					$telp = $k->No_Telp;
					$isi = $k->Isi;
					$nama = $k->Nama;
					$url = apiruangWA.'send_message';
					$data = array('token' => tokenwa, 'number' => $telp, 'message' => str_replace("||","\n",$isi).str_replace("||","\n",footerpesan));
					$hasil = $this->apiCURL($url, $data);
					$x = json_decode($hasil, true);
					// if($x["result"] == true){
						$this->Mdata->hapuspenerimabroadcast($telp);
					// }
					echo base64_encode("1|".$nama."|".$telp);
				}
			}else{
				echo base64_encode("0|Proses Broadcast Selesai di Lakukan");
			}
		}else{
			echo base64_encode("0|Proses Broadcast Selesai di Lakukan");
		}
	}

	public function databroadcast(){
		$idakun = "(".trim($this->input->post("idakun")).")";
		$isi = trim(str_replace("'","`",$this->input->post("isi")));
        $dt = $this->Mdata->persiapanbroadcast($idakun);
		$jml = 0;
        foreach ($dt as $k){
            $telp = $k->No_Telp;
            $nama = trim(str_replace("'","`",$k->Nama_Lengkap));
			$hasil = $this->Mdata->tambahpenerimabroadcast($telp, $nama, $isi);
			if($hasil == "1"){
				$jml++;
			}
        }
		echo base64_encode($jml);
	}

	public function hapusbroadcast(){
		$dt = $this->Mdata->hapusbroadcast();
		echo base64_encode($dt);
	}

	function infoalat(){
		$url = apiruangWA.'device';
		$data = array('token' => tokenwa);
		$hasil = $this->apiCURL($url, $data);
        $x = json_decode($hasil, true);
        if($x["result"] == "true"){
            echo base64_encode("1|".$x["message"]."|".$x["id"]."|".$x["name"]."|".$x["phoneNumber"]."|".$x["manufacturer"]."|".$x["model"]."|".$x["os_version"]);
        }else{
            echo base64_encode("0|".$x["message"]);
        }
    }

	function infoakun(){
		$url = apiruangWA.'info';
		$data = array('token' => tokenwa, 'username' => usernamewa);
		$hasil = $this->apiCURL($url, $data);
        $x = json_decode($hasil, true);
        if($x["result"] == true){
            echo base64_encode("1|".$x["message"]."|".$x["nama"]."|".number_format($x["balance"],0,",",".")."|".$x["token"]["id"]."|".$x["token"]["sender"]."|".$x["token"]["paket"]."|".tgl_indo_lengkap2($x["token"]["expired"]));
        }else{
            echo base64_encode("0|Gagal Deteksi");
        }
    }

    function ambilqrcode(){
		$url = apiruangWA.'qrcode';
		$data = array('token' => tokenwa);
		$hasil = $this->apiCURL($url, $data);
        $x = json_decode($hasil, true);
        if($x["status"] == true){
            echo base64_encode("1|".$x["qrcode"]);
        }else{
            echo base64_encode("0|");
        }
    }

	// function restartalat(){
	// 	$url = apiruangWA.'restart.php';
	// 	$data = array('token' => tokenwa);
	// 	$hasil = $this->apiCURL($url, $data);
    //     $x = json_decode($hasil, true);
    //     if($x["result"] == true){
    //         echo base64_encode("1");
    //     }else{
    //         echo base64_encode("0");
    //     }
    // }

	// function deletesesi(){
	// 	$url = apiruangWA.'del-session.php';
	// 	$data = array('token' => tokenwa);
	// 	$hasil = $this->apiCURL($url, $data);
    //     $x = json_decode($hasil, true);
    //     if($x["result"] == true){
    //         echo base64_encode("1");
    //     }else{
    //         echo base64_encode("0");
    //     }
    // }

	public function jsonbroadcast(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mdata->databroadcast("0");
        foreach ($dt as $k){
            $telp = $k->No_Telp;
            $nama = $k->Nama;
			$isi = $k->Isi;
			$tomboledit = "<button class='btn btn-icon btn-round btn-primary' data-telp='".$telp."' data-isi='".$isi."' onclick='kirimulang(this)'><i class='icon wb-envelope'></i></button>";
            $dtisi .= '["'.$tomboledit.'","'.$nama.'","'.$telp.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

    public function logout(){
        $this->session->unset_userdata(sesi);
        if($this->session->userdata(sesi) == NULL){echo base64_encode("1");}
        else{echo base64_encode("0");}
    }

    public function gantipassword(){
		$ayy = dekripsi($this->encryption->decrypt(base64_decode($this->session->userdata(sesi))));
		$dtl = explode("|", $ayy);
		$id = $dtl[0];
		$lama = md5(base64_encode(enkripsi(trim($this->input->post("lama")))));
		$baru = md5(base64_encode(enkripsi(trim($this->input->post("baru")))));
		$td = $this->Mlogin->login($id, $lama);
		if(is_array($td)){
			if(count($td) > 0){
				$operasi = $this->Mlogin->update_password($id, $baru);
				if($operasi == "1"){
					$ket = "ID: $id Mengganti Passwordnya";
					$this->Mlog->log_history("Akun","Ganti Password",$ket);
				}
				echo base64_encode($operasi);
			}else{echo base64_encode("90");}
		}else{echo base64_encode("90");}
	}
}
