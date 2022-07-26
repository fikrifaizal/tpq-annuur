<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

$setMonth = date("m");
$setYear = date("Y");
$periode = monthConverter2($setMonth)." ".$setYear;
$tanggal = $setYear."-".$setMonth;

// connect & query database
$query = "SELECT * FROM `santri`";
$result = mysqli_query($conn, $query);

// set periode
if(isset($_POST['filter'])) {
  $explodeData = explode(" ",$_POST['periode']);
  $periode = $explodeData[1]."-".monthConverter(strtoupper($explodeData[0]));

  header("Location: ?periode=$periode");
}
// ambil data setelah search
elseif(!empty($_GET['periode'])){
  $tanggal = $_GET['periode'];
  $explodeData = explode("-",$_GET['periode']);
  $periode = monthConverter2($explodeData[1])." ".$explodeData[0];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ - Masjid Annuur</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/admin/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Riwayat SPP Santri</h3>
        <a href="/user/admin/santri/spp/spp.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>

        <!-- card tabel -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <form method="post">
              <div class="row">

                <!-- filter periode -->
                <div class="col-sm-9">
                  <p for="datepicker" class="form-label fw-bold">Periode</p>
                  <input type="text" name="periode" class="form-control btn btn-input text-start" id="input-periode" placeholder="Klik untuk memilih bulan" value="<?= $periode?>" readonly>
                </div>

                <!-- button -->
                <div class="col-sm-2 d-grid">
                  <p for="btn-group" class="form-label fw-bold">&nbsp</p>
                  <button type="submit" name="filter" class="btn btn-primary btn-block">
                    <span>Tampilkan</span>
                  </button>
                </div>
                <!-- button -->
                <div class="col-sm-1 d-grid">
                  <p for="btn-group" class="form-label fw-bold">&nbsp</p>
                  <a href="rekap-spp.php" class="btn btn-success btn-block">
                    <span>Cetak</span>
                  </a>
                </div>
              </div>
            </form><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col" width="10%">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $count = 1;

                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      // cek pembayaran
                      $cekQuery = "SELECT EXISTS
                                  (SELECT id FROM `keuangan_tpq` WHERE `tanggal` LIKE '%$setMonth%' AND `keterangan` LIKE '%".$data['nama_lengkap']."%')
                                  as ket";
                      $cekResult = mysqli_query($conn, $cekQuery);
                      $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

                      echo "<tr class='text-center'><td class='fw-bold'>".$count++."</td>";
                      echo "<td>".$data['induk']."</td>";
                      echo "<td class='text-start'>".$data['nama_lengkap']."</td>";
                      
                      if($cekData['ket'] > 0) {
                        echo "<td><span class='badge bg-success text-wrap'>Sudah Bayar</span></td>";
                      }
                      else { ?>
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $data['induk']?>">
                            <span>Pilih</span>
                          </button>
                        </td></tr>
                      
                      <!-- Modal Detail -->
                      <div class="modal fade" id="detailModal<?=$data['induk']?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <label class="col-sm-5">Nomor Induk Santri</label>
                                <p class="col-sm-7"><?=$data['induk']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Lengkap</label>
                                <p class="col-sm-7"><?=$data['nama_lengkap']?></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a role="button" class="btn btn-success" href="action-spp.php?induk=<?=$data['induk']?>">Konfirmasi</a>
                            </div>
                          </div>
                        </div>
                      </div><?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <!-- Javascript -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('#input-periode').datepicker({
          format: "MM yyyy",
          startView: 1,
          minViewMode: 1,
          maxViewMode: 2,
          language: "id",
          orientation: "bottom auto"
        });
      });
    </script>
  </body>
</html>