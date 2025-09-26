<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4 text-success">Daftar Barang</h3>

            <?php if ($role === 'admin') { ?>
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="d-flex gap-2">
                        <a href="<?php echo site_url('tambah'); ?>" class="btn btn-success">
                            + Tambah Barang
                        </a>
                        <a href="<?php echo site_url('barang_masuk'); ?>" class="btn btn-success">
                            📥 Barang Masuk
                        </a>
                        <a href="<?php echo site_url('barang_keluar'); ?>" class="btn btn-success">
                            📤 Barang Keluar
                        </a>
                    </div>
                </div>
            <?php } ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle table-custom">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Stok Sekarang</th>
                            <th>Foto</th>
                            <th>Total Masuk</th>
                            <th>Total Keluar</th>
                            <?php if ($role === 'admin') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barang as $row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                <td class="text-center"><?php echo (int) $row['stok']; ?></td>
                                <td class="text-center">
                                    <?php
                                    $folder = 'uploads/';
                                    $foto = !empty($row['foto']) ? $row['foto'] : '';
                                    if ($foto && file_exists(FCPATH . $folder . $foto)) {
                                        echo '<img src="' . base_url($folder . htmlspecialchars($foto)) . '" width="80" height="60" class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">';
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>
                                <td class="text-center"><?php echo (int) $row['total_masuk']; ?></td>
                                <td class="text-center"><?php echo (int) $row['total_keluar']; ?></td>
                                <?php if ($role === 'admin') { ?>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?php echo site_url('detail?id=' . $row['id']); ?>"
                                                class="btn btn-success btn-sm">📊 Riwayat</a>
                                            <a href="<?php echo site_url('edit?id=' . $row['id']); ?>"
                                                class="btn btn-success btn-sm">✏ Edit</a>
                                            <a href="<?php echo site_url('hapus?id=' . $row['id']); ?>"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirmHapus(event, <?php echo $row['id']; ?>)">🗑 Hapus</a>
                                        </div>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmHapus(event, id) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data tidak bisa dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo site_url('hapus?id='); ?>' + id;
            }
        });
        return false;
    }
</script>