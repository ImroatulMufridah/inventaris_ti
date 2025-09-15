<?php
include "db_connect.php";

// Hapus barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
    header("Location: index.php");
    exit;
}

// Ambil data
$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Inventaris Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Inventaris Barang</h2>
        <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Barang</a>
        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Foto</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                        <td>
                            <?php if ($row['foto']) { ?>
                                <img src="uploads/<?= $row['foto'] ?>" width="80" height="60"
                                    style="object-fit:cover; border-radius:5px;">
                            <?php } else { ?>
                                <span class="text-muted">-</span>
                            <?php } ?>
                        </td>
                        <td><?= $row['lokasi'] ?></td>
                        <td><?= $row['keterangan'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="index.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')"
                                class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

            <?php $no = 1;
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['lokasi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="index.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')"
                            class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>