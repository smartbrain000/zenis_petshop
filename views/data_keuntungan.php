<div class="row">
    <?php
    $qry1 = mysqli_query($koneksi, "SELECT * FROM laba WHERE id_laba='1'");
    $t1 = mysqli_fetch_array($qry1);
    $qry2 = mysqli_query($koneksi, "SELECT sum(laba_diambil) as total_laba FROM histori_ambil_laba WHERE LEFT(tgl_ambil,10)='" . date("Y-m-d") . "'");
    $t2 = mysqli_fetch_array($qry2);
    $qry3 = mysqli_query($koneksi, "SELECT sum(laba_diambil) as total_laba FROM histori_ambil_laba WHERE LEFT(tgl_ambil,7)='" . date("Y-m") . "'");
    $t3 = mysqli_fetch_array($qry3);
    $qry4 = mysqli_query($koneksi, "SELECT sum(laba_diambil) as total_laba FROM histori_ambil_laba WHERE LEFT(tgl_ambil,4)='" . date("Y") . "'");
    $t4 = mysqli_fetch_array($qry4);
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Laba saat ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t1['total_laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Laba yang diambil hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t2['total_laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Laba yang diambil bulan ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t3['total_laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Laba yang diambil tahun ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t4['total_laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    extract($_POST);
    date_default_timezone_set('Asia/Jakarta');
    $waktu = $tgl . " " . date("H:i:s");
    $sisa = $t1['total_laba'] - $ambil_laba;
    $query4 = mysqli_query($koneksi, "UPDATE laba SET total_laba='" . $sisa . "',updated='" . $waktu . "' WHERE id_laba='1'");
    $query3 = mysqli_query($koneksi, "INSERT INTO histori_ambil_laba(tgl_ambil,laba_diambil,sisa,ket) VALUES ('" . $waktu . "','" . $ambil_laba . "','" . $sisa . "','" . $ket . "') ");
    if ($query3) {
        echo "<h2 class='text-center bg=success'>DATA BERHASIL DISIMPAN</h2>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?menu=data_keuntungan'>";
    } else {
        echo "<h2 class='text-center bg=success'>DATA GAGAL DISIMPAN</h2>";
    }
}
?>
<div class="x_panel">
    <div class="x_title">
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modal"> Ambil Laba</a>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Ambil</th>
                                <th>Total Laba</th>
                                <th>Sisa Laba</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no1 = 1;
                            $query2 = mysqli_query($koneksi, "SELECT *
                                    FROM histori_ambil_laba
                                    ORDER BY tgl_ambil DESC");
                            while ($col1 = mysqli_fetch_array($query2)) {
                            ?>
                                <tr>
                                    <td><?php echo $no1; ?></td>
                                    <td><?php echo $col1['tgl_ambil']; ?></td>
                                    <td>Rp. <?php echo number_format($col1['laba_diambil']) ?></td>
                                    <td>Rp. <?php echo number_format($col1['sisa']) ?></td>
                                    <td><?= $col1['ket'] ?></td>
                                    <td class="text-center">
                                        <a href="?menu=hapus_histori&id=<?php echo $col1['id_hal']; ?>" class="btn btn-danger" title='Hapus Data ini' onclick="return confirm('Anda yakin ingin menghapus data ini?')">
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

<div class="modal fade" id="modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Bagian header -->
            <div class="modal-header">
                <h4 class="modal-title" id="judul"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Bagian body -->
            <div class="modal-body">
                <form action="" method="post">
                    <form id="demo-form2" class="form-horizontal form-label-left" action="" method="post">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align">Tanggal</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input class="form-control" placeholder="dd-mm-yyyy" required="required" type="date" name='tgl'>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align" for="laba">Ambil Laba</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="laba" name="ambil_laba" required="required" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-3 label-align" for="ket">Keterangan</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="ket" name="ket" required="required" class="form-control">
                            </div>
                        </div>
                        <div class=" ln_solid">
                        </div>
                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                            </div>
                        </div>

                    </form>
                </form>
            </div>
        </div>
    </div>
</div>