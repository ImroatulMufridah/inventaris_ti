<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya Admin yang bisa menghapus.'); window.location='index.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM barang WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='index.php';</script>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>