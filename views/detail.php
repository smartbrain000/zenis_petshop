<?php
if (isset($_GET)) {
    if ($_GET["id"]) {
        $query1 = mysqli_query($koneksi, "select * from barang where id_barang='" . $_GET["id"] . "'");
        $t = mysqli_fetch_array($query1);
?>
        <div class="x_panel col-sm-6">
            <div class="x_title">
                <h2>Detail Barang</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table">
                    <tr>
                        <td>ID Barang</td>
                        <td>: <?= $t['id_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Barang</td>
                        <td>: <?= $t['nama_barang'] ?></td>
                    </tr>
                    <tr>
                        <td>Harga Beli</td>
                        <td>: Rp. <?= number_format($t['harga_beli_barang']) ?></td>
                    </tr>
                    <tr>
                        <td>Harga Jual</td>
                        <td>: Rp. <?= number_format($t['harga_jual']) ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Beli</td>
                        <td>: <?= tanggal($t['tgl_beli']) ?></td>
                    </tr>
                    <tr>
                        <td>Expired</td>
                        <td>: <?php
                                if ($t['expired'] == '0000-00-00') {
                                    echo "";
                                } else {
                                    echo tanggal($t['expired']);
                                }
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Stok</td>
                        <td>: <?= $t['jumlah_stok'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="?menu=edit_barang&id=<?php echo $t['id_barang']; ?>" class="btn btn-success">
                                Edit
                            </a>
                            <a href="?menu=hapus_barang&id=<?php echo $t['id_barang']; ?>" class="btn btn-danger" title='Hapus Data <?php echo $t['nama_barang'] ?>' onclick="return confirm('Anda yakin ingin menghapus data <?php echo $col['nama_barang'] ?>?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

<?php
    }
}
?>