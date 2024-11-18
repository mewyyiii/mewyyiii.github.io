<?php
require "koneksi.php";

$id = $_GET['id'] ?? null; // Make $id globally accessible

if ($id) {
    $query = mysqli_query($koneksi, "SELECT * FROM tb_form WHERE id = '$id'");
    $data = mysqli_fetch_array($query);
}

if (isset($_POST['update']) && $id) { // Check if $id exists
    $NIS = $_POST['NIS'];
    $namalengkap = $_POST['namalengkap'];
    $kelas = $_POST['kelas'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $query = mysqli_query($koneksi, "UPDATE tb_form SET NIS = '$NIS', namalengkap = '$namalengkap', kelas = '$kelas', nohp = '$nohp', email = '$email', alamat = '$alamat' WHERE id = '$id'");

    if ($query) {
        echo '<div class="toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        Data berhasil diupdate.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>';
        echo '<script>setTimeout(() => { window.location.href = "forms.php"; }, 1500);</script>';
    } else {
        echo '<div class="alert alert-danger">Error updating record: ' . mysqli_error($koneksi) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .toast {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card p-4">
        <a href="index.php" class="btn btn-outline-secondary mb-4">Home</a>
        <h3 class="text-center mb-4">Edit Anggota</h3>
        <form method="POST" action="" class="needs-validation" novalidate>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="NIS" class="form-label">NIS</label>
                    <input type="text" name="NIS" class="form-control" id="NIS" placeholder="Masukkan NIS" value="<?php echo htmlspecialchars($data['NIS']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan NIS.</div>
                </div>
                <div class="col-md-6">
                    <label for="namalengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="namalengkap" class="form-control" id="namalengkap" placeholder="Masukkan Nama Lengkap" value="<?php echo htmlspecialchars($data['namalengkap']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan nama lengkap.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" id="kelas" placeholder="Masukkan Kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan kelas.</div>
                </div>
                <div class="col-md-6">
                    <label for="nohp" class="form-label">No.Telp</label>
                    <input type="text" name="nohp" class="form-control" id="nohp" placeholder="Masukkan No. Telepon" value="<?php echo htmlspecialchars($data['nohp']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan nomor telepon.</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan email yang valid.</div>
                </div>
                <div class="col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required>
                    <div class="invalid-feedback">Silakan masukkan alamat.</div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
                <a href="forms.php" class="btn btn-outline-secondary w-100 mt-2">Kembali</a>
            </div>
        </form>
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
    })()

    const toastElList = [].slice.call(document.querySelectorAll('.toast'))
    const toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    toastList.forEach(toast => toast.show());
</script>
</body>
</html>
