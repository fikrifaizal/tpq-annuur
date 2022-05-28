<?php
// menentukan tanggal akhir bulan
function lastOfMonth($month, $year) {
  return date("Y-m-d", strtotime('-1 second', strtotime('+1 month',strtotime($month . '/01/' . $year. ' 00:00:00'))));
}

// convert bulan ke int
function monthConverter($month) {
  $bulan = ["JANUARI","FEBRUARI","MARET","APRIL","MEI","JUNI","JULI","AGUSTUS","SEPTEMBER","OKTOBER","NOVEMBER","DESEMBER"];
  for($i=0; $i < count($bulan); $i++) {
    if(array_search($month, $bulan) == $i) {
      $i = $i+1;
      if($i < 10) {
        return "0".$i;
        break;
      } else {
        return $i;
        break;
      }
    }
  }
}

// mengganti bulan ke bahasa indonesia
function monthLocalization($month) {
  $english = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  $indonesia = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

  for($i=0; $i < count($english); $i++) {
    if(array_search($month, $english) == $i) {
      return $indonesia[$i];
      break;
    }
  }
}

// mengganti hari ke bahasa indonesia
function dayLocalization($day) {
  $english = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  $indonesia = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

  for($i=0; $i < count($english); $i++) {
    if(array_search($day, $english) == $i) {
      return $indonesia[$i];
      break;
    }
  }
}

function ifToday($month, $year) {
  $todayMonth = date('m');
  $todayYear = date('Y');
  if($month == $todayMonth && $year == $todayYear) {
    $today = dayLocalization(date('l')).", ".date('d')." ".monthLocalization(date('M'))." ".date('Y');
    return ["isToday"=>true, "date"=>"$today"];
  } else {
    return ["isToday"=>false, "date"=>""];
  }
}

// mendapatkan hari pada tanggal tertentu
function getDay($date) {
  return dayLocalization(date('l', strtotime($date)));
}

function defaultDateFormat($date) {
  $explode = explode(" ", $date);
  return $explode['3']."-".monthConverter(strtoupper($explode['2']))."-".$explode['1'];
}
?>