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
        <h3 class="text-black">Jadwal TPQ</h3>
        
        <!-- 1st card content -->
        <div class="card border shadow mb-3">
          <div class="card-header text-secondary">
            <span><i class="bi bi-search me-2"></i></span>
            <span>Jadwal Hari Ini</span>
          </div>

          <div class="card-body m-3">
            <h4>Senin</h4>
          </div>
        </div>

        <!-- 2nd card content -->
        <div class="card border shadow">
          <div class="card-header text-secondary">
            <span><i class="bi bi-search me-2"></i></span>
            <span>Jadwal Keseluruhan</span>
          </div>

          <div class="card-body m-3">
            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam</th>
                    <th scope="col">Pengajar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Senin</td>
                    <td>15.00 - 16.00</td>
                    <td>Susanto</td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <!-- button -->
            <div>
              <a class="btn btn-success btn-sm" href="#" role="button">
                <span class="me-1"><i class="bi bi-house"></i></span>
                <span>Cetak Jadwal</span></a>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>