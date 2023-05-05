<html>

<head>
	<title>Print Preview</title>
	<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<?php include "helpers/tanggal.php";
				// $koneksi = mysqli_connect("localhost", "root", "", "fantasy");
				$koneksi = mysqli_connect("localhost", "root", "", "stok");
				if (isset($_POST['print'])) {
					$jns = $_POST['jns'];
					$tgl1 = $_POST['tg1'];
					$tgl2 = $_POST['tg2'];

					if ($jns == 'laba') {

				?>
						<h2 class="text-center">Laporan Laba</h2>
						<h4 class="text-center">Periode <?= tanggal($tgl1); ?> sampai dengan <?= tanggal($tgl2); ?></h4>
						<div class="table-responsive" style="margin-top:10px;">
							<table class='table table-bordered'>
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Tanggal</th>
										<th class="text-center">ID Struk</th>
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
										<td align="right">Rp. <?= number_format($baris1['laba']); ?></td>
									</tr>
								<?php
											$total_laba += $baris1['laba'];
											$no1++;
										}
								?>
								<tr>
									<td colspan="3" class="text-right"><b>Total Laba </b></td>
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
											AND tgl_terjual >= '" . $tgl1 . "' 
											AND tgl_terjual <= '" . $tgl2 . "'";
										$qry2 = mysqli_query($koneksi, $sql2);
										$no2 = 1;
										$jmlh_stok = 0;
										$jmlh_terjual = 0;
										while ($baris2 = mysqli_fetch_array($qry2)) {
										?>
											<td><?php echo $no2; ?></td>
											<td><?php echo tanggal($baris2['tgl_terjual']); ?></td>
											<td><?php echo $baris2['nama_barang'] ?></td>
											<td align="right">Rp. <?php echo number_format($baris2['harga_jual']); ?></td>
											<td align="right"><?php echo $baris2['jumlah_barang'] ?></td>
											<td align="right">Rp. <?php echo number_format($baris2['total_harga']); ?></td>
									</tr>
									<tr>
									<?php
											$jmlh_stok += $baris2['jumlah_barang'];
											$jmlh_terjual += $baris2['total_harga'];
											$no2++;
										}
									?>
									<tr>
										<td colspan="4" class="text-right"><b>Jumlah Keseluruhan</b></td>
										<td align="right"><?= $jmlh_stok ?></td>
										<td align="right"><?= "Rp. " . number_format($jmlh_terjual); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					<?php
					}
					?>

				<?php
				}
				?>
			</div>
		</div>
	</div>
</body>

</html>
<script>
	window.print();
</script>