<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('location:login.php');
} else {
  $username = $_SESSION['user'];
}
$koneksi = mysqli_connect("localhost", "root", "", "stok");
$qe1 = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$qe2 = mysqli_fetch_array($qe1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zenis PetShop | </title>
  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS TABEL -->
  <link href="vendors/datatables/datatables.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
  <style>
    .table2 {
      width: 100%;
    }

    .table2 td {
      border: 1px solid rgb(222, 226, 230);
      padding: 3px;
      font-size: 15px;
      color: #000;
    }

    .table2 input {
      font-size: 15px;
      color: #000;
      border: 0px;
      padding-right: 0px;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Zenis PetShop</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="img/<?= $qe2['img'] ?>" class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?= $qe2['title'] ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li>
                  <a href="?menu=home"><i class="fa fa-home"></i> Home</a>
                </li>
                <li><a href="?menu=data_barang"><i class="fa fa-desktop"></i> Data Barang </a></li>
                <li><a href="?menu=data_penjualan"><i class="fa fa-list-ul"></i> Data Penjualan </a></li>
                <li><a href="?menu=data_keuntungan"><i class="fa fa-list-ul"></i> Data Keuntungan</a></li>
                <li><a><i class="fa fa-bar-chart"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="?menu=laporan&jns=penjualan">Laporan Penjualan</a></li>
                    <li><a href="?menu=laporan&jns=laba">Laporan Laba</a></li>
                  </ul>
                </li>
                <li><a href="?menu=data_users"><i class="fa fa-users"></i> Data Users </a></li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav navbar-nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>

          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="img/<?= $qe2['img'] ?>" alt=""><?= $qe2['title'] ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="?menu=ganti_pw">Ubah Password</a>
                  <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12  ">

              <?php include "helpers/tanggal.php";
              if (isset($_GET["menu"])) {
                include_once('views/' . $_GET["menu"] . ".php");
              } else {
                include "views/home.php";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Zenis PetShop - Copyright © 2021 Raihan WN
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS TABEL -->
  <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vendors/datatables/datatables.min.js"></script>
  <!-- JS CHART -->
  <script src="vendors/Chart.js/dist/Chart.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="build/js/custom.js"></script>
  <script>
    function init_charts() {
      if (typeof(Chart) === 'undefined') {
        return;
      }
      Chart.defaults.global.legend = {
        enabled: false
      };
      if ($('#lineChart').length) {
        var ctx = document.getElementById("lineChart");
        var lineChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: [
              <?php
              $n1 = 0;
              $n2 = 0;
              $pk = mysqli_query($koneksi, "SELECT LEFT(tgl_terjual,7) as tgl, DATE_FORMAT(tgl_terjual,'%M') as bulan 
                    FROM transaksi_penjualan 
                    -- WHERE LEFT(tgl_terjual,4)=" . date("Y") . "
                    GROUP BY tgl ASC");
              $pk2 = mysqli_query($koneksi, "SELECT sum(total_harga) as total, LEFT(tgl_terjual,7) as tgl 
                    FROM transaksi_penjualan 
                    -- WHERE LEFT(tgl_terjual,4)=" . date("Y") . "
                    GROUP BY tgl ASC");
              $n6 = 0;
              $pk6 = mysqli_query($koneksi, "SELECT sum(laba) as total, LEFT(tgl_terjual,7) as tgl 
                    FROM transaksi_penjualan 
                    -- WHERE LEFT(tgl_terjual,4)=" . date("Y") . " 
                    GROUP BY tgl ASC");
              while ($p1 = mysqli_fetch_array($pk)) {
                if ($n1 != '0') {
                  echo ",";
                }
                echo '"' . $p1['bulan'] . '"';
                $n1++;
              }
              ?>
            ],
            datasets: [{
                label: "Penjualan ",
                backgroundColor: "rgba(38, 185, 154, 0.31)",
                borderColor: "rgba(38, 185, 154, 0.7)",
                pointBorderColor: "rgba(38, 185, 154, 0.7)",
                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointBorderWidth: 1,
                data: [
                  <?php
                  while ($p2 = mysqli_fetch_array($pk2)) {
                    if ($n2 != '0') {
                      echo ",";
                    }
                    echo $p2['total'];
                    $n2++;
                  }
                  ?>
                ]
              }, {
                label: "Laba ",
                backgroundColor: "rgba(3, 88, 106, 0.3)",
                borderColor: "rgba(3, 88, 106, 0.70)",
                pointBorderColor: "rgba(3, 88, 106, 0.70)",
                pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(151,187,205,1)",
                pointBorderWidth: 1,
                data: [
                  <?php
                  while ($p6 = mysqli_fetch_array($pk6)) {
                    if ($n6 != '0') {
                      echo ",";
                    }
                    echo $p6['total'];
                    $n6++;
                  }
                  ?>
                ]
              }

            ]
          },
        });
      }
    }

    function init_chart_doughnut() {
      if (typeof(Chart) === 'undefined') {
        return;
      }
      if ($('.canvasDoughnut').length) {
        var chart_doughnut_settings = {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              <?php
              $n3 = 0;
              $pk3 = mysqli_query($koneksi, "SELECT sum(jumlah_barang) as total, nama_barang 
                    FROM transaksi_penjualan a, barang b
                    WHERE a.id_barang = b.id_barang
                    AND LEFT(tgl_terjual,4)='" . date("Y") . "' 
                    GROUP BY a.id_barang ASC
                    ORDER BY total DESC
                    LIMIT 5");
              $pk4 = mysqli_query($koneksi, "SELECT sum(jumlah_barang) as total, nama_barang 
                    FROM transaksi_penjualan a, barang b
                    WHERE a.id_barang = b.id_barang
                    AND LEFT(tgl_terjual,4)='" . date("Y") . "' 
                    GROUP BY a.id_barang ASC
                    ORDER BY total DESC
                    LIMIT 5");
              while ($p3 = mysqli_fetch_array($pk3)) {
                if ($n3 != '0') {
                  echo ",";
                }
                echo '"' . $p3['nama_barang'] . '"';
                $n3++;
              }
              ?>
            ],
            datasets: [{
              data: [
                <?php $n4 = 0;
                while ($p4 = mysqli_fetch_array($pk4)) {
                  if ($n4 != '0') {
                    echo ",";
                  }
                  echo $p4['total'];
                  $n4++;
                }
                ?>
              ],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]
            }]
          },
          options: {
            legend: false,
            responsive: false
          }
        }
        $('.canvasDoughnut').each(function() {
          var chart_element = $(this);
          var chart_doughnut = new Chart(chart_element, chart_doughnut_settings);
        });

      }

    }

    $(document).ready(function() {
      init_charts()
      init_chart_doughnut()
    });
  </script>
</body>

</html>