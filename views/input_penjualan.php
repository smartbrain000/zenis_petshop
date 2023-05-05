<?php

if (isset($_POST['simpan1'])) {
  extract($_POST);
  //CEK ID STRUK
  if ($_GET['id'] != '1') {
    $id_struk = $_GET['id'];
  } else {
    $id_struk = "struk" . date("YmdHi");
  }

  $jml = count($id_barang);
  $total[] = 0;
  $laba[] = 0;
  for ($i = 0; $i < $jml; $i++) {
    //QUERY MENCARI DATA BARANG BERDASARKAN ID BARANG
    $query1 = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='" . $id_barang[$i] . "'");
    $t1 = mysqli_fetch_array($query1);
    //QUERY INPUT PENJUALAN DENGAN 
    $tgl = date("Y-m-d");
    if ($qty[$i] != null) {
      //UPDATE JUMLAH STOK DI TABEL BARANG
      $stok = $t1['jumlah_stok'] - $qty[$i];
      $query2 = mysqli_query($koneksi, "UPDATE barang SET jumlah_stok='" . $stok . "' WHERE id_barang='" . $t1['id_barang'] . "'");
      //INPUT PENJUALAN
      $total[$i] = $qty[$i] * $t1['harga_jual'];
      $laba[$i] = $total[$i] - ($qty[$i] * $t1['harga_beli_barang']);
      $query3 = mysqli_query($koneksi, "INSERT INTO transaksi_penjualan (id_struk,tgl_terjual,id_barang,harga_jual,jumlah_barang,total_harga,laba) VALUES ('" . $id_struk . "','" . $tgl . "','" . $id_barang[$i] . "','" . $t1['harga_jual'] . "','" . $qty[$i] . "','" . $total[$i] . "','" . $laba[$i] . "');");
    }
  }
  if ($query1) {
    if ($query2) {
      if ($query3) {
        echo "<h3 class='text-center bg=success'>DATA BERHASIL DISIMPAN</h3>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?menu=input_penjualan&id=" . $id_struk . "'>";
      } else {
        echo "<h3>GAGAL MENYIMPAN DATA PENJUALAN !!!</h3>";
      }
    } else {
      echo "<h5>GAGAL UPDATE STOK !!!</h5>.";
    }
  } else {
    echo "<h5>ERROR QUERY CARI DATA BARANG !!!</h5>";
  }
}

if (isset($_POST['simpan2'])) {
  extract($_POST);
  date_default_timezone_set('Asia/Jakarta');
  $tgl = date("Y-m-d H:i:s");

  //QUERY MENCARI DATA LABA
  $query4 = mysqli_query($koneksi, "SELECT * FROM laba WHERE id_laba='1'");
  $t2 = mysqli_fetch_array($query4);
  $laba = $real_laba - $diskon;

  //CEK STRUK
  $query5 = mysqli_query($koneksi, "SELECT count(id_struk) as jml,laba FROM struk WHERE id_struk='" . $id_struk . "'");
  $t3 = mysqli_fetch_array($query5);
  if ($t3['jml'] > 0) {
    //UPDATE STRUK
    $query6 = mysqli_query($koneksi, "UPDATE struk SET tgl='" . $tgl . "',total_harga='" . $total_harga . "',diskon='" . $diskon . "',tunai='" . $tunai . "',kembalian='" . $kembalian2 . "',laba='" . $laba . "',laba_real='" . $real_laba . "' WHERE id_struk='" . $id_struk . "'");
    //LABA BERKURANG NAMUN DIPERBARUI
    $labaSekarang = ($t2['total_laba'] - $t3['laba']) + $laba;
  } else {
    //INPUT STRUK
    $query6 = mysqli_query($koneksi, "INSERT INTO struk(id_struk,tgl,total_harga,diskon,tunai,kembalian,laba,laba_real) VALUES ('" . $id_struk . "','" . $tgl . "','" . $total_harga . "','" . $diskon . "','" . $tunai . "','" . $kembalian2 . "','" . $laba . "','" . $real_laba . "');");
    //LABA BERTAMBAH
    $labaSekarang = $t2['total_laba'] + $laba;
  }

  //UPDATE TOTAL LABA DI TABEL LABA
  $query7 = mysqli_query($koneksi, "UPDATE laba SET total_laba='" . $labaSekarang . "' WHERE id_laba='1'");
  if ($query7) {
    echo "<h3> DATA STRUK TERSIMPAN </h3>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?menu=struk2&id=" . $id_struk . "'>";
  } else {
    echo "<h3>DATA STURK GAGAL DISIMPAN</h3>";
  }
}

?>
<!-- PILIH BARANG -->
<div class="col-md-7">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 text-center">
          <h5 class="font-weight-bold text-primary">Pilih Produk</h5>
          <hr>
        </div>
      </div>
      <form action="" method="post">
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table id="datatable" class="table table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $qry1 = mysqli_query($koneksi, "select * from barang WHERE jumlah_stok>0");
                  $no = 1;
                  while ($col1 = mysqli_fetch_array($qry1)) {
                    if ($_GET['id'] != "1") {
                      //CEK BARANG SUDAH TERDAFTAR PADA STRUK ATAU TIDAK
                      $qry2 = mysqli_query($koneksi, "SELECT * FROM transaksi_penjualan WHERE id_struk='" . $_GET['id'] . "' AND id_barang='" . $col1['id_barang'] . "'");
                      $cek = mysqli_fetch_array($qry2);
                      if ($cek == null) {
                  ?>
                        <tr>
                          <td><?php echo $col1['nama_barang'] ?></td>
                          <td class="text-center" width="70px"><?= $col1['jumlah_stok'] ?></td>
                          <td class="form-group" width="90px">
                            <input type="text" name="qty[]" class="form-control">
                            <input type="text" name="id_barang[]" hidden class="form-control" value="<?= $col1['id_barang'] ?>">
                          </td>
                        </tr>
                      <?php
                      }
                    } else {
                      ?>
                      <tr>
                        <td><?= $col1['nama_barang'] ?></td>
                        <td class="text-center" width="70px"><?= $col1['jumlah_stok'] ?></td>
                        <td class="form-group" width="90px">
                          <input type="text" name="qty[]" class="form-control">
                          <input type="text" name="id_barang[]" hidden class="form-control" value="<?= $col1['id_barang'] ?>">
                        </td>
                      </tr>
                  <?php
                    }
                    $no++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-12">
            <button type="submit" name="simpan1" class="btn btn-primary btn-block"><span class="text"><i class="fa fa-shopping-cart fa-sm"></i> Masukan keranjang</span></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- KERANJANG BELANJA -->
<div class="col-md-5">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 text-center">
          <h5 class="font-weight-bold text-primary">Keranjang Belanja</h5>
          <hr>
        </div>
      </div>
      <form action="" method="post">
        <?php
        if ($_GET['id'] != '1') {
        ?>
          <div class="row mb-3">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table2" cellspacing="0">
                  <tbody>
                    <?php
                    $no = 1;
                    $totalLaba = 0;
                    $totalHarga = 0;
                    $id_struk = '';
                    $qry3 = mysqli_query($koneksi, "SELECT a.*, nama_barang,jumlah_stok 
                            FROM transaksi_penjualan a, barang b 
                            WHERE a.id_barang = b.id_barang 
                            AND id_struk='" . $_GET['id'] . "'");
                    while ($col = mysqli_fetch_array($qry3)) {
                    ?>
                      <tr>
                        <td class="text-center" width="50px" rowspan="2">
                          <a href="?menu=hapus_pesanan&id1=<?php echo $col['id_struk']; ?>&id2=<?= $col['id_transaksi_penjualan'] ?>" class="btn btn-danger btn-sm" title='Hapus Data <?php echo $col['nama_barang'] ?>' onclick="return confirm('Anda yakin ingin menghapus data <?php echo $col['nama_barang'] ?>?')">
                            <i class="fa fa-remove"></i>
                          </a>
                          <input type="text" name="id_barang[]" value="<?= $col['id_barang'] ?>" hidden>
                        </td>
                        <td colspan="2"><?php echo $col['nama_barang'] ?></td>
                      </tr>
                      <tr>
                        <td><?= $col['jumlah_barang'] . " x " . number_format($col['harga_jual']) ?></td>
                        <td class="form-group text-right" style="width:110px;">
                          <?= number_format($col['total_harga']) ?>
                        </td>
                      </tr>
                    <?php $no++;
                      $id_struk = $col['id_struk'];
                      $totalLaba += $col['laba'];
                      $totalHarga += $col['total_harga'];
                    } ?>
                    <tr>
                      <td class="text-right" colspan="2">Total Harga : </td>
                      <td class="text-right">
                        <?= number_format($totalHarga) ?>
                        <input type="text" name="total_harga" value="<?= $totalHarga ?>" hidden>
                        <input type="text" name="real_laba" value="<?= $totalLaba ?>" hidden>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right" colspan="2">Diskon : </td>
                      <td class="form-group" width="50px">
                        <input type="text" name="diskon" class="form-control text-right" autofocus>
                      </td>
                    </tr>
                    <script>
                      function countit(what) {
                        var tunai = what.form.tunai.value;
                        var diskon = what.form.diskon.value;
                        let nilai = (tunai - (<?= $totalHarga ?> - diskon));
                        $('.kembalian').html(nilai);
                        $('.kembalian2').val(nilai);
                      }
                    </script>
                    <tr>
                      <td class="text-right" colspan="2">Tunai : </td>
                      <td class="form-group" width="50px">
                        <input type="text" name="tunai" class="form-control text-right" onkeyup="countit(this)">
                        <input type="text" name="id_struk" value="<?= $id_struk ?>" hidden>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right" colspan="2">
                        <p>

                          Kembalian :
                        </p>
                      </td>
                      <td class="text-right">
                        <p class="kembalian"></p>
                        <input type="text" name="kembalian2" class="kembalian2" hidden>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-right">
              <button type="button" name="batal" class="btn btn-danger btn-inline">
                <span class="text"> Batal</span></button>
              <button type="submit" name="simpan2" class="btn btn-primary btn-inline">
                <span class="text"> Buat Struk</span></button>
            </div>
          </div>
        <?php } ?>
      </form>
    </div>
  </div>
</div>