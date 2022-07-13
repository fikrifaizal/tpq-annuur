<?php
require_once('../config.php');
require_once('../helper.php');
include_once('akses.php');

// santri
$querySantri = "SELECT COUNT(induk) as santri FROM `santri`";
$resultSantri = mysqli_query($conn, $querySantri);
$dataSantri = mysqli_fetch_array($resultSantri, MYSQLI_ASSOC);

// pengasuh
$queryPengasuh = "SELECT COUNT(id) as pengasuh FROM `pengajar`";
$resultPengasuh = mysqli_query($conn, $queryPengasuh);
$dataPengasuh = mysqli_fetch_array($resultPengasuh, MYSQLI_ASSOC);

// petugas piket
$queryPiket = "SELECT COUNT(id) as piket FROM `piket`";
$resultPiket = mysqli_query($conn, $queryPiket);
$dataPiket = mysqli_fetch_array($resultPiket, MYSQLI_ASSOC);

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
    <title>TPQ</title>
    <!-- style css -->
    <link rel="stylesheet" href="\user\bendahara\layout\style.css" />
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
                    <div class="font-weight-bold text-primary text-uppercase mb-1">SPP Belum Lunas</div>
                    <div class="h5 font-weight-bold"><?= $dataSantri['santri']?> Orang</div>
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
                    <div class="font-weight-bold text-secondary text-uppercase mb-1">Saldo TPQ</div>
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
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                <span>Keuangan Tahun <?=$setYear?></span>
              </div>
              <div class="card-body">
                <canvas class="keuanganchart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <!-- Javascript Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>

    <script>
      // Area Chart Januari-Juni
      const chart1 = document.querySelectorAll(".keuanganchart");

      chart1.forEach(function (chart) {
        var ctx = chart.getContext("2d");
        var myChart = new Chart(ctx, {
          type: "line",
          data: {
            labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
            datasets: [
              {
                label: "Jumlah Peminjaman",
                data: [
                  <?php
                    for($i=1;$i<=12;$i++) {
                      if($i<10) {
                        $setMonth = $setYear."-0$i";
                      } else {
                        $setMonth = $setYear."-$i";
                      }

                      $count_chart = "SELECT id FROM `keuangan_tpq` WHERE `tanggal` LIKE '%$setMonth%'";
                      $query_chart = mysqli_query($conn, $count_chart);
                      echo mysqli_num_rows($query_chart);

                      if($i<12) {
                        echo ',';
                      }
                    }
                  ?>
                ],
                borderColor: [
                  "rgba(255, 99, 132, 1)",
                  "rgba(54, 162, 235, 1)",
                  "rgba(255, 206, 86, 1)",
                  "rgba(75, 192, 192, 1)",
                  "rgba(75, 206, 192, 1)",
                  "rgba(75, 192, 235, 1)",
                  "rgba(255, 192, 192, 1)",
                  "rgba(132, 192, 192, 1)",
                  "rgba(75, 255, 99, 1)",
                  "rgba(75, 102, 192, 1)",
                  "rgba(153, 102, 255, 1)",
                  "rgba(255, 159, 64, 1)"
                ],
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      });
    </script>
  </body>
</html>