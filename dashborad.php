<?php
    include('./include/header.php');
    include('./include/navbar.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ภาพรวม</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-lg-6 col-xl-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-3">
                            <div class="text-white-75 small">จำนวนสมาชิก</div>
                            <div class="text-lg fw-bold">40,000</div>
                        </div>
                        <i class="fa-2x fas fa-users"></i>
                    </div>
                </div>
                <div class="card-footer d-flex bg-primary align-items-center justify-content-between small">
                    <a class="text-white stretched-link" href="#!">View Report</a>
                    <div class="text-white"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                ดำเนินการเสร็จสิ้น</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ร้องเรียน
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                รอดำเนินการ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    จำนวนการร้องเรียน
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- แบ่ง -->
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    ประเภทการร้องเรียน
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- แบ่ง -->
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    กราฟแท่งสัดส่วนของประเภทการร้อง
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="complaintsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    สัดส่วนของประเภทการร้อง
                </div>
                <div class="card-body">
                    <div class="chart-pie">
                        <canvas id="complaintsdoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table Task Management -->
    <div class="card mb-4">
        <div class="card-header">งานร้องเรียน</div>
        <div class="card-body">
            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ลำดับ</th>
                            <th>ผู้ร้องเรียน</th>
                            <th>เรื่องร้องเรียน</th>
                            <th>สถานะ</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1.</td>
                            <td>จารุวัฒน์ อำนวยสัตย์</td>
                            <td>ไฟฟ้า</td>
                            <td>
                                <div class="badge bg-info text-white rounded-pill">ดำเนินการ</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-circle btn-sm btn-success">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-sm btn-danger">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="text-center">
                        <td>2.</td>
                            <td>จารุวัฒน์ อำนวยสัตย์</td>
                            <td>ไฟฟ้า</td>
                            <td>
                                <div class="badge bg-info text-white rounded-pill">ดำเนินการ</div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-circle btn-sm btn-success">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-circle btn-sm btn-danger">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php
    include('./include/script.php');
    include('./include/footer.php');
?>