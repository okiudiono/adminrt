<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Developer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('akun_model', 'akunapi');
        require APPPATH . 'libraries/phpmailer/src/Exception.php';
        require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH . 'libraries/phpmailer/src/SMTP.php';
    }
    public function login()
    {
        $this->load->view('template/header');
        $this->load->view('developer/login');
        $this->load->view('template/footer');
    }
    public function daftar()
    {
        $mail = new PHPMailer(true);
        try {
            // Pengaturan server
            $mail->isSMTP();
            $mail->Host       = '124.40.255.2'; // Atau 'localhost' atau alamat IP lokal server SMTP
            $mail->SMTPAuth   = false;       // Set ke false jika tidak memerlukan autentikasi
            $mail->Port       = 25;          // Port SMTP, 25 adalah port default untuk SMTP tanpa SSL/TLS
            $mail->Username = 'mpp@banyumaskab.go.id';
            $mail->Password = 'mpp.Banyuma5';
            $mail->SMTPDebug = 2;

            // Pengaturan penerima
            $mail->setFrom('mpp@banyumaskab.go.id', 'Your Name'); // Pengirim
            $mail->addAddress('okiudiono@gmail.com', 'Recipient Name'); // Penerima

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Subject Here';
            $mail->Body    = '<p>This is the HTML message body in bold!</p>';
            $mail->AltBody = 'This is the plain text version of the email content';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        die;
        // $this->load->view('template/header');
        // if ($this->input->method() === 'post') {
        //     // print_r($_POST);
        //     $rules = $this->akunapi->rules();
        //     $this->form_validation->set_rules($rules);
        //     if ($this->form_validation->run() == FALSE) {

        //         return $this->load->view('developer/daftar');
        //     }

        //     $feedback = [
        //         'email' => $this->input->post('email'),
        //         're_email' => $this->input->post('re_email'),
        //         'url_activeted' => uniqid('', true)
        //     ];

        //     $feedback_saved = $this->akunapi->insert($feedback);

        //     if ($feedback_saved) {
        //         $this->session->set_flashdata('success', 'Data berhasil di simpan!');
        //         return $this->load->view('developer/daftar');
        //     } else {

        //         $this->session->set_flashdata('error', 'Data gagal di simpan!');
        //         return $this->load->view('developer/daftar');
        //     }
        // }
        // $this->load->view('developer/daftar');
        // $this->load->view('template/footer');
    }
    public function url_activated($link)
    {
        $user_name = 'masterapi';
        $password  = 'admin123*';
        $token  = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhcHByZXN0c2VydmljZSIsImF1ZCI6InBlbmdndW5hIiwiaWF0IjoxNzIxNzg5MTY1LCJuYmYiOjE3MjE3ODkxNzV9.lgNiIFEHifmWvSPlDrGr7CZoV3qoYtq1qgUPEI_KuOY';
        $curl = curl_init();
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
            'x-username:' . $user_name,
            'x-password:' . $password
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://10.98.33.103:8000/api/userbyutlactive/' . $link . '',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        die($response);
        curl_close($curl);
        $datas = json_decode($response, true);
        if ($datas['status'] == 'sukses') {

            $data = [
                'email'   => $datas['data']['email']
            ];
            $this->load->view('template/headerreg');
            $this->load->view('developer/_urlactiveted', $data);
            $this->load->view('template/footer');
        } else {
            die;
        }
    }
}
