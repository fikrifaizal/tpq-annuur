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
        <h3>Detail Presensi Pengajar</h3>
        <a href="presensi.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <div>
              <label class="text-secondary">Hari Ini</label>
              <h5>Senin, 30 Februari 2022</h5>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="10%">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <td>19191919</td>
                    <td>Healme</td>
                    <td>
                      <button type="button" class="btn btn-outline-success btn-sm">Hadir</button>
                      <button type="button" class="btn btn-outline-danger btn-sm">Tidak Hadir</button>
                    </td>
                    <!-- button trigger modal detail -->
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" disabled>Ralat</button></td>
                  </tr>
                  <tr class="text-center align-middle">
                    <td>19191919</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ralat Presensi Pengajar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <label class="col-sm-5">Nama Lengkap</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Keterangan</label>
                      <div class="col-sm-7">
                        <button type="button" class="btn btn-outline-success btn-sm">Hadir</button>
                        <button type="button" class="btn btn-outline-danger btn-sm">Tidak Hadir</button>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
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