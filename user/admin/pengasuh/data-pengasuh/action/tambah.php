<?php
require_once('../../../../config.php');
require_once('../../../akses.php');
// set root
$root = realpath(dirname(__FILE__).'/../../../../../../assets');

$getYear = date("Y");

// danger alert
$setAlertCondition = false;
$setAlertText = "";
$setAlertText2 = "";

// form tambah data
if(isset($_POST['tambah'])) {
  // set Nomor Induk Pengasuh (NIP)
  $queryCheck = "SELECT nip FROM pengajar WHERE nip LIKE '%$getYear%' ORDER BY nip DESC LIMIT 1";
  $resultCheck = mysqli_query($conn, $queryCheck);
  $dataCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
  if(!empty($dataCheck['nip'])) {
    $setNIP = $dataCheck['nip']+1;
  } else {
    $setNIP = $getYear."01001";
  }

  $nama = addslashes($_POST['nama']);
  $gender = $_POST['gender'];
  $alamat = addslashes($_POST['alamat']);
  $telp = $_POST['nomortelepon'];

  $explodeName = explode(" ",strtolower($nama));
  $maximumSize	= 1048576; // 1 MB

  // file foto dan sertifikat
  if(!empty($_FILES['foto']['name']) && !empty($_FILES['sertifikat']['name'])) {
    $getEkstensiFoto = explode(".",$_FILES['foto']['name']);
    $getEkstensiFoto = end($getEkstensiFoto);
    $getEkstensiSertif = explode(".",$_FILES['sertifikat']['name']);
    $getEkstensiSertif = end($getEkstensiSertif);

    // checking size of file
    if($_FILES['foto']['size'] <= $maximumSize && $_FILES['sertifikat']['size'] <= $maximumSize) {
      $foto = "foto_".$setNIP."_".$explodeName[0].".$getEkstensiFoto";
      $sertifikat = "sertifikat_".$setNIP."_".$explodeName[0].".$getEkstensiSertif";
      $typeFoto = array("image/png","image/jpeg");
      $typeSertif = "application/pdf";
      $directoryFoto = $root."/berkas/foto/";
      $directorySertif = $root."/berkas/sertifikat/";

      // checking type of file
      if(in_array($_FILES['foto']['type'], $typeFoto) && ($_FILES['sertifikat']['type'] == $typeSertif)) {
        // checking if upload is success
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $directoryFoto.$foto) && move_uploaded_file($_FILES['sertifikat']['tmp_name'], $directorySertif.$sertifikat)) {
          // send data to db
          $query = "INSERT INTO `pengajar`(`nip`,`nama`,`jenis_kelamin`,`alamat`,`no_telp`,`sertifikat`,`foto`) VALUES ('$setNIP','$nama','$gender','$alamat','$telp','$sertifikat','$foto')";
          $result = mysqli_query($conn, $query);

          header("Location: ../pengasuh.php");
        } else {
          $setAlertCondition = true;
          $setAlertText = "File gagal di upload!";
          $setAlertText2 = "Silahkan coba kembali";
        }
      } else {
        $setAlertCondition = true;
        $setAlertText = "Tipe file salah!";
        $setAlertText2 = "Dimohon mengunggah file dengan tipe yang benar";
      }
    } else {
      $setAlertCondition = true;
      $setAlertText = "Ukuran file terlalu besar!";
      $setAlertText2 = "Ukuran maksimal adalah 1 MB";
    }
  }
  // file foto atau sertifikat
  elseif(!empty($_FILES['foto']['name']) || !empty($_FILES['sertifikat']['name'])) {
    if(!empty($_FILES['foto']['name'])) {
      $getEkstensi = explode(".",$_FILES['foto']['name']);
      $getEkstensi = end($getEkstensi);
      $filetmp = $_FILES['foto']['tmp_name'];
      $fileType = $_FILES['foto']['type'];
      $fileSize = $_FILES['foto']['size'];
      $setFileName = "foto_".$setNIP."_".$explodeName[0].".$getEkstensi";
      $type = array("image/png","image/jpeg");
      $directory = $root."/berkas/foto/";
      $query = "INSERT INTO `pengajar`(`nip`,`nama`,`jenis_kelamin`,`alamat`,`no_telp`,`sertifikat`,`foto`) VALUES ('$setNIP','$nama','$gender','$alamat','$telp','','$setFileName')";
    } else {
      $getEkstensi = explode(".",$_FILES['sertifikat']['name']);
      $getEkstensi = end($getEkstensi);
      $filetmp = $_FILES['sertifikat']['tmp_name'];
      $fileType = $_FILES['sertifikat']['type'];
      $fileSize = $_FILES['sertifikat']['size'];
      $setFileName = "sertifikat_".$setNIP."_".$explodeName[0].".$getEkstensi";
      $type = array("application/pdf");
      $directory = $root."/berkas/sertifikat/";
      $query = "INSERT INTO `pengajar`(`nip`,`nama`,`jenis_kelamin`,`alamat`,`no_telp`,`sertifikat`,`foto`) VALUES ('$setNIP','$nama','$gender','$alamat','$telp','$setFileName','')";
    }

    // checking size of file
    if($fileSize <= $maximumSize) {

      // checking type of file
      if(in_array($fileType, $type)) {
        $upload = move_uploaded_file($filetmp, $directory.$setFileName);

        // checking if upload is success
        if($upload) {
          // send data to db
          $result = mysqli_query($conn, $query);

          header("Location: ../pengasuh.php");
        } else {      
          $setAlertCondition = true;
          $setAlertText = "File gagal di upload!";
          $setAlertText2 = "Silahkan coba kembali";
        }
      } else {
        $setAlertCondition = true;
        $setAlertText = "Tipe file salah!";
        $setAlertText2 = "Dimohon mengunggah file dengan tipe yang benar";
      }
    } else {
      $setAlertCondition = true;
      $setAlertText = "Ukuran file terlalu besar!";
      $setAlertText2 = "Ukuran maksimal adalah 1 MB";
    }
  }
  else {
    $query = "INSERT INTO `pengajar`(`nip`,`nama`,`jenis_kelamin`,`alamat`,`no_telp`,`sertifikat`,`foto`) VALUES ('$setNIP','$nama','$gender','$alamat','$telp','','')";
    $result = mysqli_query($conn, $query);

    header("Location: ../pengasuh.php");
  }
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
        <h3>Tambah Data Pengasuh</h3>
        <a href="/user/admin/pengasuh/data-pengasuh/pengasuh.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>

        <!-- danger alert -->
        <div class="alert alert-danger alert-dismissible fade show" id="alert">
          <strong><?= $setAlertText?></strong> <?= $setAlertText2?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            <form method="post" enctype="multipart/form-data">

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
              </div><hr class="my-4">

              <!-- Foto -->
              <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input class="form-control" name="foto" id="formFoto" type="file" accept=".png,.jpg,.jpeg">
                  <small class="form-text text-muted">
                    * Tipe File: png, jpg, jpeg Ukuran Maksimal: 1MB (Boleh dikosongkan)
                  </small>
                </div>
              </div><br>

              <!-- Sertifikat -->
              <div class="form-group row">
                <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                <div class="col-sm-10">
                  <input class="form-control" name="sertifikat" id="formSertifikat" type="file" accept="application/pdf">
                  <small class="form-text text-muted">
                    * Tipe File: pdf Ukuran Maksimal: 1MB (Boleh dikosongkan)
                  </small>
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

    <!-- Javascript -->
    <!-- Show Alert -->
    <?php
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