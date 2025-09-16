<?php
require 'vendor/autoload.php'; // PHPMailer
require 'fpdf.php';           // FPDF
include "db_connect.php";     // koneksi database

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Ambil data dari database
    $result = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

    // 2. Buat PDF laporan inventaris
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Inventaris Barang', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1);
    $pdf->Ln(3);

    // Header tabel
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Foto', 1, 1, 'C');

    // Isi tabel
    $pdf->SetFont('Arial', '', 11);
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(80, 10, $row['nama_barang'], 1, 0);
        $pdf->Cell(30, 10, $row['jumlah'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['foto'], 1, 1); // hanya tampilkan nama file
    }

    // Simpan PDF ke file
    $pdfPath = __DIR__ . "/laporan_inventaris.pdf";
    $pdf->Output('F', $pdfPath);

    // 3. Kirim email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mufridahfidah@gmail.com';   
        $mail->Password   = 'xpoc wiqd npbq vcws';      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('mufridahfidah@gmail.com', 'Inventaris TI');
        $mail->addAddress($_POST['email']); 
        // Lampirkan PDF
        $mail->addAttachment($pdfPath);

        // Isi email
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body    = nl2br($_POST['pesan']);

        $mail->send();
        $alert = '<div class="alert alert-success mt-3">✅ Email berhasil dikirim dengan laporan inventaris!</div>';
    } catch (Exception $e) {
        $alert = '<div class="alert alert-danger mt-3">❌ Gagal mengirim email. Error: ' . $mail->ErrorInfo . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Email - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .btn-success { background-color: #084127ff !important; border-color: #084127ff !important; }
        .btn-success:hover { background-color: #06341f !important; border-color: #06341f !important; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h3 class="mb-4 text-success">📧 Kirim Email</h3>
                    <?php if (!empty($alert)) echo $alert; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Email Tujuan</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" name="subject" class="form-control" value="Laporan Inventaris Barang" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" rows="5" class="form-control" placeholder="Tulis pesan di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Email</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
