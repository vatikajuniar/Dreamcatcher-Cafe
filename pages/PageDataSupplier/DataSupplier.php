<?php
session_start();
include "config.php";

// Cek apakah ada status success atau error dari session
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] === 'success') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data supplier berhasil ditambahkan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } elseif ($_SESSION['status'] === 'error') {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Terjadi kesalahan saat menambahkan data supplier. Silakan coba lagi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        // Jika ada pesan error, tambahkan ini untuk menampilkan pesan error detailnya
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
        }
    }

    // Hapus session setelah menampilkan pesan
    unset($_SESSION['status']);
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier</title>
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
                <i class="bi bi-truck"></i>
                Data Supplier
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

    <form class="form-inline my-4 my-lg-0" method="GET">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search...." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button class="btn my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form id="dataForm" action="supplier_hapus.php" method="post">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>supplier_id</th>
                                <th>nama_supplier</th>
                                <th>alamat</th>
                                <th>telepon</th>
                                <th>email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $search = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';

                            $sql = "SELECT supplier_id, nama_supplier, alamat, telepon, email FROM supplier";
                            if ($search) {
                                $sql .= " WHERE nama_supplier LIKE '%$search%'";
                            }
                            $sql .= " ORDER BY supplier_id";

                            $hasil = mysqli_query($config, $sql);

                            if (mysqli_num_rows($hasil) > 0) {
                                while ($data = mysqli_fetch_array($hasil)) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="selected[]" class="checkbox-item" value="<?php echo $data['supplier_id']; ?>"></td>
                                <td><?php echo $data['supplier_id']; ?></td>
                                <td><?php echo $data['nama_supplier']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['telepon']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="action-buttons">
            <a href="CreateSupplier.php" class="btn btn-white-black">Create</a>
            <button class="btn btn-white-black" id='btn-update'>Update</button>
            <button class="btn btn-danger" onclick="document.getElementById('dataForm').submit();">Delete</button>
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
        let supplierID = null;

        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('click', function() {
                if (this.checked) {
                    supplierID = this.value;
                    checkboxes.forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                } else {
                    supplierID = null;
                }
            });
        });

        btnUpdate.addEventListener('click', function() {
            if (supplierID) {
                document.getElementById('dataForm').action = 'UpdateDataSupplier.php?supplier_id=' + supplierID;
                document.getElementById('dataForm').submit();
            } else {
                alert('Please select a record to update.');
            }
        });
    </script>
</body>
</html>
