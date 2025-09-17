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
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>
<div class="content">
    <div class="card col-6">
        <div class="card-header text-center">
            Edit Barang
        </div>
        <div class="card-body">
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
    </div>
</div>

<?php include "templates/footer.php"; ?>