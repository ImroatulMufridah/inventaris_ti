<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Kirim_email extends CI_Controller
{
    protected $session;
    protected $input;
    protected $form_validation;
    protected $Barang_model;

    public function __construct()
    {
        parent::__construct();
        
        // Load dependencies
        $this->load->database();
        $this->load->model('Barang_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form', 'file', 'string']);
        
        // Cek session
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        
        // Load required libraries
        require_once APPPATH . '../vendor/autoload.php';
    }

    public function index()
    {
        $data['alertType'] = '';
        $data['alertMessage'] = '';
        if ($this->input->method() === 'post') {
            try {
                // Validasi input
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('subject', 'Subject', 'required');
                $this->form_validation->set_rules('pesan', 'Pesan', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $data['alertType'] = 'error';
                $data['alertMessage'] = validation_errors();
                $this->load->view('templates/header');
                $this->load->view('templates/navbar');
                $this->load->view('templates/sidebar');
                $this->load->view('kirim_email/index', $data);
                $this->load->view('templates/footer');
                return;
            }
            try {
                $result = $this->Barang_model->get_all_barang();
                if (empty($result)) {
                    throw new Exception('Tidak ada data barang untuk dilaporkan');
                }

                require_once(APPPATH . 'third_party/fpdf/fpdf.php');
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
            foreach ($result as $row) {
                $pdf->Cell(10, 10, $no++, 1, 0, 'C');
                $pdf->Cell(80, 10, $row['nama_barang'], 1, 0);
                $pdf->Cell(30, 10, $row['jumlah'], 1, 0, 'C');
                $pdf->Cell(60, 10, $row['foto'], 1, 1);
            }
            $pdfPath = FCPATH . "laporan_inventaris.pdf";
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
                $mail->addAddress($this->input->post('email'));
                $mail->addAttachment($pdfPath);
                $mail->isHTML(true);
                $mail->Subject = $this->input->post('subject');
                $mail->Body = nl2br($this->input->post('pesan'));
                $mail->send();
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
                $data['alertType'] = 'success';
                $data['alertMessage'] = 'Email berhasil dikirim dengan laporan inventaris!';
            } catch (Exception $e) {
                $data['alertType'] = 'error';
                $data['alertMessage'] = 'Gagal mengirim email. Error: ' . $mail->ErrorInfo;
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
            }
            } catch (Exception $e) {
                $data['alertType'] = 'error';
                $data['alertMessage'] = 'Error: ' . $e->getMessage();
                if (isset($pdfPath) && file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
            }
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kirim_email/index', $data);
        $this->load->view('templates/footer');
    }
}
