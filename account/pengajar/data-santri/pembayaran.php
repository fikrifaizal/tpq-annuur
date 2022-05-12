<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn-success {
        background-color: #088A44 !important;
      }

      .nav .nav-item .active {
        color: #088A44 !important;
      }

      .nav .nav-item .nav-link {
        color: #000000;
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
        <h3 class="text-black">Data Santri</h3>
        
        <!-- card cari -->
        <div class="card border mb-3">
          <div class="card-header text-secondary">
            <span><i class="bi bi-search me-2"></i></span>
            <span>Cari Santri</span>
          </div>

          <div class="card-body m-3">
            <!-- nav-tabs button -->
            <ul class="nav nav-tabs nav-justified" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-transaksi" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Nomor Induk Santri</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-anggota" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Nama Santri</button>
              </li>
            </ul>

            <!-- nav-tabs content -->
            <div class="tab-content" id="pills-tabContent">
              <!-- Berdasarkan Nomor Transaksi -->
              <div class="tab-pane fade show active" id="pills-transaksi" role="tabpanel" aria-labelledby="pills-transaksi-tab">
                <!-- form -->
                <form method="post" enctype="multipart/form-data">
                  <!-- Nomor Induk Santri -->
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" name="transaksi" class="form-control" autocomplete="off" id="nomortransaksi" placeholder="ketik nomor induk santri..." required>
                      <small id="nomortransaksi" class="form-text text-muted text-center">
                        Pastikan input Nomor Induk Santri dengan benar
                      </small>
                    </div>
                  </div><br>

                  <!-- Button -->
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col col-md-6 d-grid gap-2">
                          <button type="reset" name="reset" class="btn btn-danger btn-block btn-sm">                        
                            <span><i class="bi bi-arrow-repeat"></i></span>
                            <span>Reset</span>
                          </button>
                        </div>
                        <div class="col col-md-6 d-grid gap-2">
                          <button type="submit" name="caritransaksi" class="btn btn-success btn-block btn-sm">
                            <span><i class="bi bi-search"></i></span>
                            <span>Cari</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- Berdasarkan Nama Santri -->
              <div class="tab-pane fade" id="pills-anggota" role="tabpanel" aria-labelledby="pills-anggota-tab">
                <!-- form -->
                <form method="post" enctype="multipart/form-data">
                  <!-- Nama Santri -->
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" name="anggota" class="form-control" autocomplete="off" id="nomoranggota2" placeholder="ketik nama santri..." required>
                      <small id="nomoranggota2" class="form-text text-muted">
                        Pastikan input Nama Santri dengan benar
                      </small>
                    </div>
                  </div><br>

                  <!-- Button -->
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col col-md-6 d-grid gap-2">
                          <button type="reset" name="reset" class="btn btn-danger btn-block btn-sm">                        
                            <span><i class="bi bi-arrow-repeat"></i></span>
                            <span>Reset</span>
                          </button>
                        </div>
                        <div class="col col-md-6 d-grid gap-2">
                          <button type="submit" name="carianggota" class="btn btn-success btn-block btn-sm">
                            <span><i class="bi bi-search"></i></span>
                            <span>Cari</span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- card tabel -->
        <div class="card border shadow">
          <div class="card-header text-secondary">
            <span><i class="bi bi-search me-2"></i></span>
            <span>Cari Santri</span>
          </div>

          <div class="card-body m-3">
            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Nama Wali</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>Udin</td>
                    <td>08121212</td>
                    <td><button type="button" class="btn btn-primary btn-sm">Pilih</button></td>
                  </tr>
                </tbody>
              </table>
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