<?php
require_once('../../../../config.php');
require_once('../../../akses.php');

$getYear = date("Y");
$getToday = date("Y-m-d");

// form tambah data
if(isset($_POST['tambah'])) {
  // set Nomor Induk Piket (NIPT)
  $queryCheck = "SELECT nipt FROM piket WHERE nipt LIKE '%$getYear%' ORDER BY nipt DESC LIMIT 1";
  $resultCheck = mysqli_query($conn, $queryCheck);
  $dataCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
  if(!empty($dataCheck['nipt'])) {
    $setNIPT = $dataCheck['nipt']+1;
  } else {
    $setNIPT = $getYear."02001";
  }

  $nama = addslashes($_POST['nama']);
  $gender = $_POST['gender'];
  $alamat = addslashes($_POST['alamat']);
  $telp = $_POST['nomortelepon'];

  $query = "INSERT INTO `piket`(`nipt`,`nama`,`jenis_kelamin`,`alamat`,`no_telp`, `status`, `tgl_daftar`) VALUES ('$setNIPT','$nama','$gender','$alamat','$telp', 'AKTIF', '$getToday')";
  $result = mysqli_query($conn, $query);

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
        <h3>Tambah Data Petugas</h3>
        <a href="/user/admin/petugas/data-petugas/petugas.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            <form method="post">

              <!-- Nama -->
              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" required>
                </div>
              </div><br>

              <!-- Jenis Kelamin -->
              <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select class="form-select" name="gender" id="gender" required>
                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                    <option value="LAKI-LAKI">Laki-laki</option>
                    <option value="PEREMPUAN">Perempuan</option>
                  </select>
                </div>
              </div><br>

              <!-- Alamat -->
              <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat" class="form-control" id="alamat" required></textarea>
                </div>
              </div><br>

              <!-- Nomor Telepon -->
              <div class="form-group row">
                <label for="nomortelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="number" name="nomortelepon" class="form-control" id="nomortelepon" required>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="reset" class="btn btn-danger btn-block">
                        <span>Reset Data</span>
                      </button>
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="tambah" class="btn btn-success btn-block">
                        <span>Tambah Data</span>
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
  </body>
</html>