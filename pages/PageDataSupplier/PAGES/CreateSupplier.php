<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gspmultimedia";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // Menyiapkan pernyataan SQL untuk menyimpan data ke tabel supplier
    $sql = "INSERT INTO supplier (nama_supplier, alamat, telepon, email) 
            VALUES ('$nama_supplier', '$alamat', '$telepon', '$email')";

    // Menjalankan query dan mengecek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        // Jika berhasil, set session success
        $_SESSION['status'] = 'success';
    } else {
        // Jika gagal, set session error
        $_SESSION['status'] = 'error';
        $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect kembali ke halaman DataSupplier
    header("Location: DataSupplier.php");
    exit;
}

// Menutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data Supplier</title>
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
                <i class="bi bi-truck"></i>
                Create Data Supplier
            </a>
        </nav>
    </div>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group row">
                <label for="nama-supplier" class="col-sm-2 col-form-label">Nama Supplier:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama-supplier" name="nama_supplier" placeholder="Enter Nama Supplier">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Enter Telepon">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='DataSupplier.php'">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
