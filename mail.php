<?php
    include('./class/class_mail.php');

    $to = 'mail_approve@smt-tours.com';
    $subject = 'ทดสอบการส่งอีเมล์';
    $message = 'สวัสดีครับ นี่คืออีเมล์ทดสอบจาก PHP';

    if(sendMail($subject,$message,$to)){
        echo 'Email sent successfully.';
    }else{
        echo 'Failed to send email';
    }
?>