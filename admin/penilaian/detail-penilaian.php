<?php
?>

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
        <h3>Detail Penilaian Santri</h3>
        <a href="penilaian.php" class="btn btn-success btn-sm btn-back">
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

              <!-- Jilid -->
              <div class="form-group row">
                <label for="jilid" class="col-sm-2 col-form-label">Jilid Awal</label>
                <div class="col-sm-10">
                  <input type="text" name="jilid" class="form-control" id="jilid" disabled>
                </div>
              </div>

              <!-- divider -->
              <hr class="my-4">

              <!-- Tanggal -->
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Sekarang</label>
                <div class="col-sm-10">
                  <input type="date" name="tanggal" class="form-control" id="tanggal" disabled>
                </div>
              </div><br>

              <!-- Penguji -->
              <div class="form-group row">
                <label for="penguji" class="col-sm-2 col-form-label">Penguji</label>
                <div class="col-sm-10">
                  <input type="text" name="penguji" class="form-control" id="penguji" disabled>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="konfirmasi" class="btn btn-danger btn-block">
                        <span><i class="bi "></i></span>
                        <span>Belum Lulus</span>
                      </button>
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="konfirmasi" class="btn btn-success btn-block">
                        <span><i class="bi "></i></span>
                        <span>Lulus</span>
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