<?php
include_once('../../config.php');
$query = "SELECT penilaian.santri_induk as nis, santri.nama_lengkap as nama, jenjang.jenjang as jenjang FROM `penilaian`
          LEFT JOIN `santri` ON penilaian.santri_induk = santri.induk
          LEFT JOIN `jenjang` ON penilaian.jenjang_id = jenjang.id
          WHERE penilaian.keterangan LIKE '%Belum Lulus%'";

$result = mysqli_query($conn, $query);

// filter
if(!empty($_GET['filter'])) {
  $filter = $_GET['filter'];
  $query = "SELECT santri.induk as nis, santri.nama_lengkap as nama, jenjang.jenjang as jenjang FROM `penilaian`
  LEFT JOIN `santri` ON penilaian.santri_induk = santri.induk
  LEFT JOIN `jenjang` ON penilaian.jenjang_id = jenjang.id
  WHERE penilaian.keterangan LIKE '%Belum Lulus%' && penilaian.jenjang_id LIKE '$filter'";

  $result = mysqli_query($conn, $query);
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
        <h3>Penilaian Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- filter jilid -->
            <div class="btn-group">
              <button class="btn btn-filter dropdown-toggle" type="button" id="dropdownFilterJilid" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                Filter Jilid
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownFilterJilid">
                <li><h6 class="dropdown-header">Pilih Jilid</h6></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=1">Jilid 1</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=2">Jilid 2</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=3">Jilid 3</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=4">Jilid 4</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=5">Jilid 5</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=6">Jilid 6</a></li>
                <li><a class="dropdown-item" href="penilaian.php?filter=7">Al Qur'an</a></li>
              </ul>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jilid Awal</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $count = 0;
                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo "<tr class='text-center align-middle'><th>".($count+1)."</th>";
                      echo "<td>".$data['nama']."</td>";
                      echo "<td>".ucfirst(strtolower($data['jenjang']))."</td>";?>
                      <td>
                        <a type="button" class="btn btn-success btn-sm" href="detail-penilaian.php?nis=<?= $data['nis'];?>">Nilai</a>
                      </td></tr><?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Javascript -->
    <script>
    </script>
  </body>
</html>