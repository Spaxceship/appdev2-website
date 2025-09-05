<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
function send_verification($jgfullname, $jgemail, $jgotp){
    $mail = new PHPMailer(true);                              // Passing true enables exceptions
    try {       
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ich1rojm@gmail.com';                 // SMTP username
        $mail->Password = 'pqxf wuqi apxp jnlm';                // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        //Recipients
        $mail->setFrom('ich1rojm@gmail.com','Santa Claus');
        $mail->addAddress($jgemail);     // Add a recipient
        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "OTP Verification";
        $mail->Body    = '<h3 style="color: #004aad; margin-bottom: 20px;">Hello, '.$jgfullname.'</h3>
<p>Thank you for signing up at <strong>BR Staycation Condotel</strong>.</p>
<p style="margin-top: 20px;">To complete your registration, please proceed to the OTP verification page and enter the code below to verify your email address.</p>
<p>Verification code:</p>
<div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; font-size: 24px; color: #004aad; font-weight: bold;">
        '.$jgotp.' </div>
<p style="margin-top:10px;font-size: 14px; color: #6c757d;">— BR Staycation Team</p>';
        $mail->send();
        ?>
            <script>
                alert("Email Successfully Send!!")
            </script>
        <?php
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>