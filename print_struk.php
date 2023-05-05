<?php
// session_start();
// 	if(!isset($_SESSION['user'])){
// 		header('location:login.php');
// 	} else {
// 		$username=$_SESSION['user'];	
// 	}
$koneksi = mysqli_connect("localhost", "root", "", "stok");
//$qe1=mysqli_query($koneksi,"select * from users where username='$username'"); 
//$qe2=mysqli_fetch_array($qe1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zenis PetShop | </title>
    <style>
        * {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 14px;
            font-weight: bold;
        }

        p {
            text-align: center;
        }

        .luar {
            position: relative;
        }

        .panjang {
            position: absolute;
            width: 250px;
            padding-top: 2px;
            padding-left: 2px;
            padding-right: 2px;
        }

        table {
            width: 100%;
        }

        .panjang table td {
            padding: 2px;
        }

        th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="luar">
        <div class="panjang">
            <div>
                <?php
                include "helpers/tanggal.php";
                if ($_POST["id"]) {
                    $query1 = mysqli_query($koneksi, "SELECT a.*, nama_barang,jumlah_stok 
                FROM transaksi_penjualan a, barang b 
                WHERE a.id_barang = b.id_barang 
                AND jumlah_stok > '0'
                AND id_struk='" . $_POST['id'] . "'");
                    $query2 = mysqli_query($koneksi, "SELECT id_struk,tgl_terjual FROM transaksi_penjualan a WHERE id_struk='" . $_POST['id'] . "'");
                    $t = mysqli_fetch_array($query2);
                    $tunai = $_POST['tunai2'];
                    $diskon = $_POST['diskon2'];
                    $kembali = $_POST['kembali'];
                }
                ?>
                <p><b>ZENIS PETSHOP</b><br>Jl. Majalengka</p>
                <hr>
                <h6>ID Struk : <?= $t['id_struk'] ?></h6>
                <h6>Tanggal : <?= tanggal($t['tgl_terjual']) ?></h6>
                <!-- <div class="table-responsive"> -->
                <hr>
                <table class="table" cellspacing="0">
                    <?php
                    $totalHarga = 0;
                    while ($col = mysqli_fetch_array($query1)) {
                    ?>
                        <tr>
                            <td colspan="2"><?php echo $col['nama_barang'] ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?= number_format($col['jumlah_barang']) ?> x <?= number_format($col['harga_jual']) ?>
                            </td>
                            <td align="right"><?= number_format($col['total_harga']) ?></td>
                        </tr>
                    <?php
                        $totalHarga += $col['total_harga'];
                    }
                    ?>
                </table>
                <hr>
                <table>
                    <tr>
                        <td>Total : </td>
                        <td align="right">
                            <?= number_format($totalHarga) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Diskon :</td>
                        <td align="right"><?= number_format($diskon) ?></td>
                    </tr>
                    <tr>
                        <td>Bayar :</td>
                        <td align="right"><?= number_format($tunai) ?></td>
                    </tr>
                    <tr>
                        <td>Kembali : </td>
                        <td align="right">
                            <?= number_format($kembali); ?>
                        </td>
                    </tr>
                </table>
                <!-- </div> -->
                <p>TERIMA KASIH SUDAH BERBELANJA

                </p>
                <HR>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    window.print();
</script>