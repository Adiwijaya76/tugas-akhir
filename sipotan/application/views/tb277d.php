<?php
    if(is_array($dtdpp)){
        if(count($dtdpp)>0){
            foreach($dtdpp as $x){
                $pengirim = $x->pengirim;
                $tgls = $x->tgl_surat;
                $nos = $x->no_surat;
                $perihal = $x->perihal;
                $tglt = $x->tgl_terima;
                $noreg = $x->no_register;
                $kepada = explode(",", $x->diteruskan_kepada);

            }
        }
    }
?>
<style>
	th, td {border-bottom: 1px solid #ddd;}
</style>
<div hidden>
    <div id="blokcetak">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center; width: 20%; font-size: 20px; padding-bottom: 20px; text-align: right">
                    <img style="width: 75px" src="assets/images/pemda_full.png">
                </td>
                <td colspan="5" style="text-align: center; width: 80%; font-size: 20px; padding-bottom: 20px;">
                    PEMERINTAH KABUPATEN JOMBANG<br>KECAMATAN JOGOROTO
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center; width: 100%; font-size: 20px; padding-bottom: 20px; padding-top: 20px;">
                    LEMBAR DISPOSISI
                </td>
            </tr>
            <tr>
                <td style="width: 15%; font-size: 12px; vertical-align: top; padding-bottom: 20px;">
                    SURAT DARI<br>
                    TANGGAL SURAT<br>
                    NOMOR SURAT<br>
                    PERIHAL
                </td>
                <td style="width: 3%; font-size: 12px; vertical-align: top; text-align: center;">
                    :<br>
                    :<br>
                    :<br>
                    :<br>
                </td>
                <td style="width: 32%; font-size: 12px; vertical-align: top;">
                    <?= $pengirim; ?><br>
                    <?= tgl_indo_lengkap($tgls); ?><br>
                    <?= $nos; ?><br>
                    <?= $perihal; ?><br>
                </td>
                <td style="width: 20%; font-size: 12px; vertical-align: top; padding-bottom: 20px;">
                    DITERIMA TANGGAL<br>
                    NOMOR PENGENDALI<br>
                    DITERUSKAN KEPADA
                </td>
                <td style="width: 3%; font-size: 12px; vertical-align: top; text-align: center;">
                    :<br>
                    :<br>
                    :<br>
                </td>
                <td style="width: 24%; font-size: 12px; vertical-align: top;">
                    <?= tgl_indo_lengkap($tglt); ?><br>
                    <?= $noreg; ?><br>
                    <br>
                    <ol>
                        <?php
                            foreach($kepada as $nilai){
                                echo "<li>".$nilai."</li>";
                            }
                        ?>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: center; width: 100%; font-size: 20px; padding-top: 20px; border-bottom: 0px">
                    ISI DISPOSISI
                </td>
            </tr>
        </table>
            
    </div>
</div>