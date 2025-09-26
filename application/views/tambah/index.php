<div class="content">
    <div class="card col-6">
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
                    <a href="<?php echo site_url('barang'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>