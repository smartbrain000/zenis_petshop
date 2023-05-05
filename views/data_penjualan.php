<div class="x_panel">
  <div class="x_title">
    <a class="btn btn-primary" href="?menu=input_penjualan&id=1"><i class="fa fa-plus"></i> Input Penjualan</a>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <table id="datatable-responsive" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>ID Struk</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Diskon</th>
                <th>Laba</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no1 = 1;
              $query1 = mysqli_query($koneksi, "SELECT * FROM struk
                GROUP BY id_struk DESC");
              while ($col1 = mysqli_fetch_array($query1)) {
              ?>
                <tr>
                  <td><?php echo $no1; ?></td>
                  <td><?php echo $col1['id_struk'] ?></td>
                  <td><?php echo tanggal($col1['tgl']) ?></td>
                  <td class="text-right">Rp. <?php echo number_format($col1['total_harga']) ?></td>
                  <td class="text-right">Rp. <?php echo number_format($col1['diskon']) ?></td>
                  <td class="text-right">Rp. <?php echo number_format($col1['laba']) ?></td>
                  <td class="text-center">
                    <a href="?menu=struk2&id=<?= $col1['id_struk'] ?>" class="btn btn-warning">
                      Struk
                    </a>
                    <a href="?menu=hapus_penjualan&id=<?php echo $col1['id_struk']; ?>" class="btn btn-danger" title='Hapus Data ini' onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                      Hapus
                    </a>
                  </td>
                </tr>
              <?php $no1++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>