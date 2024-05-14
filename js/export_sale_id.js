$(document).ready(function() {
    $('.btn_export_id').click(function() {
        var order_id = $(this).data('export_id');

        $.ajax({
            url: 'php/export_id.php',
            method: 'post',
            data: {
                order_id: order_id,
            },
            success: function(response){
                console.log(response);
                window.location = 'php/' + response;
            }
        });
    });
});