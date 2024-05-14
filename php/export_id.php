<?php
    include('../class/class_connect_db.php');
    include('../lib/vendor/autoload.php');
    include('../class/class_view_order.php');
    include('../class/func_date.php');

    $conn = db_connect();

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder());

    if(isset($_POST['order_id'])){

        $order_id = $_POST['order_id'];

        if($result = export_data_id($conn,$order_id)){
            if($result && pg_num_rows($result) > 0){
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
    
                $header = [
                    'เลขที่ใบสั่งขาย',
                    'วันที่ใบสั่ง',
                    'ผู้ซื้อ',
                    'รายการสินค้า',
                    'จำนวน',
                    'หน่วยงาน',
                    'จำนวนเงิน',
                    'หน่วย(บาท)',
                    'ผู้ขาย',
                    'สถานะ',
                    'เหตุผล/หมายเหตุ',
                    'วันที่อนุมัติ'
                ];
                $sheet->fromArray($header, NULL, 'A1');
                $row = 2;
                while($data = pg_fetch_assoc($result)){
                    $sale_id = $data['sale_order_id'];
                    $sale_date = $data['sale_date'];
                    $buyer = $data['buyer'];
                    $order_sale = $data['order_sale'];
                    $quantity = $data['quantity'];
                    $unit = $data['unit'];
                    $saler = $data['saler'];
                    $total = $data['total'];
                    $unit_price = $data['unit_price'];
                    $approve_date = $data['create_date'];
                    $descripton = $data['descripton'];
    
                    $status  = $data['status'];
    
                    $status_text = $status;
    
                    if ($status == 1) {
                        $status_text = '01';
                    } elseif ($status == 2) {
                        $status_text = '02';
                    } 
    
                    $Approve_Date_DC = converToThaiDate($approve_date); // approve date
                    $sale_date_DC = converdate($sale_date);
    
                    $sheet->setCellValue('A'. $row, $sale_id);
                    $sheet->setCellValue('B'. $row, $sale_date_DC);
                    $sheet->setCellValue('C'. $row, $buyer);
                    $sheet->setCellValue('D'. $row, $order_sale);
                    $sheet->setCellValue('E'. $row, $quantity);
                    $sheet->setCellValue('F'. $row, $unit);
                    $sheet->setCellValue('G'. $row, $total);
                    $sheet->setCellValue('H'. $row, $unit_price);
                    $sheet->setCellValue('I'. $row, $saler);
                    $sheet->setCellValue('J'. $row, $status_text);
                    $sheet->setCellValue('K'. $row, $descripton);
                    $sheet->setCellValue('L'. $row, $Approve_Date_DC);
    
                    $row++;
                }
    
                $writer = new Xlsx($spreadsheet);
                $output_file = '../uploads/exports/export_data_status_apprve.xlsx'; // เปลี่ยนการย้าย path ได้
                $writer->save($output_file);
    
               // ปลดปล่อยทรัพยากร์ที่ใช้ในการ fetch ข้อมูล
               pg_free_result($result);
    
               // ส่งชื่อไฟล์ Excel กลับไปยัง JavaScript
               echo $output_file;
            }else{
                echo 'Error: No data to export.';
            }
        }else{
            echo 'Error: Export function failed.';
        }
    }
?>