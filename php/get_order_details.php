<?php
// Include database connection and view_order_details class
include('../class/class_connect_db.php');
include('../class/class_view_order.php');

// Connect to the database
$conn = db_connect();

// Get the order_id sent from JavaScript
$order_id = $_GET['order_id'];

// Fetch order details from the database based on order_id
$order_details = view_order_details($conn, $order_id);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($order_details) {
    $data_customer = "";
    $data_order_id = "";
    while ($row = pg_fetch_assoc($order_details)) {

        $data_customer .= '
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1">วันที่ขาย</span>
                <input type="text" class="form-control" aria-describedby="basic-addon1" value="'.$row['sale_date'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon2">ชื่อลูกค้า</span>
                <input type="text" class="form-control" aria-describedby="basic-addon2" value="'.$row['saler'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon3">รายการ</span>
                <input type="text" class="form-control" aria-describedby="basic-addon3" value="'.$row['order_sale'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon4">จำนวน</span>
                <input type="text" class="form-control" aria-describedby="basic-addon4" value="'.$row['quantity'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon5">หน่วย</span>
                <input type="text" class="form-control" aria-describedby="basic-addon5" value="'.$row['unit'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon6">ราคา</span>
                <input type="text" class="form-control" aria-describedby="basic-addon6" value="'.$row['total'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon7">สกุลเงิน</span>
                <input type="text" class="form-control" aria-describedby="basic-addon7" value="'.$row['unit_price'].'">
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon8">ผู้ซื้อ</span>
                <input type="text" class="form-control" aria-describedby="basic-addon8" value="'.$row['buyer'].'">
            </div>
        ';
    }

    echo json_encode(array('data_customer'=>$data_customer));
} else {
    // ถ้าไม่พบข้อมูล ส่งข้อความแจ้งเตือนกลับไปยัง JavaScript
    echo json_encode(array('error' => 'ไม่พบข้อมูลใบสั่งขาย'));
}
?>
