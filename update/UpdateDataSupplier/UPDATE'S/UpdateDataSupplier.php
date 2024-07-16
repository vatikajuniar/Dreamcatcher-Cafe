<?php
    session_start();
    include 'config.php';

    if(isset($_GET['supplier_id'])) {
        $supplierId = $_GET['supplier_id'];

        $sql = "SELECT * FROM supplier WHERE supplier_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "i", $supplierId);
        mysqli_stmt_execute($stmt);
    
        // Mendapatkan hasil query
        $result = mysqli_stmt_get_result($stmt);
        
        // Mengambil data sebagai asosiasi array
        $data = mysqli_fetch_assoc($result);

        // Memeriksa apakah data ditemukan
        if (!$data) {
            echo "Data pengembalian tidak ditemukan.";
        }
        

    } else {
        echo "Parameter pengembalian_id tidak ditemukan.";
    }

    if(isset($_POST['ubah'])) {
        $namaSupplier = $_POST['namaSupplier'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];

        $sql = "UPDATE supplier SET supplier_id = ?, nama_supplier = ?, alamat = ?, telepon = ?, email = ? WHERE supplier_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "sssiss", $supplierId, $namaSupplier, $alamat, $telepon, $email, $supplierId);
        mysqli_stmt_execute($stmt);

        if( mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: DataSupplier.php");
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
                Update Data Supplier
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="POST" action="#">
            <div class="form-group row">
                <label for="pengembalian-id" class="col-sm-2 col-form-label">Supplier ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="supplier-id" name="supplierid" placeholder="Enter supplier ID" value="<?= $data['supplier_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="barang-id" class="col-sm-2 col-form-label">Nama Supplier:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" value="<?= $data['nama_supplier'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisi-akhir" class="col-sm-2 col-form-label">Alamat:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Telepon:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" required value="<?= $data['telepon'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" required value="<?= $data['email'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a class="btn btn-primary" href="Pengembalian.php">Back</a>
                    <button type="submit" name="ubah" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
