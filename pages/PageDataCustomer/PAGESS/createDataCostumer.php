<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data Customer</title>
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
        form label {
            width: 150px; /* Adjust as needed */
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
                <i class="bi bi-person-video2"></i>
                Create Data Customer
            </a>
        </nav>
    </div>
    <div class="container">
        <form method="post" action="create_customer_action.php">
            <div class="form-group row">
                <label for="nama-customer" class="col-sm-2 col-form-label">Nama Customer:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama-customer" name="nama_customer" placeholder="Enter Nama Customer" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Enter Alamat" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Enter Telepon" maxlength="15" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="255" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="submit" name="ubah" value="Simpan" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='DataCustomer.php'">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
