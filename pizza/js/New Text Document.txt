$(document).ready(function() {
  $(document).on('click', 'ul.crutSizeList li a', function() {
    $('ul.crutSizeList li a').removeClass('selected');
    var option_value_id = new Array();
    var e = $(this).siblings("input.hidden-crust-size").val();
    global_crust_size_indicator = e;
    var child_id = $(this).parent("li").attr("id");
    var sizeHid = $('#' + child_id).children('input[name="attributes_hidden"]').val();
    var sizeId = $('#' + child_id).children("input.hidden-crust-type").val();
    global_crust_size_id = sizeHid;
    $('.customTopping').children('div').hide();
    $('.customTopping').children('div').removeClass('in-pizza');
    var divs = $('div.' + sizeHid);
    for (var i = 0; i < divs.length; i++) {
      $('div.' + sizeHid + ':eq(' + (i) + ')').show();
      if (i == 2) {
        break;
      }
    }
    if ($('#rc_' + sizeId + '_' + sizeHid).length) {
      $('#rc_' + sizeId + '_' + sizeHid).siblings('div').hide();
      $('#rc_' + sizeId + '_' + sizeHid).hide();
      $('#rc_' + sizeId + '_' + sizeHid).next().show();
    } else {
      $('div.crustGutter:first').show();
    }
    var total_price = parseFloat($(this).siblings('input[name="price_hidden"]').val()).toFixed(2);
    $("#hidden-unit-price").val(total_price);
    updateModalPrice();
//    $("#customPriceId").html(total_price);
//    $("#product_qty").val(1);
    option_value_id = child_id.split('-');
    if (typeof option_value_id[2] !== 'undefined') {
      child_id = option_value_id[2];
    }
    var topping_rel_key = "3#2_" + child_id;
    toppingsSelect(topping_rel_key, '', pizzaData['product_model']);
    $(this).addClass('selected');
    $('div.pizzaImg img').removeClass('in');
    return false;
  });

  $(document).on('click', 'ul.crustType li a', function() {
    var option_value_id = new Array();
    $('ul.crustType li a').removeClass('selected');
    $('ul.crutSizeList li').find('a').removeClass('selected');
    var crust_size_id = $(this).attr("id");
    option_value_id = crust_size_id.split('-');
    if (typeof option_value_id[2] !== 'undefined') {
      crust_size_id = option_value_id[2];
    }
    $('ul > ul').hide();
    $('ul#ulsize_' + crust_size_id).show();
    $('ul#ulsize_' + crust_size_id + ' li').find('a').removeClass('selected');
    $('ul#ulsize_' + crust_size_id + ' li:nth-child(1)').find('a:first').addClass('selected');
    var total_price = parseFloat($('ul#ulsize_' + crust_size_id + ' li:nth-child(1)').find('a:first').siblings('input[name="price_hidden"]').val()).toFixed(2);
    $("#hidden-unit-price").val(total_price);
    updateModalPrice();
//    $("#customPriceId").html(total_price);
//    $("#product_qty").val(1);
    var size_id = $('ul#ulsize_' + crust_size_id + ' li:nth-child(1)').attr('id');
    var sizeHid = $('#' + size_id).children('input[name="attributes_hidden"]').val();
    var sizeId = $('#' + size_id).children("input.hidden-crust-type").val();
    global_crust_size_id = sizeHid;
    $('.customTopping').children('div').hide();
    $('.customTopping').children('div').removeClass('in-pizza');
    var divs = $('div.' + sizeHid);
    for (var i = 0; i < divs.length; i++) {
//      $('div.' + sizeHid + ':eq(' + (i + 1) + ')').show();
      $('div.' + sizeHid + ':eq(' + (i) + ')').show();
      if (i == 2) {
        break;
      }
    }
    if ($('#rc_' + sizeId + '_' + sizeHid).length) {
      $('#rc_' + sizeId + '_' + sizeHid).siblings('div').hide();
      $('#rc_' + sizeId + '_' + sizeHid).hide();
      $('#rc_' + sizeId + '_' + sizeHid).next().show();
    } else {
      $('div.crustGutter:first').show();
    }
    global_crust_size_indicator = $('#' + size_id).children('.hidden-crust-size').val();
    option_value_id = size_id.split('-');
    if (typeof option_value_id[2] !== 'undefined') {
      size_id = option_value_id[2];
    }
    topping_rel_key = "3#2_" + size_id;
    toppingsSelect(topping_rel_key, '', pizzaData['product_model']);
    $(this).addClass('selected');
    $('div.pizzaImg img').removeClass('in');
    return false;
  });

  $(document).on('click', 'ul.selectToppingsTab li a', function() {
    $('ul.selectToppingsTab li a').removeClass('active');
    $(this).addClass('active');
    var curTop = $(this).attr('href');
    $('.selectToppingsContent').hide();
    $(curTop).fadeIn('fast');
    return false;
  });

  $(document).on('click', 'ul.selectToppingsList li a', function() {
    var curTop = $(this).attr('href');
    var elementAttrVal = '';
    var toppingVal = $(this).siblings('input[name="hidden_attributes"]').val();
    if (!$(this).hasClass('selected')) {
      $("div.customTopping div").each(function(index, element) {
        elementAttrVal = $(element).children('input[name="hidden_attributes"]').val();
        if (toppingVal == elementAttrVal) {
          $(element).addClass('in-pizza');
          $(element).hide();
          $('.customTopping').children('div').hide();
          var divs = $('div.' + global_crust_size_id);
          var inc = 0;
          for (var i = 0; i < divs.length; i++) {
            if ($('div.' + global_crust_size_id + ':eq(' + (i) + ')').hasClass('in-pizza')) {
              continue;
            }
            $('div.' + global_crust_size_id + ':eq(' + (i) + ')').show();
            if (inc == 2) {
              break;
            }
            inc++;
          }
          return false;
        }
      });
      $(this).addClass('selected');
      $(curTop).addClass('in');
    }
    else {
      $("div.customTopping div").each(function(index, element) {
        elementAttrVal = $(element).children('input[name="hidden_attributes"]').val();
        if (toppingVal == elementAttrVal) {
          $(element).removeClass('in-pizza');
          return false;
        }
      });
      $(this).removeClass('selected');
      $(curTop).removeClass('in');
    }
    calcToppingTotal();
    return false;
  });

  $(document).on('click', '.accord .panelHeading', function() {
    $(this).toggleClass('close');
    $(this).next('.panelBody').slideToggle();
    $(this).closest('.customisingContent').find('.customisingContentRight').slideToggle();
    return false;
  });

  $(document).on('click', '.accordToppings .panelHeading', function() {
    $(this).toggleClass('close');
    $(this).next('.panelBody').slideToggle();
    return false;
  });
  
  $(document).on('click', 'ul.selectPizzaList li a', function() {
    var curTop = $(this).attr('href');
    $(this).toggleClass('selected');
    return false;
  });
  $(document).on('click', '.plusBtnCustom', function(e) {
    updateModalPrice();
    e.preventDefault();
    return false;
  });
  $(document).on('click', '.minusBtnCustom', function(e) {
    updateModalPrice();
    e.preventDefault();
    return false;
  });
  $('ul.selectPizzaList li a').click(function() {
    var curTop = $(this).attr('href');
    $(this).toggleClass('selected');
    return false;
  });
  
  $(document).on('mouseenter', '.customisingContent.toppingsOuter', function() {
    if ($(window).scrollTop() < 150) {
      if (!$(this).find('.panelHeading').hasClass('close')) {
        if (!$('.customisingContent.crustOuter .panelHeading').hasClass('close')) {
          $('.customisingContent.crustOuter .panelHeading').addClass('close toopen');
          $('.customisingContent.crustOuter .panelBody').stop().slideUp();
          $('.customisingContent.crustOuter .customisingContentRight').stop().slideUp();
          return false;
        }
      }
    }
  });
  
  $(document).on('mouseleave', '.customisingContent.toppingsOuter', function() {
    if (!$(this).find('.panelHeading').hasClass('close')) {
      if ($('.customisingContent.crustOuter .panelHeading').hasClass('toopen')) {
        $('.customisingContent.crustOuter .panelHeading').removeClass('close');
        $('.customisingContent.crustOuter .panelHeading').removeClass('toopen');
        $('.customisingContent.crustOuter .panelBody').stop().slideDown();
        $('.customisingContent.crustOuter .customisingContentRight').stop().slideDown();
      }
      return false;
    }
  });
  
  $(document).on('click', '.replaceToppings', function(e) {
    $(this).slideUp();
    $('#replaceToppings').slideDown();
    $('.crustOuter .panelHeading, .selectToppingsBox .panelHeading').addClass('close');
    $('.crustOuter .panelBody, .selectToppingsBox .panelBody').stop().slideUp();
    $('.crustOuter .customisingContentRight, .toppingsOuter .customisingContentRight').stop().slideUp();
    return false;
  });
  $(document).on('click', '.custom_crust', function(e) {
    e.preventDefault();
    var elementAttrVal = '';
    var elementCrustVal = '';
    var attributeVal = $(this).siblings('input[name="attributes_hidden"]').val();
    var sizeVal = $(this).siblings("input.hidden-crust-type").val();
    $("ul.crutSizeList li a").each(function(index, element) {
      elementAttrVal = $(element).siblings('input[name="attributes_hidden"]').val();
      elementCrustVal = $(element).siblings('input.hidden-crust-type').val();
      if (attributeVal == elementAttrVal && sizeVal == elementCrustVal) {
        $('ul.crutSizeList li a').removeClass('selected');
        $(element).addClass('selected');
        var option_value_id = new Array();
        var e = $(this).siblings("input.hidden-crust-size").val();
        global_crust_size_indicator = e;
        $('ul > ul').hide();
        var crust_size_id = $(this).parent("li").parent("ul").attr("id");
        $('#' + crust_size_id).show();
        option_value_id = crust_size_id.split('_');
        if (typeof option_value_id[1] !== 'undefined') {
          crust_size_id = option_value_id[1];
        }
        $('ul.crustType li a').removeClass('selected');
        $('#crust-type-' + crust_size_id).addClass('selected');
        var child_id = $(this).parent("li").attr("id");
        var sizeHid = $('#' + child_id).children('input[name="attributes_hidden"]').val();
        var sizeId = $('#' + child_id).children("input.hidden-crust-type").val();
        if ($('#rc_' + sizeId + '_' + sizeHid).length) {
          $('#rc_' + sizeId + '_' + sizeHid).siblings('div').hide();
          $('#rc_' + sizeId + '_' + sizeHid).hide();
          $('#rc_' + sizeId + '_' + sizeHid).next().show();
        } else {
          $('div.crustGutter:first').show();
        }
        var total_price = parseFloat($(this).siblings('input[name="price_hidden"]').val()).toFixed(2);
        $("#hidden-unit-price").val(total_price);
        updateModalPrice();
//        $("#customPriceId").html(total_price);
//        $("#product_qty").val(1);
        option_value_id = child_id.split('-');
        if (typeof option_value_id[2] !== 'undefined') {
          child_id = option_value_id[2];
        }
        var topping_rel_key = "3#2_" + child_id;
        toppingsSelect(topping_rel_key,'', pizzaData['product_model']);
        $(this).addClass('selected');
        $('div.pizzaImg img').removeClass('in');
        return false;
      }
    });
    return false;
  });
  
  $(document).on('click', '.recomTopping', function(e) {
    e.preventDefault();
    var elementAttrVal = '';
    var curTop = '';
    var attributeVal = $(this).siblings('input[name="hidden_attributes"]').val();
    $(this).parent('div').hide();
    $(this).parent('div').addClass('in-pizza');
    $("ul.selectToppingsList li a").each(function(index, element) {
      elementAttrVal = $(element).siblings('input[name="hidden_attributes"]').val();
      if (attributeVal == elementAttrVal) {
        $('.customTopping').children('div').hide();
        var divs = $('div.' + global_crust_size_id);
        var inc = 0;
        for (var i = 0; i < divs.length; i++) {
          if ($('div.' + global_crust_size_id + ':eq(' + (i) + ')').hasClass('in-pizza')) {
            continue;
          }
          $('div.' + global_crust_size_id + ':eq(' + (i) + ')').show();
          if (inc == 2) {
            break;
          }
          inc++;
        }
        curTop = $(element).attr('href');
        $(element).addClass('selected');
        $(curTop).addClass('in');
        calcToppingTotal();
        return false;
      }
    });
    var elementAttrVal = $("#extraCheeze").children('input[name="hidden_attributes"]').val();
    if (attributeVal == elementAttrVal) {
      $('#extraCheezeCheck').addClass('selected');
      $('#extraCheezeCheck').css('background-position', '0px -60px');
      calcToppingTotal();
      return false;
    }
    return false;
  });
});