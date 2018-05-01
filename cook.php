<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script>

    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
    <link type="text/css" href="css/bootstrap.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <style type="text/css">

        .item {
            display: block;

        }
    </style>

    <script type="text/javascript">


        var data = {"total": 0, "rows": []};
        var totalCost = 0;

        $(function () {
            var count = 300;
            $('#cartcontent ').datagrid({
                singleSelect: true
            });
            $('.item').draggable({
                revert: true,
                proxy: 'clone',
                onStartDrag: function () {
                    $(this).draggable('options').cursor = 'not-allowed';
                    $(this).draggable('proxy').css('z-index', 10);
                },
                onStopDrag: function () {
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
                onDrop: function (e, source) {
                    count++;
                    var name = $(source).find('p:eq(0)').html();
                    var price = $(source).find('p:eq(1)').html();
                    var srcc = $(source).find('p:eq(2)').html();
                    $('.pizza').append("<img src='img/pizza/img/pizza in/" + srcc + ".png' style='position:absolute;display:z-index:" + count + "'/>");

                    addProduct(name, parseFloat(price.split('$')[1]));
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
                    name: name,
                    quantity: 1,
                    price: price
                });
            }

            add();
            totalCost += price;
            $('#cartcontent').datagrid('loadData', data);
            $('div.cart .total').html('Total: $' + totalCost);
        }
    </script>

    <link href="css/resetNav.css" rel="stylesheet">
    <link href="css/styleNav.css" rel="stylesheet">
    <script src="js/modernizr.js" type="text/javascript"></script> <!-- Modernizr -->

</head>
<body>

<?PHP include 'navBar.php' ?>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4 " style="background: white">
            <ul class="container-fluid">

                <li class="col-md-4 ">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingsTandooriChicken.jpg" alt=""/>
                        <div>
                            <p>Tandoori</p>
                            <p>Price:$55</p>
                            <p style="display:none" id="1" class="imgadd">customise-tandoori-chicken</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-4">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingsTomato.jpg"/>
                        <div>
                            <p>Tomato</p>
                            <p>Price:$15</p>
                            <p style="display:none" id="2" class="imgadd">customise-pizza-tomato</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-4">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingsBellPepper.jpg"/>
                        <div>
                            <p>BellPepper</p>
                            <p>Price:$05</p>
                            <p style="display:none" id="3" class="imgadd">customise-pizza-bell-pepper</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-4">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingsBarbeque.jpg"/>
                        <div>
                            <p>Barbeque</p>
                            <p>Price:$25</p>
                            <p style="display:none" id="4" class="imgadd">customise-pizza-bell-pepper</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-4">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingsSpicyChicken.jpg"/>
                        <div>
                            <p>Spicy Chicken</p>
                            <p>Price:$55</p>
                            <p style="display:none" id="5" class="imgadd">customise-pizza-spicy</p>
                        </div>
                    </a>
                </li>
                <li class="col-md-3">
                    <a href="#" class="item">
                        <img src="img/pizza/img/pizza menu/toppingPineapple.jpg"/>
                        <div>
                            <p>Pineapple</p>
                            <p>Price:$20</p>
                            <p style="display:none" id="6" class="imgadd">customise-pizza-jalapeno</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-3">
            <div class="cart">
                <h1>Shopping Cart</h1>
                <div >
                    <table id="cartcontent" fitColumns="true" style="height:auto">
                        <thead>
                        <tr>
                            <th field="name" width=140>Name</th>
                            <th field="quantity" width=60 align="right">Quantity</th>
                            <th field="price" width=60 align="right">Price</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <p class="total">Total: $0</p>
                <h2>Drop here to add to cart</h2>
            </div>
        </div>
        <div class="col-md-5">
            <div class="pizza" id="pizzaa">

                <img src="img/pizza/img/margherita.png" style="position:absolute;  z-index: -1;"
                     alt=""/>
            </div>
        </div>

    </div>
</div>

<script src="js/nav.js" type="text/javascript"></script>
<script src="js/velocity.min.js" type="text/javascript"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous" type="text/javascript"></script>
</body>
</html>