<?php
include "db_connect.php";

$id = $_POST['barang_id'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

// simpan transaksi masuk
mysqli_query($conn, "INSERT INTO barang_masuk (barang_id, jumlah, tanggal) 
                     VALUES ('$id', '$jumlah', '$tanggal')");

// update jumlah & total_masuk di tabel barang
mysqli_query($conn, "UPDATE barang 
                     SET jumlah = jumlah + $jumlah, 
                         total_masuk = total_masuk + $jumlah 
                     WHERE id = $id");

header("Location: daftar_barang.php");
?>