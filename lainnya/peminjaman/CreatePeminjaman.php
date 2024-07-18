<?php
$status = isset($_GET['status']) ? $_GET['status'] : '';
$message = '';

if ($status == 'success') {
    $message = 'Data peminjaman berhasil ditambahkan.';
} elseif ($status == 'error') {
    $message = 'Gagal menambahkan data peminjaman. Silakan coba lagi.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Peminjaman</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        form label {
            width: 150px; 
            text-align: left;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="fas fa-shopping-cart"></i>
                Create Peminjaman
            </a>
        </nav>
    </div>
    <div class="container">
        <?php if (!empty($message)) : ?>
        <div class="alert alert-<?php echo ($status == 'success') ? 'success' : 'danger'; ?>" role="alert">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>
        <form action="create_peminjaman_action.php" method="post">
            <div class="form-group">
                <label for="peminjaman_id">Peminjaman ID:</label>
                <input type="text" class="form-control" id="peminjaman_id" name="peminjaman_id" required>
            </div>
            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="text" class="form-control" id="customer_id" name="customer_id" required>
            </div>
            <div class="form-group">
                <label for="barang_id">Barang ID:</label>
                <input type="text" class="form-control" id="barang_id" name="barang_id" required>
            </div>
            <div class="form-group">
                <label for="tanggal_reservasi">Tanggal Reservasi:</label>
                <input type="date" class="form-control" id="tanggal_reservasi" name="tanggal_reservasi" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam:</label>
                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="number" class="form-control" id="total_harga" name="total_harga" required>
            </div>
            <div class="form-group">
                <label for="kondisi_awal">Kondisi Awal:</label>
                <input type="text" class="form-control" id="kondisi_awal" name="kondisi_awal" required>
            </div>
            <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='peminjaman.php'">Batal</button>
                </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

