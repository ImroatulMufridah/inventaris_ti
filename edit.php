<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya Admin yang bisa.'); window.location='index.php';</script>";
    exit;
}
include "db_connect.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$nama', jumlah='$jumlah'
        WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>
<?php include "templates/style_edit.php"; ?>

</html>