<?php
    $sale_date = "";
    $buyer = "";
    $saler = "";
    $email_cus = "";

    if($rsdata = view_order_details($conn,$order_id)){
        if($row = pg_fetch_assoc($rsdata)){
            $sale_date = $row['sale_date'];
            $buyer = $row['buyer'];
            $saler = $row['salyer'];
            $email_cus = $row['email_cus'];
        }
    }
?>