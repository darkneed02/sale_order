$(document).ready(function(){
    
    $('#btn_approve').on('click', function(){
        var order_id = $(this).data('order_id');
        var email = $('#email_cus').val();
        var descripton = $('#descripton').val();
        var approve = 'approve';

        $.ajax({
            url: 'php/process_order.php',
            method: 'post',
            data: {
                order_id:order_id,email:email,descripton:descripton,approve:approve
            },
            success: function(response){
                swal.fire({
                    icon: 'success',
                    title: 'ทำการอนุมัติรายการ'+ order_id,
                    text:  response,
                    showConfirmButton: false,
                    // timer: 1500
                }).then(function() {
                    window.location = 'list_order.php';
                });
            }
        });
    });
    
    $('#btn_cancle').click(function() {
        var order_id = $(this).data('order_id');
        var email = $('#email_cus').val();
        var descripton = $('#descripton').val();
        var cancel = 'cancel';

        $.ajax({
            url: 'php/process_order.php',
            method: 'post',
            data: {
                order_id:order_id,email:email,descripton:descripton,cancel:cancel
            },
            success: function(response){
                swal.fire({
                    icon: 'success',
                    title: 'ทำการไม่อนุมัติรายการ'+ order_id,
                    text:  response,
                    showConfirmButton: false,
                    // timer: 1500
                }).then(function() {
                    window.location = 'list_order.php';
                });
            }
        });
    });
});