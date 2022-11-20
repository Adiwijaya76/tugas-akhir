<?php
	if(is_array($dtsistem)){
		if(count($dtsistem)>0){
			foreach($dtsistem as $k){
				$jmlsistem = $k->jumlah;
			}
		}else{$jmlsistem = "???";}
	}else{$jmlsistem = "???";}

	if(is_array($dtform)){
		if(count($dtform)>0){
			foreach($dtform as $k){
				$jmlform = $k->jumlah;
			}
		}else{$jmlform = "???";}
	}else{$jmlform = "???";}

	if(is_array($dtakun)){
		if(count($dtakun)>0){
			foreach($dtakun as $k){
				$jmlakun = $k->jumlah;
			}
		}else{$jmlakun = "???";}
	}else{$jmlakun = "???";}
?>
<div class="row">
	<div class="col-xxl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card card-shadow card-completed-options btn-primary">
            <div class="card-block p-30">
                <div class="row">
                    <div class="col-12">
                        <div class="counter text-left blue-grey-700">
                          	<div class="counter-label mt-10" style="color: white">Jumlah Blok Sistem</div>
                          	<div class="counter-number font-size-40 mt-10" style="color: white"><?= $jmlsistem; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-xxl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card card-shadow card-completed-options btn-info">
            <div class="card-block p-30">
                <div class="row">
                    <div class="col-12">
                        <div class="counter text-left blue-grey-700">
                          	<div class="counter-label mt-10" style="color: white">Jumlah Form</div>
                          	<div class="counter-number font-size-40 mt-10" style="color: white"><?= $jmlform; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-xxl-4 col-lg-4 col-md-4 col-sm-12">
        <div class="card card-shadow card-completed-options btn-success">
            <div class="card-block p-30">
                <div class="row">
                    <div class="col-12">
                        <div class="counter text-left blue-grey-700">
                          	<div class="counter-label mt-10" style="color: white">Jumlah Akun</div>
                          	<div class="counter-number font-size-40 mt-10" style="color: white"><?= $jmlakun; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$("#tpmdashboard").addClass("active");
</script>