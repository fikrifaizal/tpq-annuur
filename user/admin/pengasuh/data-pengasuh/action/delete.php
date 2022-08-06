<?php
require_once('../../../../config.php');
require_once('../../../akses.php');
// set root
$root = realpath(dirname(__FILE__).'/../../../../../../assets');

if(isset($_GET['nip'])) {
  $nip = $_GET['nip'];

  $getFilesNameQuery = "SELECT `sertifikat`,`foto` FROM `pengajar` WHERE `nip` LIKE '$nip'";
  $getFilesNameResult = mysqli_query($conn, $getFilesNameQuery);
  $getFilesNameData = mysqli_fetch_array($getFilesNameResult, MYSQLI_ASSOC);

  $query = "DELETE FROM `pengajar` WHERE `nip` LIKE '$nip'";
  $result = mysqli_query($conn, $query);

  $directoryFoto = $root."/berkas/foto/";
  $directorySertif = $root."/berkas/sertifikat/";

  if($result) {
    if($getFilesNameData['foto'] != null) {
      $files = $directoryFoto.$getFilesNameData['foto'];

      // if exists maka hapus gambar
      if(file_exists($files)){
        unlink($files);
      }
    }
    if($getFilesNameData['sertifikat'] != null) {
      $files = $directorySertif.$getFilesNameData['sertifikat'];

      // if exists maka hapus sertifikat
      if(file_exists($files)){
        unlink($files);
      }
    }
  }

  header("Location: ../pengasuh.php");
} else {
  header("Location: ../pengasuh.php");
}
?>