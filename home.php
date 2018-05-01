<?PHP include './db/FoodOpperation.php';
    session_start();
    $con = new FoodOpperation();
    $id = 0;
    if (isset($_SESSION['user'])) {

        $id = $_SESSION['user'];
    }
?>

<!doctype html>
<!--suppress ALL -->
<html lang="en" class="no-js" xmlns:z-index="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <style type="text/css">
        body {
            background: #ff3019;
            background: -moz-radial-gradient(center, ellipse cover, #ff3019 0%, #cf0404 100%);
            background: -webkit-radial-gradient(center, ellipse cover, #ff3019 0%,#cf0404 100%);
            background: radial-gradient(ellipse at center, #ff3019 0%,#cf0404 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=1 );
        }

        .item {
            display: block;

        }

        /*modal fullscreen */

        .modal.modal-fullscreen .modal-dialog,
        .modal.modal-fullscreen .modal-content {
            bottom: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .modal.modal-fullscreen .modal-dialog {
            margin: 0;
            width: 100%;
            animation-duration: 0.6s;
        }

        .modal.modal-fullscreen .modal-content {
            border: none;
            -moz-border-radius: 0;
            border-radius: 0;
            -webkit-box-shadow: inherit;
            -moz-box-shadow: inherit;
            -o-box-shadow: inherit;
            box-shadow: inherit;
            /* change bg color below */
            /* background:#1abc9c; */
        }

        .modal.modal-fullscreen.force-fullscreen {
            /* Remove the padding inside the body */
        }

        .modal.modal-fullscreen.force-fullscreen .modal-body {
            padding: 0;
        }

        .modal.modal-fullscreen.force-fullscreen .modal-header,
        .modal.modal-fullscreen.force-fullscreen .modal-footer {
            left: 0;
            position: absolute;
            right: 0;
        }

        .modal.modal-fullscreen.force-fullscreen .modal-header {
            top: 0;
        }

        .modal.modal-fullscreen.force-fullscreen .modal-footer {
            bottom: 0;
        }


    </style>

    <link rel="stylesheet" href="css/styleNav.css">

    <link rel="stylesheet" href="css/styleCard.css"> <!-- Resource style -->

    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <script type="text/javascript">

        jQuery(document).ready(function ($) {

            (function () {
                // Convert array to object
                var convArrToObj = function (array) {
                    var thisEleObj = new Object();
                    if (typeof array == "object") {
                        for (var i in array) {
                            var thisEle = convArrToObj(array[i]);
                            thisEleObj[i] = thisEle;
                        }
                    } else {
                        thisEleObj = array;
                    }
                    return thisEleObj;
                };
                var oldJSONStringify = JSON.stringify;
                JSON.stringify = function (input) {
                    return oldJSONStringify(convArrToObj(input));
                };
            })();
            var data = {"total": 0, "rows": []};
            var totalCost = 0;
            var details = "";
            var card = [];
            var stroage = sessionStorage;
            createcart();

            function createcart() {

                if (stroage.getItem('youcancookcart') === null) {
                    var mycart = {};
                    mycart.items = [];
                    stroage.setItem(stroage, toJson(mycart));
                }
            }

            function toJson(obj) {
                var str = JSON.stringify(obj);
                return str;
            }

            $(function () {
                var count = 300;
                $('#cartcontent').datagrid({

                    singleSelect: true
                });
                $('.item').draggable({
                    revert     : true,
                    proxy      : 'clone',
                    onStartDrag: function () {
                        $(this).draggable('options').cursor = 'not-allowed';
                        $(this).draggable('proxy').css('z-index', 10);
                    },
                    onStopDrag : function () {
                        $(this).draggable('options').cursor = 'move';
                    }
                });

                $('.cart').droppable({

                    onDragEnter: function (e, source) {
                        $(source).draggable('options').cursor = 'auto';
                    },
                    onDragLeave: function (e, source) {
                        $(source).draggable('options').cursor = 'move';
                    },
                    onDrop     : function (e, source) {
                        count++;
                        var name = $(source).find('p:eq(0)').html();
                        var price = $(source).find('p:eq(1)').html();
                        var srcc = $(source).find('p:eq(2)').html();
                        //alert(srcc);
                        $('.pizza').append("<img src='admin/" + srcc + "' style='position:fixed; top: 150px; left: 460px; opacity:0.9;display:z-index:" + count + "'/>");

                        addProduct(name, parseFloat(price.split('$')[1]));

                        details = "";

                        for (var i = 0; i < data.total; i++) {
                            var row = data.rows[i];
                            details += row.name + " - " + row.quantity + "<br>";
                        }
                        $('#customAddToCard').attr('data-details', details);
                        $('#customAddToCard').attr('data-price', totalCost)
                    }
                });

            });

            function addProduct(name, price) {
                function add() {
                    for (var i = 0; i < data.total; i++) {
                        var row = data.rows[i];
                        if (row.name === name) {
                            row.quantity += 1;
                            return;
                        }
                    }
                    data.total += 1;
                    data.rows.push({
                        name    : name,
                        quantity: 1,
                        price   : price
                    });
                }

                add();
                totalCost += price;
                $('#cartcontent').datagrid('loadData', data);
                $('div.cart .total').html('Total: Rs.' + totalCost);
            }


            $('#checkOut').click(function () {

                var count = $('#basket .product').length;
                var checkOutPrice = $('#checkOutPrice').html();
                //alert(checkOutPrice);
                for (var i = 0; i < count; i++) {
                    var temp = [];

                    temp['name'] = $("#basket .name").eq(i).html();
                    temp['quantity'] = $("#basket .quantity").eq(i).find("option:selected").text();
                    temp['details'] = $("#basket .details").eq(i).html();
                    temp['price'] = $("#basket .price").eq(i).html();

                    card.push(temp);

                }
                stroage.clear();

                //console.log(card);
                stroage.setItem('youcancookcart', JSON.stringify(card));
                stroage.setItem('checkOutPrice', checkOutPrice);
                console.log(JSON.stringify(card));


            });

        });
    </script>

</head>
<body>
<?PHP include 'navBar.php' ?>

<!-- Main food -->

<ul class="cd-items cd-container ">
    <div class=" container-fluid">
        <div class="row text-center">
            <?php

                $foods = $con->getAllFood();

                for ($food = 0; $food < sizeof($foods); $food++) {
                    ?>
                    <li class="cd-item" id="<?PHP echo $foods[$food]['id'] ?>">
                        <img src="admin/<?PHP echo $foods[$food]['image'] ?>" alt="Item Preview">

                        <a href="#0" class="cd-trigger">Quick View</a>
                    </li> <!-- cd-item -->
                <?PHP } ?>
        </div>
    </div>
</ul> <!-- cd-items -->

<!-- Food Contain-->
<div class="cd-quick-view text-center">

    <a href="#0" class="cd-close">Close</a>
</div>

<!-- Trigger the modal with a button -->
<div style="left: 50px;bottom: 150px;position: fixed">
    <button type="button" class="btn btn-lg cook-btn" data-toggle="modal" data-target="#myModalFullscreen"><img
                src="img/pizza-cutter.png" height="50px" width="50px"></button>
</div>

<!--Cook model -->

<div class="modal fade modal-fullscreen  footer-to-bottom" id="myModalFullscreen" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="modal-title" style="padding: 5px">Kitchen</h1>

            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <ul class="cd-item-action">
                        <?PHP
                            if ($id > 0) {
                                ?>
                                <a href="#0" data-dismiss="modal" id="customAddToCard" class="cd-add-to-cart"
                                   data-img=""
                                   data-name="Custom" data-details="" data-price="">Add To
                                                                                    Cart</a>
                                <?PHP
                            } else {
                                ?>
                                <a href="login.php  " class="btn btn-danger btn-lg">Login First</a>
                                <?PHP
                            }
                        ?>

                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-4 " style="background: white">
                        <ul class="container-fluid">
                            <?php

                                $ingredients = $con->getAllIngredients();

                                for ($ingredient = 0; $ingredient < sizeof($ingredients); $ingredient++) {
                                    ?>
                                    <li class="col-md-3 text-center">
                                        <a href="#" class="item">
                                            <img src="admin/<?PHP echo $ingredients[$ingredient]['icon'] ?>"/>
                                            <div>
                                                <p><?PHP echo $ingredients[$ingredient]['name'] ?></p>
                                                <p>Price:$ <?PHP echo $ingredients[$ingredient]['price'] ?></p>
                                                <p style="display:none" id="6"
                                                   class="imgadd"><?PHP echo $ingredients[$ingredient]['image'] ?></p>
                                            </div>
                                        </a>
                                    </li>
                                <?PHP } ?>
                        </ul>
                    </div>
                    <div class="col-md-4 cart" style="height: 500px">
                        <div class="pizza col-md-12" id="pizzaa">

                            <img src="img/pizza/img/margherita.png"
                                 style="position:fixed; top: 150px; left: 460px; opacity:0.9;" class="img-responsive "
                                 z-index: 0; alt=""/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart">
                            <h1 style="padding: 10px;">Ingredients</h1>
                            <div>
                                <table id="cartcontent" fitColumns="true" style="width:400px;height:auto;">
                                    <thead>
                                    <tr>
                                        <th field="name" width=20><span style="all: unset;font-size: 20px;">Name</span>
                                        </th>
                                        <th field="quantity" width=20 align="right"><span
                                                    style="all: unset;font-size: 20px;margin: 2px">Quantity</span></th>
                                        <th field="price" align="right"><span
                                                    style="all: unset;font-size: 20px">Price</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <p class="total " style="font-size: 50px">Total: Rs.0</p>

                        </div>
                    </div>
                </div>


            </div>


        </div>

    </div>
    <!-- /.modal-content -->
</div>


<!-- Basket -->
<div class="cd-cart-container empty">
    <a href="#0" class="cd-cart-trigger">
        Cart
        <ul class="count"> <!-- cart items count -->
            <li>0</li>
            <li>0</li>
        </ul> <!-- .count -->
    </a>

    <div class="cd-cart">
        <div class="wrapper">
            <header>
                <h2>Cart</h2>
                <span class="undo">Item removed. <a href="#0">Undo</a></span>
            </header>

            <div class="body">
                <ul id="basket">
                    <!-- products added to the cart will be inserted here using JavaScript -->
                </ul>
            </div>

            <footer>
                <a href="paymentSheet.php" class="checkout btn" id="checkOut"><em>Checkout - $<span
                                id="checkOutPrice">0</span></em></a>
            </footer>
        </div>
    </div> <!-- .cd-cart -->
</div> <!-- cd-cart-container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    if (!window.jQuery) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/card.js"></script>
<script src="js/nav.js"></script>
<script src="js/velocity.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>


</body>
</html>