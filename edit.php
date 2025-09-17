<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya Admin yang bisa.'); window.location='index.php';</script>";
    exit;
}

include "db_connect.php";

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data barang
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
$data = mysqli_fetch_assoc($result);

// Jika tombol Update ditekan
if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $jumlah = (int) $_POST['jumlah'];

    // Cek apakah ada file foto yang diunggah
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        $filename = time() . '_' . basename($_FILES['foto']['name']);
        $target_file = $target_dir . $filename;

        // Pindahkan file ke folder uploads
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Hapus foto lama jika ada
            if ($data['foto'] && file_exists($target_dir . $data['foto'])) {
                unlink($target_dir . $data['foto']);
            }
            $foto_sql = ", foto='$filename'";
        } else {
            echo "<script>alert('Gagal upload foto!');</script>";
            $foto_sql = "";
        }
    } else {
        $foto_sql = "";
    }

    $update = mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$nama', jumlah='$jumlah' $foto_sql
        WHERE id=$id");

    if ($update) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Gagal update data!');</script>";
    }
}

// Include template
include "templates/header.php";
include "templates/navbar.php";
include "templates/sidebar.php";
include "templates/style_edit.php";
?>

<body>
    <div class="container mt-5">
        <h2>Edit Barang</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Foto Barang</label><br>
                <?php if ($data['foto']) { ?>
                    <img src="uploads/<?= $data['foto'] ?>" width="100" class="mb-2 rounded"><br>
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