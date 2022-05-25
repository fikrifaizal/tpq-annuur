<?php
require_once('../../../config.php');

// connect & query database
$id = $_GET['id'];
$query = "SELECT * FROM `pengajar` WHERE `id` LIKE '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result, MYSQLI_ASSOC);

// danger modal
$setSecondDangerCondition = false;
$setSecondDangerText = "";

// get data from database
$nama = $data['nama'];
$gender = $data['jenis_kelamin'];
$alamat = $data['alamat'];
$telp = $data['no_telp'];
$sertifikat = $data['sertifikat'];

// form ubah data
if(isset($_POST['ubah'])) {
  // get data from form
  $nama = $_POST['nama'];
  $gender = $_POST['gender'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['nomortelepon'];
  $sertifikat = $_POST['sertifikat'];
  
  $query = "UPDATE `pengajar` SET 
            `nama`='$nama', `jenis_kelamin`='$gender', `alamat`='$alamat',
            `no_telp`='$telp', `sertifikat`='$sertifikat'
            WHERE `id` LIKE '$id'";
  $result = mysqli_query($conn, $query);

  $setSecondDangerCondition = true;
  $setSecondDangerText = "Data berhasil diubah";
}
// form hapus data
elseif(isset($_POST['hapus'])) {
  $query = "DELETE FROM `pengajar` WHERE `id` LIKE '$id'";
  $result = mysqli_query($conn, $query);
  
  $setSecondDangerCondition = true;
  $setSecondDangerText = "Data berhasil dihapus";
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
      include('../../layout/sidebar.html');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Update Data Santri</h3>
        <a href="/tpq-annuur/admin/data-pengasuh/pengasuh.php" class="btn btn-success btn-sm btn-back">
          <span><i class="bi bi-chevron-left"></i></span>
          <span>Kembali</span>
        </a>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- form input -->
            <form method="post">

              <!-- Nomor Induk -->
              <div class="form-group row">
                <label for="induk" class="col-sm-2 col-form-label">Nomor Induk</label>
                <div class="col-sm-10">
                  <input type="text" name="induk" class="form-control" id="induk" value="<?= $id?>" disabled>
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

              <!-- Sertifikat -->
              <div class="form-group row">
                <label for="sertifikat" class="col-sm-2 col-form-label">Sertifikat</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <input type="file" class="form-control" id="sertifikat" aria-describedby="fileSertifikat" aria-label="Upload">
                    <button class="btn btn-outline-secondary" type="button" id="fileSertifikat" disabled>Lihat File</button>
                  </div>
                </div>
              </div><br>

              <!-- Button -->
              <div class="form-group row">
                <label for="button" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="hapus" class="btn btn-danger btn-block">
                        <span><i class="bi "></i></span>
                        <span>Hapus Data</span>
                      </button>
                    </div>
                    <div class="col col-md-6 d-grid gap-2">
                      <button type="submit" name="ubah" class="btn btn-success btn-block">
                        <span><i class="bi "></i></span>
                        <span>Ubah Data</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <!-- Modal Danger -->
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <!-- selected data in select form -->
    <?php
      if($gender == "LAKI-LAKI") {
        echo '<script type="text/javascript">
                document.getElementById("gender").getElementsByTagName("option")[1].selected = "selected"
              </script>';
      } else {
        echo '<script type="text/javascript">
                document.getElementById("gender").getElementsByTagName("option")[2].selected = "selected"
              </script>';
      }
    ?>
    <script>

    </script>
  </body>
</html>