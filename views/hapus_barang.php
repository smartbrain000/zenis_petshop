<?php
if ($_GET["id"]) {

    $query1 = mysqli_query($koneksi, "DELETE FROM transaksi_penjualan WHERE id_barang='" . $_GET["id"] . "'");
    $query2 = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='" . $_GET["id"] . "'");

    if ($query1) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=data_barang'>";
    }
}
