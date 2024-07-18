<?php
include 'config.php';

if (isset($_POST['selected'])) {
    $selected = $_POST['selected'];
    foreach ($selected as $id) {
        $sql = "DELETE FROM supplier WHERE supplier_id = '$id'";
        mysqli_query($config, $sql);
    }
    echo "Data berhasil dihapus.";
} else {
    echo "Tidak ada data yang dipilih.";
}
?>

<a href="DataSupplier.php">Kembali ke Data Supplier</a>

