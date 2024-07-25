$(document).ready(function(){
    $('#uploadForm_bugdet').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'php/upload_approve.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
            Swal.fire({
                    title:'อัพโหลดข้อมูลสำเร็จ',
                    text:  response,
                    icon: 'success'
                }).then(function() {
                    window.location = 'list_order.php';
                });
            },
            error: function(xhr, status, error){
                alert('Upload failed: ' + status + ', ' + error);
            }
        });
    });
});