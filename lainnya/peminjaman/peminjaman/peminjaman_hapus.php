<?php
include 'config.php';

$status = 'success'; // Default status

if (isset($_POST['selected'])) {
    $selected = $_POST['selected'];
    foreach ($selected as $id) {
        $id = mysqli_real_escape_string($config, $id);

        // Hapus dari tabel pengembalian
        $sql = "DELETE FROM pengembalian WHERE peminjaman_id = '$id'";
        if (!mysqli_query($config, $sql)) {
            $status = 'error';
            break;
        }

        // Hapus dari tabel peminjaman
        $sql = "DELETE FROM peminjaman WHERE peminjaman_id = '$id'";
        if (!mysqli_query($config, $sql)) {
            $status = 'error';
            break;
        }
    }
} else {
    $status = 'error';
}

header("Location: peminjaman.php?status=$status");
exit;
?>
