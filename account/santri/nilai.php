<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn {
        background-color: #088A44 !important;
      }
    </style>
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('layout/sidebar.html');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3 class="text-black">Riwayat Penilaian</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Tanggal Ujian</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Jilid 1</td>
                    <td>Selasa, 26 April 2022</td>
                    <td>Lulus</td>
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