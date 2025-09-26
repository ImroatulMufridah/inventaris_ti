<div class="content">
    <div class="card col-12">
        <div class="card-header">
            <h3>Laporan Inventaris Barang</h3>
            <div class="no-print">
                <a href="<?php echo site_url('barang'); ?>" class="btn btn-light">← Kembali</a>
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
                        foreach ($result as $row) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                <td class="text-center"><?php echo (int) $row['jumlah']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td colspan="2">Total Barang</td>
                            <td><?php echo $total; ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>