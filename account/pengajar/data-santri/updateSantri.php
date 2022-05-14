<?php
include('../../../config.php');
$query = "SELECT * FROM `biodata`";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Santri</title>
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
        <h3>Update Data Santri</h3>
        <a href="santri.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post" class="was-validated">

              <!-- NIS -->
              <div class="form-group row">
                <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Santri</label>
                <div class="col-sm-10">
                  <input type="text" name="nis" class="form-control" id="nis" disabled>
                </div>
              </div><br>

              <!-- Nama -->
              <div class="form-group row">
                <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" required>
                </div>
              </div><br>

              <!-- Tempat, Tanggal Lahir -->
              <div class="form-group row">
                <label for="lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                <div class="col-sm-10">
                  <div class="input-group has-validation">
                    <input type="text" name="tempat" class="form-control" id="tempat" required>
                    <span class="input-group-text" id="inputGroupPrepend3">,</span>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                  </div>
                </div>
              </div><br>

              <!-- Jenis Kelamin -->
              <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-select" name="gender" id="gender" required>
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="">Laki-laki</option>
                    <option value="">Perempuan</option>
                  </select>
                </div>
              </div><br>

              <!-- Nama Wali -->
              <div class="form-group row">
                <label for="namaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                <div class="col-sm-10">
                  <input type="text" name="namaWali" class="form-control" id="namaWali" required>
                </div>
              </div><br>

              <!-- Alamat -->
              <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat" class="form-control is-invalid" id="alamat" required></textarea>
                </div>
              </div><br>

              <!-- Email -->
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" name="email" class="form-control" id="email" required>
                </div>
              </div><br>

              <!-- Nomor Telepon -->
              <div class="form-group row">
                <label for="nomortelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="number" name="nomortelepon" class="form-control" id="nomortelepon" required>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="tambah" class="btn btn-success btn-block">
                        <span><i class="bi "></i></span>
                        <span>Update</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <!-- Modal Danger -->
            <div class="modal fade" tabindex="-1" id="modalDanger" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p><?=$setDangerText?></p>
                  </div>
                  <div class="modal-footer">
                    <a href="buku.php" class="btn btn-secondary" >OK</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <script>
    </script>
  </body>
</html>