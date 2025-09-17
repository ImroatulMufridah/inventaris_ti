<?php
include "db_connect.php";

$id = $_POST['barang_id'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

// simpan transaksi keluar
mysqli_query($conn, "INSERT INTO barang_keluar (barang_id, jumlah, tanggal) 
                     VALUES ('$id', '$jumlah', '$tanggal')");

// update jumlah & total_keluar di tabel barang
mysqli_query($conn, "UPDATE barang 
                     SET jumlah = jumlah - $jumlah, 
                         total_keluar = total_keluar + $jumlah 
                     WHERE id = $id");

header("Location: daftar_barang.php");
?>
