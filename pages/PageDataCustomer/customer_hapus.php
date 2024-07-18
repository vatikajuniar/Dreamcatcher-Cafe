<?php
include 'config.php';

if (isset($_POST['selected'])) {
    $selected = $_POST['selected'];
    foreach ($selected as $id) {

        // Hapus dari tabel pengembalian
        $sql = "DELETE pengembalian FROM pengembalian 
                INNER JOIN peminjaman ON pengembalian.peminjaman_id = peminjaman.peminjaman_id 
                WHERE peminjaman.customer_id = '$id'";
        mysqli_query($config, $sql);

        // Hapus dari tabel peminjaman
        $sql = "DELETE FROM peminjaman WHERE customer_id = '$id'";
        mysqli_query($config, $sql);

        // Hapus dari tabel customer
        $sql = "DELETE FROM customer WHERE customer_id = '$id'";
        mysqli_query($config, $sql);
    }
    echo "Data berhasil dihapus.";
} else {
    echo "Tidak ada data yang dipilih.";
}
?>

<a href="DataCustomer.php">Kembali ke Data Customer</a>
