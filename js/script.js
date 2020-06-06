$(function(){
    var oldVal, newVal, id, field;

    $('.edit').focus(function()
    {
        oldVal = $(this).text();
        id = $(this).data('id');
        field = $(this).data('name');
        console.log(oldVal + '|' + id + '|' + field);

    }).blur(function(){

        newVal = $(this).text();

        if(newVal != oldVal){
            $.ajax
            ({
                url: './class_list.php',
                type: 'POST',
                data: {val: newVal, id: id, field: field},
                success: function (res) {
                    console.log(res);
                },
                error: function () {
                    alert('Error!')
                }
            });
        }
    })

    $('.img-button-del-student').click(function (e) {
        id = $(this).data('id');
        newVal = id;
        $.ajax({
            url:  './student_list.php',
            type: 'POST',
            data: {delete_item: newVal, id: id},
            success: function(res) {
                console.log(res);
                location.reload();
            },
            error: function() { alert('Error!') }
        });
    });

    $('.img-button-del-class').click(function (e) {
        id = $(this).data('id');
        newVal = id;
        $.ajax({
            url:  './class_list.php',
            type: 'POST',
            data: {delete_item: newVal, id: id},
            success: function(res) {
                console.log(res);
                location.reload();
            },
            error: function() { alert('Error!') }
        });
    });
});