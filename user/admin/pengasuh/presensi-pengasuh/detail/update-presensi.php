<?php
require_once('../../../../config.php');
require_once('../../../akses.php');

if(isset($_GET['id']) && isset($_GET['induk'])) {
  $id = $_GET['id'];
  $induk = $_GET['induk'];
  $keterangan = $_GET['ket'];
  $tanggal = $_GET['tgl'];
  
  $dateExplode = explode("-",$tanggal);
  $filterDate = $dateExplode[2];
  
  $action = $_GET['action'];
  if($action == "insert") {
    if($keterangan == 1) {
      $queryRalat = "INSERT INTO `presensi_pengajar`(`pengajar_id`,`filter_id`,`keterangan`,`tanggal`) VALUES ('$induk','$id','HADIR','$tanggal')";
      $resultRalat = mysqli_query($conn, $queryRalat);
    
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    elseif($keterangan == 0) {
      $queryRalat = "INSERT INTO `presensi_pengajar`(`pengajar_id`,`filter_id`,`keterangan`,`tanggal`) VALUES ('$induk','$id','TIDAK HADIR','$tanggal')";
      $resultRalat = mysqli_query($conn, $queryRalat);
      
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    else {
      header("Location: ../presensi.php");
    }
  }
  elseif($action == "update") {
    if($keterangan == 1) {
      $queryRalat = "UPDATE `presensi_pengajar` SET `keterangan`='HADIR' WHERE `pengajar_id` LIKE '$induk' AND `tanggal` LIKE '$tanggal'";
      $resultRalat = mysqli_query($conn, $queryRalat);
    
      header("Location: detail-presensi.php?id=$id&tgl=$filterDate");
    }
    elseif($keterangan == 0) {
      $queryRalat = "UPDATE `presensi_pengajar` SET `keterangan`='TIDAK HADIR' WHERE `pengajar_id` LIKE '$induk' AND `tanggal` LIKE '$tanggal'";
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