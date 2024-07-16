<?php 
    session_start();
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
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="fas fa-shopping-cart"></i>
                Peminjaman
            </a>
        </nav>
    </div>
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
    <form class="form-inline my-4 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search...." aria-label="Search">
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
                            include "config.php";

                            $sql = "SELECT peminjaman_id, customer_id, barang_id, tanggal_reservasi, tanggal_pinjam, jumlah, total_harga, kondisi_awal FROM peminjaman ORDER BY peminjaman_id";
                            $hasil = mysqli_query($config, $sql);

                            if (!$hasil) {
                                echo "Error: " . mysqli_error($config);
                            }

                            while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                            <tr>
                                <td><input type="checkbox" class="checkbox-item" value="<?php echo $data['peminjaman_id']; ?>"></td>
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
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="action-buttons">
            <button class="btn btn-white-black" onclick="document.getElementById('dataForm').action='create.php'; document.getElementById('dataForm').submit();">Create</button>
            <button class="btn btn-white-black" id='btn-update'>Update</button>
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
        let peminjamanID;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                if (this.checked) {
                    peminjamanID = this.value;
                }else{
                    peminjamanID = null;
                }
            });
        });


        btnUpdate.addEventListener('click', function() {
            if (peminjamanID) {
                document.getElementById('dataForm').action = 'UpdatePeminjaman.php?peminjaman_id=' + peminjamanID;
                document.getElementById('dataForm').submit();
            }
        });
    </script>
</body>
</html>