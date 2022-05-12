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
        <h3 class="text-black">Riwayat Pembayaran</h3>
        
        <!-- 1st card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Jumlah Bayar</th>
                    <th scope="col">Tanggal Bayar</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Januari 2022</td>
                    <td>Rp75.000</td>
                    <td>-</td>
                    <td><span class="badge bg-success">Sudah Bayar</span></td>
                  </tr>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Februari 2022</td>
                    <td>Rp75.000</td>
                    <td>-</td>
                    <td><span class="badge bg-danger">Belum Bayar</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            <!-- button -->
            <div>
              <a class="btn btn-success btn-sm" href="#" role="button">
                <span class="me-1"><i class="bi bi-house"></i></span>
                <span>Cetak Riwayat Pembayaran</span></a>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>