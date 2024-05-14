<?php

    function view_order($conn){
        $query = "select DISTINCT sale_order_id from tb_approve_sale where status = 0 ";
        return pg_query($conn,$query);
    }

    function view_order_approve($conn){
        $query = "select DISTINCT ON (sale_order_id) * from tb_approve_sale where status = 1 or status= 2 ";
        return pg_query($conn,$query);
    }

    function view_order_approve_export($conn){
        $query = "select * from tb_approve_sale where status = 1 or status= 2 ";
        return pg_query($conn,$query);
    }
    
    function view_order_details($conn,$order_id){
        $query = "select * from tb_approve_sale where sale_order_id = '$order_id'";
        return pg_query($conn,$query);
    }

    function update_status($conn,$order_id,$status,$descripton){
        $query = "update tb_approve_sale set status = '$status', create_date=NOW(), descripton='$descripton' where sale_order_id='$order_id'";
        return pg_query($conn,$query);
    }

     // Line Notify
     function sendLineNotify($list_approve,$orderId,$descripton) {
        $token = 'hREwoK6OZguzBzUA4jckt5OcxOG5mPMqwGYC2khwGI9';
        $message = $list_approve . ' ' . $orderId . '\n' . 'รายละเอียด: ' . $descripton;
    
        $data = array('message' => $message);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://notify-api.line.me/api/notify');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ));
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        if ($response === false) {
            return json_encode(array('error' => 'เกิดข้อผิดพลาดในการส่งข้อมูล'));
        } else {
            return json_encode(array('success' => 'ส่งข้อมูลสำเร็จ'));
        }
    }

    function import_data($conn,$sale_id,$sale_date,$buyer,$order,$quantity,$unit,$saler,$total,$unit_price){
        $query = "insert into tb_approve_sale (sale_order_id,sale_date,buyer,order_sale,quantity,unit,saler,total,unit_price) 
        values ('$sale_id','$sale_date','$buyer','$order','$quantity','$unit','$saler','$total','$unit_price')";

        return pg_query($conn, $query);
    }

    function data_table_order($conn,$order_id){
        $query = "select * from tb_approve_sale where sale_order_id = '$order_id'";
        return pg_query($conn,$query);
    }

    function export_data_id($conn, $order_id) {
        $query = "SELECT * FROM tb_approve_sale WHERE sale_order_id='$order_id' AND status IN (1, 2)";
        return pg_query($conn, $query);
    }

?>