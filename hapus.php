<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Hanya Admin yang bisa menghapus!',
        }).then(() => { window.location='index.php'; });
    </script>";
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hapus Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        <?php if ($hapus) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data barang berhasil dihapus!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location = 'index.php';
            });
        <?php } else { ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data barang gagal dihapus!',
            }).then(() => {
                window.location = 'index.php';
            });
        <?php } ?>
    </script>
</body>

</html>