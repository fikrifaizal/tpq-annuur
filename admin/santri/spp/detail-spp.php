<?php
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
      include('../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Detail Pembayaran SPP</h3>
        <a href="spp.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post">

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
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" disabled>
                </div>
              </div><br>

              <!-- Tempat, Tanggal Lahir -->
              <div class="form-group row">
                <label for="lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                <div class="col-sm-10">
                  <div class="input-group has-validation">
                    <input type="text" name="tempat" class="form-control" id="tempat" disabled>
                    <span class="input-group-text" id="inputGroupPrepend3">,</span>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" disabled>
                  </div>
                </div>
              </div><br>

              <!-- Nama Wali -->
              <div class="form-group row">
                <label for="namaWali" class="col-sm-2 col-form-label">Nama Wali</label>
                <div class="col-sm-10">
                  <input type="text" name="namaWali" class="form-control" id="namaWali" disabled>
                </div>
              </div><br>

              <!-- Alamat -->
              <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat" class="form-control" id="alamat" disabled></textarea>
                </div>
              </div>

              <!-- divider -->
              <hr class="my-4">

              <!-- Jumlah Bayar -->
              <div class="form-group row">
                <label for="jumlahBayar" class="col-sm-2 col-form-label">Jumlah Bayar</label>
                <div class="col-sm-10">
                  <input type="text" name="jumlahBayar" class="form-control" id="jumlahBayar" disabled>
                </div>
              </div><br>

              <!-- Penerima -->
              <div class="form-group row">
                <label for="penerima" class="col-sm-2 col-form-label">Penerima</label>
                <div class="col-sm-10">
                  <input type="text" name="penerima" class="form-control" id="penerima" disabled>
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
                      <button type="submit" name="konfirmasi" class="btn btn-success btn-block">
                        <span><i class="bi "></i></span>
                        <span>Konfirmasi</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <script>
    </script>
  </body>
</html>