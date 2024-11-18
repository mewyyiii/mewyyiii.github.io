<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Daftar Berita</title>
    <style>
        .container { 
            max-width: 900px; 
        }
        .form-control, .btn {
            border-radius: 8px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .btn-action {
            margin-right: 5px;
        }
        .truncate-text {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Berita</h2>

    <!-- Search Form -->
    <form action="" method="post" class="mb-4">
        <div class="row g-2">
            <div class="col-md-8">
                <input type="text" name="pencarian" placeholder="Pencarian berita" class="form-control" value="<?php echo isset($_POST['pencarian']) ? $_POST['pencarian'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <input type="submit" name="dicari" value="Cari" class="btn btn-success w-100">
            </div>
        </div>
    </form>

    <!-- News Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Isi</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 require "koneksi.php";

                 if (isset($_POST['dicari']) && !empty($_POST['pencarian'])) {
                    // Secure input
                    $pencarian = mysqli_real_escape_string($koneksi, $_POST['pencarian']);
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_berita WHERE judul LIKE '%$pencarian%' ORDER BY idberita DESC");
                } else {
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_berita ORDER BY idberita DESC");
                }
                 $no=1;
                 while ($data = mysqli_fetch_array($sql)){
                ?>
                 <tr>
                    <td><?php echo $no++ ?></td>
                    <td class="truncate-text"><?php echo $data['judul'] ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    <td class="truncate-text"><?php echo $data['isi'] ?></td>
                    <td class="truncate-text"><?php echo $data['gambar'] ?></td>
                    <td>
                        <a href="editberita.php?id=<?php echo $data['idberita']; ?>" class="btn btn-warning btn-sm btn-action">Edit</a>
                        <a href="hapusberita.php?id=<?php echo $data['idberita']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php
                     }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add News Button -->
    <div class="text-end mt-3">
        <a href="tambahberita.php" class="btn btn-dark">Tambah Data</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
