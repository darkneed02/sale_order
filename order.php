<?php
include('./include/header.php');
include('./include/navbar.php');
include('./class/class_view_order.php');
include('./class/class_connect_db.php');

$conn = db_connect();
$order_id = $_GET['order_id'];
include('./php/get_data.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="card mb-4 col-md-12">
            <form id="order_data" class="user">
                <div class="card-header">รายการออร์เดอร์ : <?php echo $order_id ?></div>
                <div class="card-body">
                    <div class="card shadow md-4">
                        <div class="card-body text-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        วันที่การขาย: <?php echo $sale_date ?>
                                    </div>
                                    <div class="col-md-4">
                                        ชื่อลูกค้า: <?php echo $saler ?>
                                    </div>
                                    <div class="col-md-4">
                                        ผู้ขาย: <?php echo $buyer ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-bordered" id="priceTable">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>เลขใบสั่งขาย</th>
                                        <th>รหัสสินค้า</th>
                                        <th>วันที่ใบสั่ง</th>
                                        <th>วันที่ส่งมอบ</th>
                                        <th>รายการสินค้า</th>
                                        <th>จำนวน</th>
                                        <th>หน่วย</th>
                                        <th>ราคา/หน่วย</th>
                                        <th>จำนวนเงิน</th>
                                        <th>ภาษี</th>
                                        <th>จำนวนเงินสุทธิ</th>
                                        <th>หน่วย(บาท)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($order_data = data_table_order($conn,$order_id)){
                                        $count = 1;
                                        while($row = pg_fetch_assoc($order_data)){
                                    ?>
                                    <tr>
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $row['sale_id']; ?></td>
                                        <td><?php echo $row['item_id']; ?></td>
                                        <td><?php echo $row['sale_date']; ?></td>
                                        <td><?php echo $row['sale_drivery']; ?></td>
                                        <td><?php echo $row['order']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['unit']; ?></td>
                                        <td><?php echo $row['unit_price']; ?></td>
                                        <td><?php echo $row['total']; ?></td>
                                        <td><?php echo $row['vat']; ?></td>
                                        <td><?php echo $row['net_amount']; ?></td>
                                        <td><?php echo $row['unit_amount']; ?></td>
                                    </tr>
                                    <?php                                                                                                        
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
    <label for="descripton" class="small mb-1">หมายเหตุ</label>
    <textarea name="descripton" id="descripton" class="form-control"></textarea>
</div>
<div class="col-md-12">
    <label for="email_cus" class="small mb-1">E-mail ลูกค้า</label>
    <input type="text" class="form-control" name="email_cus" id="email_cus" value="<?php echo $email_cus; ?>">
</div>
                    </div>
                    <div class="card shadow md-4">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="small mb-1"></label>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-block btn-success" name="btn_approve" id="btn_approve" data-order_id="<?php echo $order_id; ?>">อนุมัติ</button>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-block btn-danger" name="btn_cancle" id="btn_cancle" data-order_id="<?php echo $order_id; ?>">ไม่อนุมัติ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php   
include('./include/script.php');
include('./include/footer.php');
?>
