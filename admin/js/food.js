//condrols  ingredient
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


$(document).on("click", ".editBtnIngredient", function () {
    var id = $(this).parent().parent().parent().attr('id');

    //alert(id);
    $(".modal-body #ingredientId").val(id);

});


//condrols  food
$(document).on('click', '.deleBtnFood', function () {

    var id = $(this).parent().parent().parent().attr('id');
    //alert(id);
    $.ajax({
        url: "../controller/foodController.php",
        method: "post",
        data: {
            foodId: id
        },
        success: function (data) {
            location.reload();

        }
    });

});



$(document).on("click", ".editBtnFood", function () {
    var id = $(this).parent().parent().parent().attr('id');


    $(".modal-body #foodId").val(id);

});
