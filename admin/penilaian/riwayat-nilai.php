<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
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
        <h3>Riwayat Penilaian Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            
            <div class="">
              <!-- filter jilid -->
              <select class="form-select" onchange="location = this.value;">
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
                    <th scope="col">Nama</th>
                    <th scope="col">Jilid Awal</th>
                    <th scope="col">Jilid Akhir</th>
                    <th scope="col">Tanggal Penilaian</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center align-middle">
                    <th scope="row">1</th>
                    <td>Healme</td>
                    <td>Jilid 1</td>
                    <td>Jilid 2</td>
                    <td>Selasa, 26 April 2022</td>
                    <td>Lulus</td>
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