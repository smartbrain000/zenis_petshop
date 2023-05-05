<?php
if (isset($_GET)) {
  if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "select * from barang where id_barang='" . $_GET["id"] . "'");
    $t = mysqli_fetch_array($query1);

    if (isset($_POST['simpan'])) {
      extract($_POST);

      $query2 = mysqli_query($koneksi, "UPDATE barang SET nama_barang='" . $nama_barang . "',harga_beli_barang='" . $harga_beli_barang . "',harga_jual='" . $harga_jual . "' WHERE id_barang='" . $_GET["id"] . "'");

      if ($query2) {
        echo "<h2 class='text-center bg=success'>DATA BERHASIL DIUBAH</h2>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?menu=data_barang'>";
      } else {
        echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data.";
      }
    }

?>

    <div class="x_panel">
      <div class="x_title">
        <h2>Edit Barang</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form id="demo-form2" class="form-horizontal form-label-left" action="" method="post">

          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nama Barang</label>
            <div class="col-md-6 col-sm-6 ">
              <input type="text" id="last-name" name="nama_barang" required="required" class="form-control" value="<?= $t['nama_barang']; ?>">
            </div>
          </div>
          <div class="item form-group">
            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Harga Beli</label>
            <div class="col-md-6 col-sm-6 ">
              <input id="middle-name" class="form-control" type="text" name="harga_beli_barang" value="<?= $t['harga_beli_barang']; ?>">
            </div>
          </div>
          <div class="item form-group">
            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Harga Jual</label>
            <div class="col-md-6 col-sm-6 ">
              <input id="middle-name" class="form-control" type="text" name="harga_jual" value="<?= $t['harga_jual']; ?>">
            </div>
          </div>
          <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align">Expired</label>
            <div class="col-md-6 col-sm-6 ">
              <input id="tanggal" class="date-picker form-control" placeholder="dd-mm-yyyy" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)" name='expired' value="<?= $t['expired'] ?>">
              <script>
                function timeFunctionLong(input) {
                  setTimeout(function() {
                    input.type = 'text';
                  }, 60000);
                }
              </script>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="item form-group">
            <div class="col-md-6 col-sm-6 offset-md-3">
              <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    </div>
    </div>
<?php }
} ?>