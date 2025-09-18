<?php
session_start();
include "db_connect.php";

$link = 'barang';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

$result = mysqli_query($conn, "
    SELECT 
        b.id, 
        b.nama_barang, 
        b.jumlah AS stok,
        b.foto,
        IFNULL((SELECT SUM(m.jumlah) FROM barang_masuk m WHERE m.barang_id = b.id), 0) AS total_masuk,
        IFNULL((SELECT SUM(k.jumlah) FROM barang_keluar k WHERE k.barang_id = b.id), 0) AS total_keluar
    FROM barang b
    ORDER BY b.id DESC
");

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
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="d-flex gap-2">
                        <a href="tambah.php" class="btn btn-success">
                            + Tambah Barang
                        </a>
                        <a href="barang_masuk.php" class="btn btn-success">
                            📥 Barang Masuk
                        </a>
                        <a href="barang_keluar.php" class="btn btn-success">
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
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                <td class="text-center"><?= (int) $row['stok'] ?></td>
                                <td class="text-center">
                                    <?php
                                    $folder = 'uploads/';
                                    $foto = !empty($row['foto']) ? $row['foto'] : '';

                                    if ($foto && file_exists($folder . $foto)) {
                                        echo '<img src="' . $folder . htmlspecialchars($foto) . '" width="80" height="60" class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">';
                                    } else {
                                        echo '<span class="text-muted">-</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-center"><?= (int) $row['total_masuk'] ?></td>
                                <td class="text-center"><?= (int) $row['total_keluar'] ?></td>

                                <?php if ($role === 'admin') { ?>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">📊
                                                Riwayat</a>
                                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">✏ Edit</a>
                                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-success btn-sm"
                                                onclick="return confirmHapus(event, <?= $row['id']; ?>)">
                                                🗑 Hapus
                                            </a>
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
                window.location.href = 'hapus.php?id=' + id;
            }
        });

        return false;
    }
</script>


<?php include "templates/footer.php"; ?>