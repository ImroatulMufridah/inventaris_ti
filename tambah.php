<?php
include "db_connect.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];
    $lokasi = $_POST['lokasi'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($conn, "INSERT INTO barang (nama_barang, jumlah, lokasi, keterangan) 
                         VALUES ('$nama','$jumlah','$lokasi','$keterangan')");
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
        <form method="post">
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="lokasi" class="form-control">
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>