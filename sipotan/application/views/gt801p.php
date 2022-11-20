<style>
	th, td {border-bottom: 1px solid #ddd;}
</style>
<div hidden>
    <div id="blokcetak" >
		<p style="text-align: center; width: 100%; font-size: 25px;">
			Rekapitulasi Surat Keluar Kecamatan Jogoroto<br>
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
					<th style="width: 15%; text-align: left; font-size: 11px;">Kepada</th>
					<th style="width: 10%; text-align: left; font-size: 11px;">Tanggal Surat</th>
					<th style="width: 20%; text-align: left; font-size: 11px;">Isi Surat</th>
					<th style="width: 10%; text-align: left; font-size: 11px;">Pengolah</th>
					<th style="width: 25%; text-align: left; font-size: 11px;">Keterangan</th>
                </tr>
            </thead>
            <tbody>
				<?php
					if(is_array($rekap)){
						if(count($rekap)>0){
							$urut = 0;
							foreach ($rekap as $k){
								$urut++;
								$no = $k->no_surat;
								$kepada = $k->kepada;
								$tglsurat = $k->tgl_surat;
								$perihal = $k->isi_surat;
								$pengolah = $k->pengolah;
								$keterangan = $k->keterangan;
								echo "<tr>
									<td style='text-align: center; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$urut."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$no."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$kepada."</td>
									<td style='text-align: center; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".tgl_indo_lengkap($tglsurat)."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$perihal."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$pengolah."</td>
									<td style='text-align: left; font-size: 11px; padding-top: 2px; padding-bottom: 2px;'>".$keterangan."</td>
								</tr>";
							}
						}
					}
				?>
            </tbody>
		</table>
    </div>
</div>