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
        <h3>Buat Presensi Bulanan</h3>
        <a href="presensi.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>        
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post" class="was-validated">

              <!-- Bulan -->
              <div class="form-group row">
                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-10">
                  <select class="form-select" name="bulan" id="bulan" required>
                    <option value="" selected disabled>Pilih Bulan</option>
                    <option value="">Januari</option>
                    <option value="">Februari</option>
                  </select>
                </div>
              </div><br>

              <!-- Tahun -->
              <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                  <input type="text" name="tahun" class="form-control" id="tahun" required>
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
                        <span>Buat</span>
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
  </body>
</html>