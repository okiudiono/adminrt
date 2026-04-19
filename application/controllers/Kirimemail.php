<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
class Kirimemail extends CI_Controller
{
  public function kirim()
  {
    $this->load->view('kirim');
  }

  public function kirim_proses()
  {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = 2;                                      // Enable verbose debug output
      $mail->isSMTP();                                           // Send using SMTP
      $mail->Host       = '124.40.255.2';                    // Set the SMTP server to send through
      // $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
      $mail->Username   = 'mpp@banyumaskab.go.id';              // SMTP username
      $mail->Password   = 'mpp.Banyuma5';                       // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port        = 25;                                   // TCP port to connect to
      $mail->SMTPAutoTLS = false;
      $mail->SMTPSecure  = false;
      //Recipients
      $mail->setFrom('mpp@banyumaskab.go.id', 'Mailer');
      $mail->addAddress('okiudiono@gmail.com', 'Joe User');

      // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');           // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');      // Optional name

      // Content
      $mail->isHTML(true);                                       // Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Message has been sent';
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
