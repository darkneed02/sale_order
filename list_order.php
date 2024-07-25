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
            <div class="card-header bg-primary text-white">รายการใบสั่งขาย</div>
            <div class="card-body">
                <ul class="list-group">
                    <?php
                        if ($menu = view_order($conn)) {
                            while ($row = pg_fetch_assoc($menu)) {
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="order.php?order_id=<?php echo $row['sale_id'] ?>" class="text-decoration-none">ใบสั่งขายเลขที่ <?php echo $row['sale_id'] ?></a>
                        <span class="badge bg-primary rounded-pill">#<?php echo $row['sale_id'] ?></span>
                    </li>
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