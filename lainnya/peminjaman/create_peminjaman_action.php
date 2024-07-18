<?php
include "config.php";

// Ambil data dari form
$peminjaman_id = $_POST['peminjaman_id'];
$customer_id = $_POST['customer_id'];
$barang_id = $_POST['barang_id'];
$tanggal_reservasi = $_POST['tanggal_reservasi'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$jumlah = $_POST['jumlah'];
$total_harga = $_POST['total_harga'];
$kondisi_awal = $_POST['kondisi_awal'];

// Query untuk menyimpan data
$sql = "INSERT INTO peminjaman (peminjaman_id, customer_id, barang_id, tanggal_reservasi, tanggal_pinjam, jumlah, total_harga, kondisi_awal) 
        VALUES ('$peminjaman_id', '$customer_id', '$barang_id', '$tanggal_reservasi', '$tanggal_pinjam', '$jumlah', '$total_harga', '$kondisi_awal')";

if (mysqli_query($config, $sql)) {
    // Jika berhasil, arahkan ke peminjaman.php dengan status success
    header("Location: peminjaman.php?status=success");
} else {
    // Jika gagal, arahkan ke peminjaman.php dengan status error
    header("Location: peminjaman.php?status=error");
}

mysqli_close($config);
?>
