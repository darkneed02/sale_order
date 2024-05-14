$(document).ready(function() {
    $('#insertFormEmp').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        formData += '&insertEMPBtn=insertemp';

        $.ajax({
            url: 'php/emp_modal/add_emp.php',
            method: 'post',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ',
                        text: response.message,
                        showConfirmButton: false,
                    }).then(function() {
                        location.reload();
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response.message,
                        showConfirmButton: true,
                    });
                }
            },
            error: function(xhr, status, error){
                console.log('Error: ', + error);
            }
        });
    });

    // import employees data 
    $('#insertImportForm').submit(function(event){
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'php/emp_modal/upload-emp.php',
            method: 'post',
            data: formData,
            contentType: false,
            processData:false,
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูล',
                        text: response.message,
                        showConfirmButton: false,
                    }).then(function() {
                        location.reload();
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response.message,
                        showConfirmButton: true,
                    });
                }
            },
            error: function(xhr, status, error){
                console.log("Error :", +error);
            }
        });
    });

    // Update Emp
    $('#form_edit_user').submit(function(event) {
        event.preventDefault();

         var formData = $(this).serialize();

         $.ajax({
            url: 'php/emp_modal/update-emp.php',
            method: 'post',
            data:  formData,
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'success',
                        title: 'อัพเดตข้อมูลสำเร็จ',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = 'employee_management.php';
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อมูลผิดพลาด',
                        text: response.message,
                        showConfirmButton:false,
                    });
                }
            },
            error: function(xhr, status, error){
                console.log("Error :", + error);
            }
         });
    });

    // Delete Emp
    $('.btn_deleted').click(function(){
         swal.fire({
            title: 'ยืนยันการทำการลบข้อมูลผู้ใช้งาน',
            text: 'คุณต้องการทำการลบข้อมูลใช่หรือไม่',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'ใช่, ทำรายการ',
            cancelButtonText: 'ยกเลิก'
         }).then((result) => {
            if(result.isConfirmed){
                var emp_id = $(this).data('emp_id');

                $.ajax({
                    url: 'php/emp_modal/delete-emp.php',
                    method: 'post',
                    data: {
                        emp_id:emp_id
                    },
                    success: function(response){
                        swal.fire({
                            title: 'ทำการลบรายการสำเร็จ',
                            text: response,
                            icon: 'success',
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    }
                });
            }
         });
    });
});