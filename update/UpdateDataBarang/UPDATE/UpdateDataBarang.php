<?php
session_start();
include 'config.php';

if(isset($_GET['barang_id'])) {
    $supplierId = $_GET['barang_id'];

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
        echo "Data barang tidak ditemukan.";
    }

} else {
    echo "Parameter barang_id tidak ditemukan.";
}

if(isset($_POST['ubah'])) {
    $namaBarang = $_POST['namaBarang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $hargaSewa = $_POST['hargaSewa'];

    $sql = "UPDATE barang SET nama_barang = ?, kategori = ?, stok = ?, harga_sewa = ? WHERE barang_id = ?";
    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $namaBarang, $kategori, $stok, $hargaSewa, $supplierId);
    mysqli_stmt_execute($stmt);

    if( mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: DataBarang.php");
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
            margin-right: 10px;
        }
        .container {
            color: black;
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            background-color: rgb(85, 6, 6);
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="bi bi-folder-fill"></i>
                Update Data Barang
            </a>
        </nav>
    </div>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="namaBarang">Nama Barang</label>
                <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="<?php echo isset($data['nama_barang']) ? $data['nama_barang'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo isset($data['kategori']) ? $data['kategori'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="text" class="form-control" id="stok" name="stok" value="<?php echo isset($data['stok']) ? $data['stok'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="hargaSewa">Harga Sewa</label>
                <input type="text" class="form-control" id="hargaSewa" name="hargaSewa" value="<?php echo isset($data['harga_sewa']) ? $data['harga_sewa'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="ubah">Update</button>
            <a href="DataBarang.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
