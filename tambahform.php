<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kasir</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-weight: bold;
            color: #343a40;
        }
        .btn-submit {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }
        .btn-submit:hover {
            background-color: #495057;
        }
        .home-icon {
            font-size: 24px;
            color: #343a40;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow-lg">
        <!-- Card Header with Home Icon -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tambah Anggota</h4>
            <!-- Home icon link to index.php -->
            <a href="index.php" class="home-icon" title="Kembali ke Home">
                <i class="bi bi-house-door-fill"></i>
            </a>
        </div>

        <div class="card-body">
            <?php
            require "koneksi.php";
            
            function input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $NIS = input($_POST["NIS"]);
                $namalengkap = input($_POST["namalengkap"]);
                $kelas = input($_POST["kelas"]);
                $nohp = input($_POST["nohp"]);
                $email = input($_POST["email"]);
                $alamat = input($_POST["alamat"]);

                $sql = "INSERT INTO tb_form (NIS, namalengkap, kelas, nohp, email, alamat) VALUES ('$NIS', '$namalengkap', '$kelas', '$nohp', '$email', '$alamat')";
                
                $hasil = mysqli_query($koneksi, $sql);

                if ($hasil) {
                    echo "<div class='alert alert-success mt-3'>Data berhasil disimpan.</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Data gagal disimpan.</div>";
                }
            }
            ?>

            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="form-group mb-3">
                    <label for="NIS" class="form-label">NIS:</label>
                    <input type="text" name="NIS" class="form-control" placeholder="Masukkan NIS Anda" required pattern="\d+" title="Hanya angka diperbolehkan" />
                </div>
                
                <div class="form-group mb-3">
                    <label for="namalengkap" class="form-label">Nama Lengkap:</label>
                    <input type="text" name="namalengkap" class="form-control" placeholder="Masukkan nama lengkap" required />
                </div>
                
                <div class="form-group mb-3">
                    <label for="kelas" class="form-label">Kelas:</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Masukkan kelas" required />
                </div>
                
                <div class="form-group mb-3">
                    <label for="nohp" class="form-label">No. Tlp:</label>
                    <input type="tel" name="nohp" class="form-control" placeholder="Masukkan no. telepon" required pattern="\d{10,15}" title="Harap masukkan no. telepon yang valid, 10-15 digit angka" />
                </div>
                
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required />
                </div>
                
                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat:</label>
                    <textarea name="alamat" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-submit btn-block mt-3">Simpan Data</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
