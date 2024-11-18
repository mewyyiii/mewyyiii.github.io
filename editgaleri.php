<?php
include("koneksi.php");

// Cek apakah parameter "id" ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "<div class='alert alert-danger'>Error: Tidak ada ID yang ditentukan!</div>";
    exit;
}

if (isset($_POST['edit'])) {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $gb = $_FILES['file']['name'];
    $x = explode('.', $gb);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, './image2/' . $gb);

            // Gunakan prepared statement untuk mencegah SQL injection
            $qedit = $koneksi->prepare("UPDATE tb_galeri SET gambar = ? WHERE id = ?");
            $result = $qedit->execute();

            if ($result) {
                echo '<div class="alert alert-success">File berhasil diupload.</div>';
            } else {
                echo '<div class="alert alert-danger">Gagal mengupload gambar.</div>';
            }
        } else {
            echo '<div class="alert alert-warning">Ukuran file terlalu besar.</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Ekstensi file yang diupload tidak diperbolehkan.</div>';
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-secondary mb-4">Home</a>
    <h3 class="text-center mb-4">Edit Galeri</h3>

    <?php
    // Mengambil data yang ada menggunakan ID yang disediakan
    $query = $koneksi->prepare("SELECT * FROM tb_galeri WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $gmb = $row['gambar'];
    ?>
        <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Saat Ini</label><br>
                <img src="./image/<?php echo $gmb; ?>" alt="Gambar Berita" class="img-thumbnail" style="max-width: 200px;">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Ganti Gambar</label>
                <input type="file" name="file" class="form-control" id="file" accept=".png, .jpg, .jpeg">
                <div class="form-text">Format yang diperbolehkan: png, jpg, jpeg. Maksimal ukuran 1 MB.</div>
            </div>

            <button type="submit" name="edit" class="btn btn-primary">Update Berita</button>
            <a href="galeritampil.php" class="btn btn-secondary">Kembali</a>
        </form>
    <?php
    } else {
        echo "<div class='alert alert-danger'>Error: Tidak ada data ditemukan!</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Script untuk validasi Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
</body>
</html>
