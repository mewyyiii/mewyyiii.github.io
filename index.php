<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Style the navbar and content */
        .bg-company-red { background-color: #d9534f; }
        .nav-link { color: white !important; font-weight: bold; padding: 8px 15px; }
        .navbar-brand, .navbar-nav .nav-link { display: flex; align-items: center; }
        .navbar-brand .icon, .nav-link .icon { margin-right: 8px; font-size: 1.2em; }
        .navbar-collapse { justify-content: space-between; }
        .welcome-section { margin-top: 20px; }
        .card-icon { font-size: 2.5em; color: #d9534f; }
        .card-body p { font-size: 1.1em; color: #333; }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-company-red">
    <div class="container-fluid">
        <a class="navbar-brand">
            <i class="fas fa-home icon"></i> Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('beritatampil.php')">
                        <i class="fas fa-newspaper icon"></i> Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('forms.php')">
                        <i class="fas fa-user-friends icon"></i> Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('organisasitampil.php')">
                        <i class="fas fa-building icon"></i> Organisasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('galeritampil.php')">
                        <i class="fas fa-images icon"></i> Galeri
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">
                        <i class="fas fa-sign-out-alt icon"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten Utama -->
<div class="container welcome-section" id="main-content">
    <!-- Initial Content -->
    <h2 class="text-center my-4">Selamat Datang di Dashboard</h2>
    <p class="text-center">Jelajahi pembaruan terbaru dan kelola konten dengan efektif.</p>

    <div class="row text-center mt-4">
        <!-- Add your cards or initial content here as desired -->
    </div>
</div>

<!-- JavaScript for AJAX Loading -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Function to load content dynamically
    function loadContent(page) {
        $('#main-content').load(page);
    }
</script>

<!-- JavaScript for Bootstrap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
