<?php
include("koneksi.php");

if (isset($_POST['tambah'])) {
    $allowed_extensions = array('png', 'jpg', 'jpeg');
    $file_name = $_FILES['file']['name'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($file_extension, $allowed_extensions)) {
        if ($file_size < 1044070) {
            $upload_path = './image2/' . $file_name;
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Fixed SQL query to match column count
                $query = mysqli_query($koneksi, "INSERT INTO tb_galeri (gambar, tanggal) VALUES ('$file_name', NOW())");
                if ($query) {
                    // Redirect to galeritampil.php after successful insertion
                    header("Location: galeritampil.php");
                    exit(); // Ensure that the script stops after the redirect
                } else {
                    echo '<div class="alert alert-danger mt-3">Gagal menyimpan berita ke database.</div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-3">Gagal meng-upload gambar.</div>';
            }
        } else {
            echo '<div class="alert alert-warning mt-3">Ukuran file terlalu besar (maksimal 1 MB).</div>';
        }
    } else {
        echo '<div class="alert alert-warning mt-3">Ekstensi file tidak diperbolehkan. Hanya png, jpg, atau jpeg yang diizinkan.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Galeri</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="file" class="form-label">Gambar</label>
                            <input type="file" name="file" class="form-control" required>
                            <small class="form-text text-muted">Ekstensi yang diperbolehkan: .png, .jpg, .jpeg (maksimal 1 MB).</small>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-success w-100">Tambah Berita</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
