<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
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
                <a href="buat-presensi.php" class="btn btn-success">
                  <span><i class="bi bi-plus"></i></span>
                  <span>Tambah Absensi Bulanan</span>
                </a>
              </div>
              <div class="col-sm">
                <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownFilterJilid" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" style="float: right;">
                  Filter Jilid
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
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Januari</td>
                    <td>2022</td>
                    <td>
                      <a role="button" href="detail-presensi.php" class="btn btn-primary btn-sm">Input</a>
                      <button type="button" class="btn btn-success btn-sm">Rekap</button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-warning btn-sm">Ubah</button>
                      <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>