$(document).ready(function() {
    $('.btn_export').click(function() {
        console.log('btn export');
    });

    $('#btn_export_all').click(function(){
        var export_all = "export_all";

        $.ajax({
            type: 'post',
            url : 'php/export_all.php',
            data: {
                export_all: export_all,
            },
            success : function(data){
                console.log(data);
                window.location = 'php/' + data;
            }
        });
    });
});