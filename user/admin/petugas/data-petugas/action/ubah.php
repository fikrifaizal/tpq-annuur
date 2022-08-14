<?php
require_once('../../../../config.php');
require_once('../../../akses.php');

if(isset($_GET['nipt'])) {
  // connect & query database
  $nipt = $_GET['nipt'];
  $query = "SELECT * FROM `piket` WHERE `nipt` LIKE '$nipt'";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  // get data from database
  $nama = $data['nama'];
  $gender = $data['jenis_kelamin'];
  $alamat = $data['alamat'];
  $telp = $data['no_telp'];
  $status = $data['status'];
  
  // form ubah data
  if(isset($_POST['ubah'])) {
    $nama = addslashes($_POST['nama']);
    $gender = $_POST['gender'];
    $alamat = addslashes($_POST['alamat']);
    $telp = $_POST['nomortelepon'];
    $status = $_POST['status'];
  
    // send data to db
    $query = "UPDATE `piket` SET `nama`='$nama',`jenis_kelamin`='$gender',
              `alamat`='$alamat',`no_telp`='$telp', `status`='$status'
              WHERE `nipt` LIKE '$nipt'";
    $result = mysqli_query($conn, $query);
    
    header("Location: ../petugas.php");
  }
} else {
  header("Location: ../petugas.php");
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
        <h3>Update Data Petugas</h3>
        <a href="/user/admin/petugas/data-petugas/petugas.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post" enctype="multipart/form-data">

              <!-- Nomor Induk -->
              <div class="form-group row">
                <label for="induk" class="col-sm-2 col-form-label">Nomor Induk Piket</label>
                <div class="col-sm-10">
                  <input type="text" name="induk" class="form-control" id="induk" value="<?= $nipt?>" disabled>
                </div>
              </div><br>

              <!-- Nama -->
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama?>" required>
                </div>
              </div><br>

              <!-- Jenis Kelamin -->
              <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-select" name="gender" id="gender" required>
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="LAKI-LAKI">Laki-laki</option>
                    <option value="PEREMPUAN">Perempuan</option>
                  </select>
                </div>
              </div><br>

              <!-- Alamat -->
              <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat" class="form-control" id="alamat" required><?= $alamat?></textarea>
                </div>
              </div><br>

              <!-- Nomor Telepon -->
              <div class="form-group row">
                <label for="nomortelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="number" name="nomortelepon" class="form-control" id="nomortelepon" value="<?= $telp?>" required>
                </div>
              </div><br>

              <!-- Status -->
              <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                  <select class="form-select" name="status" id="status" required>
                    <option value="" disabled>Pilih Status</option>
                    <option value="AKTIF">Aktif</option>
                    <option value="NONAKTIF">Nonaktif</option>
                  </select>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="ubah" class="btn btn-success btn-block">
                        <span>Ubah Data</span>
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
      if($gender == "LAKI-LAKI") {
        echo '<script type="text/javascript">
                document.getElementById("gender").getElementsByTagName("option")[1].selected = "selected"
              </script>';
      } else {
        echo '<script type="text/javascript">
                document.getElementById("gender").getElementsByTagName("option")[2].selected = "selected"
              </script>';
      }

      // status
      $arrStatus = ["AKTIF","NONAKTIF"];
      for($i=0; $i < count($arrStatus); $i++) {
        if(array_search($status, $arrStatus) == $i) {
          $i = $i+1;
          echo '<script type="text/javascript">
                document.getElementById("status").getElementsByTagName("option")['.$i.'].selected = "selected"
              </script>';
          break;
        }
      }
    ?>
  </body>
</html>