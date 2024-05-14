<?php
    include('./include/header.php');
    include('./include/navbar.php');
    include('./class/class_connect_db.php');
    include('./class/class_activity.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">ประวัติการเข้าใช้งาน</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>ลำดับ</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>กิจกรรม</th>
                                    <th>เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($result = data_activeity_log($conn)){
                                        $count = 1;
                                        while($rslog = mysqli_fetch_assoc($result)){
                                ?>
                                    <tr class="text-center">
                                        <td><?php echo $count++ ?></td>
                                        <td><?php echo $rslog['firstname'].' '. $rslog['lastname']; ?></td>
                                        <td>
                                            <?php
                                                if($rslog['activity'] == 'login'){
                                                    echo '<div class="badge bg-info text-white rounded-pill">login</div>';
                                                }elseif($rslog['activity'] == 'logout'){
                                                    echo '<div class="badge bg-danger text-white rounded-pill">logout</div>';
                                                }elseif($rslog['activity'] == 'import'){
                                                    echo '<div class="badge bg-success text-white rounded-pill">import</div>';
                                                }elseif($rslog['activity'] == 'delete employess'){
                                                    echo '<div class="badge bg-danger text-white rounded-pill">delete employess</div>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $rslog['date_save']; ?></td>
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