<?php
include "db_connect.php";
$result = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
$link = 'user';
include "templates/header.php";
include "templates/navbar.php";
include "templates/sidebar.php";
?>

<!-- Load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4 text-success">Daftar User</h3>
            <div class="mb-3">
                <a href="tambah_user.php" class="btn btn-success">+ Tambah User</a>
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
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td class="text-center"><?= ucfirst($row['role']) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-delete" data-id="<?= $row['id'] ?>">
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
    // Event listener untuk tombol hapus
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
                    // Redirect ke hapus_user.php
                    window.location = 'hapus_user.php?id=' + userId;
                }
            });
        });
    });

    // Optional: SweetAlert2 notifikasi sukses hapus
    <?php if (isset($_GET['hapus']) && $_GET['hapus'] == 'success') { ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'User berhasil dihapus!'
        });
    <?php } ?>
</script>

<?php include "templates/footer.php"; ?>