<?php
include_once('../../config.php');

// connect & query database
$nis = $_GET['nis'];
$query = "SELECT santri.nama_lengkap as nama, jenjang.jenjang as jenjang, penilaian.jenjang_id as jenjang_id FROM `penilaian`
          LEFT JOIN `santri` ON penilaian.santri_induk = santri.induk
          LEFT JOIN `jenjang` ON penilaian.jenjang_id = jenjang.id
          WHERE `santri_induk` LIKE '$nis'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);

// get data from database
$namaLengkap = $data['nama'];
$jenjang = ucfirst(strtolower($data['jenjang']));

if(isset($_POST['belumlulus'])) {
  $tanggal = $_POST['tanggal'];
  $keterangan = "Belum Lulus";
  
  $query = "UPDATE penilaian SET `tanggal`='$tanggal', `keterangan`='$keterangan' WHERE `santri_induk` LIKE '$nis'";
  $result = mysqli_query($conn, $query);

  header("Location: penilaian.php");
}
elseif(isset($_POST['lulus'])) {
  $tanggal = $_POST['tanggal'];
  $keterangan = "Lulus";
  
  $query = "UPDATE penilaian SET `tanggal`='$tanggal', `keterangan`='$keterangan' WHERE `santri_induk` LIKE '$nis'";
  $result = mysqli_query($conn, $query);
  

  $newJenjang = $data['jenjang_id'] + 1;
  $newKeterangan = "Belum Lulus";
  $newQuery = "INSERT INTO penilaian(`santri_induk`, `jenjang_id`, `tanggal`, `keterangan`) VALUES ('$nis', '$newJenjang', '$tanggal', '$newKeterangan')";
  $newResult = mysqli_query($conn, $newQuery);

  header("Location: penilaian.php");
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
        <h3>Detail Penilaian Santri</h3>
        <a href="penilaian.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post">

              <!-- NIS -->
              <div class="form-group row">
                <label for="nis" class="col-sm-2 col-form-label">Nomor Induk Santri</label>
                <div class="col-sm-10">
                  <input type="text" name="nis" class="form-control" id="nis" value="<?= $nis;?>" disabled>
                </div>
              </div><br>

              <!-- Nama -->
              <div class="form-group row">
                <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" value="<?= $namaLengkap;?>" disabled>
                </div>
              </div><br>

              <!-- Jilid -->
              <div class="form-group row">
                <label for="jilid" class="col-sm-2 col-form-label">Jilid Awal</label>
                <div class="col-sm-10">
                  <input type="text" name="jilid" class="form-control" id="jilid" value="<?= $jenjang;?>" disabled>
                </div>
              </div>

              <!-- divider -->
              <hr class="my-4">

              <!-- Tanggal -->
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Sekarang</label>
                <div class="col-sm-10">
                  <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                </div>
              </div><br>

              <!-- Penguji -->
              <div class="form-group row">
                <label for="penguji" class="col-sm-2 col-form-label">Penguji</label>
                <div class="col-sm-10">
                  <input type="text" name="penguji" class="form-control" id="penguji" disabled>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="belumlulus" class="btn btn-danger btn-block">
                        <span><i class="bi "></i></span>
                        <span>Belum Lulus</span>
                      </button>
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="lulus" class="btn btn-success btn-block">
                        <span><i class="bi bi-check"></i></span>
                        <span>Lulus</span>
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
    <script>
    </script>
  </body>
</html>