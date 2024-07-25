<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// โหลดไฟล์ autoload.php ของ Composer
require './lib/vendor/autoload.php';

$mail = new PHPMailer(true);

    // ตั้งค่าการเชื่อมต่อ SMTP
    $mail = new PHPMailer;
	$mail->CharSet = "utf-8";
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';//แก้ไขเมื่อได้ smte แล้ว
	$mail->Port = 587;//แก้ไขเมื่อได้ smte แล้ว
	$mail->SMTPSecure = 'tls';//แก้ไขเมื่อได้ smte แล้ว
	$mail->SMTPAuth = true;


    // ตั้งค่าผู้ส่งและผู้รับ
    $gmail_username = "cloudmatethailand@gmail.com"; // gmail ที่ใช้ส่ง
	$gmail_password = "oubo mnqf smxg gohs"; // รหัสผ่าน gmail

    $email_sender = "cloudmatethailand@gmail.com"; // เมล์ผู้ส่ง 
	$email_receiver = "overlag02@gmail.com"; // เมล์ผู้รับ *** บ.ประกัน ib4direct@tokiomarinesafety.co.th

	$subject = "CLOUDMATE"; // หัวข้อเมล์


    $mail->Username = $gmail_username;
	$mail->Password = $gmail_password;
	$mail->setFrom($email_sender, 'Sender Mail');
	$mail->addAddress($email_receiver);
	$mail->Subject = $subject;


    $email_content = '
	เรียน คุณ Test System  <br> <br>

	Test mail <br>

		ขอแสดงความนับถือ <br>
		    CLOUMATE
	';

    if ($email_receiver) {
		$mail->msgHTML($email_content);


		if (!$mail->send()) {  // สั่งให้ส่ง email
            echo "ไม่สำเร็จ";
		} else {
			echo "ส่งสำเร็จ";
		}
	}
?>
