<div class="content">
    <div class="card p-4 col-6">
        <h3 class="mb-4 text-success">📧 Kirim Email</h3>
        <form id="emailForm" method="post">
            <div class="mb-3">
                <label class="form-label">Email Tujuan</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Subjek</label>
                <input type="text" name="subject" class="form-control" value="Laporan Inventaris Barang" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pesan</label>
                <textarea name="pesan" rows="5" class="form-control" placeholder="Tulis pesan di sini..."
                    required></textarea>
            </div>
            <button type="submit" id="btnSendEmail" class="btn btn-success">Kirim Email</button>
            <a href="<?php echo site_url('barang'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('emailForm').addEventListener('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Email akan dikirim ke penerima!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
    <?php if (!empty($alertType)): ?>
        Swal.fire({
            icon: '<?php echo $alertType; ?>',
            title: '<?php echo $alertType === "success" ? "Berhasil" : "Gagal"; ?>',
            text: '<?php echo $alertMessage; ?>'
        });
    <?php endif; ?>
</script>