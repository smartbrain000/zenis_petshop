<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<FORM ACTION="" METHOD="POST" style="margin-top:3%;">
					<div class="col-md-3">
						<input type="date" name="tgl1" class="form-control" autofocus="" required="" id="tanggalf" style="display:inline;">
					</div>
					<div class="col-md-1">
						<p class="text-center">S/d</p>
					</div>
					<div class="col-md-3">
						<input type="date" name="tgl2" class="form-control" required="" id="tanggal" style="display:inline;">
					</div>
					<div class="form-actions col-md-2" style="text-align:center;margin-bottom:3%;">
						<input type="submit" name="cari" class="btn btn-primary" value="Cari" />
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php
				if (isset($_POST['cari'])) {
					$jns = $_GET['jns'];
					$tgl1 = $_POST['tgl1'];
					$tgl2 = $_POST['tgl2'];

					if ($jns == 'laba') {
				?>
						<h2 class="text-center">Laporan Laba</h2>
						<h4 class="text-center">Periode <?php echo tanggal($tgl1); ?> sampai dengan <?php echo tanggal($tgl2); ?></h4>
						<div class="table-responsive" style="margin-top:10px;">
							<table class='table table-bordered'>
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Tanggal</th>
										<th class="text-center">ID Struk</th>
										<th class="text-center">Total Harga</th>
										<th class="text-center">Diskon</th>
										<th class="text-center">Laba</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
										$qry1 = mysqli_query($koneksi, "SELECT * FROM struk 
										WHERE tgl >= '$tgl1' AND tgl <= '$tgl2' 
										GROUP BY id_struk ASC");
										$no1 = 1;
										$total_laba = 0;
										while ($baris1 = mysqli_fetch_array($qry1)) {
										?>
									<tr>
										<td><?php echo $no1; ?></td>
										<td><?php echo tanggal($baris1['tgl']); ?></td>
										<td><?= $baris1['id_struk']; ?></td>
										<td align="right">Rp. <?= number_format($baris1['total_harga']); ?></td>
										<td align="right">Rp. <?= number_format($baris1['diskon']); ?></td>
										<td align="right">Rp. <?= number_format($baris1['laba']); ?></td>
									</tr>
								<?php
											$total_laba += $baris1['laba'];
											$no1++;
										}
								?>
								<tr>
									<td colspan="5" class="text-right"><b>Total Laba </b></td>
									<td align="right"><?= "Rp." . number_format($total_laba); ?></td>
								</tr>
								</tbody>
							</table>
						</div>
					<?php }
					if ($jns == 'penjualan') {
					?>
						<h2 class="text-center">Laporan Penjualan</h2>
						<h4 class="text-center">Periode <?php echo tanggal($tgl1); ?> sampai dengan <?php echo tanggal($tgl2); ?></h4>
						<div class="table-responsive" style="margin-top:10px;">
							<table class='table table-bordered'>
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Tanggal</th>
										<th class="text-center">Nama Barang</th>
										<th class="text-center">Harga Barang</th>
										<th class="text-center">Qty</th>
										<th class="text-center">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
										$sql2 = "SELECT  a.*, nama_barang 
										from transaksi_penjualan a, barang b 
										WHERE a.id_barang = b.id_barang
										AND tgl_terjual >= '$tgl1' AND tgl_terjual <= '$tgl2'";
										$qry2 = mysqli_query($koneksi, $sql2);
										$no2 = 0;
										$jmlh_stok = 0;
										$jmlh_terjual = 0;
										$jmlh_laba = 0;
										while ($baris2 = mysqli_fetch_array($qry2)) {
											$jmlh_stok += $baris2['jumlah_barang'];
											$jmlh_terjual += $baris2['total_harga'];
											$no2++;
										?>
											<td><?php echo $no2; ?></td>
											<td><?php echo tanggal($baris2['tgl_terjual']); ?></td>
											<td><?php echo $baris2['nama_barang'] ?></td>
											<td align="right">Rp. <?php echo number_format($baris2['harga_jual']); ?></td>
											<td align="right"><?php echo $baris2['jumlah_barang'] ?></td>
											<td align="right">Rp. <?php echo number_format($baris2['total_harga']); ?></td>
									</tr>
									<tr>
									<?php } ?>
									<tr>
										<td colspan="4" class="text-right"><b>Jumlah Keseluruhan</b></td>
										<td align="right"><?= $jmlh_stok ?></td>
										<td align="right"><?= "Rp." . number_format($jmlh_terjual); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php
					}
					?>
					<form action='print.php' target="_blank" method='POST'>
						<div class="col-lg-3">
							<input type="hidden" name="jns" value="<?php echo $jns; ?>" />
						</div>
						<div class="col-lg-3">
							<input type="hidden" name="tg1" value="<?php echo $tgl1; ?>" />
						</div>
						<div class="col-lg-3">
							<input type="hidden" name="tg2" value="<?php echo $tgl2; ?>" />
						</div>
						<div class="col-lg-3 text-right">
							<input type="submit" name="print" class="btn btn-primary" value="Print Document" />
						</div>
					</form>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>