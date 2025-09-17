<?php
include "db_connect.php";
$link = 'laporan';

$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM barang"))['total'];
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<div class="content">
    <!-- Tabel laporan -->
    <div class="card col-12">
        <div class="card-header">
            <h3>Laporan Inventaris Barang</h3>
            <div class="no-print">
                <a href="index.php" class="btn btn-light">← Kembali</a>
                <button onclick="window.print()" class="btn btn-success">🖨 Cetak</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-success text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                <td class="text-center"><?= (int) $row['jumlah'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td colspan="2">Total Barang</td>
                            <td><?= $total ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include "templates/footer.php"; ?>