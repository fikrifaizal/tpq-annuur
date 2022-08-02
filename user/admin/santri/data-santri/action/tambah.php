<?php
require_once('../../../akses.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ - Masjid Annuur</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/admin/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Tambah Data Santri</h3>
        <a href="/user/admin/santri/data-santri/santri.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- nav-tabs button -->
        <ul class="nav nav-tabs nav-justified" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-form-tab" data-bs-toggle="pill" data-bs-target="#pills-transaksi" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Form</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-file-tab" data-bs-toggle="pill" data-bs-target="#pills-anggota" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">File Excel</button>
          </li>
        </ul>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- nav-tabs content -->
            <div class="tab-content" id="pills-tabContent">

              <div class="tab-pane fade show active" id="pills-transaksi" role="tabpanel" aria-labelledby="pills-transaksi-tab">
                <?php include('tambah/with-form.php')?>
              </div>

              <div class="tab-pane fade" id="pills-anggota" role="tabpanel" aria-labelledby="pills-anggota-tab">
                <?php include('tambah/with-file.php')?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>