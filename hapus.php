<?php
session_start();
include "db_connect.php";

// Load SweetAlert2
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

if (!isset($_SESSION['user_id'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Silakan login terlebih dahulu!'
        }).then(() => window.location='login.php');
    </script>";
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Hanya Admin yang bisa menghapus!'
        }).then(() => window.location='index.php');
    </script>";
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Request',
            text: 'ID tidak valid!'
        }).then(() => window.location='index.php');
    </script>";
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
            }).then(() => window.location.href = 'index.php');
        <?php } else { ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Data barang gagal dihapus!'
            }).then(() => window.location.href = 'index.php');
        <?php } ?>
    </script>
</body>

</html>