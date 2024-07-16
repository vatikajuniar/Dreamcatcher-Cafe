<?php
include "config.php";

// UNTUK ISI PESAN BERHASIl

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Customer</title>
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
            <a class="navbar-brand" href="#">
                <i class="fas fa-home"></i>
                <i class="bi bi-person-video2"></i>
                Data Customer
            </a>
        </nav>
    </div>
    <form class="form-inline my-4 my-lg-0" method="GET">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search...." aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <div class="container-fluid">
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-<?php echo $_GET['status']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_GET['message']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <form id="dataForm" action="customer_hapus.php" method="post">
                    <table class="table table-striped">
                        <thead>
                         <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>customer_id</th>
                            <th>nama_customer</th>
                            <th>alamat</th>
                            <th>telepon</th>
                            <th>email</th>
                         </tr>
                        </thead>

                        <tbody>
                        <?php
                           $search = isset($_GET['search']) ? mysqli_real_escape_string($config, $_GET['search']) : '';

                           $sql = "SELECT customer_id, nama_customer, alamat, telepon, email FROM customer";
                           if ($search) {
                               $sql .= " WHERE nama_customer LIKE '%$search%'";
                           }
                           $sql .= " ORDER BY customer_id";

                           $hasil = mysqli_query($config, $sql);

                           if (mysqli_num_rows($hasil) > 0) {
                               while ($data = mysqli_fetch_array($hasil)) {
                            
                            if (!$hasil) {
                                die("Query Error: " . mysqli_error($config));
                            }
                            ?>
                            <tr>
                                <td><input type="checkbox" name="selected[]" value="<?php echo $data['customer_id']; ?>"></td>
                                <td><?php echo $data['customer_id']; ?></td>
                                <td><?php echo $data['nama_customer']; ?></td>
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
            <button class="btn btn-white-black" onclick="document.getElementById('dataForm').action='createDataCostumer.php'; document.getElementById('dataForm').submit();">Create</button>
            <button class="btn btn-white-black" onclick="updateSelectedCustomer();">Update</button>
            <button class="btn btn-danger" onclick="document.getElementById('dataForm').submit();">Delete</button>
        </div>
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

        function updateSelectedCustomer() {
            var selected = document.querySelector('input[name="selected[]"]:checked');
            if (selected) {
                var customerId = selected.value;
                window.location.href = 'update_customer.php?customer_id=' + customerId;
            } else {
                alert('Please select a customer to update.');
            }
        }
    </script>
</body>
</html>
