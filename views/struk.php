<?php
if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "SELECT a.*, nama_barang,jumlah_stok 
    FROM transaksi_penjualan a, barang b 
    WHERE a.id_barang = b.id_barang 
    AND id_struk='" . $_GET['id'] . "'");
    $query2 = mysqli_query($koneksi, "SELECT id_struk,tgl_terjual FROM transaksi_penjualan a WHERE id_struk='" . $_GET['id'] . "'");
    $t = mysqli_fetch_array($query2);
?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h5>ID Struk : <?= $t['id_struk'] ?></h5>
                    <h5>Tanggal : <?= tanggal($t['tgl_terjual']) ?></h5>
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
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $col['id_barang'] ?></td>
                                        <td><?php echo $col['nama_barang'] ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($col['harga_jual']) ?></td>
                                        <td class="text-right"><?= number_format($col['jumlah_barang']) ?></td>
                                        <td class="text-right">Rp. <?= number_format($col['total_harga']) ?></td>
                                    </tr>
                                <?php
                                    $no++;
                                    $totalHarga += $col['total_harga'];
                                }
                                ?>
                                <tr>
                                    <td class="text-right" colspan="5">Total Harga : </td>
                                    <td class="text-right">
                                        Rp. <?= number_format($totalHarga) ?>
                                    </td>
                                </tr>
                                <script>
                                    function countit(what) {
                                        var tunai = what.form.tunai.value;
                                        var diskon = what.form.diskon.value;
                                        let nilai = (tunai - (<?= $totalHarga ?> - diskon));
                                        $('.kembalian').html("Rp. " + nilai);
                                        $('.diskon2').val(diskon);
                                        $('.tunai2').val(tunai);
                                        $('.kembali').val(nilai);
                                    }
                                </script>
                                <form method="post">
                                    <tr>
                                        <td class="text-right" colspan="5">Diskon : </td>
                                        <td class="text-right">
                                            Rp. <input type="text" class="diskon" name="diskon" autofocus></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5">Tunai : </td>
                                        <td class="text-right">
                                            Rp. <input type="text" class="tunai" name="tunai" onkeyup="countit(this)"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="5">Kembalian : </td>
                                        <td class="text-right">
                                            <p class="kembalian"></p>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-right">
                <form action='print_struk.php' target="_blank" method='POST'>
                    <input type="hidden" name="id" value="<?= $t['id_struk'] ?>" />
                    <input type="hidden" name="tunai2" class="tunai2" />
                    <input type="hidden" name="diskon2" class="diskon2" />
                    <input type="hidden" name="kembali" class="kembali" />
                    <input type="submit" name="print" class="btn btn-success" value="Print Struk" />
                </form>
            </div>
        </div>
    </div>
    </div>

<?php } ?>