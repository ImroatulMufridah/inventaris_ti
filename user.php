<?php
include "db_connect.php";
$result = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC");
$link = 'user';
include "templates/header.php";
include "templates/navbar.php";
include "templates/sidebar.php";
?>
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
                                    <a href="hapus_user.php?id=<?= $row['id'] ?>"
                                        onclick="return confirm('Yakin hapus user ini?')" class="btn btn-success">🗑
                                        Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "templates/footer.php"; ?>