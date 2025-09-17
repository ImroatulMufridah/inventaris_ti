<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Hanya Admin yang bisa mengakses!',
        }).then(() => { window.location='index.php'; });
    </script>";
    exit;
}

include "db_connect.php";

$id = (int) $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $jumlah = (int) $_POST['jumlah'];

    $foto_sql = '';
    // Upload foto jika ada
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "uploads/";
        $filename = time() . '_' . basename($_FILES['foto']['name']);
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            // Hapus foto lama
            if ($data['foto'] && file_exists($target_dir . $data['foto'])) {
                unlink($target_dir . $data['foto']);
            }
            $foto_sql = ", foto='$filename'";
        } else {
            $foto_error = true;
        }
    }

    $update = mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$nama', jumlah='$jumlah' $foto_sql
        WHERE id=$id");

    $update_success = $update && empty($foto_error);
}
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<!-- Load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content">
    <div class="card col-6">
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
                    <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>

<?php if (isset($_POST['update'])): ?>
    <script>
        <?php if ($update_success): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data barang berhasil diupdate!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location = 'index.php';
            });
        <?php elseif (!empty($foto_error)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Upload Foto',
                text: 'Foto tidak berhasil diupload!'
            });
        <?php else: ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Gagal update data!'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>