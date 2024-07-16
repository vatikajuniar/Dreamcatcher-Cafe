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
            margin-right: 10px;
        }
        form label {
            width: 150px;
            text-align: left;
            color: white;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';

    if (isset($_POST['selected']) && count($_POST['selected']) == 1) {
        $id = mysqli_real_escape_string($config, $_POST['selected'][0]);
        $sql = "SELECT * FROM peminjaman WHERE peminjaman_id = '$id'";
        $result = mysqli_query($config, $sql);
        if ($result) {
            $data = mysqli_fetch_array($result);
        } else {
            echo "Error retrieving data: " . mysqli_error($config);
            exit;
        }
    } else {
        echo "Pilih satu data untuk diubah.";
        exit;
    }
    ?>
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
        <form method="POST" action="update_peminjaman_action.php">
            <div class="form-group row">
                <label for="peminjaman_id" class="col-sm-2 col-form-label">Peminjaman ID:</label>
                <div class="col-sm-10">
                    <input type="number" name="peminjaman_id" value="<?php echo $data['peminjaman_id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="customer_id" class="col-sm-2 col-form-label">Customer ID:</label>
                <div class="col-sm-10">
                    <input type="number" name="customer_id" value="<?php echo $data['customer_id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="barang_id" class="col-sm-2 col-form-label">Barang ID:</label>
                <div class="col-sm-10">
                    <input type="number" name="barang_id" value="<?php echo $data['barang_id']; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_reservasi" class="col-sm-2 col-form-label">Tanggal Reservasi:</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_reservasi" value="<?php echo $data['tanggal_reservasi']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="tanggal_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam:</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_pinjam" value="<?php echo $data['tanggal_pinjam']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah:</label>
                <div class="col-sm-10">
                    <input type="number" name="jumlah" value="<?php echo $data['jumlah']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="total_harga" class="col-sm-2 col-form-label">Total Harga:</label>
                <div class="col-sm-10">
                    <input type="number" name="total_harga" value="<?php echo $data['total_harga']; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisi_awal" class="col-sm-2 col-form-label">Kondisi Awal:</label>
                <div class="col-sm-10">
                    <input type="text" name="kondisi_awal" value="<?php echo $data['kondisi_awal']; ?>">
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='peminjaman.php'">Batal</button>
                </div>>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
