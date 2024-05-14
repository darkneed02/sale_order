$(document).ready(function(){
    $('#btn_approve').click(function() {
        var order_id = $(this).data('order_id');
        var email_cus = $('#email_cus').val();
        var descripton = $('#descripton').val();
        var approve = 'approve';

        $.ajax({
            url: 'php/process_order.php',
            method: 'post',
            data: {
                order_id:order_id,
                approve:approve,
                email_cus:email_cus,
                descripton:descripton
            },
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'success',
                        title: 'บันทึกสำเร็จ',
                        text: 'ทำการอนุมัติเรียบร้อย',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = 'list_order.php';
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ'
                    });
                }
            },
            error: function(xhr, status, error){
                console.log('Error: ', + error);
            }
        });
    });

    $('#btn_cancle').click(function() {
        var order_id = $(this).data('order_id');
        var email_cus = $('#email_cus').val();
        var descripton = $('#descripton').val();
        var cancel = 'cancel'

        $.ajax({
            url: 'php/process_order.php',
            method: 'post',
            data: {
                order_id:order_id,
                cancel:cancel,
                email_cus:email_cus,
                descripton:descripton
            },
            dataType: 'json',
            success: function(response){
                if(response.status === 'success'){
                    swal.fire({
                        icon: 'error',
                        title: 'ปฏิเสธการอนุมัติ',
                        text: 'ปฏิเสธการอนุมัติ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = 'list_order.php';
                    });
                }else{
                    swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ'
                    });
                }
            },
            error: function(xhr, status, error){
                console.log('Error: ', + error);
            }
        });
    });
});