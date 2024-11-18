<?php
$host="localhost";
$username="root";
$pass="";
$db="db_multimedia";

$koneksi=mysqli_connect($host, $username, $pass, $db);
if (!$koneksi) {
    die("koneksi gagal".mysqli_connect_error());
}
?>