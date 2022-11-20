<div class="page-header">
	<h1 class="page-title">Pengelolaan Data Menu</h1>
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
							<th style="width: 10%">Aksi</th>
							<th style="width: 10%">ID</th>
							<th>Nama</th>
							<th style="width: 15%">Icon</th>
							<th style="width: 10%">Bentuk</th>
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
						<label class="form-control-label">ID Menu*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" placeholder="Masukkan Kode Menu" autocomplete="off" maxlength="5">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nama Menu*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnama" placeholder="Masukkan Nama Menu" autocomplete="off">
					</div>
					<div class="form-group col-md-8 jedaobyek">
						<label class="form-control-label" style="margin-bottom: -5px;">Icon</label>
						<select class="form-control select2" id="cboicon">
							<option value="">Silahkan Pilih</option>
							<?php
								if(is_array($iccon)){
									if(count($iccon)>0){
										foreach($iccon as $x){
											echo "<option value='".$x->nama."'>".$x->nama."</option>";
										}
									}
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-4" id="blokicon" style="font-size: 55px; text-align: center; margin-top: -5px;"></div>
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
		pageLength: 25,
		lengthMenu: [10, 25, 50, 100]
	});

	$("#cboicon").change(function(){lihaticon();});
	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	
	function refresh(){
        $("#txtid").val("");
        $("#txtnama").val("");
		$("#cboicon").val("").change();
		$("#blokicon").html("");
        $("#lbljudul").html('Form Tambah Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-success" id="btntambah" onclick="tambah()">Tambahkan</button>&nbsp<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function lihaticon(){
		var icon = $("#cboicon").val();
		$("#blokicon").html('<i class="icon '+ icon +'" aria-hidden="true"></i>')
	}
	
	function tambah(){
		$("#btntambah").attr("disabled", true);
        var id = $("#txtid").val();
        var nama = $("#txtnama").val();
		var icon = $("#cboicon").val();
    
        if(id == "" || nama == "" || icon == ""){
            swal({title: 'Tambah Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/tambah'); ?>",
            method: "POST",
            data: {id: id, nama: nama, icon: icon},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Tambah Berhasil',
						text: 'Data Menu Berhasil di Tambahkan',
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

        var id = $("#txtid").val();
        var nama = $("#txtnama").val();
		var icon = $("#cboicon").val();
    
        if(id == "" || nama == "" || icon == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, nama: nama, icon: icon},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Menu Berhasil di Update',
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
            swal({title: 'Hapus Gagal', text: 'ID Menu Kosong !', icon: 'error'});
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
								text: 'Data Menu Berhasil di Hapus',
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
									swal({title: 'Hapus Gagal', text: 'Data Menu Ini Masih digunakan dalam Data Form, Sehingga Tidak Dapat di Hapus Hanya Dapat di Ubah', icon: 'error'});
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
					$("#txtnama").val(xx[2]);
					$("#cboicon").val(xx[3]).change();
					$("#lbljudul").html('Form Kelola Data');
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
			