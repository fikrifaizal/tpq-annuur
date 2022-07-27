<?php
require_once('../../../config.php');
require_once('../../akses.php');

// connect & query database
$query = "SELECT * FROM `piket`";
$result = mysqli_query($conn, $query);
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
        <h3>Data Petugas</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            <!-- button tambah data -->
            <div>
              <a href="action/tambah.php" class="btn btn-success">
                <span>Tambah Data Petugas</span>
              </a>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">Nomor Induk Piket</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col" width="15%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo "<tr class='text-center align-middle'><td>".$data['nipt']."</td>";
                      echo "<td class='text-start'>".$data['nama']."</td>";
                      echo "<td>".$data['no_telp']."</td>";?>
                      <!-- button trigger modal detail -->
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail" data-bs-toggle="modal" data-bs-target="#detailModal<?= $data['nipt']?>">
                          <span><i class="bi bi-journal"></i><span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModalDanger<?= $data['nipt']?>">
                          <span><i class="bi bi-trash"></i><span>
                        </button>
                      </td></tr>
                      
                      <!-- Modal Detail -->
                      <div class="modal fade" id="detailModal<?=$data['nipt']?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Data Lengkap Petugas</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <label class="col-sm-5">Nomor Induk Piket</label>
                                <p class="col-sm-7"><?= $data['nipt']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Lengkap</label>
                                <p class="col-sm-7"><?= $data['nama']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Jenis Kelamin</label>
                                <p class="col-sm-7"><?= ucfirst(strtolower($data['jenis_kelamin']))?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Alamat</label>
                                <p class="col-sm-7"><?= $data['alamat']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nomor Telepon</label>
                                <p class="col-sm-7"><?= $data['no_telp']?></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a role="button" class="btn btn-warning" href="action/ubah.php?nipt=<?= $data['nipt']?>">Edit</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal Danger -->
                      <div class="modal fade" tabindex="-1" id="deleteModalDanger<?= $data['nipt']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Peringatan!</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <span>Apakah anda yakin untuk menghapus data ini?</span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                              <a href="action/delete.php?nipt=<?= $data['nipt']?>" class="btn btn-danger">
                                <span>Hapus</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div><?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
</html>