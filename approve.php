<?php
    include('./include/header.php');
    include('./include/navbar.php');

    include('./class/class_connect_db.php');
    include('./class/class_view_order.php');


    $conn = db_connect();
?>
<div class="container-fluid">
<div class="row">
            <div class="card-body">
                <div class="card text-center">
                    <div class="card-body">
                    <div class="tab">
                        <div class="left-tab">
                            <h3>รายการใบสั่งขาย</h3>
                            <ul id="orderList">
                                <!-- <li><a href="#">ใบสั่งขายเลขที่ 2100000058</a></li>
                                <li><a href="#">ใบสั่งขายเลขที่ 2100000059</a></li> -->
                                <!-- เพิ่มรายการใบสั่งขายอื่น ๆ ตรงนี้ตามต้องการ -->
                                <?php
                                    if($menu = view_order($conn)){
                                        while($row = pg_fetch_assoc($menu)){
                                ?>
                                <li><a href="#">ใบสั่งขายเลขที่ <?php echo $row['sale_order_id'] ?></a></li>
                                <?php                                                                       
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="right-tab" id="detailsTab">
                            <h3 id="orderTitle">รายละเอียดใบสั่งขาย</h3>
                            <div id="orderDetails"></div>
                            <div id="approvalButtons">
                                <button id="btn_approve" onclick="approveOrder()" class="btn btn-success">อนุมัติ</button>
                                <button id="btn_cancel" onclick="disapproveOrder()" class="btn btn-danger">ไม่อนุมัติ</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card-footer text-muted">
                        ระบบทำการอนุมัติจ่าย
                    </div>
                </div>
            </div>
        </div>

</div>
<?php
    include('./include/script.php');
    include('./include/footer.php');
?>