<?php
session_start();
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barang_id = (int) $_POST['barang_id'];
    $jumlah = (int) $_POST['jumlah'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);

    // simpan log barang masuk
    $sql_insert = "INSERT INTO barang_masuk (barang_id, jumlah, tanggal) 
                   VALUES ('$barang_id', '$jumlah', '$tanggal')";
    mysqli_query($conn, $sql_insert) or die("Query insert error: " . mysqli_error($conn));

    // update stok di tabel barang (tambah)
    $sql_update = "UPDATE barang SET jumlah = jumlah + $jumlah WHERE id = $barang_id";
    mysqli_query($conn, $sql_update) or die("Query update error: " . mysqli_error($conn));

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
                <!-- Pilih Barang dengan Select2 AJAX -->
                <div class="mb-3">
                    <label for="barang_id" class="form-label">Pilih Barang</label>
                    <select name="barang_id" id="barang_id" class="form-select" required></select>
                    <div class="invalid-feedback">Silakan pilih barang.</div>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah (pcs)</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                    <div class="invalid-feedback">Jumlah barang wajib diisi.</div>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    <div class="invalid-feedback">Tanggal wajib diisi.</div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
                    <button type="submit" class="btn btn-success">💾 Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery & Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
    })();

    $('#barang_id').select2({
        placeholder: "Ketik nama barang...",
        allowClear: true,
        ajax: {
            url: "get_barang.php?type=masuk", // 👈 pakai type=keluar
            dataType: "json",
            delay: 250,
            data: function (params) {
                return { q: params.term || "" };
            },
            processResults: function (data) {
                return { results: data.results };
            },
            cache: true
        }
    });
</script>

<?php include "templates/footer.php"; ?>