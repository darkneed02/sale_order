<?php
    include('../class/class_connect_db.php');
    include('../lib/vendor/autoload.php');
    include('../class/class_view_order.php');
    // include('../class/func_date.php');

    $conn = db_connect();

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder());

    
    if($result = view_order_approve_export($conn)){
        if($result && pg_num_rows($result) > 0){
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $header = [
                'เลขที่ใบสั่งขาย',
                'item',
                'วันที่ใบสั่ง',
                'วันที่ส่งมอบ',
                'ผู้ซื้อ',
                'customer email',
                'รายการสินค้า',
                'จำนวน',
                'หน่วย',
                'ราคา/หน่วย',
                'จำนวนเงิน',
                'vat 7%',
                'จำนวนเงินสุทธิ',
                'หน่วย(บาท)',
                'ผู้ขาย',
                'สถานะอนุมัติ',
                'เหตุผล/หมายเหตุ',
                'วันที่อนุมัติ'
            ];
            $sheet->fromArray($header, NULL, 'A1');
            $row = 2;
            while($data = pg_fetch_assoc($result)){
                $sale_id = $data['sale_id'];
                $item_id = $data['item_id'];
                $sale_date = $data['sale_date'];
                $sale_drivery = $data['sale_drivery'];
                $buyer = $data['buyer'];
                $email_cus = $data['email_cus'];
                $order = $data['order'];
                $quantity = $data['quantity'];
                $unit = $data['unit'];
                $unit_price = $data['unit_price'];
                $total = $data['total'];
                $vat = $data['vat'];
                $net_amount =$data['net_amount'];
                $unit_amount = $data['unit_amount'];
                $salyer = $data['salyer'];
                $status  = $data['status'];

                $status_text = $status;

                if ($status == 1) {
                    $status_text = '01';
                } elseif ($status == 2) {
                    $status_text = '02';
                } 

                $descripton = $data['descripton'];

                $approve_date = $data['approve_date'];

                $sheet->setCellValue('A'. $row, $sale_id);
                $sheet->setCellValue('B'. $row, $item_id);
                $sheet->setCellValue('C'. $row, $sale_date);
                $sheet->setCellValue('D'. $row, $sale_drivery);
                $sheet->setCellValue('E'. $row, $buyer);
                $sheet->setCellValue('F'. $row, $email_cus);
                $sheet->setCellValue('G'. $row, $order);
                $sheet->setCellValue('H'. $row, $quantity);
                $sheet->setCellValue('I'. $row, $unit);
                $sheet->setCellValue('J'. $row, $unit_price);
                $sheet->setCellValue('K'. $row, $total);
                $sheet->setCellValue('L'. $row, $vat);
                $sheet->setCellValue('M'. $row, $net_amount);
                $sheet->setCellValue('N'. $row, $unit_amount);
                $sheet->setCellValue('O'. $row, $salyer);
                $sheet->setCellValue('P'. $row, $status_text);
                $sheet->setCellValue('Q'. $row, $descripton);
                $sheet->setCellValue('R'. $row, $approve_date);

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
?>