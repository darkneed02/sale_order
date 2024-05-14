$(document).ready(function() {
    // insert user data
    $('#form_user').submit(function(event){
        event.preventDefault(); // ป้องกันการ submit ฟอร์ม

        var formData = $(this).serialize();

        formData += '&btn_save=insert';

        $.ajax({
            url: 'php/user_modal/add_user.php',
            type: 'post',
            data: formData,
            dataType: 'json',
            success: function(response){
                if (response.status === 'success') {
                    swal.fire({
                        icon: 'success',
                        title: 'บันทึกข้อมูลสำเร็จ',
                        text: response.message,
                        showConfirmButton: false,
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response.message,
                        showConfirmButton: true,
                    });
                }
            },
            error: function(xhr, status, error){
                console.log('Error: ' + error);
            }
        });
    });
});