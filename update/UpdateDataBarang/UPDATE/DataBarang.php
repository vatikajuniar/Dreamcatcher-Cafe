<?php
include "config.php";

// UNTUK MENAMBAHKAN PESAN BERHASIL ATAU TIDAK

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
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
                <i class="bi bi-folder-fill"></i>
                Data Barang
            </a>
        </nav>
    </div>
    <form id="dataForm" action="barang_hapus.php" method="post">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>barang_id</th>
                    <th>nama_barang</th>
                    <th>kategori</th>
                    <th>stok</th>
                    <th>harga_sewa</th>
                    <th>supplier_id</th>
                </tr>
            </thead>
            <tbody>
            <?php
               $search = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';

               $sql = "SELECT barang_id, nama_barang, kategori, stok, harga_sewa, supplier_id FROM barang";
               if ($search) {
                   $sql .= " WHERE barang_id LIKE '%$search%' OR nama_barang LIKE '%$search%' OR kategori LIKE '%$search%' OR stok LIKE '%$search%' OR harga_sewa LIKE '%$search%' OR supplier_id LIKE '%$search%'";
               }
               $sql .= " ORDER BY barang_id";

               $hasil = mysqli_query($config, $sql);

               if (!$hasil) {
                   die("Query Error: " . mysqli_error($config));
               }

               if (mysqli_num_rows($hasil) > 0) {
                   while ($data = mysqli_fetch_array($hasil)) {
                ?>
                <tr>
                    <td><input type="checkbox" name="selected[]" value="<?php echo $data['barang_id']; ?>"></td>
                    <td><?php echo $data['barang_id']; ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['kategori']; ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td><?php echo $data['harga_sewa']; ?></td>
                    <td><?php echo $data['supplier_id']; ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
    <div class="action-buttons">
        <button class="btn btn-white-black" onclick="updateSelected();">Update</button>
        <button class="btn btn-danger" onclick="document.getElementById('dataForm').submit();">Delete</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }

        function updateSelected() {
            var checkboxes = document.getElementsByName('selected[]');
            var selected = [];
            for (var checkbox of checkboxes) {
                if (checkbox.checked) {
                    selected.push(checkbox.value);
                }
            }
            if (selected.length === 1) {
                document.getElementById('dataForm').action = 'UpdateDataBarang.php?barang_id=' + selected[0];
                document.getElementById('dataForm').submit();
            } else {
                alert('Please select exactly one record to update.');
            }
        }
    </script>
</body>
</html>
