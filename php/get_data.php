<?php
    $sale_date = "";
    $buyer = "";
    $saler = "";

    if($rsdata = view_order_details($conn,$order_id)){
        if($row = pg_fetch_assoc($rsdata)){
            $sale_date = $row['sale_date'];
            $buyer = $row['buyer'];
            $saler = $row['saler'];
        }
    }
?>