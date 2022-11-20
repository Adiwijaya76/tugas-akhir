<?php
	$filter1 = $this->session->userdata("filtertglsk")[0];
	$filter2 = $this->session->userdata("filtertglsk")[1];
?>
<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Surat Keluar</h1>
	<div class="page-header-actions">
		<div class="btn-group btn-group-sm" id="withBtnGroup" aria-label="Page Header Actions" role="group">
			<button type="button" class="btn btn-primary">
				<i class="icon <?= $icform; ?>" aria-hidden="true"></i>
				<span class="hidden-sm-down">Kode Form: <?= $idf; ?></span>
			</button>
			<button type="button" class="btn btn-danger" data-toggle="tooltip" data-original-title="Refresh Data" data-container="body" onclick="refreshdata()">
				<i class="icon wb-loop" aria-hidden="true"></i>
			</button>
			
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xxl-7 col-lg-7 col-md-7">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<div class="form-row">
					<div class="form-group col-md-3 jedaobyek">
						<label class="form-control-label">Tanggal Awal*</label>
						<input type="date" class="form-control jedaobyek" id="txttgl1" value="<?= $filter1; ?>">
					</div>
					<div class="form-group col-md-3 jedaobyek">
						<label class="form-control-label">Tanggal Akhir*</label>
						<input type="date" class="form-control jedaobyek" id="txttgl2" value="<?= $filter2; ?>">
					</div>
					<div class="form-group col-md-6 jedaobyek">
						<button type="button" class="btn btn-success" onclick="setfilter()" style="margin-top: 30px;">Cari Data</button>
						<button type="button" class="btn btn-primary" onclick="cetakpdf()" style="margin-top: 30px;">Export PDF</button>
						<button type="button" class="btn btn-primary" onclick="cetakexcel()" style="margin-top: 30px;">Export Excel</button>
					</div>
				</div>
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 20%;">Aksi</th>
							<th style="width: 40%;">Data</th>
							<th style="width: 40%;">Tidak Lanjut</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-5 col-lg-5 col-md-5">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                    <div class="form-group col-md-6">
						<label class="form-control-label">ID Surat Keluar*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" autocomplete="off" readonly>
					</div>
					<div class="form-group col-md-6">
						<label class="form-control-label">Tanggal Surat*</label>
						<input type="date" class="form-control jedaobyek" id="txttglsurat" value="<?= date('Y-m-d'); ?>">
					</div>
					
					<div class="form-group col-md-4 jedaobyek">
						<label class="form-control-label">No Surat*</label>
						<button type="button" class="btn btn-danger btn-sm" id="btnstatus" onclick="setstatus()">Manual</button>
						<input type="text" class="form-control khusus_angka" id="txtnosurat" readonly>
					</div>
					<div class="form-group col-md-4 jedaobyek">
						<label class="form-control-label">Kode Kecamatan*</label>
						<input type="text" class="form-control" id="txtkodekec" value="<?= $kdsurat; ?>" readonly>
					</div>
					<div class="form-group col-md-4 jedaobyek">
						<label class="form-control-label">Tahun Surat*</label>
						<input type="text" class="form-control khusus_angka" id="txtthsurat" value="<?= date("Y"); ?>" maxlength="4">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Kepada*</label>
						<input type="text" class="form-control jedaobyek tokenfield" id="txtkepada" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Isi Surat*</label>
						<textarea class="form-control khusus_abjad2 cegahenter jedaobyek" id="txtperihal" placeholder="Masukkan Isi Surat" autocomplete="off"></textarea>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Pengolah*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtpengolah" placeholder="Masukkan Divisi Pembuat Surat" autocomplete="off">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Jenis Surat*</label>
						<select class="form-control jedaobyek select2" id="cbojenis">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($datajenis)){
									if(count($datajenis)>0){
										foreach($datajenis as $x){
											$kode = $x->kode;
											$namajenis = $x->nama_jenis_surat;
											$gab = $namajenis." (".$kode.")";
											echo "<option value='$kode'>$gab</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Keterangan</label>
						<textarea class="form-control khusus_abjad2 cegahenter jedaobyek" id="txtket" placeholder="Keterangan" autocomplete="off"></textarea>
					</div>
					<div class="form-group col-md-12" id="bloktombol"></div>
                </div>
			</div>
		</div>
	</div>
	<div class="modal fade modal-primary" id="modaldokumen" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Kelola Dokumen</h4>
                </div>
                <div class="modal-body">
					<div class="form-row">
						<input type="hidden" id="txtidsk">
						<input type="file" name="txtfile" id="txtfile" hidden onchange="ambilnamadoc()">
						<div class="form-group col-md-6 jedaobyek">
							<label class="form-control-label">Nama File*</label>
							<input type="text" class="form-control jedaobyek" id="txtnamafile" placeholder="pdf, doc, docx, jpg, png, jpeg, bmp" readonly>
						</div>
						<div class="form-group col-md-6 jedaobyek">
							<button type="button" class="btn btn-success" onclick="$('#txtfile').click()" style="margin-top: 30px;">Cari File</button>
							<button type="button" class="btn btn-primary" onclick="uploaddoc()" style="margin-top: 30px;">Upload</button>
						</div>
					</div>
					<table class="table table-hover table-striped w-full" id="tbl-xdoc">
						<thead>
							<tr>
								<th style="width: 30%;">Aksi</th>
								<th style="width: 70%;">Dokumen</th>
							</tr>
						</thead>
					</table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="kosongformdoc()">Reset</button>
					<button type="button" class="btn btn-info" onclick="tabeldoc.ajax.reload(null, false);">Rerfresh Data</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$('.tokenfield').tokenfield()
	var idmenu = "<?= $idmskr; ?>";
	var idform = "<?= ucfirst($idf); ?>";
	$("#tpm" + idmenu).addClass("active");
	$("#stpm" + idform).addClass("active");

	swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
	var tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= base_url(ucfirst($idf).'/json'); ?>",
		"fnDrawCallback": function(oSettings){swal.close();}
	});
	var tabeldoc = $('#tbl-xdoc').DataTable({
		"ajax": "<?= base_url(ucfirst($idf).'/jsondoc'); ?>",
		"fnDrawCallback": function(oSettings){swal.close();}
	});

	setInterval(function(){
		let status = $("#txtnosurat").is("[readonly]");
		if(status == true){
			$.ajax({
				url: "<?= base_url(ucfirst($idf).'/nootomatis'); ?>",
				method: "POST",
				cache: "false",
				success: function(x){
					$("#txtnosurat").val(atob(x));
				},
				error: function(){
					$("#txtnosurat").val("");
				}
			})
		}
	}, 2000);

	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	
	function refresh(){
        $("#txtid").val("Otomatis By Sistem");
		$("#cbojenis").val("").change();
		$("#btnstatus").html("Otomatis");
		$("#btnstatus").click();
		$('#txtkepada').tokenfield('setTokens', []);
		$("#txtperihal").val("");
        $("#txtpengolah").val("");		
		$("#txtket").val("");
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", true);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function setstatus(){
		let status = $("#btnstatus").html();
		if(status == "Manual"){
			$("#txtnosurat").attr("readonly", false);
			$("#btnstatus").html("Otomatis");
			$("#btnstatus").removeClass("btn-danger");
			$("#btnstatus").addClass("btn-success");
		}else{
			$("#txtnosurat").attr("readonly", true);
			$("#btnstatus").html("Manual");
			$("#btnstatus").removeClass("btn-success");
			$("#btnstatus").addClass("btn-danger");
		}
	}

	function setfilter(){
		let tgl1 = $("#txttgl1").val();
		let tgl2 = $("#txttgl2").val();
		if(tgl1 == "" || tgl2 == ""){
            swal({title: 'Filter Gagal', text: 'Range Tanggal Masih Kosong', icon: 'error'});
            return;
        }
		$.ajax({
            url: "<?= base_url(ucfirst($idf).'/setfilter'); ?>",
            method: "POST",
            data: {tgl1: tgl1, tgl2: tgl2},
            cache: "false",
            success: function(){
				refreshdata();
            },
			error: function(){
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
		let tglsurat = $("#txttglsurat").val();
		let kodejenis = $("#cbojenis").val();
		let nosurat = $("#txtnosurat").val();
		let kodekec = $("#txtkodekec").val();
		let thsurat = $("#txtthsurat").val();
		let kepada = $("#txtkepada").val();
		let perihal = $("#txtperihal").val();
        let pengolah = $("#txtpengolah").val();	
		let keterangan = $("#txtket").val();
        if(tglsurat == "" || kodejenis == "" || nosurat == "" || kodekec == "" || thsurat == "" || kepada == "" || perihal == "" || pengolah == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            $("#btntambah").attr("disabled", false);
			return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {tglsurat: tglsurat, kodejenis: kodejenis, nosurat: nosurat, kodekec: kodekec, thsurat: thsurat, kepada: kepada, perihal: perihal, pengolah: pengolah, keterangan: keterangan},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Surat Keluar Berhasil di Tambahkan',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Tambah Gagal', text: 'Anda Tidak Memiliki Akses Menambah Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Tambah Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Tambah Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
		$("#btntambah").attr("disabled", false);
	}

	function update(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);
		let id = $("#txtid").val();
		let tglsurat = $("#txttglsurat").val();
		let kodejenis = $("#cbojenis").val();
		let nosurat = $("#txtnosurat").val();
		let kodekec = $("#txtkodekec").val();
		let thsurat = $("#txtthsurat").val();
		let kepada = $("#txtkepada").val();
		let perihal = $("#txtperihal").val();
        let pengolah = $("#txtpengolah").val();	
		let keterangan = $("#txtket").val();
        if(tglsurat == "" || kodejenis == "" || nosurat == "" || kodekec == "" || thsurat == "" || kepada == "" || perihal == "" || pengolah == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
			$("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, tglsurat: tglsurat, kodejenis: kodejenis, nosurat: nosurat, kodekec: kodekec, thsurat: thsurat, kepada: kepada, perihal: perihal, pengolah: pengolah, keterangan: keterangan},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Surat Keluar Berhasil di Update',
						icon: 'success'
					}).then((Refreshh)=>{
						refresh();
						tabel.ajax.reload(null, false);
					});
                }else{
					if(y == 99){
						swal({title: 'Update Gagal', text: 'Anda Tidak Memiliki Akses Update Data Pada Menu Ini', icon: 'error'});
						refresh();
					}else{
						swal({title: 'Update Gagal', text: 'Ada Beberapa Masalah dengan Data yang Anda Isikan !', icon: 'error'});
					}
                }
            },
			error: function(){
				swal.close();
				swal({title: 'Update Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}

	function hapus(){
		$("#btnupdate").attr("disabled", true);
		$("#btnhapus").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtid").val();
    
        if(id == ""){
            swal({title: 'Hapus Gagal', text: 'ID Surat Masuk Kosong !', icon: 'error'});
			$("#btnupdate").attr("disabled", false);
			$("#btnhapus").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
            return;
		}
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Data Ini ?",
			icon: 'warning',
			buttons:{
				confirm: {text : 'Yakin', className : 'btn btn-success'},
				cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
			}
		}).then((Hapuss)=>{
			if(Hapuss){
				$.ajax({
					url: "<?= base_url(ucfirst($idf).'/hapus'); ?>",
					method: "POST",
					data: {id: id},
					cache: "false",
					success: function(x){
						swal.close();
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Data Surat Keluar Berhasil di Hapus',
								icon: 'success'
							}).then((Refreshh)=>{
								refresh();
								tabel.ajax.reload(null, false);
							});
						}else{
							if(y == 99){
								swal({title: 'Hapus Gagal', text: 'Anda Tidak Memiliki Akses Menghapus Data Pada Menu Ini', icon: 'error'});
								refresh();
							}else{
								if(y == 90){
									swal({title: 'Hapus Gagal', text: 'Data Ini Masih digunakan dalam Data Arsip Surat Keluar, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
									refresh();
								}else{
									swal({title: 'Hapus Gagal', text: 'Periksa Kembali Data Yang Anda Pilih !', icon: 'error'});
								}
							}
						}
					},
					error: function(){
						swal.close();
						swal({title: 'Hapus Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
					}
				})
			}else{swal.close();}
		});

		$("#btnupdate").attr("disabled", false);
		$("#btnhapus").attr("disabled", false);
		$("#btnrefresh").attr("disabled", false);
	}
	
	function filter(el){
		var id = $(el).data("id");
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		$.ajax({
            url: "<?= base_url($idf.'/filter'); ?>",
            method: "POST",
            data: {id: id},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
				var xx = y.split("|");
				if(xx[0] == 1){
					$("#btnstatus").html("Manual");
					$("#btnstatus").click();
					$("#txtid").val(xx[1]);
					$("#cbojenis").val(xx[2]).change();
					$("#txtnosurat").val(xx[3]);
					$("#txtkodekec").val(xx[4]);
					$("#txtthsurat").val(xx[5]);
					$("#txtkepada").val(xx[6]).change();
					$("#txttglsurat").val(xx[7]);
					$("#txtperihal").val(xx[8]);
					$("#txtpengolah").val(xx[9]);
					$("#txtket").val(xx[10]);
					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
						<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>\
					');
				}else{
					swal({title: 'Filter Gagal', text: 'Data Tidak di Temukan', icon: 'error'});
					refresh();
				}
            },
			error: function(){
				swal.close();
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
    }

	//-------------------------------------------------------------------------------------------------------------

	function setid(el){
		let id = $(el).data("id");
		if(id == ""){
            swal({title: 'Filter Gagal', text: 'ID Dokumen Tidak Terdeteksi', icon: 'error'});
            return;
        }
		$.ajax({
            url: "<?= base_url(ucfirst($idf).'/setfilterdoc'); ?>",
            method: "POST",
            data: {id: id},
            cache: "false",
            success: function(){
				tabeldoc.ajax.reload(null, false);
				$("#txtidsk").val(id);
				$("#modaldokumen").modal({backdrop: 'static', keyboard: false});
            },
			error: function(){
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
	}

	function ambilnamadoc(){
		var obj = document.getElementById("txtfile");
		var nama = obj.files.item(0).name;
		$("#txtnamafile").val(nama);
	}

	function kosongformdoc(){
		$("#txtfile").val("");
		$("#txtnamafile").val("");
	}

	function uploaddoc(){
		let idsk = $("#txtidsk").val();
		let namafile = $("#txtnamafile").val();
        if(idsk == "" || namafile == ""){
            swal({title: 'Upload Gagal', text: 'ID Surat Keluar Tidak Terdeteksi atau Anda Belum Memilih File', icon: 'error'});
            return;
        }
		let dd = new Date();
        let iddoc = dd.getTime();
		let ff = namafile.split(".");
		let ekstensi = ff[ff.length-1];
		var files = document.getElementById("txtfile").files;
		if(files.length > 0){
			var formData = new FormData();
			formData.append("idfile", idsk);
			formData.append("namafile", iddoc + "." + ekstensi);
			formData.append("file", files[0]);
			var xhttp = new XMLHttpRequest();
			xhttp.open("POST", "<?= base_url(ucfirst($idf).'/uploaddoc'); ?>", true);
			xhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					var response = this.responseText;
					if(response == 1){
						swal({
							title: 'Berhasil',
							text: 'File ' + namafile + ' Berhasil di Upload',
							icon: 'success'
						}).then((Refreshh)=>{
							kosongformdoc();
							tabeldoc.ajax.reload(null, false);
							refreshdata();
						});						
					}else{
						if(response == 2){
							swal({title: 'Upload Gagal', text: 'File Tidak Didukung !', icon: 'error'});
						}else{
							swal({title: 'Upload Gagal', text: 'Jaringan Bermasalah', icon: 'error'});
						}
					}
				}
			};
			xhttp.send(formData);
		}else{
			app.dialog.alert("Silahkan Memilih File Terlebih Dahulu","File Kosong");
		}
	}

	function hapusdoc(el){
        let id = $(el).data("id");
        if(id == ""){
            swal({title: 'Hapus Gagal', text: 'ID Dokumen Kosong !', icon: 'error'});
            return;
		}
		swal({
			title: 'Hapus Data',
			text: "Anda Yakin Ingin Menghapus Dokumen Ini ?",
			icon: 'warning',
			buttons:{
				confirm: {text : 'Yakin', className : 'btn btn-success'},
				cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
			}
		}).then((Hapuss)=>{
			if(Hapuss){
				swal("Hapus Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
				$.ajax({
					url: "<?= base_url(ucfirst($idf).'/hapusdoc'); ?>",
					method: "POST",
					data: {id: id},
					cache: "false",
					success: function(x){
						swal.close();
						var y = atob(x);
						if(y == 1){
							swal({
								title: 'Hapus Berhasil',
								text: 'Dokumen Berhasil di Hapus',
								icon: 'success'
							}).then((Refreshh)=>{
								tabeldoc.ajax.reload(null, false);
								tabel.ajax.reload(null, false);
							});
						}else{
							if(y == 99){
								swal({title: 'Hapus Gagal', text: 'Anda Tidak Memiliki Akses Menghapus Dokumen Pada Menu Ini', icon: 'error'});
								refresh();
							}else{
								swal({title: 'Hapus Gagal', text: 'Periksa Kembali Data Yang Anda Pilih !', icon: 'error'});
							}
						}
					},
					error: function(){
						swal.close();
						swal({title: 'Hapus Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
					}
				})
			}else{swal.close();}
		});
	}

	function cetakdoc(el){
		let nama = $(el).data("nama");
        if(nama == ""){
            swal({title: 'Cetak Gagal', text: 'Nama Dokumen Kosong !', icon: 'error'});
            return;
		}
		window.open("<?= base_url(); ?>" + "arsip/suratkeluar/" + nama, "_blank");
	}

	function cetakpdf(){
		let tgl1 = $("#txttgl1").val();
		let tgl2 = $("#txttgl2").val();
		if(tgl1 == "" || tgl2 == ""){
            swal({title: 'Cetak Gagal', text: 'Range Tanggal Masih Kosong', icon: 'error'});
            return;
        }
		if(tabel.rows().count() == 0){
			swal({title: 'Cetak Gagal', text: 'Data Masih Kosong', icon: 'error'});
            return;
		}
		let key = btoa(tgl1 + "|" + tgl2);
		window.open("<?= base_url(ucfirst($idf).'/cetakpdf/'); ?>" + key, "_blank");
	}

	function cetakexcel(){
		let tgl1 = $("#txttgl1").val();
		let tgl2 = $("#txttgl2").val();
		if(tgl1 == "" || tgl2 == ""){
            swal({title: 'Cetak Gagal', text: 'Range Tanggal Masih Kosong', icon: 'error'});
            return;
        }
		if(tabel.rows().count() == 0){
			swal({title: 'Cetak Gagal', text: 'Data Masih Kosong', icon: 'error'});
            return;
		}
		let key = btoa(tgl1 + "|" + tgl2);
		window.open("<?= base_url(ucfirst($idf).'/cetakexcel/'); ?>" + key, "_blank");
	}
</script>
			