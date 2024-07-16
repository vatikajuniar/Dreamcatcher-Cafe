<?php
    session_start();
    include 'config.php';

    if(isset($_GET['barang_id'])) {
        $barangID = $_GET['barang_id'];

        $sql = "SELECT * FROM barang WHERE barang_id = ?";
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
        $namaBarang = $_POST['namaBarang'];
        $kategori = $_POST['kategori'];
        $stok = $_POST['stok'];
        $hargaSewa = $_POST['hargaSewa'];
        $supplierId = $_POST['supplierID'];

        $sql = "UPDATE barang SET barang_id = ?, nama_barang = ?, kategori = ?, stok = ?, harga_sewa = ?, supplier_id = ? WHERE barang_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "sssiiss", $barangID, $namaBarang, $kategori, $stok, $hargaSewa, $supplierId, $barangID);
        mysqli_stmt_execute($stmt);

        if( mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: DataBarang.php");
            $_SESSION['message'] = "Data berhasil diperbaharui.";
            $_SESSION['message_type'] = "success";
        }  else {
            header("Location: DataBarang.php");
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
    <title>Update Data Barang</title>
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
                <label for="pengembalian-id" class="col-sm-2 col-form-label">Barang ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="barang-id" name="barangid" placeholder="Enter barang ID" value="<?= $data['barang_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="barang-id" class="col-sm-2 col-form-label">Nama Barang:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?= $data['nama_barang'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisi-akhir" class="col-sm-2 col-form-label">Kategori:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $data['kategori'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Stok:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stok" name="stok" required value="<?= $data['stok'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Harga Sewa:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hargaSewa" name="hargaSewa" required value="<?= $data['harga_sewa'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Supplier Id:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="supplierID" name="supplierID" required value="<?= $data['supplier_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a class="btn btn-primary" href="DataBarang.php">Back</a>
                    <button type="submit" name="ubah" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
