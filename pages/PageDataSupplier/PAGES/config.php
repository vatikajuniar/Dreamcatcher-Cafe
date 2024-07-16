<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gspmultimedia";

// Membuat koneksi
$config = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$config) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>