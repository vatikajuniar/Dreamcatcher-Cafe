<?php
session_start();
session_unset();
session_destroy();
header("Location: ../login/login/login.php"); // Ubah sesuai struktur folder Anda
exit();
?>
