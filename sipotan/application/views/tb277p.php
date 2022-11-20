<style>
	th, td {border-bottom: 1px solid #ddd;}
</style>
<div hidden>
    <div id="blokcetak" >
		<p style="text-align: center; width: 100%; font-size: 25px;">
			Rekapitulasi Surat Masuk Kecamatan Jogoroto<br>
			<font style="text-align: center; width: 100%; font-size: 20px;">
				<?= tgl_indo_lengkap($tgl1); ?> 
				sd. 
				<?= tgl_indo_lengkap($tgl2); ?>
			</font>
		</p>
        <table >
            <thead>
                <tr>
					<th style="width: 5%; text-align: center; font-size: 11px;">Urut</th>
					<th style="width: 15%; text-align: left; font-size: 11px;">No Surat</th>
					<th style="width: 10%; text-align: center; font-size: 11px;">Tanggal Surat</th>
					<th style="width: 15%; text-align: left; font-size: 11px;">Pengirim</th>
					<th style="width: 20%; text-align: left; font-size: 11px;">Hal</th>
					<th style="width: 10%; text-align: center; font-size: 11px;">Tanggal Terima</th>
					<th style="width: 25%; text-align: left; font-size: 11px;">Disposisi</th>
                </tr>
            </thead>
            <tbody>
				<?php
					if(is_array($rekap)){
						if(count($rekap)>0){
							$urut = 0;
							foreach ($rekap as $k){
								$urut++;
								$nosurat = $k->no_surat;
								$pengirim = $k->pengirim;
                                $tglsurat = $k->tgl_surat;
                                $perihal = $k->perihal;
                                $tglterima = $k->tgl_terima;
                                $kepada = $k->diteruskan_kepada;
                                $disposisi = $k->disposisi;
                                $keterangan = $k->keterangan;
								echo "<tr>
									<td style='text-align: center; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$urut."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$nosurat."</td>
									<td style='text-align: center; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".tgl_indo_lengkap($tglsurat)."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$pengirim."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$perihal."</td>
									<td style='text-align: center; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".tgl_indo_lengkap($tglterima)."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$disposisi."</td>
								</tr>";
							}
						}
					}
				?>
            </tbody>
		</table>
    </div>
</div>