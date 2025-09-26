<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="text-success mb-4">📊 Riwayat Barang</h3>
            <div class="mb-4">
                <h5>Nama Barang: <span
                        class="text-primary"><?php echo htmlspecialchars($data_barang['nama_barang']); ?></span></h5>
                <p>Stok Sekarang: <b><?php echo (int) $data_barang['jumlah']; ?></b></p>
                <?php if (!empty($data_barang['foto']) && file_exists(FCPATH . 'uploads/' . $data_barang['foto'])) { ?>
                    <img src="<?php echo base_url('uploads/' . htmlspecialchars($data_barang['foto'])); ?>" width="120"
                        height="100" class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-success">📥 Riwayat Barang Masuk</h5>
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($masuk)) {
                                foreach ($masuk as $row) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                        <td><?php echo (int) $row['jumlah']; ?></td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5 class="text-success">📤 Riwayat Barang Keluar</h5>
                    <table class="table table-bordered table-sm text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($keluar)) {
                                foreach ($keluar as $row) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                        <td><?php echo (int) $row['jumlah']; ?></td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <a href="<?php echo site_url('barang'); ?>" class="btn btn-secondary">⬅ Kembali</a>
            </div>
        </div>
    </div>
</div>