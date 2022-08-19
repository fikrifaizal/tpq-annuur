<?php
include_once('../../../config.php');
require_once('../../akses.php');

if(isset($_GET['induk'])) {
  $induk = $_GET['induk'];
  $jilidAwal = $_GET['jilid'];

  // cek penilaian
  $cekQuery = "SELECT EXISTS
              (SELECT id FROM `penilaian` WHERE `santri_induk` LIKE '$induk' AND jenjang_id LIKE '$jilidAwal')
              as ket";
  $cekResult = mysqli_query($conn, $cekQuery);
  $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

  if($cekData['ket'] == 0) {
    // make new data penilaian
    $query = "INSERT INTO `penilaian`(`santri_induk`, `jenjang_id`, `tanggal`, `keterangan`, `pengajar_id`) VALUES ('$induk', '10', '2022-01-01', 'BELUM UJIAN', '0')";
    $result = mysqli_query($conn, $query);
  }

  // connect & query database
  $query = "SELECT santri.nama_lengkap as nama_lengkap, jenjang.jenjang as jenjang, penilaian.jenjang_id as jenjang_id FROM `penilaian`
            LEFT JOIN `santri` ON penilaian.santri_induk = santri.induk
            LEFT JOIN `jenjang` ON penilaian.jenjang_id = jenjang.id
            WHERE penilaian.santri_induk LIKE '$induk' AND penilaian.jenjang_id LIKE '$jilidAwal'";
  $result = mysqli_query($conn, $query);
  $data = mysqli_fetch_array($result, MYSQLI_ASSOC);

  // get data from database
  $namaLengkap = $data['nama_lengkap'];
  $jenjangAwal = ucwords(strtolower($data['jenjang']));

  // button trigger
  if(isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $pengajar = $_POST['penguji'];

    $query = "UPDATE `penilaian` SET `tanggal`='$tanggal', `keterangan`='LULUS', `pengajar_id`='$pengajar' WHERE `santri_induk` LIKE '$induk' AND `jenjang_id` LIKE '$jilidAwal'";
    $result = mysqli_query($conn, $query);

    $newJenjang = $_POST['jilid'];
    $newQuery = "INSERT INTO `penilaian`(`santri_induk`, `jenjang_id`, `tanggal`, `keterangan`, `pengajar_id`) VALUES ('$induk', '$newJenjang', '$tanggal', 'BELUM UJIAN', '$pengajar')";
    $newResult = mysqli_query($conn, $newQuery);

    header("Location: penilaian.php");
  }
} else {
  header("Location: penilaian.php");
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
      include('../../layout/sidebar.php');
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
                  <input type="text" name="nis" class="form-control" id="nis" value="<?= $induk?>" disabled>
                </div>
              </div><br>

              <!-- Nama -->
              <div class="form-group row">
                <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                  <input type="text" name="namaLengkap" class="form-control" id="namaLengkap" value="<?= $namaLengkap?>" disabled>
                </div>
              </div><br>

              <!-- Jilid Awal -->
              <div class="form-group row">
                <label for="jilid" class="col-sm-2 col-form-label">Jilid Awal</label>
                <div class="col-sm-10">
                  <input type="text" name="jilid" class="form-control" id="jilid" value="<?= $jenjangAwal?>" disabled>
                </div>
              </div>

              <!-- divider -->
              <hr class="my-4">

              <!-- Jilid Akhir -->
              <div class="form-group row">
                <label for="jilid" class="col-sm-2 col-form-label">Jilid Akhir</label>
                <div class="col-sm-10">
                  <select class="form-select" name="jilid" id="jilid" required>
                    <option value="" selected disabled>Pilih Jilid Akhir</option>
                    <option value="0">Pra TK</option>
                    <option value="1">Jilid 1</option>
                    <option value="2">Jilid 2</option>
                    <option value="3">Jilid 3</option>
                    <option value="4">Jilid 4</option>
                    <option value="5">Jilid 5</option>
                    <option value="6">Jilid 6</option>
                    <option value="7">Al Qur'an</option>
                    <option value="8">Ghorib</option>
                  </select>
                </div>
              </div><br>

              <!-- Tanggal -->
              <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Penilaian</label>
                <div class="col-sm-10">
                  <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                </div>
              </div><br>

              <!-- Penguji -->
              <div class="form-group row">
                <label for="penguji" class="col-sm-2 col-form-label">Penguji</label>
                <div class="col-sm-10">
                  <select class="form-select" name="penguji" id="penguji" required>
                    <option value="" selected disabled>Pilih Nama Penguji</option>
                    <?php
                      $queryPenguji = "SELECT `id`,`nama` FROM `pengajar` WHERE `status` NOT LIKE 'HIDDEN' ORDER BY `nip`";
                      $resultPenguji = mysqli_query($conn, $queryPenguji);

                      while($dataPenguji = mysqli_fetch_array($resultPenguji, MYSQLI_ASSOC)){
                        echo "<option value='".$dataPenguji['id']."'>".$dataPenguji['nama']."</option>";
                      }
                    ?>
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
                      <button type="submit" name="simpan" class="btn btn-success btn-block">
                        <span>Simpan</span>
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