<?php
    session_start();
    $id=0;
    if (isset($_SESSION['cookerId'])) {
        $id = $_SESSION['cookerId'];
        echo $id;
        if ($id == -1) {
            header("Location:index.php");
        }
    }else{
        header("Location:index.php");
    }
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->

    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <link href="css/ihover.css" rel="stylesheet">
                                                 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
                                                 <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <title></title>
</head>
<body>
<div class="cd-fold-content single-page container-fluid">
    <form class="">
        <!-- Left to right-->
        <div class="row ">

            <div class="col-md-12 center-block ">
                <?PHP
                    include '../db/OrderOpperation.php';
                    $con = new OrderOpperation();
                    if (!$con->idOrderInProsser($id)) {

                        $orders = $con->getNewOrder();
                        foreach ($orders as $order) {
                            ?>
                            <!-- normal -->
                            <div class="ih-item square effect6 from_top_and_bottom col-lg-8 col-lg-offset-3">
                                <a href="../controller/orderController.php?id=<?PHP echo $order['id'] ?>&cookerId=<?PHP echo $id?>">
                                    <div class="img img-responsive"><img src="../img/Pizza-Hut-Wallpaper-2.jpg"
                                                                         alt="img">
                                    </div>
                                    <div class="info">
                                        <h3><?PHP echo $order['name'] ?></h3>
                                        <p><?PHP echo $order['details'] ?></p>
                                        <p><?PHP echo $order['no'] ?></p>
                                    </div>
                                </a>
                            </div>
                            <br>
                            <!-- end normal -->
                        <?PHP }
                    } ?>
            </div>

        </div>
        <!-- end Right to left-->
    </form>
</div>
</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

</html>