$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');
    var checkOutPrice;
    var shipAdress;

    allWells.hide();
    $("#last").click(function () {
        //alert("The paragraph was clicked.");

        var name = document.getElementById("name").value;
        var address = document.getElementById("address").value;
        var city = document.getElementById("city").value;
        var province = document.getElementById("province").value;
        var country = document.getElementById("country").value;
        //alert(checkOutPrice);

        shipAdress = name + "<br>" + address + "<br>" + city + "<br>" + province + "<br>" + country + "<br>";
        //alert(shipAdress);
        document.getElementById("shippingAddress").innerHTML = shipAdress;
        document.getElementById("totalPrice").innerHTML = checkOutPrice;

    });

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);
        if (!$item.hasClass('disabled')) {
            //navListItems.removeClass('btn-primary').addClass('btn-default');
            if ($item.attr('id') !== $(navListItems[1]).attr('id')) {
                $(navListItems[1]).removeClass('btn-primary').addClass('btn-success');
            }
            //$('#item3').addClass('btn-success');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'], input[type='password'], input[type='email']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');

    /////////// Session Storage///////////////////

    var orders = JSON.parse(sessionStorage.getItem('youcancookcart'));
    checkOutPrice = sessionStorage.getItem('checkOutPrice');
    //console.log('order: ', obj);


    $(document).on('click', '#pay', function () {
      //  alert(22);

        $.ajax({
            url    : "./controller/orderController.php",
            method : "post",
            data   : {
                payConform : "payed",
                shipAddress: shipAdress,
                orders     : orders
            },
            success: function (data) {
                //location.reload();
             //   alert(data);
                window.location.replace("success.html");

            }
        })


    });

});