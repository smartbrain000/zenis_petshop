<div class="row">
    <?php
    $HariIni = date("Y-m-d");
    $BulanIni = date("Y-m");
    $TahunIni = date("Y");


    $sql1 = mysqli_query($koneksi, "SELECT sum(total_harga) as total,sum(laba) as laba FROM struk WHERE left(tgl,10)='" . $HariIni . "'");
    $sql2 = mysqli_query($koneksi, "SELECT sum(total_harga) as total, left(tgl,7) as tgl, sum(laba) as laba FROM struk WHERE left(tgl,7)='" . $BulanIni . "' GROUP BY tgl");
    $sql3 = mysqli_query($koneksi, "SELECT sum(total_harga) as total, left(tgl,4) as tgl, sum(laba) as laba FROM struk WHERE left(tgl,4)='" . $TahunIni . "' GROUP BY tgl");
    $sql4 = mysqli_query($koneksi, "SELECT sum(total_harga) as total,sum(laba) as laba FROM struk");
    $t1  = mysqli_fetch_array($sql1);
    $t2  = mysqli_fetch_array($sql2);
    $t3  = mysqli_fetch_array($sql3);
    $t4  = mysqli_fetch_array($sql4);
    ?>
    <!-- Penjualan hari ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penjualan hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t1['total']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Penjualan bulan ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjualan bulan ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= (!empty($t2['total']))?number_format($t2['total']):'0'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Penjualan tahun ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjualan tahun ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= (!empty($t3['total']))?number_format($t3['total']):'0'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Penjualan selama ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Penjualan selama ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t4['total']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Laba hari ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Laba hari ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t1['laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Laba bulan ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laba bulan ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= (!empty($t2['laba']))?number_format($t2['laba']):'0'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Laba tahun ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laba tahun ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= (!empty($t3['laba']))?number_format($t3['laba']):'0'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Laba selama ini -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Laba selama ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($t4['laba']) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-primary">Grafik Laba & Penjualan</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" class="grafik">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6">
        <div class="x_panel">
            <div class="x_title">
                <h2 class="text-primary">Produk Terlaris</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="" style="width:100%">
                    <tr>
                        <th style="width:40%;">
                            <p>Top 5</p>
                        </th>
                        <th>
                            <div class="col-lg-7 col-md-7 col-sm-7 ">
                                <p class="">Produk</p>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                <p class="">Progress</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <canvas class="canvasDoughnut" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                        </td>
                        <td>
                            <table class="tile_info">
                                <?php
                                $sql5 = mysqli_query($koneksi, "SELECT sum(jumlah_barang) as total, nama_barang 
                                    FROM transaksi_penjualan a, barang b
                                    WHERE a.id_barang = b.id_barang
                                    AND LEFT(tgl_terjual,4)='" . date("Y") . "' 
                                    GROUP BY a.id_barang ASC
                                    ORDER BY total DESC
                                    LIMIT 5");
                                $sql6 = mysqli_query($koneksi, "SELECT sum(jumlah_barang) as total 
                                    FROM `transaksi_penjualan` 
                                    WHERE LEFT(tgl_terjual,4)='" . date("Y") . "' 
                                    GROUP BY id_barang DESC");
                                $total = 0;
                                while ($t6 = mysqli_fetch_array($sql6)) {
                                    $total += $t6['total'];
                                }
                                $warna = ["aero", "purple", "red", "green", "blue"];
                                $no5 = 0;
                                while ($t5 = mysqli_fetch_array($sql5)) {
                                ?>
                                    <tr>
                                        <td>
                                            <p><i class="fa fa-square <?= $warna[$no5] ?>"></i><?= $t5['nama_barang'] ?> </p>
                                        </td>
                                        <td>
                                            <?php
                                            $jml1 = ($t5['total'] * 100);
                                            $jml2 = $jml1 / $total;
                                            echo number_format($jml2) . " %";
                                            ?>
                                        </td>
                                    </tr>
                                <?php $no5++;
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>