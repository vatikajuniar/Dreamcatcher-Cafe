<?php
include "config.php";

// Inisialisasi variabel $data
$data = array('barang_id' => '', 'nama_barang' => '', 'kategori' => '', 'stok' => '', 'harga_sewa' => '', 'supplier_id' => '');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate if barang_id is set and not empty
    if (isset($_POST['barang_id']) && !empty($_POST['barang_id'])) {
        // Prepare a select statement
        $sql = "SELECT * FROM barang WHERE barang_id = ?";

        if ($stmt = mysqli_prepare($config, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $barang_id);

            // Set parameter
            $barang_id = $_POST['barang_id'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if barang_id exists, then fetch data
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $barang_id, $nama_barang, $kategori, $stok, $harga_sewa, $supplier_id);
                    
                    // Fetch data
                    if (mysqli_stmt_fetch($stmt)) {
                        // Assign fetched values to $data
                        $data['barang_id'] = $barang_id;
                        $data['nama_barang'] = $nama_barang;
                        $data['kategori'] = $kategori;
                        $data['stok'] = $stok;
                        $data['harga_sewa'] = $harga_sewa;
                        $data['supplier_id'] = $supplier_id;
                    }
                } else {
                    $_SESSION['message'] = "Barang dengan ID tersebut tidak ditemukan.";
                    $_SESSION['message_type'] = "danger";
                }
            } else {
                $_SESSION['message'] = "Gagal mengambil data dari database.";
                $_SESSION['message_type'] = "danger";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = "Gagal menyiapkan statement SQL.";
            $_SESSION['message_type'] = "danger";
        }

        // Close connection
        mysqli_close($config);
    } else {
        $_SESSION['message'] = "Harap masukkan ID Barang yang valid.";
        $_SESSION['message_type'] = "danger";
    }
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
                Update Data Barang
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="POST" action="update_action.php">
            <div class="form-group row">
                <label for="barang-id" class="col-sm-2 col-form-label">Barang ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="barang-id" name="barang_id" placeholder="Enter Barang ID" value="<?= $data['barang_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="namaBarang" class="col-sm-2 col-form-label">Nama Barang:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namaBarang" name="nama_barang" value="<?= $data['nama_barang'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $data['kategori'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="stok" class="col-sm-2 col-form-label">Stok:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="stok" name="stok" required value="<?= $data['stok'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="hargaSewa" class="col-sm-2 col-form-label">Harga Sewa:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="hargaSewa" name="harga_sewa" required value="<?= $data['harga_sewa'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="supplierId" class="col-sm-2 col-form-label">Supplier ID:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="supplierId" name="supplier_id" value="<?= $data['supplier_id'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a class="btn btn-primary" href="DataBarang.php">Back</a>
                    <button type="submit" name="simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
