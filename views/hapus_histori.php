<?php
if ($_GET["id"]) {
    $query1 = mysqli_query($koneksi, "SELECT * FROM histori_ambil_laba where id_hal='" . $_GET['id'] . "'");
    $t1 = mysqli_fetch_array($query1);
    $query2 = mysqli_query($koneksi, "SELECT * FROM laba where id_laba='1'");
    $t2 = mysqli_fetch_array($query2);
    $laba = $t2['total_laba'] + $t1['laba_diambil'];

    $query3 = mysqli_query($koneksi, "UPDATE laba SET total_laba='" . $laba . "' WHERE id_laba='1'");

    $query4 = mysqli_query($koneksi, "DELETE FROM histori_ambil_laba WHERE id_hal='" . $_GET["id"] . "'");
    if ($query4) {
        echo "<meta http-equiv='refresh' content='0; url=?menu=data_keuntungan'>";
    }
}
