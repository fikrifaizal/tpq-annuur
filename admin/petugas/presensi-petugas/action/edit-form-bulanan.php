<?php 
require_once('../../../../config.php');

// danger modal
$setAlertCondition = false;
$setAlertText = "";

$id = $_GET['id'];

$query = "SELECT * FROM `filter_presensi` WHERE `id` LIKE '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);

$bulan = $data['bulan'];
$tahun = $data['tahun'];

if(isset($_POST['edit'])) {
  $bulan = strtoupper($_POST['bulan']);

  $query = "UPDATE `filter_presensi` SET `bulan`='$bulan' WHERE `id` LIKE '$id'";
  $result = mysqli_query($conn, $query);
  
  header("Location: ../presensi.php?success=edit");
}
// hapus data
elseif(!empty($_GET['action']) && $_GET['action'] == "delete") {
  $query = "DELETE FROM `filter_presensi` WHERE `id` LIKE '$id'";
  $result = mysqli_query($conn, $query);

  header("Location: ../presensi.php?success=delete");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TPQ</title>
    <link rel="shortcut icon" href="\tpq-annuur\assets\image\logo-annur-bulat.png">
    <!-- style css -->
    <link rel="stylesheet" href="\tpq-annuur\admin\layout\style.css" />
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../../../layout/sidebar.html');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Ubah Presensi Bulanan</h3>
        <a href="/tpq-annuur/admin/petugas/presensi-petugas/presensi.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>

        <!-- danger alert -->
        <div class="alert alert-danger alert-dismissible fade show" id="alert">
          <strong><?= $setAlertText;?></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post" class="was-validated">

              <!-- Bulan -->
              <div class="form-group row">
                <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                <div class="col-sm-10">
                  <select class="form-select" name="bulan" id="bulan" required>
                    <option value="" disabled>Pilih Bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                  </select>
                </div>
              </div><br>

              <!-- Tahun -->
              <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                  <input type="text" name="tahun" class="form-control" id="tahun" value="<?= $tahun;?>" disabled>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="button" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#deleteModalDanger">
                        <span><i class="bi "></i></span>
                        <span>Hapus Data</span>
                      </button>
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="edit" class="btn btn-success btn-block">
                        <span><i class="bi "></i></span>
                        <span>Ubah</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <?php
      // selected data in select form
      $arrayBulan = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
      for($i=0; $i < count($arrayBulan); $i++) {
        if(array_search($bulan, $arrayBulan) == $i) {
          $i = $i+1;
          echo '<script type="text/javascript">
                document.getElementById("bulan").getElementsByTagName("option")['.$i.'].selected = "selected"
              </script>';
          break;
        }
      }

      // Show Alert
      if($setAlertCondition) {
        echo '<script type="text/javascript">
                $("#alert").show();
              </script>';
      } else {
        echo '<script type="text/javascript">
                $("#alert").hide();
              </script>';
      }
    ?>
  </body>
</html>