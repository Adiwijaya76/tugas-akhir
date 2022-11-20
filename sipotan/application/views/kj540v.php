<div class="page-header">
	<h1 class="page-title">Data Pengaturan</h1>
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
				<table class="table table-hover table-striped w-full" id="tbl-xdt">
					<thead>
						<tr>
							<th style="width: 10%">Aksi</th>
							<th style="width: 10%">ID</th>
							<th style="width: 50%">Nilai</th>
							<th style="width: 30%">Keterangan</th>
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
                    <div class="form-group col-md-12">
						<label class="form-control-label">ID*</label>
						<input type="text" class="form-control khusus_angka jedaobyek" id="txtid" autocomplete="off" maxlength="3">
					</div>
					<div class="form-group col-md-12 jedaobyek">
						<label class="form-control-label">Nilai*</label>
						<input type="text" class="form-control khusus_abjad jedaobyek" id="txtnilai" autocomplete="off">
					</div>
					<div class="form-group col-md-12">
						<label class="form-control-label">Keterangan</label>
						<textarea class="form-control khusus_abjad2 jedaobyek" id="txtket" autocomplete="off"></textarea>
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
		pageLength: 25,
		lengthMenu: [10, 25, 50, 100]
	});

	refresh();

	function refreshdata(){
		swal("Sedang Mengakses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
		tabel.ajax.reload(null, false);
	}
	
	function refresh(){
        $("#txtid").val("");
        $('#txtnilai').val("");
		$("#txtket").val("");
        $("#lbljudul").html('Form Kelola Data');
		$("#txtid").attr("readonly", false);
        $("#bloktombol").html('<button type="button" class="btn btn-primary" id="btnrefresh" onclick="refresh()">Batal</button>');
	}

	function update(){
		$("#btnupdate").attr("disabled", true);
		$("#btnrefresh").attr("disabled", true);

        var id = $("#txtid").val();
        var nilai = $("#txtnilai").val();
		var keterangan = $("#txtket").val();
    
        if(id == "" || nilai == ""){
            swal({title: 'Update Gagal', text: 'Ada Isian yang Belum Anda Isi !', icon: 'error'});
			$("#btnupdate").attr("disabled", false);
			$("#btnrefresh").attr("disabled", false);
            return;
        }
		swal("Memproses Data.....", {button: false, closeOnClickOutside: false, closeOnEsc: false});
        $.ajax({
            url: "<?= base_url(ucfirst($idf).'/update'); ?>",
            method: "POST",
            data: {id: id, nilai: nilai, keterangan: keterangan},
            cache: "false",
            success: function(x){
				swal.close();
				var y = atob(x);
                if(y == 1){
                    swal({
						title: 'Update Berhasil',
						text: 'Data Pengaturan Berhasil di Update',
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
					$("#txtnilai").val(xx[2]);
					$("#txtket").val(xx[3]);
					$("#lbljudul").html('Form Kelola Data');
					$("#txtid").attr("readonly", true);
					$("#bloktombol").html('\
						<button type="button" class="btn btn-info" id="btnupdate" onclick="update()">Update</button>\
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
			