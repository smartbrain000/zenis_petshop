<?php
if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "select * from transaksi_penjualan where id_struk='" . $_GET['id'] . "'");

    while ($t1 = mysqli_fetch_array($query1)) {
        //NAMBAH STOK
        $query2 = mysqli_query($koneksi, "select * from barang where id_barang='" . $t1['id_barang'] . "'");
        $t2 = mysqli_fetch_array($query2);
        $stok = $t2['jumlah_stok'] + $t1['jumlah_barang'];
        $query3 = mysqli_query($koneksi, "UPDATE barang SET jumlah_stok='" . $stok . "' WHERE id_barang='" . $t1['id_barang'] . "'");
        //NGURANGAN LABA
        $query4 = mysqli_query($koneksi, "select * from laba where id_laba='1'");
        $t3 = mysqli_fetch_array($query4);
        $laba = $t3['total_laba'] - $t1['laba'];
        $query5 = mysqli_query($koneksi, "UPDATE laba SET total_laba='" . $laba . "' WHERE id_laba='1'");
    }

    //HAPUS DATA PENJUALAN
    $query6 = mysqli_query($koneksi, "DELETE FROM transaksi_penjualan WHERE id_struk='" . $_GET["id"] . "'");
    //HAPUS STRUK
    $query7 = mysqli_query($koneksi, "DELETE FROM struk WHERE id_struk='" . $_GET["id"] . "'");
    if ($query6 && $query7) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=data_penjualan'>";
    }
}
