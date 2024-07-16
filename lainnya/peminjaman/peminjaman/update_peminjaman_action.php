<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $peminjaman_id = isset($_POST['peminjaman_id']) ? $_POST['peminjaman_id'] : '';
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
    $barang_id = isset($_POST['barang_id']) ? $_POST['barang_id'] : '';
    $tanggal_reservasi = isset($_POST['tanggal_reservasi']) ? $_POST['tanggal_reservasi'] : '';
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : '';
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : '';
    $kondisi_awal = isset($_POST['kondisi_awal']) ? $_POST['kondisi_awal'] : '';

    // Cek jika koneksi masih aktif
    if (!mysqli_ping($config)) {
        mysqli_close($config);
        include "config.php";
    }

    $sql = "UPDATE peminjaman SET customer_id=?, barang_id=?, tanggal_reservasi=?, tanggal_pinjam=?, jumlah=?, total_harga=?, kondisi_awal=? WHERE peminjaman_id=?";
    $stmt = mysqli_prepare($config, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $customer_id, $barang_id, $tanggal_reservasi, $tanggal_pinjam, $jumlah, $total_harga, $kondisi_awal, $peminjaman_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Data berhasil diubah.";
        } else {
            echo "Data gagal diubah. Error: " . mysqli_error($config);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare statement. Error: " . mysqli_error($config);
    }

    mysqli_close($config);
}
?>
<br>Kembali ke <a href="Peminjaman.php">Peminjaman</a>
