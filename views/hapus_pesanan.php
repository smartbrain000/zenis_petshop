<?php
if ($_GET["id1"]) {
    $query1 = mysqli_query($koneksi, "SELECT * FROM transaksi_penjualan WHERE id_struk='" . $_GET['id1'] . "'");
    $t = mysqli_fetch_array($query1);
    //QUERY MENGHAPUS DATA
    $query2 = mysqli_query($koneksi, "DELETE FROM transaksi_penjualan WHERE id_transaksi_penjualan='" . $_GET["id2"] . "'");
    if ($query2) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=input_penjualan&id=" . $t['id_struk'] . "'>";
    }
}
