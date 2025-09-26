<div class="content">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-success mb-4">📤 Tambah Barang Keluar</h4>
            <form id="formKeluar" method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="barang_id" class="form-label">Pilih Barang</label>
                    <select name="barang_id" id="barang_id" class="form-select" required></select>
                    <div class="invalid-feedback">Silakan pilih barang.</div>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah (pcs)</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                    <div class="invalid-feedback">Jumlah barang wajib diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Keluar</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    <div class="invalid-feedback">Tanggal wajib diisi.</div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?php echo site_url('barang'); ?>" class="btn btn-secondary">⬅ Kembali</a>
                    <button type="submit" class="btn btn-success">💾 Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('formKeluar').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: 'Konfirmasi',
            text: "Yakin ingin menambahkan barang keluar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
    $('#barang_id').select2({
        placeholder: "Ketik nama barang...",
        allowClear: true,
        ajax: {
            url: "<?php echo site_url('get_barang?type=keluar'); ?>",
            dataType: "json",
            delay: 250,
            data: function (params) { return { q: params.term || "" }; },
            processResults: function (data) { return { results: data.results }; },
            cache: true
        }
    });
    <?php if (!empty($success)): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Barang keluar berhasil disimpan!',
            timer: 1500,
            showConfirmButton: false
        }).then(() => { window.location.href = '<?php echo site_url('barang'); ?>'; });
    <?php elseif ($error === 'stok_kurang'): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Stok tidak mencukupi untuk jumlah yang diminta!'
        });
    <?php endif; ?>
</script>