<?php
require_once('../../config.php');
require_once('../helper.php');

$query = "";

// filter tanggal
$startDate = "";
$endDate = ""; 

if(isset($_POST['filter'])) {
  $startDate = defaultDateFormat($_POST['start']);
  $endDate = defaultDateFormat($_POST['end']);

  // data santri
  $result = query($conn, $id, $setDate);

  header("Location: keuangan.php?start=$startDate&end=$endDate");
}
// ambil data setelah search
elseif(!empty($_GET['start']) && !empty($_GET['end'])){
  $setDate = $tahun."-".$bulanInt."-".$_GET['tgl'];
  $tanggal = customDateFormat($setDate);

  // data santri
  $result = query($conn, $id, $setDate);
}
// get filter kas
elseif(!empty($_GET['kas'])) {
  if($_GET['kas'] == "masuk") {
    $query = "SELECT * FROM `keuangan_tpq` WHERE `keluar` LIKE '0'";
  } elseif($_GET['kas'] == "keluar") {
    $query = "SELECT * FROM `keuangan_tpq` WHERE `masuk` LIKE '0'";
  }
}
else {
  $query = "SELECT * FROM `keuangan_tpq`";
}

// connect & query database
$result = mysqli_query($conn, $query);

function setIDRFormat(int $number) {
  if($number > 0) {
    return "Rp ".number_format($number,0,'.','.');
  } else {
    return "";
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <link rel="shortcut icon" href="\tpq-annuur\assets\image\logo-annur-bulat.png">
    <!-- style css -->
    <link rel="stylesheet" href="\tpq-annuur\admin\layout\style.css" />
    <style>
    </style>
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Keuangan TPQ</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <form method="post">
              <!-- Tanggal -->
              <div class="form-group row">
                <div class="col-sm-12 input-daterange input-group" id="datepicker">
                  <input type="text" class="form-control btn btn-input" name="start" placeholder="Pilih tanggal awal" value="<?= $startDate?>" readonly>
                  <span class="input-group-text">to</span>
                  <input type="text" class="form-control btn btn-input" name="end" placeholder="Pilih tanggal akhir" value="<?= $endDate?>" readonly>
                </div>
              </div>
              <div class="row my-3">
                <div class="col-sm-12 d-grid">
                  <button type="submit" name="filter" class="btn btn-info btn-block">
                    <span><i class="bi bi-check"></i></span>
                    <span>Filter Tanggal</span>
                  </button>
                </div>
              </div>
            </form>
            
            <!-- filter button -->
            <div class="row">
              <div class="col-sm-4 d-grid">
                <a href="keuangan.php" class="btn btn-warning btn-block">
                  <span><i class="bi "></i></span>
                  <span>Semua</span>
                </a>
              </div>
              <div class="col-sm-4 d-grid">
                <a href="?kas=masuk" class="btn btn-success btn-block">
                  <span><i class="bi "></i></span>
                  <span>Kas Masuk</span>
                </a>
              </div>
              <div class="col-sm-4 d-grid">
                <a href="?kas=keluar" class="btn btn-danger btn-block">
                  <span><i class="bi "></i></span>
                  <span>Kas Keluar</span>
                </a>
              </div>
            </div>
            <hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Kas Masuk</th>
                    <th scope="col">Kas Keluar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $count = 1;
                    $uangMasuk = 0;
                    $uangKeluar = 0;

                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo "<tr class='text-center align-middle'><td>".$count++."</td>";
                      echo "<td>".customDateFormat($data['tanggal'])."</td>";
                      echo "<td>".$data['keterangan']."</td>";
                      echo "<td>".setIDRFormat($data['masuk'])."</td>";
                      echo "<td>".setIDRFormat($data['keluar'])."</td>";
                      
                      $uangMasuk = $uangMasuk+intval($data['masuk']);
                      $uangKeluar = $uangKeluar+intval($data['keluar']);
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" class="fw-bold">Jumlah</td>
                    <td class='text-center align-middle'><?= setIDRFormat($uangMasuk)?></td>
                    <td class='text-center align-middle'><?= setIDRFormat($uangKeluar)?></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="fw-bold">Saldo Saat Ini</td>
                    <td colspan="2" class='text-center align-middle'>Rp <?= number_format($uangMasuk-$uangKeluar,0,'.','.')?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    
    <!-- Javascript -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.input-daterange').datepicker({
          format    : 'DD, dd MM yyyy',
          todayBtn  : "linked",
          language  : "id",
          orientation: "bottom auto",
          todayHighlight: true,
          maxViewMode: 2
        });
      });
    </script>
  </body>
</html>