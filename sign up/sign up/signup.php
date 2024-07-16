<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gspmultimedia";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hashing password sebelum menyimpannya
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Menambahkan tanggal login saat ini
    $tanggal_login = date("Y-m-d H:i:s");

    // Query SQL untuk memasukkan data pengguna ke tabel admin
    $sql = "INSERT INTO admin (username, password, tanggal_login) VALUES ('$user', '$password', '$tanggal_login')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../../login/login");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Form tidak dikirim dengan benar.";
}
?>
