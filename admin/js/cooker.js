$(document).on('click', '.deleteBtn', function () {
    var id = $(this).parent().parent().parent().attr('id');
    //alert(id);
    $.ajax({
        url: "../controller/cookerController.php",
        method: "post",
        data: {
            deleteid: id

        },
        success: function (data) {
            location.reload();


        }
    });

});


$(document).on("click", ".editBtn", function () {
    var id = $(this).parent().parent().parent().attr('id');


    $(".modal-body #cookerId").val(id);

});
