<?php
require_once "config.php"; // Pastikan file ini ada dan mendefinisikan variabel $config

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_customer = $_POST['nama_customer'] ?? null;
    $alamat = $_POST['alamat'] ?? null;
    $telepon = $_POST['telepon'] ?? null;
    $email = $_POST['email'] ?? null;

    if ($nama_customer && $alamat && $telepon && $email) {
        $stmt = $config->prepare("INSERT INTO customer (nama_customer, alamat, telepon, email) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $message = "Prepare failed: (" . $config->errno . ") " . $config->error;
            $status = "danger";
        } else {
            $stmt->bind_param("ssss", $nama_customer, $alamat, $telepon, $email);
            if ($stmt->execute()) {
                $message = "New record created successfully";
                $status = "success";
            } else {
                $message = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                $status = "danger";
            }
            $stmt->close();
        }
    } else {
        $message = "Please fill in all the fields";
        $status = "warning";
    }
}
$config->close();
header("Location: DataCustomer.php?message=$message&status=$status");
exit;
?>
