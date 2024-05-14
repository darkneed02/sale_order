<?php
    include('../class/class_connect_db.php');
    include('../class/class_view_order.php');
    include('../class/class_mail.php');

    $conn = db_connect();

    if(isset($_POST['approve'])){
        $order_id = $_POST['order_id'];
        $email_cus = $_POST['email_cus'];
        $descripton = $_POST['descripton'];
        $list_approve = 'รายการอนุมัติ :';

        /***
         * * ทำการอนุมัติรายการออร์เดอร์
         */
        if(update_status($conn,$order_id,1,$descripton)){
            $result = sendLineNotify($list_approve,$order_id,$descripton);

            // email
            $to = $email_cus;
            $subject = 'รายการใบจ่าย';
            $message = 'ทำการอนุมัติรายการ'.' '. $order_id;
    
            sendMail($subject,$message,$to);

            echo json_encode(['status' => 'success', 'message' => 'ทำการอนุมัติเสร็จสิ้น']);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแล']);
        }
    }

    if(isset($_POST['cancel'])){
        $order_id = $_POST['order_id'];
        $email_cus = $_POST['email_cus'];
        $descripton = $_POST['descripton'];
        $list_approve = 'รายการไม่อนุมัติ :';

        /***
         * * ทำการไม่อนุมัติรายการออร์เดอร์
         */
        if(update_status($conn,$order_id,2,$descripton)){
            $result = sendLineNotify($list_approve,$order_id,$descripton);

            // email
            $to = $email_cus;
            $subject = 'รายการใบจ่าย';
            $message = 'ทำการไม่อนุมัติรายการ'.' '. $order_id;
    
            sendMail($subject,$message,$to);

            echo json_encode(['status' => 'success', 'message' => 'ทำการอนุมัติเสร็จสิ้น']);
        }else{
            echo json_encode(['status' => 'error', 'message' => 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแล']);
        }
    }

?>