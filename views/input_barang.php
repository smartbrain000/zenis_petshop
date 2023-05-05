<div class="col-md-6 ">
	<?php
		if (isset($_POST['simpan'])) {
			extract($_POST);
			$tgl = date("Y-m-d");
			$sql = mysqli_query($koneksi, "INSERT INTO barang (tgl_beli,nama_barang,harga_beli_barang,harga_jual,jumlah_stok,expired) VALUES('" . $tgl . "','" . $nama_barang . "','" . $harga_beli . "','" . $harga_jual . "','" . $jumlah_stok . "','" . $expired . "');");

			if ($sql) {
				echo "<h2 class='text-center bg=success'>DATA BERHASIL DISIMPAN</h2>";
				echo "<meta http-equiv='refresh' content='0; url=index.php?menu=data_barang'>";
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			}
		}
	?>

	<div class="x_panel">
		<div class="x_title">
			<h2>Input Barang</h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<br />
			<form id="demo-form2" class="form-horizontal form-label-left" action="" method="post">
				<div class="item form-group">
					<label class="col-form-label col-md-4 col-sm-3 label-align" for="last-name">Nama Barang</label>
					<div class="col-md-6 col-sm-6 ">
						<input type="text" id="last-name" name="nama_barang" required="required" class="form-control">
					</div>
				</div>
				<div class="item form-group">
					<label for="middle-name" class="col-form-label col-md-4 col-sm-3 label-align">Harga Beli</label>
					<div class="col-md-6 col-sm-6 ">
						<input id="middle-name" class="form-control" type="text" name="harga_beli">
					</div>
				</div>
				<div class="item form-group">
					<label for="middle-name" class="col-form-label col-md-4 col-sm-3 label-align">Harga Jual</label>
					<div class="col-md-6 col-sm-6 ">
						<input id="middle-name" class="form-control" type="text" name="harga_jual">
					</div>
				</div>
				<div class="item form-group">
					<label for="middle-name" class="col-form-label col-md-4 col-sm-3 label-align">Jumlah Stok</label>
					<div class="col-md-6 col-sm-6 ">
						<input id="middle-name" class="form-control" type="text" name="jumlah_stok">
					</div>
				</div>
				<div class="item form-group">
					<label class="col-form-label col-md-4 col-sm-3 label-align">Expired</label>
					<div class="col-md-6 col-sm-6 ">
						<input class="form-control" placeholder="dd-mm-yyyy" type="date" name='expired'>
					</div>
				</div>
				<div class=" ln_solid">
				</div>
				<div class="item form-group">
					<div class="col-md-6 col-sm-6 offset-md-3">
						<a class="btn btn-danger" href="?menu=data_barang"></i>Kembali</a>
						<button type="submit" class="btn btn-success" name="simpan">Simpan</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>