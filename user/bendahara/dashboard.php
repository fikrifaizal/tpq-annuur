<?php
require_once('../config.php');
require_once('../helper.php');
include_once('akses.php');

$setMonth = date("m");

// santri
$querySantri = "SELECT COUNT(id) as santri FROM `keuangan_tpq` WHERE `keluar` LIKE '0' AND `tanggal` LIKE '%$setMonth%' AND `keterangan` LIKE '%SPP%'";
$resultSantri = mysqli_query($conn, $querySantri);
$dataSantri = mysqli_fetch_array($resultSantri, MYSQLI_ASSOC);

// saldo
$querySaldo = "SELECT (SUM(masuk)-SUM(keluar)) as saldo FROM `keuangan_tpq`";
$resultSaldo = mysqli_query($conn, $querySaldo);
$dataSaldo = mysqli_fetch_array($resultSaldo, MYSQLI_ASSOC);

// set year
$setYear = date("Y");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TPQ - Masjid Annuur</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/bendahara/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Dashboard</h3>

        <!-- card info -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-primary text-uppercase mb-1">SPP Belum Lunas Bulan Ini</div>
                    <div class="h5 font-weight-bold"><?= $dataSantri['santri']?> Santri</div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="card border-left-secondary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-secondary text-uppercase mb-1">Saldo TPQ Saat Ini</div>
                    <div class="h5 font-weight-bold"><?= setIDRFormat($dataSaldo['saldo'])?></div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card border-left-success shadow h-100">
              <div class="card-header">
                <span class="me-1"><i class="bi bi-bar-chart-fill"></i></span>
                <span>Keuangan Tahun <?=$setYear?></span>
              </div>
              <div class="card-body">
                <canvas id="keuanganchart" width="100%" height="25px"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <!-- Javascript Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>

    <script>
      // Area Chart
      new Chart("keuanganchart", {
        type: "line",
        data: {
          labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
          datasets: [{
            label: "Kas Masuk",
            data: [
              <?php
                for($i=1;$i<=12;$i++) {
                  if($i<10) {
                    $setMonth = $setYear."-0$i";
                  } else {
                    $setMonth = $setYear."-$i";
                  }

                  $count_chart = "SELECT SUM(masuk) as totalmasuk FROM `keuangan_tpq` WHERE `tanggal` LIKE '%$setMonth%' AND `keluar` LIKE '0'";
                  $query_chart = mysqli_query($conn, $count_chart);
                  $data_chart = mysqli_fetch_array($query_chart, MYSQLI_ASSOC);
                  if(!empty($data_chart['totalmasuk'])) {
                    echo $data_chart['totalmasuk'];
                  } else {
                    echo 0;
                  }

                  if($i<12) {
                    echo ',';
                  }
                }
              ?>
            ],
            borderColor: "green",
            borderWidth: 1,
            fill: false
          },
          {
            label: "Kas Keluar",
            data: [
              <?php
                for($i=1;$i<=12;$i++) {
                  if($i<10) {
                    $setMonth = $setYear."-0$i";
                  } else {
                    $setMonth = $setYear."-$i";
                  }

                  $count_chart = "SELECT SUM(keluar) as totalkeluar FROM `keuangan_tpq` WHERE `tanggal` LIKE '%$setMonth%' AND `masuk` LIKE '0'";
                  $query_chart = mysqli_query($conn, $count_chart);
                  $data_chart = mysqli_fetch_array($query_chart, MYSQLI_ASSOC);
                  if(!empty($data_chart['totalkeluar'])) {
                    echo $data_chart['totalkeluar'];
                  } else {
                    echo 0;
                  }

                  if($i<12) {
                    echo ',';
                  }
                }
              ?>
            ],
            borderColor: "red",
            borderWidth: 1,
            fill: false
          }]
        },
        options: {
          legend: {display: false}
        }
      });
    </script>
  </body>
</html>