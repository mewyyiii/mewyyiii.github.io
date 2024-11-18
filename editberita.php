<?php
include("koneksi.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='alert alert-danger'>Error: Tidak ada ID yang ditentukan!</div>";
    exit;
}

if (isset($_POST['edit'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $gb = $_FILES['file']['name'];
    $file_update = '';

    if (!empty($gb)) {
        $x = explode('.', $gb);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 1044070) {
                $file_update = './image/' . $gb;
                move_uploaded_file($file_tmp, $file_update);
            } else {
                echo '<div class="alert alert-warning">Ukuran file terlalu besar.</div>';
                exit;
            }
        } else {
            echo '<div class="alert alert-warning">Ekstensi file yang diupload tidak diperbolehkan.</div>';
            exit;
        }
    } else {
        $query = $koneksi->prepare("SELECT gambar FROM tb_berita WHERE idberita = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $file_update = $row['gambar'];
    }

    $qedit = $koneksi->prepare("UPDATE tb_berita SET judul = ?, isi = ?, gambar = ? WHERE idberita = ?");
    $qedit->bind_param("sssi", $judul, $isi, $file_update, $id);
    $result = $qedit->execute();

    if ($result) {
        echo '<div class="toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Data berhasil diupdate.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>';
        echo '<script>setTimeout(() => { window.location.href = "beritatampil.php"; }, 1500);</script>';
    } else {
        echo '<div class="alert alert-danger">Error updating record: ' . $koneksi->error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .img-preview {
            max-width: 200px;
            display: block;
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <a href="index.php" class="btn btn-outline-secondary mb-4">Home</a>
    <h3 class="text-center mb-4">Edit Berita</h3>

    <?php
    $query = $koneksi->prepare("SELECT * FROM tb_berita WHERE idberita = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $judul = $row['judul'];
        $isi = $row['isi'];
        $gmb = $row['gambar'];
    ?>
        <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" id="judul" value="<?php echo htmlspecialchars($judul); ?>" required>
                <div class="invalid-feedback">Silakan masukkan judul berita.</div>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea name="isi" class="form-control" id="isi" rows="5" required><?php echo htmlspecialchars($isi); ?></textarea>
                <div class="invalid-feedback">Silakan masukkan isi berita.</div>
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Saat Ini</label><br>
                <img src="./image/<?php echo htmlspecialchars($gmb); ?>" alt="Gambar Berita" class="img-thumbnail img-preview">
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Ganti Gambar</label>
                <input type="file" name="file" class="form-control" id="file" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                <div class="form-text">Format yang diperbolehkan: png, jpg, jpeg. Maksimal ukuran 1 MB.</div>
                <img id="preview" class="img-preview d-none">
            </div>

            <button type="submit" name="edit" class="btn btn-primary w-100">Update Berita</button>
            <a href="beritatampil.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
        </form>
    <?php
    } else {
        echo "<div class='alert alert-danger'>Error: Tidak ada data ditemukan!</div>";
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Bootstrap validation
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

    // Image preview
    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.classList.remove('d-none');
    }

    // Show toast notification
    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    const toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    toastList.forEach(toast => toast.show());
</script>
</body>
</html>
