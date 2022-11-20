<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tb277 extends CI_Controller {
	public $idsc;
	public $aksesc = array();
	function __construct() {
		parent::__construct();
		include APPPATH."libraries\SimpleXLSXGen.php";
		$idformini = "tb277";
		$data["datalogin"] = $this->Mlogin->cek_login();
		$dataform = $this->Mlogin->cek_sistem($idformini);
        if(is_array($data["datalogin"])){
			foreach($dataform as $cx){
				$idsistem_sistem = $cx->id_sistem;
			}
			$idsistem_user = array();
         	foreach ($data["datalogin"] as $dl){
				$idlevel = $dl->id_level;
				array_push($idsistem_user, $dl->id_sistem);
			}
			if(array_search($idsistem_sistem, $idsistem_user) !== false){}else{redirect(base_url());}
			$data["datamenu"] = $this->Mlogin->cek_menu($idsistem_sistem, $idlevel);
			$data["dataform"] = $this->Mlogin->cek_form($idsistem_sistem, $idlevel);
			$data["ids"] = $idsistem_sistem;
			$data["idf"] = $idformini;
			$this->idsc = $idsistem_sistem;
			$idform = array(); $akses = array();
			foreach ($data["dataform"] as $dx){
				array_push($idform, $dx->id_form);
				if($dx->id_form == $idformini){array_push($akses, $dx->akses_tambah, $dx->akses_update, $dx->akses_hapus, $dx->akses_cetak);}
			}
			if(array_search($idformini, $idform) !== false){
				$data["akses"] = $akses;
				$this->aksesc = $akses; 
			}else{redirect(base_url());}
        	$this->load->view($idsistem_sistem.'/basis', $data, true);
        }else{redirect(base_url());}
    }

	public function index(){
		$this->session->set_userdata("filtertglsm", array(date("Y-m-d"), date("Y-m-d")));
		$this->session->set_userdata("filterdocsm", "xxxxx");
		$data["fill"] = "tb277v";
		$this->load->view($this->idsc.'/basis', $data);
	}

	public function nootomatis(){
		$dtno = $this->Mtb277->nootomatis();
		if(is_array($dtno)){
			if(count($dtno)>0){
				foreach($dtno as $k){
					$not = $k->no_register;
					$noo = $not + 1;
				}
			}else{$noo = "1";}
		}else{$noo = "1";}
		echo base64_encode($noo);
	}

	public function setfilter(){
		$tgl1 = trim(str_replace("'","`",$this->input->post("tgl1")));
		$tgl2 = trim(str_replace("'","`",$this->input->post("tgl2")));
		$this->session->set_userdata("filtertglsm", array($tgl1, $tgl2));
	}

	public function json(){
		if($this->session->userdata("filtertglsm") == NULL){
			$filter1 = date("Y-m-d");
			$filter2 = date("Y-m-d");
		}else{
			$filter1 = $this->session->userdata("filtertglsm")[0];
			$filter2 = $this->session->userdata("filtertglsm")[1];
		}
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mtb277->data($filter1, $filter2);
        foreach ($dt as $k){
            $id = $k->id;
			$reg = $k->no_register;
            $no = $k->no_surat;
			$pengirim = $k->pengirim;
			$tglsurat = $k->tgl_surat;
			$perihal = $k->perihal;
			$tglterima = $k->tgl_terima;
			$diteruskan = $k->diteruskan_kepada;
			$disposisi = $k->disposisi;
			$keterangan = $k->keterangan;
			$jml = $k->jumlah_doc;
			if($this->aksesc[1] == "1"){
				$tomboledit = "<a class='dropdown-item' href='javascript:void(0)' data-id='".$id."' onclick='filter(this)' role='menuitem' style='text-decoration: none'>Edit Data</a>";
			}else{$tomboledit = "";}
			if($this->aksesc[3] == "1"){
				$tombolcetak = "<a class='dropdown-item' href='javascript:void(0)' data-id='".$id."' onclick='cetakdisposisi(this)' role='menuitem' style='text-decoration: none'>Cetak Disposisi</a>";
			}else{$tombolcetak = "";}
			if($this->aksesc[0] == "1"){
				$tomboltambahdoc = "<a class='dropdown-item' href='javascript:void(0)' data-id='".$id."' onclick='setid(this)' role='menuitem' style='text-decoration: none' data-target='#modaldokumen' data-toggle='modal' >Kelola Dokumen</a>";
			}else{$tomboltambahdoc = "";}
			$tombol = "<div class='btn-group' role='group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='icon wb-pencil' aria-hidden='true'></i> Kelola </button><div class='dropdown-menu' role='menu'>".$tomboledit.$tombolcetak.$tomboltambahdoc."</div></div>";
			$isi = "<b>No Register:</b> $reg<br><b>No Surat:</b> $no<br><b>Tanggal:</b> ".tgl_indo_lengkap($tglsurat)."<br><b>Perihal:</b> $perihal<br><b>Pengirim:</b> $pengirim<br><b>Jumlah Dokumen:</b> $jml";
			$tindaklanjut = "<b>Tanggal Terima:</b> ".tgl_indo_lengkap($tglterima)."<br><b>Disposisi Kepada:</b> $diteruskan<br><b>Isi Disposisi:</b> $disposisi<br><b>Keterangan:</b> $keterangan";
            $dtisi .= '["'.$tombol.'","'.$isi.'","'.$tindaklanjut.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function filter(){
		$id = trim($this->input->post("id"));
		$dt = $this->Mtb277->filter($id);
		if(is_array($dt)){
			if(count($dt) > 0){
				foreach ($dt as $k){
					$id = $k->id;
					$reg = $k->no_register;
					$no = $k->no_surat;
					$pengirim = $k->pengirim;
					$tglsurat = $k->tgl_surat;
					$perihal = $k->perihal;
					$tglterima = $k->tgl_terima;
					$diteruskan = $k->diteruskan_kepada;
					$disposisi = $k->disposisi;
					$keterangan = $k->keterangan;
				}
				echo base64_encode("1|".$id."|".$reg."|".$no."|".$pengirim."|".$tglsurat."|".$perihal."|".$tglterima."|".$diteruskan."|".$disposisi."|".$keterangan);
			}else{echo base64_encode("0|");}
		}else{echo base64_encode("0|");}
	}
	
	public function tambah(){
		if($this->aksesc[0] == "1"){
			$id = round(microtime(true) * 1000);
			$reg = trim(str_replace("'","`",$this->input->post("reg")));
			$no = trim(str_replace("'","`",$this->input->post("no")));
			$tglsurat = trim(str_replace("'","`",$this->input->post("tglsurat")));
			$pengirim = trim(str_replace("'","`",$this->input->post("pengirim")));
			$tglterima = trim(str_replace("'","`",$this->input->post("tglterima")));
			$perihal = trim(str_replace("'","`",$this->input->post("perihal")));
			$disposisi = trim(str_replace("'","`",$this->input->post("disposisi")));
			$kepada = trim(str_replace("'","`",$this->input->post("kepada")));
			$keterangan = trim(str_replace("'","`",$this->input->post("keterangan")));
			$operasi = $this->Mtb277->tambah($id, $reg, $no, $tglsurat, $pengirim, $tglterima, $perihal, $disposisi, $kepada, $keterangan);
			if($operasi == "1"){
				$ket = "ID: $id,\No Register: $reg,\nNo Surat: $no,\nTgl Surat: $tglsurat,\nPengirim: $pengirim,\nTgl Terima: $tglterima,\nPerihal: $perihal,\nDisposisi: $disposisi,\nDiteruskan Kepada: $kepada,\nKeterangan: $keterangan";
				$this->Mlog->log_history("Surat Masuk","Tambah",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function update(){
		if($this->aksesc[1] == "1"){
			$id = trim(str_replace("'","`",$this->input->post("id")));
			$reg = trim(str_replace("'","`",$this->input->post("reg")));
			$no = trim(str_replace("'","`",$this->input->post("no")));
			$tglsurat = trim(str_replace("'","`",$this->input->post("tglsurat")));
			$pengirim = trim(str_replace("'","`",$this->input->post("pengirim")));
			$tglterima = trim(str_replace("'","`",$this->input->post("tglterima")));
			$perihal = trim(str_replace("'","`",$this->input->post("perihal")));
			$disposisi = trim(str_replace("'","`",$this->input->post("disposisi")));
			$kepada = trim(str_replace("'","`",$this->input->post("kepada")));
			$keterangan = trim(str_replace("'","`",$this->input->post("keterangan")));
			$operasi = $this->Mtb277->update($id, $reg, $no, $tglsurat, $pengirim, $tglterima, $perihal, $disposisi, $kepada, $keterangan);
			if($operasi == "1"){
				$ket = "ID: $id,\No Register: $reg,\nNo Surat: $no,\nTgl Surat: $tglsurat,\nPengirim: $pengirim,\nTgl Terima: $tglterima,\nPerihal: $perihal,\nDisposisi: $disposisi,\nDiteruskan Kepada: $kepada,\nKeterangan: $keterangan";
				$this->Mlog->log_history("Surat Masuk","Update",$ket);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function hapus(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","`",$this->input->post("id")));
			$td = $this->Mtb277->cekform($id);
			if(is_array($td)){
				if(count($td) > 0){echo base64_encode("90");}
				else{
					$dt = $this->Mtb277->filter($id);
					$operasi = $this->Mtb277->hapus($id);
					if($operasi == "1"){
						foreach ($dt as $k){
							$id = $k->id;
							$reg = $k->no_register;
							$no = $k->no_surat;
							$pengirim = $k->pengirim;
							$tglsurat = $k->tgl_surat;
							$perihal = $k->perihal;
							$tglterima = $k->tgl_terima;
							$kepada = $k->diteruskan_kepada;
							$disposisi = $k->disposisi;
							$keterangan = $k->keterangan;
						}
						$ket = "ID: $id,\No Register: $reg,\nNo Surat: $no,\nTgl Surat: $tglsurat,\nPengirim: $pengirim,\nTgl Terima: $tglterima,\nPerihal: $perihal,\nDisposisi: $disposisi,\nDiteruskan Kepada: $kepada,\nKeterangan: $keterangan";
						$this->Mlog->log_history("Surat Masuk","Hapus",$ket);
					}
					echo base64_encode($operasi);
				}
			}else{echo base64_encode("80");}
		}else{echo base64_encode("99");}
	}

	public function uploaddoc(){
		if(isset($_FILES["file"]["name"])){
			$idsm = $_POST["idfile"];
			$filename = $_POST["namafile"];
			$location = "arsip/suratmasuk/".$filename;
			$extensi = pathinfo($location, PATHINFO_EXTENSION);
			$extensi = strtolower($extensi);
			$extvalid = array("pdf","doc","docx","jpg","png","jpeg","bmp");
			$response = 0;
			if(in_array($extensi, $extvalid)){
				if(move_uploaded_file($_FILES["file"]["tmp_name"],$location)){
					$id = round(microtime(true) * 1000);
					$this->Mtb277->tambahdoc($id, $idsm, $filename);
					$response = 1;
				}
			}else{
				$response = 2;
			}
			echo $response;
			exit;
		}
	}

	public function setfilterdoc(){
		$id = trim(str_replace("'","`",$this->input->post("id")));
		$this->session->set_userdata("filterdocsm", $id);
	}

	public function jsondoc(){
		if($this->session->userdata("filterdocsm") == NULL){
			$filter = "xxxxx";
		}else{
			$filter = $this->session->userdata("filterdocsm");
		}
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mtb277->datadoc($filter);
        foreach ($dt as $k){
            $id = $k->id;
            $idsurat = $k->id_surat;
			$namafile = $k->nama_file;
			if($this->aksesc[2] == "1"){
				$tombolhapus = "<a class='dropdown-item' href='javascript:void(0)' data-id='".$id."' onclick='hapusdoc(this)' role='menuitem' style='text-decoration: none'>Hapus Dokumen</a>";
			}else{$tombolhapus = "";}
			if($this->aksesc[2] == "1"){
				$tombollihat = "<a class='dropdown-item' href='javascript:void(0)' data-nama='".$namafile."' onclick='cetakdoc(this)' role='menuitem' style='text-decoration: none'>Lihat Dokumen</a>";
			}else{$tombollihat = "";}
			$tombol = "<div class='btn-group' role='group'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-expanded='false'><i class='icon wb-pencil' aria-hidden='true'></i> Kelola </button><div class='dropdown-menu' role='menu'>".$tombolhapus.$tombollihat."</div></div>";
            $dtisi .= '["'.$tombol.'","'.$namafile.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
	}

	public function hapusdoc(){
		if($this->aksesc[2] == "1"){
			$id = trim(str_replace("'","`",$this->input->post("id")));
			$dt = $this->Mtb277->filterdoc($id);
			$operasi = $this->Mtb277->hapusdoc($id);
			if($operasi == "1"){
				foreach ($dt as $k){
					$id = $k->id;
					$idsurat = $k->id_surat;
					$namafile = $k->nama_file;
				}
				$ket = "ID: $id,\nID Surat: $idsurat,\nNama File: $namafile";
				$this->Mlog->log_history("Dokumen Surat Masuk","Hapus",$ket);
				unlink("arsip/suratmasuk/".$namafile);
			}
			echo base64_encode($operasi);
		}else{echo base64_encode("99");}
	}

	public function cetakpdf(){
		if($this->aksesc[3] == "1"){
			$key = base64_decode($this->uri->segment(3,0));
			$arr = explode("|", $key);
			$data["rekap"] = $this->Mtb277->data($arr[0], $arr[1]);
			$data["tgl1"] = $arr[0];
			$data["tgl2"] = $arr[1];
			$datacetak = $this->load->view("tb277p", $data, true);
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
			$mpdf->setFooter('hal {PAGENO}');
			$mpdf->SetAuthor('Kecamatan Jogoroto');
			$mpdf->WriteHTML($datacetak);
			$mpdf->Output('rekap_surat_masuk.pdf','I');
		}else{redirect(base_url());}
	}

	public function cetakdisposisi(){
		if($this->aksesc[3] == "1"){
			$key = base64_decode($this->uri->segment(3,0));
			$data["dtdpp"] = $this->Mtb277->filter($key);
			$datacetak = $this->load->view("tb277d", $data, true);
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8', 
				'format' => array(210,145),
				'orientation' => 'P',
				'margin_left' => 10,
				'margin_right' => 10,
				'margin_top' => 10
			]);
			$mpdf->SetAuthor('Kecamatan Jogoroto');
			$mpdf->WriteHTML($datacetak);
			$mpdf->Output('disposisi_'.$key.'.pdf','I');
		}else{redirect(base_url());}
	}

	public function cetakexcel(){
		if($this->aksesc[3] == "1"){
			$key = base64_decode($this->uri->segment(3,0));
			$arr = explode("|", $key);
			$rekap = $this->Mtb277->data($arr[0], $arr[1]);
			$dtjson = [];
			array_push($dtjson, ["Dari Tanggal ",": ".tgl_indo_lengkap($arr[0])], ["Sampai Tanggal ",": ".tgl_indo_lengkap($arr[1])]);
			array_push($dtjson, ["Kecamatan",": Jogoroto"], ["Kabupaten",": Jombang"]);
			array_push($dtjson, [""]);
			array_push($dtjson, ["<b><center>Urut</center></b>", "<b>No Surat</b>", "<b><center>Tanggal Surat</center></b>", "<b>Pengirim</b>", "<b>Hal</b>", "<b><center>Tanggal Terima</center></b>", "<b>Disposisi</b>"]);
			if(is_array($rekap)){
				if(count($rekap)>0){
					$urut = 0;
					foreach($rekap as $k){
						$urut++;
						$nosurat = $k->no_surat;
						$pengirim = $k->pengirim;
						$tglsurat = $k->tgl_surat;
						$perihal = $k->perihal;
						$tglterima = $k->tgl_terima;
						$kepada = $k->diteruskan_kepada;
						$disposisi = $k->disposisi;
						$keterangan = $k->keterangan;
						array_push($dtjson, ["<center>$urut</center>", $nosurat, "<center>".tgl_indo_lengkap($tglsurat)."</center>", $pengirim, $perihal, "<center>".tgl_indo_lengkap($tglterima)."</center>", $disposisi]);
					}
				}
			}
			$xlsx = SimpleXLSXGen::fromArray($dtjson);
			$xlsx->downloadAs('rekap_surat_masuk.xlsx');
		}else{redirect(base_url());}
	}
}