<?PHP
    session_start();
    include '../db/CookerOpperation.php';
    include '../db/DelivererOpperation.php';
    include '../db/FoodOpperation.php';
    include '../db/OrderOpperation.php';
    include '../db/UserOpperation.php';
    if (isset($_SESSION['adminUser'])) {
        //echo $_SESSION['adminUser'];
        if ($_SESSION['adminUser'] == -1) {
            header("Location:index.php");
        }
    } else {
        header("Location:index.php");
    }


    if (isset($_SESSION['searchUser']) && isset($_SESSION['searchUserName']) && isset($_SESSION['searchUserId'])) {

        $searchUser = $_SESSION['searchUser'];
        $searchUserName = $_SESSION['searchUserName'];
        $searchUserId = $_SESSION['searchUserId'];
    } else {
        $searchUser = 0;
        $searchUserName = 0;
        $searchUserId = 0;
    }


    $con1 = new CookerOpperation();
    $resultsforcooker = $con1->getForChart();

    $con2 = new DelivererOpperation();
    $resultsforSeller = $con2->getForChart();

    $con2 = new OrderOpperation();
    $newOrder = $con2->countNewOrder();
    $inCooking = $con2->countinCookOrder();
    $inDelivery = $con2->countInDeOrder();


?>

<html>
<head>
    <title>Admin</title>
    <script src="https://use.fontawesome.com/48c08ae4fd.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
    <link href="css/cooker.css" rel="stylesheet">
    <link href="css/deliverer.css" rel="stylesheet">

    <link rel="stylesheet" href="css/resetNav.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/styleNav.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>


        #custom-search-input {
            margin: 0;
            margin-top: 10px;
            padding: 0;
        }

        #custom-search-input .search-query {
            padding-right: 3px;
            padding-right: 4px \9;
            padding-left: 3px;
            padding-left: 4px \9;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */

            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #custom-search-input button {
            border: 0;
            background: none;
            /** belows styles are working good */
            padding: 2px 5px;
            margin-top: 2px;
            position: relative;
            left: -28px;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */
            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            color: #D9230F;
        }

        .search-query:focus + button {
            z-index: 3;
        }

    </style>
    <script type="text/javascript" src="js/jquery-2.1.1.js"></script>
    <style type="text/css">

        .item {
            display: block;

        }

        .hedding {
            color: white;
            font-size: medium;
        }
    </style>

    <script type="text/javascript">


        var data = {"total": 0, "rows": []};
        var totalCost = 0;
        var details = "";
        $(function () {

            $('#cartcontent ').datagrid({
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
                    $('.panel-body').attr("style", "width:300px");

                    var name = $(source).find('p:eq(0)').html();
                    var price = $(source).find('p:eq(1)').html();
                    var srcc = $(source).find('p:eq(2)').html();
                    //details += name + " " + price + "<br>";

                    addProduct(name, parseFloat(price.split('$')[1]));
                    details = "";
                    document.getElementById("newFoodDetails").value = details;
                    for (var i = 0; i < data.total; i++) {
                        var row = data.rows[i];
                        details += row.name + " - " + row.quantity + "<br>";
                    }
                    document.getElementById("newFoodDetails").value = details;

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
            $('div.cart .total').html('Total: Rs' + totalCost);
        }
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChartForCooker);
        google.charts.setOnLoadCallback(drawChartForSeller);
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChartForCooker() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Cooker');
            data.addColumn('number', 'Order');
            data.addRows([
                <?PHP

                foreach ($resultsforcooker as $row) {
                    echo "['" . $row['name'] . "', " . $row['count'] . "],";
                }
                ?>
            ]);

            // Set chart options
            var options = {
                'title'          : 'How Many Pizza Cookeed',
                'width'          : 600,
                'height'         : 600,
                'backgroundColor': 'transparent',
                textStyle        : {color: '#FFF'}
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_cooker'));
            chart.draw(data, options);
        }

        function drawChartForSeller() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Celler');
            data.addColumn('number', 'Order');
            data.addRows([
                <?PHP

                foreach ($resultsforSeller as $row) {
                    echo "['" . $row['name'] . "', " . $row['count'] . "],";
                }
                ?>
            ]);

            // Set chart options
            var options = {
                'title'          : 'How Many Pizza delivered',
                'width'          : 600,
                'height'         : 600,
                'backgroundColor': 'transparent'

            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_seller'));
            chart.draw(data, options);
        }

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['New Order',     <?PHP echo $newOrder;?>],
                ['In Cooking',      <?PHP echo $inCooking?>],
                ['In delivery',  <?PHP echo $inDelivery?>]

            ]);

            var options = {
                title            : 'Orders',
                'width'          : 900,
                'height'         : 500,
                'backgroundColor': 'transparent',
                is3D             : true
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>


<div id="cd-vertical-nav">

    <ul>
        <li>
            <a href="#section1" data-number="1">
                <span class="cd-dot"></span>
                <span class="cd-label">Home</span>
            </a>
        </li>
        <li>
            <a href="#section2" data-number="2">
                <span class="cd-dot"></span>
                <span class="cd-label">Cooker</span>
            </a>
        </li>
        <li>
            <a href="#section3" data-number="3">
                <span class="cd-dot"></span>
                <span class="cd-label">Distributor</span>
            </a>
        </li>
        <li>
            <a href="#section4" data-number="4">
                <span class="cd-dot"></span>
                <span class="cd-label">Foods</span>
            </a>
        </li>
        <li>
            <a href="#section5" data-number="6">
                <span class="cd-dot"></span>
                <span class="cd-label">Order</span>
            </a>
        </li>
        <li>
            <a href="#section6" data-number="6">
                <span class="cd-dot"></span>
                <span class="cd-label">Customers</span>
            </a>
        </li>

    </ul>
</div>
<a class="cd-nav-trigger cd-img-replace">Open navigation<span></span></a>
<!-- Admin -->
<section id="section1" class="cd-section">
    <h1 style="font-size: 60px">Administrator</h1>

    <div class="container">

        <a class="btn bg-danger btn-lg col-lg-2 col-lg-offset-5" href="../controller/logout.php?action=admin">LOGOUT</a>
    </div>
</section><!-- cd-section -->

<!-- Cooker -->
<section id="section2" class="cd-section">
    <div class="text-center" style="color:white;">
        <h2>Cooker</h2>
    </div>
    <div class="container-fluid">

        <div class="col-md-6">
            <br>
            <div class="row col-md-10 col-md-offset-1">

                <button class="btn icon-btn btn-success pull-right " data-title="newCooker" data-toggle="modal"
                        data-target="#newCooker" id="addcook">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add
                </button>
            </div>
            <div class="row">

                <div class="col-md-12  ">

                    <div class="table-responsive">


                        <table id="mytable" class="table table-bordred table-striped">

                            <thead>

                            <th class="hedding">ID</th>
                            <th class="hedding">Email</th>
                            <th class="hedding">Password</th>
                            <th class="hedding">Name</th>

                            <th class="hedding">Edit</th>
                            <th class="hedding">Delete</th>
                            </thead>
                            <tbody>
                            <?php
                                $con = new CookerOpperation();
                                $cookers = $con->getAllCooker();

                                for ($cooker = 0; $cooker < sizeof($cookers); $cooker++) {
                                    ?>
                                    <tr id="<?PHP echo $cookers[$cooker]['id'] ?>">

                                        <td><?PHP echo $cookers[$cooker]['id'] ?></td>
                                        <td><?PHP echo $cookers[$cooker]['email'] ?></td>
                                        <td><?PHP echo $cookers[$cooker]['password'] ?></td>
                                        <td><?PHP echo $cookers[$cooker]['name'] ?></td>

                                        <td>
                                            <span data-placement="top" data-toggle="tooltip" title="Edit">

                                                <button class="btn btn-primary btn-xs editBtn" data-title="Edit"
                                                        id="editbtn" data-toggle="modal" data-target="#edit"><span
                                                            class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </span>
                                        </td>
                                        <td>
                                            <span data-placement="top" data-toggle="tooltip" title="Delete">
                                                <button class="btn btn-danger btn-xs deleteBtn">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </span>
                                        </td>
                                    </tr>

                                <?PHP } ?>

                            </tbody>

                        </table>


                    </div>
                </div>


            </div>

        </div>

        <div class="col-md-6" id="chart_cooker">

        </div>

        <!-- Update cooker -->
        <div id="edit" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Cooker Detail</h4></div>
                    <div class="modal-body">
                        <form action="./controll/cookControl.php" method="post">
                            <div class="modal-body form-group" style="display: none">
                                <input type="text" name="id" id="cookerId" value=""/>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="text" placeholder="User name" name="email"
                                       data-validation="length" data-validation-length="max100">
                            </div>
                            <div class="form-group">

                                <input class="form-control " type="password" placeholder="Password" name="password"
                                       data-validation="strength"
                                       data-validation-strength="2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" data-validation="length"
                                       data-validation-length="max100">

                            </div>
                            <button type="submit" class="btn btn-info btn-lg" style="width: 100%;" name="update">
                                Update
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- New cooker -->
        <div id="newCooker" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">New Cooker</h4></div>
                    <div class="modal-body">
                        <form action="./controll/cookControl.php" method="post">

                            <div class="form-group">
                                <input class="form-control " type="text" placeholder="User name" name="newemail"
                                       data-validation="length" data-validation-length="max100">
                            </div>
                            <div class="form-group">

                                <input class="form-control " type="password" placeholder="Password" name="newpassword"
                                       data-validation="strength"
                                       data-validation-strength="2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="newname" data-validation="length"
                                       data-validation-length="max100">


                            </div>
                            <button class="btn btn-success btn-lg" style="width: 100%;" name="newCooker">Add</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section><!-- cd-section -->

<!-- Distributor -->
<section id="section3" class="cd-section">
    <div class="text-center" style="color:white;"><h2>Distributor</h2></div>
    <div class="container-fluid">

        <div class="col-md-6">
            <br>
            <div class="row col-md-10 col-md-offset-1">

                <button class="btn icon-btn btn-success pull-right " data-title="newCooker" data-toggle="modal"
                        data-target="#newDistributor" id="addcook">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add
                </button>
            </div>
            <div class="row">

                <div class="col-md-12  ">

                    <div class="table-responsive">


                        <table id="mytable" class="table table-bordred table-striped">

                            <thead>

                            <th class="hedding">ID</th>
                            <th class="hedding">Email</th>
                            <th class="hedding">Password</th>
                            <th class="hedding">Name</th>

                            <th class="hedding">Edit</th>
                            <th class="hedding">Delete</th>
                            </thead>
                            <tbody>
                            <?php
                                $con = new DelivererOpperation();
                                $deliverers = $con->getAllDeliverer();

                                for ($deliverer = 0; $deliverer < sizeof($deliverers); $deliverer++) {
                                    ?>
                                    <tr id="<?PHP echo $deliverers[$deliverer]['id'] ?>">

                                        <td><?PHP echo $deliverers[$deliverer]['id'] ?></td>
                                        <td><?PHP echo $deliverers[$deliverer]['email'] ?></td>
                                        <td><?PHP echo $deliverers[$deliverer]['password'] ?></td>
                                        <td><?PHP echo $deliverers[$deliverer]['name'] ?></td>

                                        <td>
                                            <span data-placement="top" data-toggle="tooltip" title="Edit">

                                                <button class="btn btn-primary btn-xs editBtnDistributor"
                                                        data-title="Edit"
                                                        id="editbtn" data-toggle="modal" data-target="#editDistributor"><span
                                                            class="glyphicon glyphicon-pencil"></span>
                                                </button>
                                            </span>
                                        </td>
                                        <td>
                                            <span data-placement="top" data-toggle="tooltip" title="Delete">
                                                <button class="btn btn-danger btn-xs deleteBtnDistributor">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </span>
                                        </td>
                                    </tr>

                                <?PHP } ?>

                            </tbody>

                        </table>


                    </div>
                </div>


            </div>

        </div>

        <div class="col-md-6" id="chart_seller">

        </div>
        <!-- Update Distributor -->
        <div id="editDistributor" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Distributor Detail</h4></div>
                    <div class="modal-body">
                        <form action="controll/delivererControl.php" method="post">
                            <div class="modal-body form-group" style="display: none">
                                <input type="text" name="id" id="distributorId" value=""/>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="text" placeholder="User name" name="email"
                                       data-validation="length" data-validation-length="max100">
                            </div>
                            <div class="form-group">

                                <input class="form-control " type="password" placeholder="Password" name="password"
                                       data-validation="strength"
                                       data-validation-strength="2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="name" data-validation="length"
                                       data-validation-length="max100">


                            </div>
                            <button type="submit" class="btn btn-info btn-lg" style="width: 100%;" name="update">
                                Update
                            </button>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- New Distributor -->
        <div id="newDistributor" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                    class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                        <h4 class="modal-title custom_align" id="Heading">New Distributor</h4></div>
                    <div class="modal-body">
                        <form action="controll/delivererControl.php" method="post">

                            <div class="form-group">
                                <input class="form-control " type="text" placeholder="User name" name="newemailDis"
                                       data-validation="length" data-validation-length="max100">
                            </div>
                            <div class="form-group">

                                <input class="form-control " type="password" placeholder="Password" name="newpasswordDis"
                                       data-validation="strength"
                                       data-validation-strength="2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Name" name="newnameDis" data-validation="length"
                                       data-validation-length="max100">


                            </div>
                            <button class="btn btn-success btn-lg" style="width: 100%;" name="newDis">Add</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section><!-- cd-section -->

<!-- Foods -->
<section id="section4" class="cd-section">
    <div class="container-fluid">
        <!-- ingredient -->
        <div class=" col-md-6">
            <div class="page-header  text-center">
                <h2 style="display: inline-block"> Ingredients</h2>
                <button class="btn icon-btn btn-success pull-right " data-toggle="modal" data-target="#newIngredient"
                        id="addIngredient" style="display: inline-block">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add
                </button>

            </div>
            <div class="row">

                <div class="container-fluid ">
                    <?php
                        $con = new FoodOpperation();
                        $ingredients = $con->getAllIngredients();

                        for ($ingredient = 0; $ingredient < sizeof($ingredients); $ingredient++) {
                            ?>
                            <div class="col-md-3 " id="<?PHP echo $ingredients[$ingredient]['id'] ?>">

                                <div class=" text-center" style="color: whitesmoke">
                                    <?PHP echo $ingredients[$ingredient]['name'] ?>
                                </div>
                                <div class="">
                                    <div class="row text-center">
                                        <img src="<?PHP echo $ingredients[$ingredient]['icon'] ?>" class="img-thumbnail"
                                             height="" width="">
                                    </div>
                                    <div class="row text-center" style="color: whitesmoke">
                                        <?PHP echo $ingredients[$ingredient]['price'] ?>
                                    </div>
                                </div>
                                <div class="">

                                    <div class="col-md-1 col-md-offset-1">
                                        <button class="btn btn-primary btn-sm editBtnIngredient" data-title="Edit"
                                                data-toggle="modal" data-target="#editIngredient">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-1 col-md-offset-1">
                                        <button class="btn btn-danger btn-sm deleBtnIngredient">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        <?PHP } ?>
                </div>
            </div>
        </div>

        <!-- food -->
        <div class=" col-md-6">

            <div class="page-header  text-center">
                <h2 style="display: inline-block"> Foods</h2>
                <button class="btn icon-btn btn-success pull-right " data-toggle="modal" data-target="#newFood"
                        style="display: inline-block">
                    <span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add
                </button>

            </div>
            <div class="row">

                <div class="container-fluid ">
                    <?php
                        $con = new FoodOpperation();
                        $foods = $con->getAllFood();

                        for ($food = 0; $food < sizeof($foods); $food++) {
                            ?>
                            <div class="col-md-3 " id="<?PHP echo $foods[$food]['id'] ?>">

                                <div class=" text-center" style="color: whitesmoke;">
                                    <?PHP echo $foods[$food]['name'] ?>
                                </div>
                                <div class="">
                                    <div class="row">
                                        <img src="<?PHP echo $foods[$food]['image'] ?>" class="img-thumbnail" height=""
                                             width="">
                                    </div>
                                    <div class="row text-center" style="color: whitesmoke">
                                        <?PHP echo $foods[$food]['price'] ?>
                                    </div>
                                </div>
                                <div class="">

                                    <div class="col-md-1 col-md-offset-1">
                                        <button class="btn btn-primary btn-sm editBtnFood" data-title="Edit"
                                                data-toggle="modal" data-target="#editFood">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-1 col-md-offset-1">
                                        <button class="btn btn-danger btn-sm deleBtnFood">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </div>

                                </div>

                            </div>
                        <?PHP } ?>
                </div>
            </div>

        </div>
    </div>

    <!-- Update model ingredient -->
    <div id="editIngredient" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Ingredient</h4></div>
                <div class="modal-body">
                    <form action="controll/foodControl.php" method="post">
                        <div class="modal-body form-group" style="display: none">
                            <input type="text" name="idIngredient" id="ingredientId" value=""/>
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Name" name="name"
                                   data-validation="length" data-validation-length="max100">
                        </div>
                        <div class="form-group">

                            <input class="form-control " type="number" placeholder="Price" name="price"
                                   data-validation="number">
                        </div>

                        <button type="submit" class="btn btn-info btn-lg" style="width: 100%;"
                                name="updateIngredient">
                            Update
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- New model ingredient -->
    <div id="newIngredient" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">New Ingredient</h4></div>
                <div class="modal-body">
                    <form action="controll/foodControl.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Name" name="newNameIngredient"
                                   data-validation="length" data-validation-length="max100">
                        </div>
                        <div class="form-group">

                            <input class="form-control" type="number" placeholder="Price" name="newPriceIngredient"
                                   data-validation="number">
                        </div>
                        <div class="form-group">
                            <label for="inc">Image</label>
                            <input id="inc" class="form-control" name="imageIngredient" type="file"
                                   data-validation="mime required"
                                   data-validation-allowing="jpg, png"
                                   data-validation-error-msg-required="No image selected" value="">

                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input id="icon" class="form-control" name="imageIconIngredient" type="file"
                                   data-validation="mime required"
                                   data-validation-allowing="jpg, png"
                                   data-validation-error-msg-required="No image selected">

                        </div>
                        <button class="btn btn-success btn-lg" style="width: 100%;" name="newIngredient">Add</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Update model food -->
    <div id="editFood" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Food</h4></div>
                <div class="modal-body">
                    <form action="controll/foodControl.php" method="post">
                        <div class="modal-body form-group" style="display: none">
                            <input type="text" name="idFood" id="foodId" value=""/>
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Name" name="nameFood"
                                   data-validation="length" data-validation-length="max100">
                        </div>
                        <div class="form-group">

                            <input class="form-control " type="number" placeholder="Price" name="priceFood"
                                   data-validation="number">
                        </div>

                        <button type="submit" class="btn btn-info btn-lg" style="width: 100%;" name="updateFood">
                            Update
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- New model food -->
    <div id="newFood" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div id="x"></div>
            <div class="modal-content" style="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                                class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">New Food</h4></div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6" style="background: white">
                                <div class="container-fluid">
                                    <ul class="row">
                                        <?php
                                            $con = new FoodOpperation();
                                            $foods = $con->getAllIngredients();

                                            for ($ingredient = 0; $ingredient < sizeof($ingredients); $ingredient++) {
                                                ?>
                                                <li class="col-md-2">
                                                    <a href="#" class="item">
                                                        <img src="<?PHP echo $ingredients[$ingredient]['icon'] ?>"/>
                                                        <div>
                                                            <p style="display:none"><?PHP echo $ingredients[$ingredient]['name'] ?></p>
                                                            <p style="display:none">
                                                                Price:Rs<?PHP echo $ingredients[$ingredient]['price'] ?></p>
                                                            <p style="display:none" id="6" class="imgadd">
                                                                customise-pizza-jalapeno</p>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?PHP } ?>
                                    </ul>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="cart">
                                    <div>
                                        <table id="cartcontent" fitColumns="true" style="height:auto">
                                            <thead>
                                            <tr>
                                                <th field="name" width=140>Name</th>
                                                <th field="quantity" width=60 align="right">Quantity</th>

                                            </tr>
                                            </thead>
                                        </table>
                                    </div>

                                    <h4>Drop here to add to cart</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <form action="controll/foodControl.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input class="form-control " type="text" placeholder="Name" name="newFoodName"
                                           data-validation="length" data-validation-length="max100">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" id="newFoodDetails" style="display: none" type="text"
                                           placeholder="Name" name="newFoodDetails">
                                </div>
                                <div class="form-group">
                                    <input class="form-control " type="number" placeholder="Price" name="newFoodPrice"
                                           data-validation="number">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="newImageFood" type="file"
                                           data-validation="mime required"
                                           data-validation-allowing="jpg, png"
                                           data-validation-error-msg-required="No image selected">

                                </div>

                                <button class="btn btn-success btn-lg" style="width: 100%;" id="newFood" name="newFood">
                                    Add
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section><!-- cd-section -->

<!-- order -->
<section id="section5" class="cd-section">
    <div class="col-lg-12 text-center">
        <h2 style="color:whitesmoke;"> Order </h2>
        <div id="piechart_3d" class="col-lg-8 col-lg-offset-2">

        </div>
    </div>
</section><!-- cd-section -->

<!-- customers -->
<section id="section6" class="cd-section">
    <div class="container">
        <div class="row">
            <div id="custom-search-input">
                <form action="../controller/userController.php" method="post">
                    <div class="input-group col-md-12">

                        <input type="email" class=" search-query form-control" name="email" placeholder="Search"/>
                        <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit" name="search">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>

                    </div>
                </form>
            </div>

            <br>
            <div class="row">
                <div class="container col-lg-8 col-lg-offset-2">

                    <div class="row text-center" style="<?PHP if ($searchUser == 0) {
                        echo "display: none;";
                    } ?>">
                        <div class="row text-center ">
                            <a href="../controller/userController.php?deleteUser=<?PHP echo $_SESSION['searchUserId']; ?>"
                               class="btn btn-lg btn-danger" style="<?PHP if ($searchUser == 0 or $searchUser == -1) {
                                echo "display: none;";
                            } ?>"><span class="glyphicon glyphicon-trash"> </span></a>
                        </div>
                        <div class="text-center"><h3
                                    style="color: white;">
                                <?PHP if ($searchUser == 1) {
                                    echo $searchUserName;
                                } else if ($searchUser == -1) {
                                    echo 'No Result';
                                } ?>
                            </h3>
                        </div>
                        <table class="table table-striped" style="<?PHP if ($searchUser == 0 or $searchUser == -1) {
                            echo "display: none;";
                        } ?>">
                            <thead>
                            <tr>
                                <th class="col-lg-4"><h2>Name</h2></th>
                                <th class="col-lg-4"><h2>Price</h2></th>
                                <th class="col-lg-4"><h2>No</h2></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP
                                if ($searchUser == 1) {
                                    $conOrder = new OrderOpperation();
                                    if (isset($_SESSION['searchUserId'])) {
                                        $orders = $conOrder->getUnFinishedOrderByUserId($searchUserId);
                                        foreach ($orders as $order) {
                                            echo <<<AAA
                            <tr >
                                <td >{$order['name']}</td >
                                <td >{$order['price']}</td >
                                <td >{$order['no']}</td >
                            </tr >
AAA;
                                        }
                                    }
                                }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section><!-- cd-section -->

<!--Div that will hold the pie chart-->

<script src="js/jquery-2.1.1.js"></script>
<!--<div id="chart_div"></div>-->
<script type="text/javascript" src="../js/jeasyui.min.js"></script>
<script src="js/velocity.min.js"></script>
<script src="js/nav.js"></script> <!-- Resource jQuery -->
<script src="js/main.js"></script> <!-- Resource jQuery -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/cooker.js"></script>
<script type="text/javascript" src="js/deliverer.js"></script>
<script type="text/javascript" src="js/food.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>

    $.validate({
        modules        : 'location, date, security, file',
        onModulesLoaded: function () {
            $('#country').suggestCountry();
        }
    });

    // Restrict presentation length
    $('#presentation').restrictLength($('#pres-max-length'));

</script>
</body>
</html>