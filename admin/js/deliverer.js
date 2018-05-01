$(document).on('click', '.deleteBtnDistributor', function () {
    var id = $(this).parent().parent().parent().attr('id');
    //alert(id);
    $.ajax({
        url: "../controller/delivererController.php",
        method: "post",
        data: {
            deleteid: id

        },
        success: function (data) {
            location.reload();


        }
    });

});


$(document).on("click", ".editBtnDistributor", function () {
    var id = $(this).parent().parent().parent().attr('id');


    $(".modal-body #distributorId").val(id);

});
