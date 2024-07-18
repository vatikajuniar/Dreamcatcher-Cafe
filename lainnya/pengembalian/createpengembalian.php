<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "gspmultimedia"; // Ganti dengan nama database Anda

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan cek apakah variabel POST telah di-set
    if (isset($_POST['peminjaman_id'], $_POST['tanggal_kembali'], $_POST['kondisi_akhir'], $_POST['denda'])) {
        $peminjaman_id = $_POST['peminjaman_id'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $kondisi_akhir = $_POST['kondisi_akhir'];
        $denda = $_POST['denda'];

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO pengembalian (peminjaman_id, tanggal_kembali, kondisi_akhir, denda) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $peminjaman_id, $tanggal_kembali, $kondisi_akhir, $denda);

        // Execute the statement
        if ($stmt->execute()) {
            $message = "New record created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pengembalian</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Inknut Antiqua;
            background-color: #101010;
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .form-group label {
            color: white;
        }
        .btn-primary {
            background-color: rgb(85, 6, 6);
            border: none;
        }
        .btn-primary:hover {
            background-color: rgb(100, 10, 10);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Pengembalian</h2>
        <form action="create_pengembalian_action.php" method="POST">
            <div class="form-group">
                <label for="peminjaman_id">Peminjaman ID:</label>
                <input type="number" class="form-control" id="peminjaman_id" name="peminjaman_id" required>
            </div>
            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali:</label>
                <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
            </div>
            <div class="form-group">
                <label for="kondisi_akhir">Kondisi Akhir:</label>
                <input type="text" class="form-control" id="kondisi_akhir" name="kondisi_akhir" required>
            </div>
            <div class="form-group">
                <label for="denda">Denda:</label>
                <input type="number" class="form-control" id="denda" name="denda" required>
            </div>
            <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='pengembalian.php'">Batal</button>
                </div>
        </form>
    </div>
</body>
</html>
