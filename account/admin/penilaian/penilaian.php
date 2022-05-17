<?php
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
        <h3>Penilaian Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- filter jilid -->
            <div class="btn-group">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownFilterJilid" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                Filter Jilid
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownFilterJilid">
                <li><h6 class="dropdown-header">Pilih Jilid</h6></li>
                <li><a class="dropdown-item" href="#">Jilid 1</a></li>
                <li><a class="dropdown-item" href="#">Jilid 2</a></li>
                <li><a class="dropdown-item" href="#">Jilid 3</a></li>
              </ul>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jilid Awal</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>Jilid 1</td>
                    <td>
                      <a type="button" class="btn btn-success btn-sm" href="detail-penilaian.php">Nilai</a>
                    </td>
                  </tr>
                </tbody>
              </table>
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