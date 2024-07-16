<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "gspmultimedia";

$config = mysqli_connect($hostname, $username, $password, $database);

if (!$config) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
