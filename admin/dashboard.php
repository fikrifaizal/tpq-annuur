<?php
require_once('../config.php');
include_once('akses.php');


?>
<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <link rel="shortcut icon" href="\tpq-annuur\assets\image\logo-annur-bulat.png">
    <!-- style css -->
    <link rel="stylesheet" href="\tpq-annuur\admin\layout\style.css" />
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
          <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                      Total Santri</div>
                    <div class="h5 font-weight-bold">20</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-secondary shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-secondary text-uppercase mb-1">
                      Keuangan TPQ</div>
                    <div class="h5 font-weight-bold">Rp40,000</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-success text-uppercase mb-1">
                      Presensi Santri</div>
                    <div class="h5 font-weight-bold">Senin, 1 Januari 2022</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="font-weight-bold text-danger text-uppercase mb-1">
                      Presensi Pengajar</div>
                    <div class="h5 font-weight-bold">Senin, 1 Januari 2022</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>