<?php
    include('./include/header.php');
    include('./include/navbar.php');
?>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">นำไฟล์ข้อมูลเข้า</h1>
        <form id="uploadForm_bugdet" name="uploadForm_bugdet"
                        class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">
                <div class="row was-validated">
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">อัพโหลดข้อมูล</label>
                        <input type="file" id="excelFile" class="form-control" name="excelFile" required/>
                        <button type="submit"
                            class="btn btn-primary mt-3">นำไฟล์ข้อมูลเข้า</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php
    include('./include/script.php');
    include('./include/footer.php');
?>