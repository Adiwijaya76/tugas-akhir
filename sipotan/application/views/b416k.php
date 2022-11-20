<div class="row">
    <?php
        if(is_array($datalogin)){
            if(count($datalogin)>0){
                foreach($datalogin as $x){
                    $idsistem = $x->id_sistem;
                    $nmsistem = $x->sistem;
                    $iconsistem = $x->icon;
                    $desksistem = $x->deskripsi;
                    $bg = random_background();
    ?>
                    <div class="col-md-4">
                        <div class="card card-block <?= $bg; ?>" data-linksistem="<?= base_url($idsistem.'/Dashboard'); ?>" onclick="ke(this)" style="cursor: pointer">
                            <div style="text-align: center; font-size: 75px;"><i class="icon <?= $iconsistem; ?>" aria-hidden="true"></i></div>
                            <p style="font-size: 25px;"><?= $nmsistem; ?></p>
                            <footer style="font-size: 16px; text-align: justify">
                                <?= $desksistem; ?>
                            </footer>
                            
                        </div>
                    </div>
    <?php
                }
            }
        }
    ?>
</div>
            