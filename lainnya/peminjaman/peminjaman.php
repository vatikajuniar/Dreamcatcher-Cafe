<?php
include "config.php";

session_start();

// Ambil status dari query string jika ada
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Set pesan berdasarkan status
$message = '';
if ($status == 'success') {
    $message = 'Data berhasil dihapus.';
} elseif ($status == 'error') {
    $message = 'Data gagal dihapus. Silakan coba lagi.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
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
        .form-inline {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
        }
        .form-inline .form-control {
            flex: 1;
            max-width: 600px;
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }
        .form-inline .btn {
            margin-left: -1px;
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
            background-color: rgb(85, 6, 6);
            color: white;
        }
        .row {
            color: black;
            background-color: white;
            margin-top: 20px;
        }
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th {
            background-color: #6c757d;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
        }
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 70px;
        }
        .action-buttons .btn {
            margin-left: 10px;
        }
        .btn-white-black {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container-fluid" id="navbar-container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="../../index.php">
                <i class="fas fa-home"></i>
                <i class="fas fa-shopping-cart"></i>
                Peminjaman
            </a>
        </nav>
    </div>

    <!-- Tampilkan pesan di atas form pencarian -->
    <?php if (!empty($message)) : ?>
    <div class="container">
        <div class="alert alert-<?php echo ($status == 'success') ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php 
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
    ?>
    <?php endif; ?>

    <form class="form-inline my-4 my-lg-0" method="GET">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search...." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button class="btn my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="dataForm" action="peminjaman_hapus.php" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>peminjaman_id</th>
                                <th>customer_id</th>
                                <th>barang_id</th>
                                <th>tanggal_reservasi</th>
                                <th>tanggal_pinjam</th>
                                <th>jumlah</th>
                                <th>total_harga</th>
                                <th>kondisi_awal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil data peminjaman dari database
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';

                            $sql = "SELECT peminjaman_id, customer_id, barang_id, tanggal_reservasi, tanggal_pinjam, jumlah, total_harga, kondisi_awal FROM peminjaman";
                            if ($search) {
                                $sql .= " WHERE customer_id LIKE '%$search%' OR barang_id LIKE '%$search%' OR tanggal_reservasi LIKE '%$search%' OR tanggal_pinjam LIKE '%$search%' OR jumlah LIKE '%$search%' OR total_harga LIKE '%$search%' OR kondisi_awal LIKE '%$search%'";
                            }
                            $sql .= " ORDER BY peminjaman_id";

                            $hasil = mysqli_query($config, $sql);

                            if (mysqli_num_rows($hasil) > 0) {
                                while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="selected[]" class="checkbox-item"  value="<?php echo $data['peminjaman_id']; ?>"></td>
                                <td><?php echo $data['peminjaman_id']; ?></td>
                                <td><?php echo $data['customer_id']; ?></td>
                                <td><?php echo $data['barang_id']; ?></td>
                                <td><?php echo $data['tanggal_reservasi']; ?></td>
                                <td><?php echo $data['tanggal_pinjam']; ?></td>
                                <td><?php echo $data['jumlah']; ?></td>
                                <td><?php echo $data['total_harga']; ?></td>
                                <td><?php echo $data['kondisi_awal']; ?></td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='9'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn btn-white-black" onclick="window.location.href='CreatePeminjaman.php';">Create</button>
            <button id="btn-update" class="btn btn-white-black">Update</button>
            <button class="btn btn-danger" onclick="document.getElementById('dataForm').action='peminjaman_hapus.php'; document.getElementById('dataForm').submit();">Delete</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('.checkbox-item');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }

        let checkboxes = document.querySelectorAll('.checkbox-item');
        let btnUpdate = document.getElementById('btn-update');
        let peminjamanID = null;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                if (this.checked) {
                    peminjamanID = this.value;
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                } else {
                    peminjamanID = null;
                }
            });
        });

        btnUpdate.addEventListener('click', function() {
            if (peminjamanID) {
                document.getElementById('dataForm').action = 'UpdatePeminjaman.php?peminjaman_id=' + peminjamanID;
                document.getElementById('dataForm').submit();
            } else {
                alert('Please select a record to update.');
            }
        });
    </script>
</body>
</html>
