<?php
require_once('../../../../../vendor/autoload.php');
require_once('../../../../config.php');
require_once('../../../akses.php');

// form tambah data
if(isset($_POST['tambahfile'])) {
  $fileName	= $_FILES['excel']['tmp_name'];

  // get latest Nomor Induk Santri in database
  $queryCheck = "SELECT nis FROM santri WHERE nis LIKE '%$getYear%' ORDER BY nis DESC LIMIT 1";
  $resultCheck = mysqli_query($conn, $queryCheck);
  $dataCheck = mysqli_fetch_array($resultCheck, MYSQLI_ASSOC);
  $setNIS = $dataCheck['nis'];

  // Create a new Xls Reader
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

  // Load $inputFileName to a Spreadsheet Object
  $spreadsheet = $reader->load($fileName);
  $sheet = $spreadsheet->getActiveSheet()->toArray();
  
  foreach($sheet as $x => $excel) {
    // skip table head
    if($x == 0) {
      continue;
    }

    $setNIS = $setNIS+1;
    $data = "'";
    // set data

    $data .= $setNIS."','";
    $data .= addslashes($excel[1])."','";
    $data .= addslashes($excel[2])."','";
    $data .= addslashes($excel[3])."','";
    $data .= $excel[4]."','";
    $data .= $excel[5]."','";
    $data .= $excel[6]."','";
    $data .= addslashes($excel[7])."','";
    $data .= addslashes($excel[8])."','";
    $data .= addslashes($excel[9])."','";
    $data .= addslashes($excel[10])."','";
    $data .= "0".$excel[11]."','";
    $data .= addslashes($excel[12])."','";
    $data .= $excel[13]."','";
    $data .= "AKTIF"."','";
    $data .= date("Y-m-d")."'";

    $query = "INSERT INTO santri(`nis`, `nama_lengkap`, `panggilan`, `tempat_lahir`, `tgl_lahir`, `jenjang_sekolah`, `kelas`,
              `nama_bapak`, `pekerjaan_bapak`,`nama_ibu`, `pekerjaan_ibu`, `no_telp_ortu`, `alamat_ortu`, `infak_bulanan`, `status`, `tgl_daftar`)
              VALUES ($data)";
    $result = mysqli_query($conn, $query);
  }
  echo("<script>location.href = '/user/admin/santri/data-santri/santri.php';</script>");
}
?>

<!DOCTYPE html>
<html>
  <!-- form input -->
  <form method="post" enctype="multipart/form-data">

    <!-- File Excel -->
    <div class="form-group row">
      <label for="excel" class="col-sm-2 col-form-label">File Excel</label>
      <div class="col-sm-10">
        <div class="input-group">
          <input class="form-control" name="excel" id="excel" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" style="border-radius: 0.25rem" required>
          <a href="/assets/berkas/format.xlsx" class="btn btn-primary ms-3" target="_blank" style="border-radius: 0.25rem">
            <span>Unduh Format</span>
          </a>
        </div>
        <small class="form-text text-muted">
          * Tipe File: xlsx Ukuran Maksimal: 2MB
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
            <button type="submit" name="tambahfile" class="btn btn-success btn-block">
              <span>Tambah Data</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</html>