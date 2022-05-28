<?php
include_once('../../config.php');
$query = "SELECT * FROM `filter_presensi`";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <link rel="shortcut icon" href="\tpq-annuur\image\logo-annur-bulat.png">
    <!-- style css -->
    <link rel="stylesheet" href="\tpq-annuur\admin\layout\style.css" />
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../layout/sidebar.html');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Presensi Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            
            <div class="row">
              <div class="col-sm">
                <a href="form-bulanan.php" class="btn btn-success">
                  <span><i class="bi bi-plus"></i></span>
                  <span>Tambah Absensi Bulanan</span>
                </a>
              </div>
              <div class="col-sm">
                <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownFilterJilid" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="float: right;">
                  Filter Tahun
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownFilterJilid">
                  <li><h6 class="dropdown-header">Pilih Jilid</h6></li>
                  <li><a class="dropdown-item" href="#">Jilid 1</a></li>
                  <li><a class="dropdown-item" href="#">Jilid 2</a></li>
                  <li><a class="dropdown-item" href="#">Jilid 3</a></li>
                </ul>
              </div>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Tahun</th>
                    <th scope="col" width="15%">Kelola</th>
                    <th scope="col" width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo "<tr class='text-center align-middle'><td>".$data['id']."</td>";
                      echo "<td>".ucfirst(strtolower($data['bulan']))."</td>";
                      echo "<td>".$data['tahun']."</td>";?>
                      <td>
                        <a role="button" href="detail/detail-presensi.php?id=<?= $data['id'];?>" class="btn btn-primary btn-sm">
                          <span><i class="bi bi-pencil"></i><span>
                          <span>Input</span>
                        </a>
                        <button type="button" class="btn btn-success btn-sm">Rekap</button>
                      </td>
                      <td>
                        <a role="button" href="form-presensi.php?action=ubah&&id=<?= $data['id'];?>" class="btn btn-warning btn-sm">
                          <span><i class="bi bi-pencil"></i><span>
                          <span>Ubah</span>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                      </td></tr><?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>