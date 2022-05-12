<?php
?>

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
        <h3 class="">Data Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Nama Wali</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col" width="16%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>Udin</td>
                    <td>08121212</td>
                    <!-- button trigger modal detail -->
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal">Detail Lengkap</button></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Lengkap Santri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <label class="col-sm-5">Nama Lengkap</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Tempat, Tanggal Lahir</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Jenis Kelamin</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Nama Wali</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Alamat</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Email</label>
                      <p class="col-sm-7">???</p>
                    </div>
                    <div class="row">
                      <label class="col-sm-5">Nomor Telepon</label>
                      <p class="col-sm-7">???</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Edit</button>
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