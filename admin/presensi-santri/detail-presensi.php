<?php
require_once('../../config.php');

// connect & query database
$query = "SELECT * FROM `santri`";
$result = mysqli_query($conn, $query);

$tanggal = $_GET['id'];
$nis = 0;

// set "hadir"
if(isset($_POST['hadir'])) {
  
}
// set "tidak hadir"
elseif(isset($_POST['tidakhadir'])) {
  
}
// set ralat presensi
elseif(isset($_POST['ralat'])) {
  
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <link rel="shortcut icon" href="\tpq-annuur\image\logo-annur-bulat.png">
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
        <h3>Input Presensi Santri</h3>
        <a href="presensi.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
          
            <form method="post">
              <label class="text-secondary">Hari Presensi</label>
              <div>
                <input type="text" class="btn btn-light" name="tanggal" id="btn-datepicker" value="" readonly>
              </div><hr class="my-3">

              <!-- table -->
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTables-table">
                  <thead class="table-secondary">
                    <tr class="text-center align-middle">
                      <th scope="col" width="10%">NIS</th>
                      <th scope="col">Nama Lengkap</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col" width="10%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        echo "<tr class='text-center align-middle'><td>".$data['induk']."</td>";
                        echo "<td>".ucfirst(strtolower($data['nama_lengkap']))."</td>";
                        $nis = $data['induk'];?>
                        <td>
                          <input type="radio" class="btn-check" name="keterangan" id="success-outlined1" autocomplete="off" value="HADIR">
                          <label class="btn btn-outline-success btn-sm" for="success-outlined1">Hadir</label>

                          <input type="radio" class="btn-check" name="keterangan" id="danger-outlined1" autocomplete="off" value="TIDAK HADIR">
                          <label class="btn btn-outline-danger btn-sm" for="danger-outlined1">Tidak Hadir</label>
                        </td>
                        <!-- button trigger modal detail -->
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" disabled>Ralat</button></td></tr>
                        
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ralat Presensi Santri</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <label class="col-sm-5">Nama Lengkap</label>
                                  <p class="col-sm-7"><?= $data['nama_lengkap'];?></p>
                                </div>
                                <div class="row">
                                  <label class="col-sm-5">Keterangan</label>
                                  <div class="col-sm-7">
                                    <input type="radio" class="btn-check" name="newketerangan" id="success-outlined2" autocomplete="off" value="HADIR">
                                    <label class="btn btn-outline-success btn-sm" for="success-outlined2">Hadir</label>

                                    <input type="radio" class="btn-check" name="newketerangan" id="danger-outlined2" autocomplete="off" value="TIDAK HADIR">
                                    <label class="btn btn-outline-danger btn-sm" for="danger-outlined2">Tidak Hadir</label>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="ralat" class="btn btn-primary">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div><?php
                      }
                    ?>
                  </tbody>
                </table>
              </div><hr class="my-3">
              <button type="submit" name="simpan" class="btn btn-success btn-block" style="float: right;">
                <span><i class="bi "></i></span>
                <span>Simpan Data</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <script type="text/javascript">
      var datesForDisable = ["30-04-2022", "01-06-2022"]
      $(document).ready(function(){
        $("#btn-datepicker").datepicker({
          format    : 'dd-mm-yyyy',
          todayBtn  : "linked",
          language  : "id",
          orientation: "bottom auto",
          todayHighlight: true,
          maxViewMode: 0,
          datesDisabled: datesForDisable
        });
      });
    </script>
  </body>
</html>