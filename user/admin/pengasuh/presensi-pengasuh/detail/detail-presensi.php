<?php
require_once('../../../../config.php');
require_once('../../../../helper.php');
require_once('../../../akses.php');

if(isset($_GET['id'])) {
  // start of setting datepicker
  $id = $_GET['id'];
  $dateQuery = "SELECT * FROM `filter_presensi_pengajar` WHERE `id` LIKE '$id'";
  $dateResult = mysqli_query($conn, $dateQuery);
  $dateData = mysqli_fetch_array($dateResult, MYSQLI_ASSOC);
  $tahun = $dateData['tahun'];
  $bulan = $dateData['bulan'];
  
  $bulanInt = monthConverter($bulan); // convert bulan dari text ke angka
  $startDate = $tahun."-".$bulanInt."-01";
  $lastDate = lastOfMonth($bulanInt, $tahun);
  $today = ifToday($bulanInt, $tahun);
  // end of setting datepicker
  
  // search data with datepicker
  if(isset($_POST['cari'])) {
    $tanggal = $_POST['tanggal'];
    $setDate = defaultDateFormat($tanggal);
    $explodeDate = explode("-",$setDate);
    $filterDate = $explodeDate['2'];
  
    header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
  }
  // ambil data setelah search
  elseif(!empty($_GET['tgl'])){
    $setDate = $tahun."-".$bulanInt."-".$_GET['tgl'];
    $tanggal = customDateFormat($setDate);
  
    // data pengajar
    $result = query($conn, $setDate);
  }
  // jika bulan adalah bulan sekarang (today)
  elseif($today['isToday']) {
    $setDate = date("Y-m-d");
    $tanggal = $today['date'];
  
    // data pengajar
    $result = query($conn, $setDate);
  }
  else {
    $setDate = $startDate;
    $tanggal = customDateFormat($startDate);
  
    // data pengajar
    $result = query($conn, $startDate);
  }
} else {
  header("Location: ../presensi.php");
}

// get data pengajar from database
function query($connection, $date) {
  $query = "SELECT * FROM `pengajar` WHERE `status` LIKE 'AKTIF' AND `tgl_daftar` BETWEEN '2022-01-01' AND '$date'";
  return mysqli_query($connection, $query);
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
      include('../../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Input Presensi Pengasuh</h3>
        <a href="/user/admin/pengasuh/presensi-pengasuh/presensi.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
          
            <form method="post">
              <!-- Tanggal -->
              <div class="form-group row">
                <label for="btn-datepicker" class="col-sm-2 col-form-label">Tanggal Presensi</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" name="tanggal" class="form-control btn btn btn-input text-start" id="btn-datepicker" value="<?= $tanggal?>" required readonly>
                    <button type="submit" name="cari" class="btn btn-success">
                      <span>Tetapkan</span>
                    </button>
                  </div>
                  <small class="form-text text-muted">
                    * Tekan form diatas untuk memilih tanggal
                  </small>
                </div>
              </div>
            </form><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="10%">NIP</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $badgeColor = $keterangan = $action = "";

                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      // cek absen
                      $cekQuery = "SELECT EXISTS
                                  (SELECT id FROM `presensi_pengajar` WHERE `tanggal` LIKE '$setDate' AND `pengajar_id` LIKE '".$data['id']."')
                                  as ket";
                      $cekResult = mysqli_query($conn, $cekQuery);
                      $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

                      echo "<tr class='text-center align-middle'><td>".$data['nip']."</td>";
                      echo "<td>".$data['nama']."</td>";
                      $btnHadir = "";
                      $btnTidakHadir = "";

                      if($cekData['ket'] > 0) {
                        $getKetQuery = "SELECT `keterangan` FROM `presensi_pengajar` WHERE `tanggal` LIKE '$setDate' AND `pengajar_id` LIKE '".$data['id']."'";
                        $getKetResult = mysqli_query($conn, $getKetQuery);
                        $getKetData = mysqli_fetch_array($getKetResult, MYSQLI_ASSOC);

                        if($getKetData['keterangan'] == "HADIR") {
                          $badgeColor = "bg-success";
                          $keterangan = "Hadir";
                          $btnHadir = "disabled";
                          $action = "update";
                        } else {
                          $badgeColor = "bg-danger";
                          $keterangan = "Tidak Hadir";
                          $btnTidakHadir = "disabled";
                          $action = "update";
                        }
                      }
                      else {
                        $badgeColor = "bg-warning";
                        $keterangan = "Kosong";
                        $action = "insert";
                      } ?>

                      <td>
                        <span class="badge <?= $badgeColor?> text-wrap"><?= $keterangan?></span>
                      </td>
                      <td>
                        <a role="button" href="update-presensi.php?id=<?= $id?>&induk=<?= $data['id']?>&ket=1&tgl=<?= $setDate?>&action=<?= $action?>"
                           class="btn btn-outline-success btn-sm <?= $btnHadir?>" aria-disabled="true">Hadir
                        </a>
                        <a role="button" href="update-presensi.php?id=<?= $id?>&induk=<?= $data['id']?>&ket=0&tgl=<?= $setDate?>&action=<?= $action?>"
                           class="btn btn-outline-danger btn-sm <?= $btnTidakHadir?>" aria-disabled="true">Tidak Hadir
                        </a>
                      </td></tr><?php
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
        $("#btn-datepicker").datepicker({
          format    : 'DD, dd MM yyyy',
          todayBtn  : "linked",
          language  : "id",
          orientation: "bottom auto",
          todayHighlight: true,
          maxViewMode: 0,
          startDate: new Date('<?= $startDate?>'),
          endDate: new Date('<?= $lastDate?>')
        });
      });
    </script>
  </body>
</html>