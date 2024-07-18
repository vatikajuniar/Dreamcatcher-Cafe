<?php
include('config.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username; // Simpan username ke dalam session
            header("Location: ../index.php");
        } else {
            $error = "Username tidak ditemukan!";
        }
    } else {
        $error = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    if (isset($error)) {
        echo "<script>alert('$error');</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            height: 100%;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
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
            text-align: center ;
            margin-top: -20px; /* Menggeser teks LOGIN ke atas */
        }
        
        .form {
            padding: 0; 
            margin: 20px;
            text-align: center;
        }

        .form .form-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left; /* Teks di kiri agar placeholder tetap di tengah */
        }

        .form .form-group input {
            width: 100%;
            padding: 10px 30px;
            border: none;
            border-bottom: 1px solid #ccc; 
            font-size: 16px;
            color: #f9f5f5;
            background: transparent;
            box-sizing: border-box;
        }

        .form .form-group input::placeholder {
            color: #f9f5f5; 
            text-align: center; /* Teks placeholder di tengah */
        }

        .form .form-group input[type="text"],
        .form .form-group input[type="password"] {
            background: transparent url('user.png') no-repeat 10px center; /* Ganti user.png dengan ikon username */
            background-size: 20px;
            padding-left: 40px;
        }

        .form button[type="submit"] {
            background-color: #f9f5f5;
            color: #030303;
            padding: 10px 70px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
            color: #efebeb;
            font-size: 14px;
            display: flex;
            justify-content: center;
        }
    
        .forgot-password a {
            text-decoration: none;
            color: #efebeb;
            margin-right: 10px;
        }

        .sign-up {
            text-decoration: none;
            color: #efebeb;
            font-size: 14px;
            margin-left: 10px;
        }

        .separator {
            color: #efebeb;
        }

        .social-login {
            margin-top: 20px;
        }
        
        .social-login p {
            color: #f9f5f5;
            margin-bottom: 5px;
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 5px;
        }
        
        .social-icons a {
            text-decoration: none;
            color: white;
            margin: 0 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="form">
            <h1>LOGIN</h1>
            <form action="#" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary">LOGIN</button> 
                <div class="forgot-password"> 
                    <a href="lupaPassword.html">Lupa Password?</a>
                    <span class="separator"> | </span>
                    <a href="../signUp" class="sign-up">Sign Up</a>
                </div>
                
                <div class="social-login">
                    <p>__________ Atau Login Dengan ___________</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
