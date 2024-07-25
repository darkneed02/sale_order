<?php
    include('../class/class_connect_db.php');
    include('../class/class_view_order.php');
    include('class_mail.php');
    include('function_line.php');

    $conn = db_connect();

    if (isset($_POST['approve'])) {
        $order_id = $_POST['order_id'];
        $email = $_POST['email'];
        $descripton = $_POST['descripton'];
        $approve_by = 'some_user'; // เปลี่ยนเป็นผู้ใช้จริงในระบบ
    
        if (update_status($conn, $order_id, 1, $descripton, $approve_by)) {

            $id_customer = 'U6d42adeba8f14f9f94143e690073626d';

            $userId = $id_customer;
            $message = 'อนุมัติรายการ'.$order_id;

            $response = sendLineMessage($userId,$message);

            $short_txt = 'ไม่อนุมัติรายการ'; // You might want to change this value
            $description = $descripton; // You might want to change this value

            send_mail($order_id, $short_txt, $description,$email);


            echo "ทำการอนุมัติเรียบร้อย";
        } else {
            echo "เกิดข้อผิดพลาด";
        }
    }


    if(isset($_POST['cancel'])){
        $order_id = $_POST['order_id'];
        $email = $_POST['email'];
        $descripton = $_POST['descripton'];
        $approve_by = 'some_user'; // เปลี่ยนเป็นผู้ใช้จริงในระบบ
    
        if (update_status($conn, $order_id, 2, $descripton, $approve_by)) {

            $id_customer = 'U6d42adeba8f14f9f94143e690073626d';

            $userId = $id_customer;
            $message = 'ไม่อนุมัติรายการ'.$order_id;

            $response = sendLineMessage($userId,$message);

            $short_txt = 'ไม่อนุมัติรายการ'; // You might want to change this value
            $description = $descripton; // You might want to change this value

            send_mail($order_id, $short_txt, $description,$email);

            echo "ทำการไม่อนุมัติเรียบร้อย";
        } else {
            echo "เกิดข้อผิดพลาด";
        }
    }

?>