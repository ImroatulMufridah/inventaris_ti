<?php
session_start();
include "db_connect.php";

// Ambil role user dari session, aman jika belum login
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4 text-success">Daftar Barang</h3>

            <?php if ($role === 'admin') { ?>
                <div class="d-flex justify-content-between mb-3">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Barang</a>
                    <a href="kirim_email.php" class="btn btn-outline-success">📧 Kirim Email</a>
                </div>
            <?php } ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle table-custom">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Foto</th>
                            <?php if ($role === 'admin') { ?>
                                <th>Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                <td class="text-center"><?= (int) $row['jumlah'] ?></td>
                                <td class="text-center">
                                    <?php if (!empty($row['foto'])) { ?>
                                        <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" width="80" height="60"
                                            class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">
                                    <?php } else { ?>
                                        <span class="text-muted">-</span>
                                    <?php } ?>
                                </td>

                                <?php if ($role === 'admin') { ?>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏ Edit</a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>"
                                            onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger">🗑
                                            Hapus</a>
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

<?php include "templates/footer.php"; ?>