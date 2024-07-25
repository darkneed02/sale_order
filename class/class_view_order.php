<?php

    function view_order($conn){
        $query = "select DISTINCT sale_id from tb_approve_sale where status = 0 ";
        return pg_query($conn,$query);
    }

    function view_order_approve($conn){
        $query = "select DISTINCT ON (sale_id) * from tb_approve_sale where status = 1 or status= 2 ";
        return pg_query($conn,$query);
    }

    function view_order_approve_export($conn){
        $query = "select * from tb_approve_sale where status = 1 or status= 2 ";
        return pg_query($conn,$query);
    }
    
    function view_order_details($conn,$order_id){
        $query = "select * from tb_approve_sale where sale_id = '$order_id'";
        return pg_query($conn,$query);
    }

    function update_status($conn, $order_id, $status, $descripton, $approve_by){
        $query = "UPDATE tb_approve_sale 
                  SET status = '$status', approve_date = NOW(), approve_by = '$approve_by', descripton = '$descripton' 
                  WHERE sale_id = '$order_id'";
        
        $result = pg_query($conn, $query);
    
        if (!$result) {
            error_log("Error in query: " . pg_last_error($conn));
            return false;
        }
    
        return true;
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

    function import_data($conn,$sale_id,$sale_date,$buyer,$order,$quantity,$unit,$saler,$total,$unit_price,$email_cus,$vat,$net_amount){
        $query = "insert into tb_approve_sale (sale_order_id,sale_date,buyer,order_sale,quantity,unit,saler,total,unit_price,email_cus,vat,net_amount) 
        values ('$sale_id','$sale_date','$buyer','$order','$quantity','$unit','$saler','$total','$unit_price','$email_cus','$vat','$net_amount')";

        return pg_query($conn, $query);
    }
    // old

    function import_data_excel($conn, $item_id, $sale_date, $sale_drivery, $buyer, $email_cus, $order, $quantity, $unit, $unit_price, $total, $vat, $net_amount, $unit_amount, $salyer, $status, $create_by, $sale_id) {
        // Preparing the SQL query with quotes around the "order" column name
        $query = "INSERT INTO tb_approve_sale (item_id, sale_date, sale_drivery, buyer, email_cus, \"order\", quantity, unit, unit_price, total, vat, net_amount, unit_amount, salyer, status, create_by, sale_id) 
                  VALUES ('$item_id', '$sale_date', '$sale_drivery', '$buyer', '$email_cus', '$order', '$quantity', '$unit', '$unit_price', '$total', '$vat', '$net_amount', '$unit_amount', '$salyer', '$status', '$create_by','$sale_id')";
    
        // Executing the query
        $result = pg_query($conn, $query);
        
        // Checking for errors
        if (!$result) {
            // Output error message
            echo "Error: " . pg_last_error($conn);
        }
    
        return $result;
    }

    function data_table_order($conn,$order_id){
        $query = "select * from tb_approve_sale where sale_id = '$order_id'";
        return pg_query($conn,$query);
    }

    function export_data_id($conn, $order_id) {
        $query = "SELECT * FROM tb_approve_sale WHERE sale_id='$order_id' AND status IN (1, 2)";
        return pg_query($conn, $query);
    }

?>