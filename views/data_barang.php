<div class="x_panel">
  <div class="x_title">
    <a class="btn btn-primary" href="?menu=input_barang"><i class="fa fa-plus"></i> Input Barang</a>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">

          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Beli</th>
                <th>Nama Barang</th>
                <th>Expired</th>
                <th>Stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = mysqli_query($koneksi, "select * from barang ORDER BY tgl_beli DESC");
              $no = 1;
              while ($col = mysqli_fetch_array($query)) {
              ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo tanggal($col['tgl_beli']) ?></td>
                  <td><?php echo $col['nama_barang'] ?></td>
                  <td>

                    <?php
                    if ($col['expired'] == '0000-00-00') {
                      echo "";
                    } else {
                      echo tanggal($col['expired']);
                    }
                    ?>

                  </td>
                  <td><?php echo $col['jumlah_stok'] ?></td>
                  <td class="text-center">
                    <a href="?menu=detail&id=<?php echo $col['id_barang']; ?>" class="btn btn-primary">
                      Detail
                    </a>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>