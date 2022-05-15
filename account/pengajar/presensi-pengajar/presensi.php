<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn-success {
        background-color: #088A44 !important;
      }
      .select-year {
        width:20%!important;
        float:right
      }
    </style>
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
                <select class="form-select select-year" onchange="location = this.value;">
                  <option selected disabled>Pilih Tahun</option>
                  <option value="#">2019</option>
                  <option value="#" selected>2020</option>
                  <option value="#">2021</option>
                </select>
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