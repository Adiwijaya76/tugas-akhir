<div class="page-header">
	<h1 class="page-title">Monitoring Unsur Hara</h1>
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
	<div class="col-xxl-9 col-lg-9 col-md-9">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title">Data</h3></div>
			<div class="panel-body">
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%;">Aksi</th>
							<th style="width: 10%;">ID</th>
							<th>Masa Tanam</th>
							<th>Unsur Hara</th>
							<th>Varietas</th>
							<th>Nilai</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-xxl-3 col-lg-3 col-md-3">
		<div class="panel">
			<div class="panel-heading"><h3 class="panel-title" id="lbljudul">Form</h3></div>
			<div class="panel-body">
				<div class="form-row">
                    <div class="form-group col-md-12">
						<label class="form-control-label">ID </label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" placeholder="Masukkan id" autocomplete="off" maxlength="3">
					</div>

                    <div class="form-group col-md-12">
						<label class="form-control-label">Masa Tanam</label>
						<select class="form-control select2" id="txtrencana_pola_tanam">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($rencana_pola_tanam)){
									if(count($rencana_pola_tanam)>0){
										foreach($rencana_pola_tanam as $x){
											echo "<option value='".$x->id."'>".$x->masa_tanam."</option>";
										}
									}
								}
							?>
						</select>
						</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Unsur Hara</label>
						<select class="form-control select2" id="txtunsur_hara">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($unsur_hara)){
									if(count($unsur_hara)>0){
										foreach($unsur_hara as $y){
											echo "<option value='".$y->id."'>".$y->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nilai</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnilai" placeholder="Masukkan Nilai" autocomplete="off">
					</div>
					<div class="form-group col-md-12" id="bloktombol"></div>
                </div>
			</div>
		</div>
	</div>
</div>



<script>
	var idmenu = "<?= $idmskr; ?>";
	var idform = "<?= ucfirst($idf); ?>";
	$("#tpm" + idmenu).addClass("active");
	$("#stpm" + idform).addClass("active");

	swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
	var tabel = $('#tbl-xdt').DataTable({
		"ajax": "<?= base_url(ucfirst($idf).'/json'); ?>",
		"fnDrawCallback": function(oSettings){swal.close();},
		pageLength: 5,
		lengthMenu: [5, 10, 25, 50, 100]
	});

	
	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	

	function refresh(){
        $("#txtid").val("");
        $("#txtrencana_pola_tanam").val("").change();
        $("#txtunsur_hara").val("").change();
        $("#txtnilai").val("");
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id 						= $("#txtid").val();
        var id_rencana_pola_tanam   = $("#txtrencana_pola_tanam").val();
        var id_unsur_hara 			= $("#txtunsur_hara").val();
        var nilai 					= $("#txtnilai").val();
    
    
        if(id == "" || id_rencana_pola_tanam == "" || id_unsur_hara == ""  || nilai == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, id_rencana_pola_tanam: id_rencana_pola_tanam, id_unsur_hara: id_unsur_hara, nilai: nilai},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Monitoring Unsur Hara Berhasil di Tambahkan',
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

        var id 					  = $("#txtid").val();
        var id_rpt = $("#txtrencana_pola_tanam").val();
        var id_uh 		  = $("#txtunsur_hara").val();
        var nilai 				  = $("#txtnilai").val();
    
        if(id == "" || id_rpt == "" || id_uh ==  "" || nilai ==""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, id_rpt: id_rpt, id_uh: id_uh, nilai: nilai},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Monitoring Unsur Hara Berhasil di Update',
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
            swal({title: 'Hapus Gagal', text: 'ID Monitoring Unsur Hara Kosong !', icon: 'error'});
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
								text: 'Data Monitoring Unsur Hara Berhasil di Hapus',
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
									swal({title: 'Hapus Gagal', text: 'Data Level Ini Masih digunakan dalam Data Form Level, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
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
					$("#txtid").val(xx[1]);
					$("#txtrencana_pola_tanam").val(xx[2]).change();
					$("#txtunsur_hara").val(xx[3]).change();
					$("#txtnilai").val(xx[4]);
					$("#txtjudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
						<button type="button" class="btn btn-danger" id="btnhapus" onclick="hapus()">Hapus</button>\
						<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>\
					');
				}else{
					swal({title: 'Update Gagal', text: 'Data Tidak di Temukan', icon: 'error'});
					refresh();
				}
            },
			error: function(){
				swal.close();
				swal({title: 'Filter Gagal', text: 'Jaringan Anda Bermasalah !', icon: 'error'});
			}
		})
    }
</script>
