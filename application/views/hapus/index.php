<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hapus Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
        <?php if (isset($success)) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?php echo $success; ?>',
                timer: 1500,
                showConfirmButton: false
            }).then(() => window.location.href = '<?php echo $redirect; ?>');
        <?php } elseif (isset($error)) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?php echo $error; ?>'
            }).then(() => window.location.href = '<?php echo $redirect; ?>');
        <?php } ?>
    </script>
</body>

</html>