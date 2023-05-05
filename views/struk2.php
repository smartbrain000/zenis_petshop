<?php
if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "SELECT a.*, nama_barang,jumlah_stok 
    FROM transaksi_penjualan a, barang b 
    WHERE a.id_barang = b.id_barang 
    AND id_struk='" . $_GET['id'] . "'");
    $query2 = mysqli_query($koneksi, "SELECT * FROM struk a WHERE id_struk='" . $_GET['id'] . "'");
    $t = mysqli_fetch_array($query2);
?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h5>ID Struk : <?= $t['id_struk'] ?></h5>
                    <h5>Tanggal : <?= tanggal($t['tgl']) ?></h5>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $totalHarga = 0;
                                while ($col = mysqli_fetch_array($query1)) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $col['id_barang'] ?></td>
                                        <td><?= $col['nama_barang'] ?></td>
                                        <td class="text-right">Rp. <?= number_format($col['harga_jual']) ?></td>
                                        <td class="text-right"><?= number_format($col['jumlah_barang']) ?></td>
                                        <td class="text-right">Rp. <?= number_format($col['total_harga']) ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                                <tr>
                                    <td class="text-right" colspan="5">Total Harga : </td>
                                    <td class="text-right">
                                        Rp. <?= number_format($t['total_harga']) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">Diskon : </td>
                                    <td class="text-right">
                                        Rp. <?= number_format($t['diskon']) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">Tunai : </td>
                                    <td class="text-right">
                                        Rp. <?= number_format($t['tunai']) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">Kembalian : </td>
                                    <td class="text-right">
                                        Rp. <?= number_format($t['kembalian']) ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-right">
                <form action='print_struk2.php' target="_blank" method='POST'>
                    <input type="hidden" name="id" value="<?= $t['id_struk'] ?>" />
                    <a href="?menu=input_penjualan2&id=<?= $t['id_struk'] ?>" class="btn btn-info">Edit Struk</a>
                    <input type="submit" name="print" class="btn btn-success" value="Print Struk" />
                </form>
            </div>
        </div>
    </div>
    </div>

<?php } ?>