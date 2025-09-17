<?php
require 'vendor/autoload.php'; 
require 'fpdf.php';           
include "db_connect.php";     

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mufridahfidah@gmail.com';   
        $mail->Password   = 'xpoc wiqd npbq vcws';      
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('mufridahfidah@gmail.com', 'Inventaris TI');
        $mail->addAddress($_POST['email']); 
        $mail->addAttachment($pdfPath);

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
<?php include "templates/style_email.php"; ?> 

</html>
