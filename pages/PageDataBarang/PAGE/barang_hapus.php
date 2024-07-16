<?php
include 'config.php';

if (isset($_POST['selected'])) {
    $selected = $_POST['selected'];
    $error_occurred = false;
    
    // Mulai transaksi
    mysqli_begin_transaction($config);
    
    try {
        foreach ($selected as $id) {
            // Hapus data terkait di tabel pengembalian
            $sql_pengembalian = "DELETE FROM pengembalian WHERE peminjaman_id IN (SELECT peminjaman_id FROM peminjaman WHERE barang_id = '$id')";
            mysqli_query($config, $sql_pengembalian);
            
            // Hapus data terkait di tabel peminjaman
            $sql_peminjaman = "DELETE FROM peminjaman WHERE barang_id = '$id'";
            mysqli_query($config, $sql_peminjaman);
            
            // Hapus data di tabel barang
            $sql_barang = "DELETE FROM barang WHERE barang_id = '$id'";
            mysqli_query($config, $sql_barang);
        }
        
        // Jika semua query berhasil, commit transaksi
        mysqli_commit($config);
        echo "Data berhasil dihapus.";
    } catch (mysqli_sql_exception $exception) {
        // Jika terjadi kesalahan, rollback transaksi
        mysqli_rollback($config);
        $error_occurred = true;
        echo "Terjadi kesalahan saat menghapus data: " . $exception->getMessage();
    }
} else {
    echo "Tidak ada data yang dipilih.";
}
?>

<a href="DataBarang.php">Kembali ke Data Barang</a>
