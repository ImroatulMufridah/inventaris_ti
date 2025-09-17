<?php
session_start();
include "db_connect.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Barang tidak ditemukan.");
}

$id = (int) $_GET['id'];

// Ambil data barang
$barang = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
if (!$barang || mysqli_num_rows($barang) == 0) {
    die("Data barang tidak ditemukan.");
}
$data_barang = mysqli_fetch_assoc($barang);

// Ambil data barang masuk
$masuk = mysqli_query($conn, "
    SELECT tanggal, jumlah 
    FROM barang_masuk 
    WHERE barang_id = $id 
    ORDER BY tanggal DESC
");

// Ambil data barang keluar
$keluar = mysqli_query($conn, "
    SELECT tanggal, jumlah 
    FROM barang_keluar 
    WHERE barang_id = $id 
    ORDER BY tanggal DESC
");
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="text-success mb-4">📊 Riwayat Barang</h3>

            <div class="mb-4">
                <h5>Nama Barang: <span class="text-primary"><?= htmlspecialchars($data_barang['nama_barang']) ?></span>
                </h5>
                <p>Stok Sekarang: <b><?= (int) $data_barang['jumlah'] ?></b></p>
                <?php if (!empty($data_barang['foto']) && file_exists("uploads/" . $data_barang['foto'])) { ?>
                    <img src="uploads/<?= htmlspecialchars($data_barang['foto']) ?>" width="120" height="100"
                        class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">
                <?php } ?>
            </div>

            <div class="row">
                <!-- Barang Masuk -->
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
                            <?php if (mysqli_num_rows($masuk) > 0) {
                                while ($row = mysqli_fetch_assoc($masuk)) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                        <td><?= (int) $row['jumlah'] ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="2"><em>Tidak ada data</em></td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

                <!-- Barang Keluar -->
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
                            <?php if (mysqli_num_rows($keluar) > 0) {
                                while ($row = mysqli_fetch_assoc($keluar)) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                        <td><?= (int) $row['jumlah'] ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="2"><em>Tidak ada data</em></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
            </div>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>