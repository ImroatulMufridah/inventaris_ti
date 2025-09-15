<?php
include "db_connect.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $foto = "";

    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $foto = time() . "_" . basename($_FILES['foto']['name']);
        $target_file = $target_dir . $foto;

        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            die("Gagal upload foto, cek permission folder uploads/");
        }
    }

    // Simpan data ke database
    $sql = "INSERT INTO barang (nama_barang, jumlah, foto) 
            VALUES ('$nama','$jumlah','$foto')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2>Tambah Barang</h2>
        <!-- enctype WAJIB ada -->
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Foto Barang</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>