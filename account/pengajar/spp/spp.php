<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <style>
      .btn-success {
        background-color: #088A44 !important;
      }
      .select-jilid {
        width: 10% !important;
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
        <h3>Pembayaran Santri</h3>

        <!-- card tabel -->
        <div class="card border shadow">
          <div class="card-body m-3">
            
            <div class="">
              <!-- filter jilid -->
              <select class="form-select select-jilid" onchange="location = this.value;">
                <option selected disabled>Pilih Jilid</option>
                <option value="#">Jilid 1</option>
                <option value="#">Jilid 2</option>
                <option value="#">Jilid 3</option>
                <option value="#">Jilid 4</option>
                <option value="#">Jilid 5</option>
                <option value="#">Jilid 6</option>
              </select>
            </div><hr class="my-3">

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
          </div>
        </div>
      </div>
    </main>
  </body>
</html>