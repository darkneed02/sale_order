<?php
    session_start();
    include('../../class/class_connect_db.php');
    include('../../class/class_activity.php');
    include('../../class/class_emp.php');
    include('../../lib/vendor/autoload.php');
    include('generated_emp.php');

    if(isset($_FILES['file_excel'])){
        
        $file = $_FILES['file_excel'];

        // ตรวจสอบสอบการใช้นามสกุลไฟล์
        $file_ex = pathinfo($file['name'], PATHINFO_EXTENSION);
        if($file_ex == 'csv' || $file_ex == 'xlsx'){
            $file_path = '../../upload/employes_import/' . $file['name'];
            move_uploaded_file($file['tmp_name'], $file_path);

            // ดำเนินการ import ไฟล์ excel หรือ csv ตามที่ import เข้ามา
            if($file_ex == 'xlsx'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($file_path);
                $sheet = $spreadsheet->getActiveSheet();

                $highestRow = $sheet->getHighestRow();

                for($i=2;$i <= $highestRow; $i++){
                    $username = $sheet->getCell('A' .$i)->getValue();
                    $password = $sheet->getCell('B' .$i)->getValue();
                    $firstname = $sheet->getCell('C' . $i)->getValue();
                    $lastname = $sheet->getCell('D' . $i)->getValue();
                    $posiiton = $sheet->getCell('E' . $i)->getValue();
                    $department = $sheet->getCell('F' .$i)->getValue();

                    
                    $new_id = generatedempID($conn);


                    if(add_emp($conn,$new_id,$username,$password,$firstname,$lastname,$posiiton,$department,$_SESSION['emp_id'])){
                       //
                    }
                }

                if(activeity_log($conn,$_SESSION['emp_id'],'import')){
                    // 
                }

                echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ']);

            }else if($file_ex == 'csv'){
                $file_handle = fopen($file_path, 'r');
                if($file_handle !== FALSE){
                    while (($data = fgetcsv($file_handle, 1000, ',')) !== FALSE){
                        $username = $data[0];
                        $password = $data[1];
                        $firstname = $data[2];
                        $lastname = $data[3];
                        $posiiton = $data[4];
                        $department = $data[5];

                        // Call function insert department
                        if(add_emp($conn,$new_id,$username,$password,$firstname,$lastname,$posiiton,$department,$_SESSION['emp_id'])){
                            //
                        }
                    }

                    if(activeity_log($conn,$_SESSION['emp_id'],'import')){
                        // 
                    }

                    echo json_encode(['status' => 'success', 'message' => 'บันทึกข้อมูลสำเร็จ']);

                    fclose($file_handle);
                }else{
                    echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาดในการบันทึกข้อมูล']);
                }
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'ไฟล์ไม่ถูกต้อง กรุณาใส่ไฟล์นามสกุล xlsx หรือ csv เท่านั้น']);
        }
    }else{
        echo json_encode(['status' => 'error', 'message' => 'กรุณาใส่ไฟล์']);
    }
?>