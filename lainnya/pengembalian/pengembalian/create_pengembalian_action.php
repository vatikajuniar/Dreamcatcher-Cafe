<?php
session_start(); // Memulai sesi
include "config.php"; // Pastikan file config.php berisi konfigurasi database yang benar

// Inisialisasi koneksi ke database
$conn = $config;

// Pesan kesuksesan atau error
$message = '';

// Pastikan form dikirimkan dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah semua field yang diperlukan ada dalam $_POST
    if (isset($_POST['peminjaman_id'], $_POST['tanggal_kembali'], $_POST['kondisi_akhir'], $_POST['denda'])) {
        // Panggil fungsi untuk memverifikasi peminjaman_id dan membuat data pengembalian
        $result = createPengembalian($conn, $_POST['peminjaman_id']);
        if ($result === true) {
            $message = "Data berhasil ditambahkan";
        } else {
            $message = $result; // Pesan error dari fungsi createPengembalian
        }
    } else {
        // Jika ada field yang kosong, tampilkan pesan error
        $message = "Semua kolom harus diisi";
    }

    // Simpan pesan dalam session
    $_SESSION['message'] = $message;
    // Arahkan kembali ke pengembalian.php
    header("Location: pengembalian.php");
    exit();
}

// Fungsi untuk memasukkan data pengembalian ke database
function createPengembalian($conn, $peminjaman_id) {
    // Cek apakah peminjaman_id ada di tabel peminjaman
    $checkSql = "SELECT * FROM peminjaman WHERE peminjaman_id = ?";
    $stmtCheck = mysqli_prepare($conn, $checkSql);

    if ($stmtCheck === false) {
        // Handle error jika prepare statement gagal
        return 'MySQL prepare error: ' . mysqli_error($conn);
    }

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmtCheck, "i", $peminjaman_id);

    // Eksekusi statement
    mysqli_stmt_execute($stmtCheck);

    // Dapatkan hasil eksekusi
    $result = mysqli_stmt_get_result($stmtCheck);

    // Tutup statement
    mysqli_stmt_close($stmtCheck);

    // Jika tidak ada baris yang ditemukan, kembalikan pesan error
    if (mysqli_num_rows($result) === 0) {
        return "Error: Peminjaman ID tidak ditemukan";
    }

    // Ambil nilai dari $_POST
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $kondisi_akhir = $_POST['kondisi_akhir'];
    $denda = $_POST['denda'];

    // Buat query untuk memasukkan data ke dalam tabel pengembalian
    $sql = "INSERT INTO pengembalian (peminjaman_id, tanggal_kembali, kondisi_akhir, denda) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql); // Siapkan statement SQL

    if ($stmt === false) {
        // Handle error jika prepare statement gagal
        return 'MySQL prepare error: ' . mysqli_error($conn);
    }

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "issd", $peminjaman_id, $tanggal_kembali, $kondisi_akhir, $denda);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        // Tutup statement
        mysqli_stmt_close($stmt);
        return true; // Berhasil
    } else {
        // Jika eksekusi gagal, kembalikan pesan error
        return mysqli_stmt_error($stmt);
    }
}

// Tutup koneksi database
mysqli_close($conn);
?>
