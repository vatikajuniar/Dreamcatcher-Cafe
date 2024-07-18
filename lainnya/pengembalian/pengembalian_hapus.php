<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected'])) {
    $selected = $_POST['selected'];

    $deleteSuccess = true;
    foreach ($selected as $id) {
        // Prevent SQL injection by using prepared statement
        $sql = "DELETE FROM pengembalian WHERE pengembalian_id = ?";
        $stmt = mysqli_prepare($config, $sql);

        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Check if rows affected
        $rows_affected = mysqli_stmt_affected_rows($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);

        if ($rows_affected <= 0) {
            $deleteSuccess = false;
            break;
        }
    }

    if ($deleteSuccess) {
        $_SESSION['message'] = "Data berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Gagal menghapus data.";
    }
} else {
    $_SESSION['message'] = "Tidak ada data yang dipilih untuk dihapus.";
}

header("Location: pengembalian.php");
exit();
?>
