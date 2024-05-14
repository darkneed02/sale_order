<?php
    require '../lib/vendor/autoload.php';
    require '../lib/vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../lib/vendor/phpmailer/phpmailer/src/SMTP.php';
    require '../lib/vendor/phpmailer/phpmailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($subject, $body, $email) {
        $mail = new PHPMailer(true); // Enable exceptions
    
        try {
            $mail->SMTPDebug = 0; // Enable SMTP debugging (for testing 0,1,2) by 0 ไม่แสดงข้อมูล,1 แสดงข้อมูลพื้นฐาน, 2 แสดงข้อมูล debug ระดับละเอียดมาก
            $mail->isSMTP();  // Set the mailer to use SMTP
            $mail->Host = 'mail.smt-tours.com'; // host mail
            $mail->SMTPAuth = true;
            $mail->Username = 'mail_approve@smt-tours.com'; // username
            $mail->Password = 'Mail_approve2024_*'; // password
            $mail->SMTPSecure = 'ssl'; // Use 'ssl' or 'tls' based on your server configuration
            $mail->Port = 465; // Adjust the port based on your server configuration
     
            $mail->setFrom('Jaruwat.a@cloudmatethailand.onmicrosoft.com', 'Admin Sender');
            $mail->addAddress('mail_approve@smt-tours.com', 'Admin Recipent');
            $mail->addCC('Jaruwat.a@cloudmatethailand.onmicrosoft.com', 'ผู้เกี่ยวข้อง'); //* CC Mail You can add CC email
            $mail->addCC($email, 'ผู้เกี่ยวข้อง'); //* CC Mail You can add CC email
    
            // Email Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body = $body;
    
            // Send the email
            $mail->send();
    
            return 'Message has been sent';
        } catch (Exception $e) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }

?>