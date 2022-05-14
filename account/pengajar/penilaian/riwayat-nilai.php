<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn-success {
        background-color: #088A44 !important;
      }
      .select-jilid {
        width: 10% !important;
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
        <h3>Riwayat Penilaian Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            
            <div class="">
              <!-- filter jilid -->
              <select class="form-select select-jilid" onchange="location = this.value;">
                <option selected disabled>Pilih Jilid</option>
                <option value="#">Jilid 1</option>
                <option value="#">Jilid 2</option>
                <option value="#">Jilid 3</option>
                <option value="#">Jilid 4</option>
                <option value="#">Jilid 5</option>
                <option value="#">Jilid 6</option>
              </select>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>Lulus</td>
                    <td>Selasa, 26 April 2022</td>
                    <!-- button trigger modal detail -->
                    <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal">Nilai</button></td>
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