<?php
    include 'config.php';
    session_start();

    if(isset($_GET['peminjaman_id'])) {
        $peminjamanid = $_GET['peminjaman_id'];

        $sql = "SELECT * FROM peminjaman WHERE peminjaman_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "i", $peminjamanid);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $data = mysqli_fetch_assoc($result);

        // Memeriksa apakah data ditemukan
        if (!$data) {
            echo "Data peminjaman tidak ditemukan.";
        }

    } else {
        echo "Parameter peminjaman_id tidak ditemukan.";
    }

    if(isset($_POST['ubah'])) {
        $peminjamanid = $_POST['peminjamanid'];
        $customerid = $_POST['customerid'];
        $barangid = $_POST['barangid'];
        $tanggalreservasi = $_POST['tanggalreservasi'];
        $tanggalpinjam = $_POST['tanggal_pinjam'];
        $jumlah = $_POST['jumlah'];
        $totalharga = $_POST['total_harga'];
        $kondisiawal = $_POST['kondisi_awal'];

        $sql = "UPDATE peminjaman SET customer_id = ?, barang_id = ?, tanggal_reservasi = ?, tanggal_pinjam = ?, jumlah = ?, total_harga = ?, kondisi_awal = ? WHERE peminjaman_id = ?";
        $stmt = mysqli_prepare($config, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssi", $customerid, $barangid, $tanggalreservasi, $tanggalpinjam, $jumlah, $totalharga, $kondisiawal, $peminjamanid);
        mysqli_stmt_execute($stmt);

        if( mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: Peminjaman.php");
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
    <title>Update Data Peminjaman</title>
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
                Update Data Peminjaman
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="POST" action="#">
            <div class="form-group row">
                <label for="peminjaman-id" class="col-sm-2 col-form-label">Peminjaman ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="peminjaman-id" name="peminjamanid" placeholder="Enter Peminjaman ID" value="<?= $data['peminjaman_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="customer-id" class="col-sm-2 col-form-label">Customer ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer-id" name="customerid" placeholder="Enter Customer ID" value="<?= $data['customer_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="barang-id" class="col-sm-2 col-form-label">Barang ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="barang-id" name="barangid" placeholder="Enter Barang ID" value="<?= $data['barang_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal-reservasi" class="col-sm-2 col-form-label">Tanggal Reservasi:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal-reservasi" name="tanggalreservasi" value="<?= $data['tanggal_reservasi'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal-peminjaman" class="col-sm-2 col-form-label">Tanggal Peminjaman:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal-peminjaman" name="tanggal_pinjam" required value="<?= $data['tanggal_pinjam'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Enter Jumlah" value="<?= $data['jumlah'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="total-harga" class="col-sm-2 col-form-label">Total Harga:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="total-harga" name="total_harga" placeholder="Enter Total Harga" value="<?= $data['total_harga'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisi-awal" class="col-sm-2 col-form-label">Kondisi Awal:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kondisi-awal" name="kondisi_awal" placeholder="Enter Kondisi Awal" value="<?= $data['kondisi_awal'] ?>">
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
