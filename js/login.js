$(document).ready(function() {
    $('#btn_login').click(function() {
         var username = $('#username').val();
         var password = $('#password').val();

         $.ajax({
            type: 'post',
            url: 'php/login/login.php',
            data: {
                username : username,
                password : password
            },
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                    }).then(function() {
                        window.location = 'dashborad.php';
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: response.message,
                        showConfirmButton: false,
                    });
                }
            },
            error: function(xhr, status, error){
                console.log('Error: ', + error);
            }
         });
    });
});