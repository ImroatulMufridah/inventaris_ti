<?php
require 'vendor/autoload.php';
require 'fpdf.php';
include "db_connect.php";

$link = 'kirim_email';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$alertType = '';
$alertMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Laporan Inventaris Barang', 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1);
    $pdf->Ln(3);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(80, 10, 'Nama Barang', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Foto', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 11);
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(80, 10, $row['nama_barang'], 1, 0);
        $pdf->Cell(30, 10, $row['jumlah'], 1, 0, 'C');
        $pdf->Cell(60, 10, $row['foto'], 1, 1);
    }

    $pdfPath = __DIR__ . "/laporan_inventaris.pdf";
    $pdf->Output('F', $pdfPath);

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mufridahfidah@gmail.com';
        $mail->Password = 'xpoc wiqd npbq vcws';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('mufridahfidah@gmail.com', 'Inventaris TI');
        $mail->addAddress($_POST['email']);
        $mail->addAttachment($pdfPath);

        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body = nl2br($_POST['pesan']);

        $mail->send();
        $alertType = 'success';
        $alertMessage = 'Email berhasil dikirim dengan laporan inventaris!';
    } catch (Exception $e) {
        $alertType = 'error';
        $alertMessage = 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
    }
}
?>
<?php include "templates/header.php"; ?>
<?php include "templates/navbar.php"; ?>
<?php include "templates/sidebar.php"; ?>

<!-- Load SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="content">
    <div class="card p-4 col-6">
        <h3 class="mb-4 text-success">📧 Kirim Email</h3>
        <form id="emailForm" method="post">
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
                <textarea name="pesan" rows="5" class="form-control" placeholder="Tulis pesan di sini..."
                    required></textarea>
            </div>
            <button type="submit" id="btnSendEmail" class="btn btn-success">Kirim Email</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Konfirmasi sebelum submit
    document.getElementById('emailForm').addEventListener('submit', function (e) {
        e.preventDefault(); // hentikan submit sementara

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Email akan dikirim ke penerima!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form jika konfirmasi Ya
                e.target.submit();
            }
        });
    });
</script>

<?php if (!empty($alertType)): ?>
    <script>
        Swal.fire({
            icon: '<?= $alertType ?>',
            title: '<?= $alertType === "success" ? "Berhasil" : "Gagal" ?>',
            text: '<?= $alertMessage ?>'
        });
    </script>
<?php endif; ?>