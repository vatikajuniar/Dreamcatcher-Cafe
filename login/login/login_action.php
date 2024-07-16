<?php
include('config.php'); // Sertakan file config.php untuk koneksi database

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username; // Simpan username ke dalam session
                header("Location: /sudahNyambung/crdn/dashboard.php");
                exit();
            } else {
                $error = "Username atau password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    // Redirect with error message if exists
    if (isset($error)) {
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }
} else {
    header("Location: login.php?error=" . urlencode("Form tidak dikirim dengan benar."));
    exit();
}
?>
