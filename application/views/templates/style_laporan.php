<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #4e7b56ff;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Header Laporan */
        .laporan-header {
            background: #084127ff;
            color: #fff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .laporan-header h3 {
            margin: 0;
        }

        .laporan-header .btn {
            margin-left: 10px;
        }

        /* Card Laporan */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* Tabel */
        table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        tfoot td {
            background: #08412733 !important;
            font-weight: bold;
        }

        /* Tombol */
        .btn-warning {
            background-color: #ffc107;
            color: #000;
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-light {
            background-color: #f8f9fa;
            color: #084127ff;
            border: 1px solid #084127ff;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
        }

        /* Print */
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .laporan-header {
                background: none;
                color: #000;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <!-- Header laporan -->
        <div class="laporan-header">
            <h3>Laporan Inventaris Barang</h3>
            <div class="no-print">
                <a href="<?= site_url('barang') ?>" class="btn btn-light">← Kembali</a>
                <button onclick="window.print()" class="btn btn-warning">🖨 Cetak</button>
            </div>
        </div>

        <!-- Tabel laporan -->
        <div class="card shadow-sm">
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

</body>