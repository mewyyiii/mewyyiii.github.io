<?php
session_start();
require "koneksi.php";

$user = @$_POST['username'];
$pass = @$_POST['password'];
if(isset($_POST['login'])){
    // Cek login hanya untuk admin
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$user' AND password = MD5('$pass')");
    if(mysqli_num_rows($sql) > 0){
        $_SESSION['status'] = "login";
        $_SESSION['username'] = "$user";
        echo "<script>document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- Tambahkan link ke Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS sama seperti yang sebelumnya */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ADD8E6, #87CEEB);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            width: 360px;
            text-align: center;
            border: 2px solid #ADD8E6;
        }

        h2 {
            margin-bottom: 30px;
            font-size: 26px;
            color: #4682B4;
            font-family: 'Poppins', sans-serif;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
            color: #333;
        }

        .input-container {
            position: relative;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ADD8E6;
            border-radius: 25px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #d9534f;
            outline: none;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 12px;
            cursor: pointer;
            color: #888;
        }

        .toggle-password:hover {
            color: #d9534f;
        }

        .remember-me {
            margin-bottom: 20px;
            text-align: left;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ADD8E6;
            border: none;
            color: white;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #87CEEB;
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.95);
        }

        @media (max-width: 500px) {
            .login-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" required>

            <label for="password">Password:</label>
            <div class="input-container">
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye"></i> <!-- Ikon mata dari Font Awesome -->
                </span>
            </div>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat Saya</label>
            </div>

            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
