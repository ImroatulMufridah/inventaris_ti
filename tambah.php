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

<?php include "templates/style_tambah.php"; ?> 

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header text-center">
            Tambah Barang
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Barang</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>