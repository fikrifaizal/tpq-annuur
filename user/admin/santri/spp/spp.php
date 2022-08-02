<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

// setting for filter query
$setMonth = date("m");
$setYear = date("Y");
$setDate = monthConverter2($setMonth)." ".$setYear;
$periode = $setYear."-".$setMonth;

// connect & query database
$query = "SELECT * FROM `santri` WHERE `status` LIKE 'AKTIF'";
$result = mysqli_query($conn, $query);
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
        <h3>SPP Santri</h3>

        <!-- card tabel -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <div class="row">
              <div class="col-sm">
                <label class="text-secondary">Periode</label>
                <h5><?= $setDate?></h5>
              </div>
              <div class="col-sm">
                <a href="rekap-spp.php?periode=<?=$periode?>" class="btn btn-success ms-1" target="_blank" style="float: right;">
                  <span>Cetak</span>
                </a>
                <a href="riwayat.php" class="btn btn-info" style="float: right;">
                  <span>Riwayat</span>
                </a>
              </div>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Tanggal Bayar</th>
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
                                  (SELECT id FROM `spp` WHERE `periode` LIKE '$periode' AND `santri_induk` LIKE '".$data['induk']."')
                                  as ket";
                      $cekResult = mysqli_query($conn, $cekQuery);
                      $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

                      echo "<tr class='text-center'><td class='fw-bold'>".$count++."</td>";
                      echo "<td>".$data['nis']."</td>";
                      echo "<td class='text-start'>".$data['nama_lengkap']."</td>";

                      if($cekData['ket'] > 0) {
                        $getTglQuery = "SELECT `tgl_bayar` FROM `spp` WHERE `periode` LIKE '$periode' AND `santri_induk` LIKE '".$data['induk']."'";
                        $getTglResult = mysqli_query($conn, $getTglQuery);
                        $getTglData = mysqli_fetch_array($getTglResult, MYSQLI_ASSOC);

                        echo "<td class='text-start'>".customDateFormat($getTglData['tgl_bayar'])."</td>";
                        echo "<td><span class='badge bg-success text-wrap'>Sudah Bayar</span></td>";
                      }
                      else { ?>
                        <td></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal<?= $data['nis']?>">
                            <span>Pilih</span>
                          </button>
                        </td></tr>
                      
                      <!-- Modal Detail -->
                      <div class="modal fade" id="detailModal<?=$data['nis']?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <label class="col-sm-5">Nomor Induk Santri</label>
                                <p class="col-sm-7"><?=$data['nis']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Lengkap</label>
                                <p class="col-sm-7"><?=$data['nama_lengkap']?></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a role="button" class="btn btn-success" href="action-spp.php?induk=<?=$data['induk']?>&periode=<?=$periode?>&filter=no">Konfirmasi</a>
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
  </body>
</html>