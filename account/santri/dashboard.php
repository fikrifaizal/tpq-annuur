<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
      }
      .border-left-secondary {
        border-left: 0.25rem solid #858796 !important;
      }
      .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
      }
      .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
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
        <h3>Dashboard</h3>
        
        <!-- card info -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Tagihan Bulan Ini</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp40,000</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Jadwal Hari Ini</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Sesi 1 - Jilid 1</div>
                  </div>                  
                  <div class="col-auto">
                    <i class="bi bi-book" aria-hidden="true"></i>
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