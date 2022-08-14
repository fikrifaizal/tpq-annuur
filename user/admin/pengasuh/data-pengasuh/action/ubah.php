<?php
require_once('../../../../config.php');
require_once('../../../akses.php');
// set root
$root = realpath(dirname(__FILE__).'/../../../../../../assets');

// danger alert
$setAlertCondition = false;
$setAlertText = "";
$setAlertText2 = "";

if(isset($_GET['nip'])) {
  // connect & query database
  $nip = $_GET['nip'];
  $query = "SELECT * FROM `pengajar` WHERE `nip` LIKE '$nip'";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

  // setup button foto & sertifikat
  $setFotoDir = $setSertifDir = "";
  $foto = $sertifikat = "";
  $fotoText = $sertifText = "Tidak Ada File";
  $fotoDisabled = $sertifDisabled = "disabled";
  if(!empty($data['foto'])) {
    $foto = $data['foto'];
    $setFotoDir = "https://assets.masjidannuur.org/berkas/foto/".$foto;
    $fotoText = "Lihat File";
    $fotoDisabled = "";
  }
  if(!empty($data['sertifikat'])) {
    $sertifikat = $data['sertifikat'];
    $setSertifDir = "https://assets.masjidannuur.org/berkas/sertifikat/".$sertifikat;
    $sertifText = "Lihat File";
    $sertifDisabled = "";
  }
  
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
        $foto = "foto_".$nip."_".$explodeName[0].".$getEkstensiFoto";
        $sertifikat = "sertifikat_".$nip."_".$explodeName[0].".$getEkstensiSertif";
        $typeFoto = array("image/png","image/jpeg");
        $typeSertif = "application/pdf";
        $directoryFoto = $root."/berkas/foto/";
        $directorySertif = $root."/berkas/sertifikat/";

        // checking type of file
        if(in_array($_FILES['foto']['type'], $typeFoto) && ($_FILES['sertifikat']['type'] == $typeSertif)) {
          // checking if upload is success
          if(move_uploaded_file($_FILES['foto']['tmp_name'], $directoryFoto.$foto) && move_uploaded_file($_FILES['sertifikat']['tmp_name'], $directorySertif.$sertifikat)) {
            // send data to db
            $query = "UPDATE `pengajar` SET `nama`='$nama',`jenis_kelamin`='$gender',`alamat`='$alamat',
                      `no_telp`='$telp',`sertifikat`='$sertifikat',`foto`='$foto',`status`='$status' WHERE `nip` LIKE '$nip'";
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
        $setFileName = "foto_".$nip."_".$explodeName[0].".$getEkstensi";
        $type = array("image/png","image/jpeg");
        $directory = $root."/berkas/foto/";
        $query = "UPDATE `pengajar` SET `nama`='$nama',`jenis_kelamin`='$gender',`alamat`='$alamat',
                  `no_telp`='$telp',`foto`='$setFileName',`status`='$status' WHERE `nip` LIKE '$nip'";
      } else {
        $getEkstensi = explode(".",$_FILES['sertifikat']['name']);
        $getEkstensi = end($getEkstensi);
        $filetmp = $_FILES['sertifikat']['tmp_name'];
        $fileType = $_FILES['sertifikat']['type'];
        $fileSize = $_FILES['sertifikat']['size'];
        $setFileName = "sertifikat_".$nip."_".$explodeName[0].".$getEkstensi";
        $type = array("application/pdf");
        $directory = $root."/berkas/sertifikat/";
        $query = "UPDATE `pengajar` SET `nama`='$nama',`jenis_kelamin`='$gender',`alamat`='$alamat',
                  `no_telp`='$telp',`sertifikat`='$setFileName',`status`='$status' WHERE `nip` LIKE '$nip'";
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
      $query = "UPDATE `pengajar` SET `nama`='$nama',`jenis_kelamin`='$gender',
                `alamat`='$alamat',`no_telp`='$telp',`status`='$status' WHERE `nip` LIKE '$nip'";
      $result = mysqli_query($conn, $query);
  
      header("Location: ../pengasuh.php");
    }
  }
} else {
  header("Location: ../pengasuh.php");
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
        <h3>Update Data Pengasuh</h3>
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

            <!-- form input -->
            <form method="post" enctype="multipart/form-data">

              <!-- Nomor Induk -->
              <div class="form-group row">
                <label for="induk" class="col-sm-2 col-form-label">Nomor Induk</label>
                <div class="col-sm-10">
                  <input type="text" name="induk" class="form-control" id="induk" value="<?= $nip?>" disabled>
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
              </div><hr class="my-4">

              <!-- Foto -->
              <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input class="form-control" name="foto" id="formFoto" type="file" accept=".png,.jpg,.jpeg" style="border-radius: 0.25rem">
                    <a href="<?= $setFotoDir?>" class="btn btn-primary ms-3 <?= $fotoDisabled?>" target="_blank" style="border-radius: 0.25rem" aria-disabled="true">
                      <span><?= $fotoText?></span>
                    </a>
                  </div>
                  <small class="form-text text-muted">
                    * Tipe File: png, jpg, jpeg Ukuran Maksimal: 1MB || Kosongkan jika tidak ingin mengganti file foto
                  </small>
                </div>
              </div><br>

              <!-- Sertifikat -->
              <div class="form-group row">
                <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input class="form-control" name="sertifikat" id="formSertifikat" type="file" accept="application/pdf" style="border-radius: 0.25rem" >
                    <a href="<?= $setSertifDir?>" class="btn btn-primary ms-3 <?= $sertifDisabled?>" target="_blank" style="border-radius: 0.25rem" aria-disabled="true">
                      <span><?= $sertifText?></span>
                    </a>
                  </div>
                  <small class="form-text text-muted">
                    * Tipe File: pdf Ukuran Maksimal: 1MB || Kosongkan jika tidak ingin mengganti file sertifikat
                  </small>
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
    <script>

    </script>
  </body>
</html>