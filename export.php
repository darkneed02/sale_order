<?php
    include('./include/header.php');
    include('./include/navbar.php');

    include('./class/class_connect_db.php');
    include('./class/class_view_order.php');

    $conn = db_connect();
?>
 <div class="container-fluid">
    <div class="row">
        <div class="card shadow mb-4 col-md-12 border-left-primary">
            <div class="card-header">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">รายการนำข้อมูลออก</h1>
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="btn_export_all" name="btn_export_all">
                        <i class="fas fa-save"></i>
                        นำข้อมูลออกทั้งหมด
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="approve_data">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสการขาย</th>
                                <th>วันที่ทำการขาย</th>
                                <th>ผู้ขาย</th>
                                <th>รายการ</th>
                                <th>จำนวน</th>
                                <th>หน่วย</th>
                                <th>ราคา</th>
                                <th>หน่วย(สกุลเงิน)</th>
                                <th>ผู้ซื้อ</th>
                                <th>สถานะ</th>
                                <th>นำข้อมูลออก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($approve = view_order_approve($conn)){
                                    $count = 1;
                                    while($row = pg_fetch_assoc($approve)){
                            ?>
                                <tr>
                                    <td><?php echo $count++ ?></td>
                                    <td class="text-center"><?php echo $row['sale_id']; ?></td>
                                    <td class="text-center"><?php echo $row['sale_date']; ?></td>
                                    <td class="text-center"><?php echo $row['salyer']; ?></td>
                                    <td class="text-center"><?php echo $row['order']; ?></td>
                                    <td class="text-center"><?php echo $row['quantity']; ?></td>
                                    <td class="text-center"><?php echo $row['unit']; ?></td>
                                    <td class="text-center"><?php echo $row['total']; ?></td>
                                    <td class="text-center"><?php echo $row['unit_price']; ?></td>
                                    <td class="text-center"><?php echo $row['buyer']; ?></td>
                                    <td class="text-center"><?php $status = $row['status']; 
                                        if($status == 1){
                                            echo "อนุมัติ";
                                        }elseif($status == 2){
                                            echo "ไม่อนุมัติ";
                                        }
                                    ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-circle btn_export_id" name="btn_export_id" id="btn_export_id" data-export_id="<?php echo $row['sale_id'] ?>">
                                            <i class="fas fa-file-export"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php                                                                        
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 </div>
<?php
    include('./include/script.php');
    include('./include/footer.php');
?>