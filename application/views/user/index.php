<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4 text-success">Daftar User</h3>
            <div class="mb-3">
                <a href="<?php echo site_url('tambah_user'); ?>" class="btn btn-success">+ Tambah User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="text-center"><?php echo ucfirst($row['role']); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-delete" data-id="<?php echo $row['id']; ?>">
                                        🗑 Hapus
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Yakin hapus user?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '<?php echo site_url('hapus_user'); ?>?id=' + userId;
                }
            });
        });
    });
</script>