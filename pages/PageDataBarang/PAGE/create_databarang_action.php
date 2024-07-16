<?php
include "config.php";

// Variabel untuk menyimpan pesan
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input untuk mencegah SQL injection
    $nama_barang = mysqli_real_escape_string($config, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($config, $_POST['kategori']);
    $stok = mysqli_real_escape_string($config, $_POST['stok']);
    $harga_sewa = mysqli_real_escape_string($config, $_POST['harga_sewa']);
    $supplier_id = mysqli_real_escape_string($config, $_POST['supplier_id']);

    // Query SQL untuk menyimpan data barang
    $sql = "INSERT INTO barang (nama_barang, kategori, stok, harga_sewa, supplier_id) 
            VALUES ('$nama_barang', '$kategori', '$stok', '$harga_sewa', '$supplier_id')";

    // Jalankan query dan periksa apakah berhasil
    if (mysqli_query($config, $sql)) {
        // Jika berhasil, atur pesan sukses
        $message = "Data berhasil disimpan.";
    } else {
        // Jika terjadi kesalahan, atur pesan error
        $message = "Error: " . $sql . "<br>" . mysqli_error($config);
    }
}

mysqli_close($config); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Inknut Antiqua', serif;
            background-color: #101010;
            color: white; /* Tambahkan warna teks agar sesuai dengan tema */
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
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .message {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            display: <?php echo ($message != '') ? 'block' : 'none'; ?>; /* Tampilkan jika pesan tidak kosong */
        }
        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            display: <?php echo ($message == '') ? 'block' : 'none'; ?>; /* Tampilkan jika pesan kosong */
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="bi bi-folder-fill"></i>
                CREATE Data Barang
            </a>
        </nav>
    </div>
    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        <div class="error-message"><?php echo $message; ?></div>
        <form method="POST" action="create_databarang_action.php">
            <div class="form-group row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang:</label>
                <div class="col-sm-10">
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="kategori" name="kategori" required>
                        <option value="Visual Equipment">Visual Equipment</option>
                        <option value="Lighting Equipment">Lighting Equipment</option>
                        <option value="Production Equipment">Production Equipment</option>
                        <option value="Audio Equipment">Audio Equipment</option>
                        <option value="Camera Equipment">Camera Equipment</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok:</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" name="stok" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="harga_sewa" class="col-sm-2 col-form-label">Harga Sewa:</label>
                <div class="col-sm-10">
                    <input type="number" step="0.01" name="harga_sewa" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="supplier_id" class="col-sm-2 col-form-label">Supplier Id:</label>
                <div class="col-sm-10">
                    <input type="number" name="supplier_id" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    <a href="databarang.php" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
