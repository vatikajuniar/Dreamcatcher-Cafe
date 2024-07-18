<?php
include "config.php";

// Inisialisasi variabel untuk pesan
$message = "";

// Pastikan form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    // Query SQL untuk insert data ke dalam tabel supplier
    $sql = "INSERT INTO supplier (nama_supplier, alamat, telepon, email) 
            VALUES ('$nama_supplier', '$alamat', '$telepon', '$email')";

    // Eksekusi query dan periksa hasilnya
    if (mysqli_query($config, $sql)) {
        // Jika berhasil, set pesan sukses
        $message = "New record created successfully";
    } else {
        // Jika gagal, set pesan error
        $message = "Error: " . $sql . "<br>" . mysqli_error($config);
    }
}

// Tutup koneksi database
mysqli_close($config);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result - Data Supplier</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Inknut Antiqua;
            background-color: #101010;
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .message {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #343a40;
        }
        .message.success {
            background-color: #28a745;
        }
        .message.error {
            background-color: #dc3545;
        }
        .btn {
            background-color: rgb(85, 6, 6);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($message)) : ?>
            <div class="message <?php echo (strpos($message, 'successfully') !== false) ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <a href="DataSupplier.php" class="btn btn-primary">Back to Data Supplier</a>
    </div>
</body>
</html>
