<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // Ubah sesuai struktur folder Anda
exit();
?>
