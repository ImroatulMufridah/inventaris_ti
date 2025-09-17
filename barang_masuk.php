<?php
session_start();
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = $_POST['barang_id'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal'];

    mysqli_query($conn, "INSERT INTO barang_masuk (barang_id, jumlah, tanggal) 
                         VALUES ('$barang_id', '$jumlah', '$tanggal')");

    // update stok di tabel barang
    mysqli_query($conn, "UPDATE barang SET jumlah = jumlah + $jumlah WHERE id = $barang_id");

    header("Location: index.php?success=1");
    exit;
}
?>

<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<div class="content">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-success mb-4">📥 Tambah Barang Masuk</h4>

            <form method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="barang_id" class="form-label">Pilih Barang</label>
                    <select name="barang_id" id="barang_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        $barang = mysqli_query($conn, "SELECT * FROM barang");
                        while ($b = mysqli_fetch_assoc($barang)) {
                            echo "<option value='{$b['id']}'>{$b['nama_barang']}</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Silakan pilih barang.</div>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah (pcs)</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                    <div class="invalid-feedback">Jumlah barang wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    <div class="invalid-feedback">Tanggal wajib diisi.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
                    <button type="submit" class="btn btn-success">💾 Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Bootstrap form validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?php include "templates/footer.php"; ?>