<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn-success {
        background-color: #088A44 !important;
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
        <h3 class="text-black">Presensi Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <h5>Senin, 30 Februari 2022</h5>
            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>
                      <button type="button" class="btn btn-outline-success btn-sm">Hadir</button>
                      <button type="button" class="btn btn-outline-danger btn-sm">Tidak Hadir</button>
                    </td>
                    <!-- button trigger modal detail -->
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" disabled>Ralat</button></td>
                  </tr>
                  <tr class="text-center align-middle">
                    <th scope="row">2</th>
                    <td>Azzaaaaaa</td>
                    <td>
                      <span class="badge bg-success">Hadir</span>
                    </td>
                    <!-- button trigger modal detail -->
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal">Ralat</button></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ralat Presensi Santri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- button -->
            <div>
              <a class="btn btn-success btn-sm" href="#" role="button">
                <span class="me-1"><i class="bi bi-house"></i></span>
                <span>Cetak Nilai</span></a>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>