<?php
include('../lib/vendor/autoload.php');
include('../class/class_view_order.php');
include('../class/class_connect_db.php');
include('function_line.php');
include('class_mail.php');

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

            /***
             * * new record data
             */

            $sale_id = $row[0];
            $item_id = $row[1];
            $sale_date = $row[2];
            $sale_drivery = $row[3];
            $buyer = $row[4];
            $email_cus = $row[5];
            $order = $row[6];
            $quantity = $row[7];
            $unit = $row[8];
            $unit_price = $row[9];
            $total = $row[10];
            $vat = $row[11];
            $net_amount = $row[12];
            $unit_amount = $row[13];
            $salyer = $row[14];


            echo $sale_id;

            // เรียกฟังก์ชัน import_data และตรวจสอบผลลัพธ์
            // if (import_data($conn, $sale_id, $sale_date, $buyer, $order, $quantity, $unit, $saler, $total, $unit_price, $email_cus, $vat, $net_amount)) {
            //     echo "บันทึกสำเร็จสำหรับรายการ $sale_id\n";
            // } else {
            //     echo "การบันทึกรายการ $sale_id ล้มเหลว\n";
            // }

            /**
             * * เพิ่มข้อมูลใหม่ 
             */
            if(import_data_excel($conn,$item_id,$sale_date,$sale_drivery,$buyer,$email_cus,$order,$quantity,$unit,$unit_price,$total,$vat,$net_amount,$unit_amount, $salyer, 0, 'U00001',$sale_id)){
                echo "บันทึกสำเร็จสำหรับรายการ $sale_id\n";
            }else{
                echo "การบันทึกรายการ $sale_id ล้มเหลว\n";
            }
        }
        
        // Prepare order_id and description for LINE Notify
        $order_id = "[เปิดรายการเพิ่มอนุมัติ][https://www.cm-mejobs.com/sale_order/list_order.php]";

        $id_customer = 'U6d42adeba8f14f9f94143e690073626d';

        $userId = $id_customer;
        $message = 'ทำการเพิ่มรายการอนุมัติ'. $order_id;

        $response = sendLineMessage($userId,$message);

        if ($result) {
            // ส่งอีเมล์
            $short_txt = 'มีรายการอนุมัติรายการ'; // You might want to change this value
            $description = 'https://www.cm-mejobs.com/sale_order/list_order.php'; // You might want to change this value

            send_mail($order_id, $short_txt, $description);
        }
    } else {
        echo "ไฟล์ที่อัปโหลดไม่ใช่ไฟล์ Excel ที่รองรับ\n";
    }
} else {
    echo "ไม่มีไฟล์ถูกอัปโหลด\n";
}
?>
