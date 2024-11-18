<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Daftar Anggota</title>
</head>
<body>

<div class="container my-4">
    <!-- Form Pencarian -->
    <form action="" method="post">
        <div class="row mb-3">
            <div class="col-md-8">
                <input type="text" name="pencarian" placeholder="Cari anggota berdasarkan nama" class="form-control" value="<?php echo isset($_POST['pencarian']) ? $_POST['pencarian'] : ''; ?>">
            </div>
            <div class="col-md-4">
                <input type="submit" name="dicari" value="Cari" class="btn btn-success w-100">
            </div>
        </div>
    </form>

    <!-- Tabel Daftar Anggota -->
    <div class="container-fluid">
        <h2 class="mb-4 text-center">Daftar Anggota</h2>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "koneksi.php";
                $no = 1;
                if (isset($_POST['dicari']) && !empty($_POST['pencarian'])) {
                    $pencarian = mysqli_real_escape_string($koneksi, $_POST['pencarian']);
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_form WHERE namalengkap LIKE '%$pencarian%' ORDER BY id DESC");
                } else {
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_form");
                }

                if (mysqli_num_rows($sql) > 0) {
                    while ($data = mysqli_fetch_array($sql)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['NIS']; ?></td>
                            <td><?php echo $data['namalengkap']; ?></td>
                            <td><?php echo $data['kelas']; ?></td>
                            <td><?php echo $data['nohp']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td>
                        <a href="editform.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm btn-action">Edit</a>
                        <a href="hapusform.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr><td colspan="8" class="text-center text-danger">Data tidak ditemukan.</td></tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Tombol Tambah Anggota -->
        <div class="text-end mt-4">
            <a href="tambahform.php" class="btn btn-dark">Tambah Anggota</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
