<?php
include('../lib/vendor/autoload.php');
include('../class/class_view_order.php');
include('../class/class_connect_db.php');
include('../class/class_mail.php');

$conn = db_connect();

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_FILES['excelFile'])) {
    $file_extension_check_A = $_FILES['excelFile'];
    $file_extension_check_B = pathinfo($file_extension_check_A['name'], PATHINFO_EXTENSION);
    // ตรวจสอบไฟล์ excel หรือไม่ ต้องเป็น xlsx, xls, csv เท่านั้น
    if ($file_extension_check_B == 'xlsx' || $file_extension_check_B == 'xls' || $file_extension_check_B == 'csv') {
        // ชื่อไฟล์เดิม
        $file_name = $_FILES['excelFile']['name']; // ชื่อเก่า
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = uniqid(); // ชื่อใหม่
        // ที่อยู่ไฟล์
        $file_tmp  = $_FILES['excelFile']['tmp_name'];
        $path_file = '../uploads/imports/' . $file_name; // ที่อยู่ไฟล์
        move_uploaded_file($file_tmp, $path_file);

        $inputFileName  =  $path_file;
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // ลบหัวคอลัมน์
        unset($sheetData[0]);

        foreach ($sheetData as $row) {
            // ตรวจสอบและข้ามแถวว่าง
            if (empty($row[0])) {
                continue;
            }

            $sale_id = $row[0];
            $sale_date = $row[1];
            $saler = $row[2];
            $order = $row[3];
            $quantity = $row[4];
            $unit = $row[5];
            $total = $row[6];
            $unit_price = $row[7];
            $buyer = $row[8];

            // เรียกฟังก์ชัน import_data และตรวจสอบผลลัพธ์
            if (import_data($conn, $sale_id, $sale_date, $buyer, $order, $quantity, $unit, $saler, $total, $unit_price)) {
                echo "บันทึกสำเร็จสำหรับรายการ $sale_id\n";

                // Prepare order_id and description for LINE Notify
                $order_id = "[เปิดรายการเพิ่มอนุมัติ](http://localhost/Approve%20sales%20order/list_order.php)";
                $description = "";
                $list_approve = "รายการใหม่";

                // Send LINE Notify
                $result = sendLineNotify($list_approve,$order_id, $description);

                if ($result) {
                    // ส่งอีเมล์
                    $to = 'mail_approve@smt-tours.com';
                    $subject = 'มีรายการเพิ่มข้อมูลขออนุมัติจ่าย';
                    $message = $order_id;

                    sendMail($subject, $message, $to);
                }
            } else {
                echo "การบันทึกรายการ $sale_id ล้มเหลว\n";
            }
        }
    } else {
        echo "ไฟล์ที่อัปโหลดไม่ใช่ไฟล์ Excel ที่รองรับ\n";
    }
} else {
    echo "ไม่มีไฟล์ถูกอัปโหลด\n";
}
?>
