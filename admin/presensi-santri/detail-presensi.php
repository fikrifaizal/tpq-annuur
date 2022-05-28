<?php
require_once('../../config.php');
// file with many function
require_once('../helper.php');

// setting datepicker
$id = $_GET['id'];
$dateQuery = "SELECT * FROM `filter_presensi` WHERE `id` LIKE '$id'";
$dateResult = mysqli_query($conn, $dateQuery);
$dateData = mysqli_fetch_array($dateResult, MYSQLI_ASSOC);
$tahun = $dateData['tahun'];
$bulan = $dateData['bulan'];

$bulanInt = monthConverter(strtoupper($bulan)); // convert bulan dari text ke angka
$startDate = $tahun."-".$bulanInt."-01";
$lastDate = lastOfMonth($bulanInt, $tahun);
$today = ifToday($bulanInt, $tahun);

$tanggal = "";
$nis = "";

// jika bulan adalah bulan sekarang (today)
if($today['isToday']) {
  $tanggal = $today['date'];

  // data santri
  $query = "SELECT `induk`, `nama_lengkap` FROM `santri`";
  $result = mysqli_query($conn, $query);
}

else {
  $firstDate = "01";
  if(!empty($_GET['tgl'])) {
    $firstDate = $_GET['tgl'];
  }
  $tanggal = getDay($startDate).", $firstDate ".ucfirst(strtolower($bulan))." $tahun";
  $searchDate = defaultDateFormat($tanggal);

  // data santri
  $query = "SELECT santri.induk as induk, santri.nama_lengkap as nama_lengkap, presensi_santri.keterangan as keterangan FROM `presensi_santri`
            LEFT JOIN `santri` ON presensi_santri.santri_induk = santri.induk
            WHERE presensi_santri.filter_id LIKE '$id' && presensi_santri.tanggal LIKE '$searchDate'";
  $result = mysqli_query($conn, $query);
  
  // set ralat presensi
  if(isset($_POST['ralat'])) {
    $tanggal = $_POST['tanggal'];
    $searchDate = defaultDateFormat($tanggal);
    $keterangan = $_POST['keterangan'];

    $queryRalat = "UPDATE `presensi_santri` SET `keterangan`='$keterangan' WHERE `santri_induk` LIKE '$nis'";
    $resultRalat = mysqli_query($conn, $queryRalat);
  }
  // cari berdasar tanggal
  elseif(isset($_POST['cari'])) {
    $tanggal = $_POST['tanggal'];
    $searchDate = defaultDateFormat($tanggal);
    $date = explode("-",defaultDateFormat($tanggal));
    $ddd = $date['2'];

    // data santri
    $query = "SELECT santri.induk as nis, santri.nama_lengkap as nama, presensi_santri.keterangan as keterangan FROM `presensi_santri`
              LEFT JOIN `santri` ON presensi_santri.santri_induk = santri.induk
              WHERE presensi_santri.filter_id LIKE '$id' && presensi_santri.tanggal LIKE '$searchDate'";
    $result = mysqli_query($conn, $query);

    header("Location: detail-presensi.php?id=$id&tgl=$ddd");
  }
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
              <!-- Tanggal -->
              <div class="form-group row">
                <label for="btn-datepicker" class="col-sm-2 col-form-label">Tanggal Presensi</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="text" name="tanggal" class="form-control btn text-start" id="btn-datepicker" value="<?= $tanggal?>" required readonly>
                    <button type="submit" name="cari" class="btn btn-success">
                      <span><i class="bi "></i></span>
                      <span>Tetapkan</span>
                    </button>
                  </div>
                  <small class="form-text text-muted">
                    * Tekan form diatas untuk memilih tanggal
                  </small>
                </div>
              </div><hr class="my-3">

              <!-- table -->
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTables-table">
                  <thead class="table-secondary">
                    <tr class="text-center align-middle">
                      <th scope="col" width="10%">NIS</th>
                      <th scope="col">Nama Lengkap</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        echo "<tr class='text-center align-middle'><td>".$data['induk']."</td>";
                        echo "<td>".$data['nama_lengkap']."</td>";?>
                        <td>
                          <span class="badge bg-success">Hadir</span>
                        </td>
                        <td>
                          <button type="submit" name="hadir" class="btn btn-outline-success btn-sm">Hadir</button>
                          <button type="submit" name="tidakhadir" class="btn btn-outline-danger btn-sm">Tidak Hadir</button>
                        </td></tr><?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </form>
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