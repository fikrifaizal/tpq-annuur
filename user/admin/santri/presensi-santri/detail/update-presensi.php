<?php
require_once('../../../../config.php');
require_once('../../../akses.php');

if(isset($_GET['id']) && isset($_GET['nis'])) {
  $id = $_GET['id'];
  $nis = $_GET['nis'];
  $keterangan = $_GET['ket'];
  $tanggal = $_GET['tgl'];
  
  $dateExplode = explode("-",$tanggal);
  $filterDate = $dateExplode[2];
  
  $action = $_GET['action'];
  if($action == "insert") {
    if($keterangan == 1) {
      $queryRalat = "INSERT INTO `presensi_santri`(`santri_induk`,`filter_id`,`keterangan`,`tanggal`) VALUES ('$nis','$id','HADIR','$tanggal')";
      $resultRalat = mysqli_query($conn, $queryRalat);
    
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    elseif($keterangan == 0) {
      $queryRalat = "INSERT INTO `presensi_santri`(`santri_induk`,`filter_id`,`keterangan`,`tanggal`) VALUES ('$nis','$id','TIDAK HADIR','$tanggal')";
      $resultRalat = mysqli_query($conn, $queryRalat);
      
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    else {
      header("Location: ../presensi.php");
    }
  }
  elseif($action == "update") {
    if($keterangan == 1) {
      $queryRalat = "UPDATE `presensi_santri` SET `keterangan`='HADIR' WHERE `santri_induk` LIKE '$induk' AND `tanggal` LIKE '$tanggal'";
      $resultRalat = mysqli_query($conn, $queryRalat);
    
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    elseif($keterangan == 0) {
      $queryRalat = "UPDATE `presensi_santri` SET `keterangan`='TIDAK HADIR' WHERE `santri_induk` LIKE '$induk' AND `tanggal` LIKE '$tanggal'";
      $resultRalat = mysqli_query($conn, $queryRalat);
      
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    else {
      header("Location: ../presensi.php");
    }
  }
  else {
    header("Location: ../presensi.php");
  }
} else {
  header("Location: ../presensi.php");
}

?>