<?php
include("koneksi.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<div class='alert alert-danger'>Error: Tidak ada ID yang ditentukan!</div>";
    exit;
}

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $kelas = $_POST['kelas'];

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
                $file_update = './image1/' . $gb;
                move_uploaded_file($file_tmp, $file_update);
            } else {
                echo '<div class="alert alert-warning">Ukuran file terlalu besar.</div>';
                exit;
            }
        } else {
            echo '<div class="alert alert-warning">Ekstensi file tidak diperbolehkan.</div>';
            exit;
        }
    } else {
        $query = $koneksi->prepare("SELECT gambar FROM tb_organisasi WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $file_update = $row['gambar'];
    }

    $qedit = $koneksi->prepare("UPDATE tb_organisasi SET nama = ?, jabatan = ?, kelas = ?, gambar = ? WHERE id = ?");
    $qedit->bind_param("ssssi", $nama, $jabatan, $kelas, $file_update, $id);
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
        echo '<script>setTimeout(() => { window.location.href = "organisasitampil.php"; }, 1500);</script>';
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
    <title>Edit Organisasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            margin: auto;
        }
        .toast {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .back-icon {
            font-size: 24px;
            color: #6c757d;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Back icon inside card -->
            <a href="organisasitampil.php" class="back-icon" title="Kembali ke Daftar Organisasi">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            <h3 class="text-center mb-0">Edit Organisasi</h3>
        </div>

        <?php
        $query = $koneksi->prepare("SELECT * FROM tb_organisasi WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $nama = $row['nama'];
            $jabatan = $row['jabatan'];
            $kelas = $row['kelas'];
            $gmb = $row['gambar'];
        ?>
            <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="<?php echo htmlspecialchars($nama); ?>" required>
                    <div class="invalid-feedback">
                        Silakan masukkan nama.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" id="jabatan" value="<?php echo htmlspecialchars($jabatan); ?>" required>
                    <div class="invalid-feedback">
                        Silakan masukkan jabatan.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" id="kelas" value="<?php echo htmlspecialchars($kelas); ?>" required>
                    <div class="invalid-feedback">
                        Silakan masukkan kelas.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar Saat Ini</label><br>
                    <img src="./image1/<?php echo htmlspecialchars($gmb); ?>" alt="Gambar Organisasi" class="img-thumbnail mb-3" style="max-width: 200px;" id="currentImage">
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Ganti Gambar</label>
                    <input type="file" name="file" class="form-control" id="file" accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                    <div class="form-text">Format yang diperbolehkan: png, jpg, jpeg. Maksimal ukuran 1 MB.</div>
                    <img id="preview" class="img-thumbnail mt-2" style="display: none; max-width: 200px;">
                </div>

                <button type="submit" name="edit" class="btn btn-primary w-100">Update Organisasi</button>
                
            </form>
        <?php
        } else {
            echo "<div class='alert alert-danger'>Error: Tidak ada data ditemukan!</div>";
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
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
    })();

    function previewImage(event) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }
</script>
</body>
</html>
