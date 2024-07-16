<?php
    include 'config.php';
    session_start();

    if(isset($_GET['customer_id'])) {
        $customerid = $_GET['customer_id'];

        $sql = "SELECT * FROM customer WHERE customer_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "i", $customerid);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        // Memeriksa apakah data ditemukan
        if (!$data) {
            echo "Data customer tidak ditemukan.";
        }

    } else {
        echo "Parameter customer_id tidak ditemukan.";
    }

    if(isset($_POST['ubah'])) {
        $customerid = $_POST['customerid'];
        $namacustomer = $_POST['namacustomer'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];

        $sql = "UPDATE customer SET nama_customer = ?, alamat = ?, telepon = ?, email = ? WHERE customer_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $namacustomer, $alamat, $telepon, $email, $customerid);
        mysqli_stmt_execute($stmt);

        if( mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: Customer.php");
            $_SESSION['message'] = "Data berhasil diperbaharui.";
            $_SESSION['message_type'] = "success";
        }  else {
            $_SESSION['message'] = "Gagal memperbaharui data.";
            $_SESSION['message_type'] = "danger";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($config);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Customer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Inknut Antiqua;
            background-color: #101010;
        }
        #navbar-container {
            background-color: rgb(85, 6, 6);
            margin-bottom: 20px;
        }
        .navbar-brand {
            color: white !important;
            display: flex;
            align-items: center;
        }
        .navbar-brand i {
            margin-right: 10px; /* Adjust spacing between the icon and text */
        }
        /* Adjust label width and text alignment */
        form label {
            width: 150px; /* Adjust as needed */
            text-align: left;
            color: white;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="bi bi-folder-fill"></i>
                Update Data Customer
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="POST" action="#">
            <div class="form-group row">
                <label for="customer-id" class="col-sm-2 col-form-label">Customer ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer-id" name="customerid" placeholder="Enter Customer ID" value="<?= $data['customer_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama-customer" class="col-sm-2 col-form-label">Nama Customer:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama-customer" name="namacustomer" placeholder="Enter Nama Customer " value="<?= $data['nama_customer'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat ID" value="<?= $data['alamat'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $data['telepon'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required value="<?= $data['email'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a class="btn btn-primary" href="Peminjaman.php">Back</a>
                    <button type="submit" name="ubah" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
