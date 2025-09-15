<?php
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
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2>Edit Barang</h2>
        <form method="post">
            <div class="mb-3">
                <label>Foto Barang</label><br>
                <?php if ($data['foto']) { ?>
                    <img src="uploads/<?= $data['foto'] ?>" width="100" class="mb-2"><br>
                <?php } ?>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>