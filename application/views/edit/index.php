<div class="content">
    <div class="card col-6">
        <div class="card-body">
            <h2>Edit Barang</h2>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Foto Barang</label><br>
                    <?php if (!empty($data['foto'])) { ?>
                        <img src="<?php echo base_url('uploads/' . $data['foto']); ?>" width="100" class="mb-2 rounded"><br>
                    <?php } ?>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control"
                        value="<?php echo $data['nama_barang']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?php echo $data['jumlah']; ?>"
                        required>
                </div>
                <button type="submit" name="update" class="btn btn-success">Update</button>
                <a href="<?php echo site_url('barang'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data barang akan diperbarui!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
    <?php if (isset($update_success) && $update_success): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data barang berhasil diupdate!',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location = '<?php echo site_url('barang'); ?>';
        });
    <?php elseif (!empty($foto_error)): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Upload Foto',
            text: 'Foto tidak berhasil diupload!'
        });
    <?php elseif (isset($update_success) && !$update_success): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal update data!'
        });
    <?php endif; ?>
</script>