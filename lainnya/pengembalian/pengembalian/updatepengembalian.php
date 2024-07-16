<?php
include 'config.php';

$data = []; // Inisialisasi $data dengan array kosong

if(isset($_GET['pengembalian_id'])) {
    $pengembalianid = $_GET['pengembalian_id'];

    $sql = "SELECT * FROM pengembalian WHERE pengembalian_id = ?";
    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "i", $pengembalianid);
    mysqli_stmt_execute($stmt);
    
    // Mendapatkan hasil query
    $result = mysqli_stmt_get_result($stmt);
    
    // Mengambil data sebagai asosiasi array
    $data = mysqli_fetch_assoc($result);

    // Memeriksa apakah data ditemukan
    if (!$data) {
        echo "Data pengembalian tidak ditemukan.";
        exit; // Keluar dari script jika data tidak ditemukan
    }
}

if(isset($_POST['ubah'])) {
    $pengembalianid = $_POST['pengembalianid'];
    $peminjamanid = $_POST['peminjamanid'];
    $tanggalkembali = $_POST['tanggalkembali'];
    $kondisiakhir = $_POST['kondisiakhir'];
    $denda = $_POST['denda'];

    $sql = "UPDATE pengembalian SET peminjaman_id = ?, tanggal_kembali = ?, kondisi_akhir = ?, denda = ? WHERE pengembalian_id = ?";
    $stmt = mysqli_prepare($config, $sql);
    mysqli_stmt_bind_param($stmt, "issii", $peminjamanid, $tanggalkembali, $kondisiakhir, $denda, $pengembalianid);
    mysqli_stmt_execute($stmt);

    if( mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: Pengembalian.php");
        exit; // Pastikan keluar setelah redirect
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($config);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pengembalian</title>
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
                Update Data Pengembalian
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="POST">
            <div class="form-group row">
                <label for="pengembalian-id" class="col-sm-2 col-form-label">Pengembalian ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengembalian-id" name="pengembalianid" placeholder="Enter Pengembalian ID" value="<?= isset($data['pengembalian_id']) ? $data['pengembalian_id'] : '' ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="peminjaman-id" class="col-sm-2 col-form-label">Peminjaman ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="peminjaman-id" name="peminjamanid" placeholder="Enter Peminjaman ID" value="<?= isset($data['peminjaman_id']) ? $data['peminjaman_id'] : '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal-kembali" class="col-sm-2 col-form-label">Tanggal Kembali:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tanggal-kembali" name="tanggalkembali" value="<?= isset($data['tanggal_kembali']) ? $data['tanggal_kembali'] : '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisiakhir" class="col-sm-2 col-form-label">Kondisi Akhir:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kondisiakhir" name="kondisiakhir" value="<?= isset($data['kondisi_akhir']) ? $data['kondisi_akhir'] : '' ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="denda" class="col-sm-2 col-form-label">Denda:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="denda" name="denda" required value="<?= isset($data['denda']) ? $data['denda'] : '' ?>">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='Pengembalian.php'">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
</body>
</html>
