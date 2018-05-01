$(document).on('click', '.deleBtnIngredient', function () {

    var id = $(this).parent().parent().parent().attr('id');
    //alert(id);
    $.ajax({
        url: "../controller/foodController.php",
        method: "post",
        data: {
            ingredientId: id

        },
        success: function (data) {
            location.reload();


        }
    });

});