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
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      
      // Hashing password sebelum menyimpannya
      // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Menambahkan tanggal login saat ini
      $tanggal_login = date("Y-m-d H:i:s");

      // Query SQL untuk memasukkan data pengguna ke tabel admin
      $sql = "INSERT INTO admin (username, password, tanggal_login, email) VALUES ('$user', '$password', '$tanggal_login', '$email')";

      if (mysqli_query($conn, $sql)) {
          header("Location: ../login");
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

      mysqli_close($conn);
  } 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet" />
    <style>
      body {
        height: 100%;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
      }

      /* Gradient background */
      .container-fluid {
        background-image: linear-gradient(to bottom, #000, #660000);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        padding: 0;
      }

      .form h1 {
        color: #fff;
        text-align: center;
      }

      .form {
        /*background-color: #fff; */
        padding: 0;
        /* border-radius: 10px; */
        /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/ /* Remove box shadow */
        margin: 20px;
        text-align: center;
      }

      .form input[type="Username"],
      .form input[type="email"],
      .form input[type="password"] {
        width: 100%;
        padding: 10px 30px;
        margin-bottom: 20px;
        border: none;
        border-bottom: 1px solid #ccc;
        font-size: 16px;
        background: transparent;
        /* background: rgba(255, 255, 255, 0.2); Set background color to translucent white */
        color: #f9f5f5; /* Set text color to white */
        background-size: 20px;
        padding-left: 40px;
        box-sizing: border-box;
      }

      .form input[type="Username"]::placeholder,
      .form input[type="email"]::placeholder,
      .form input[type="password"]::placeholder {
        color: #f9f5f5; /* Set placeholder text color to white */
      }

      .form button[type="submit"] {
        background-color: #f9f5f5;
        color: #030303;
        padding: 10px 70px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
      }

      .Already-Have-an-Account {
        text-decoration: none;
        color: #efebeb;
        font-size: 14px;
        margin-top: 2%;
      }

      .Sign-in {
        margin-top: 5%;
        color: #0e0e0e; /* Set text color to white */
      }

      .Sign-in a {
        text-decoration: none;
        color: #efebeb;
        font-size: 14px;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="form">
        <h1>SIGN UP</h1>
        <form
          action="#"
          method="POST">
          <input
            type="Username"
            class="form-control"
            placeholder="Username"
            name="username" />
          <input
            type="email"
            class="form-control"
            placeholder="Email"
            name="email" />
          <input
            type="password"
            class="form-control"
            placeholder="Password"
            name="password" />
          <button
            type="submit"
            class="btn btn-primary">
            SIGN UP
          </button>
          <br />

          <div class="Already-Have-an-Account">
            <a
              href="#"
              class="Already-Have-an-Account"
              >Already Have an Account ?</a
            >
            <a
              href="../login"
              class="Sign-in text-white"
              >Sign in</a
            >
          </div>
        </form>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
