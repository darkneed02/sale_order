<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: text/html; charset=utf-8');

// Load Composer's autoload file
require '../lib/vendor/autoload.php';

function send_mail($order_id, $short_txt, $description, $email_cus)
{
    $mail = new PHPMailer;
    $mail->CharSet = "utf-8";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // แก้ไขเมื่อได้ smte แล้ว
    $mail->Port = 587; // แก้ไขเมื่อได้ smte แล้ว
    $mail->SMTPSecure = 'tls'; // แก้ไขเมื่อได้ smte แล้ว
    $mail->SMTPAuth = true;

    $gmail_username = "cloudmatethailand@gmail.com"; // gmail ที่ใช้ส่ง
    $gmail_password = "oubo mnqf smxg gohs"; // รหัสผ่าน gmail
    // ตั้งค่าอนุญาตการใช้งานได้ที่นี่ https://myaccount.google.com/lesssecureapps?pli=1

    $sender = 'Sender Mail'; // ชื่อผู้ส่ง
    $email_sender = "cloudmatethailand@gmail.com"; // เมล์ผู้ส่ง
    $email_receiver = "sapidsrollout@nttdata.co.th"; // เมล์ผู้รับ *** บ.ประกัน ib4direct@tokiomarinesafety.co.th
    $email_customer = $email_cus; // เมล์ลูกค้า

    $subject = $order_id; // หัวข้อเมล์

    $mail->Username = $gmail_username;
    $mail->Password = $gmail_password;
    $mail->setFrom($email_sender, $sender);
    $mail->addAddress($email_receiver);
    $mail->addAddress($email_customer); // Add the customer recipient
    $mail->Subject = $subject;

    $email_content = '
	เรียน คุณ Cloudmate  <br> <br>

	CLOUDMATE <br>
    เรื่อง : ' . $short_txt . ' <br>
    รายการ: ' . $order_id . ' <br>
    รายละเอียด :  ' . $description . ' <br>

		ขอแสดงความนับถือ <br>
		    CLOUMATE
	';

    // ถ้ามี email ผู้รับ
    if ($email_receiver) {
        $mail->msgHTML($email_content);

        if (!$mail->send()) { // สั่งให้ส่ง email
            // กรณีส่ง email ไม่สำเร็จ
            // echo "<h3 class='text-center'>ระบบมีปัญหา กรุณาลองใหม่อีกครั้ง</h3>";
            // echo $mail->ErrorInfo; // ข้อความ รายละเอียดการ error
        } else {
            // กรณีส่ง email สำเร็จ
            // echo "ระบบได้ส่งข้อความไปเรียบร้อย";
        }
    }
}

?>
