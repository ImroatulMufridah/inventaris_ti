<?php
session_start();
include "db_connect.php";

// Pastikan ada ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $error = "ID user tidak valid!";
} else {
    $id = (int) $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM user WHERE id=$id");
    if ($hapus) {
        $success = "User berhasil dihapus!";
    } else {
        $error = "User gagal dihapus!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hapus User</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        <?php if (isset($success)) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $success ?>',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location = 'user.php';
            });
        <?php } elseif (isset($error)) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $error ?>'
            }).then(() => {
                window.location = 'user.php';
            });
        <?php } ?>
    </script>
</body>

</html>