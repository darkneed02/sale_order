<?php
    include('./include/header.php');
    include('./include/navbar.php');

    include('./class/class_connect_db.php');
    include('./class/class_view_order.php');

    $conn = db_connect();
?>

    <div class="container-fluid">
        <div class="row">
            <div class="card shadow mb-4 col-md-12">
                <div class="card-header">รายการใบสั่งขาย</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                                if($menu = view_order($conn)){
                                        while($row = pg_fetch_assoc($menu)){
                                ?>
                                <li><a href="order.php?order_id=<?php echo $row['sale_order_id'] ?>">ใบสั่งขายเลขที่ <?php echo $row['sale_order_id'] ?></a></li>
                                <?php                                                                       
                                    }
                                }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php
    include('./include/script.php');
    include('./include/footer.php');
?>