<?php
    session_start();
    $id = 0;
    if (isset($_SESSION['cookerId'])) {
        $id = $_SESSION['cookerId'];
        //echo $id;
        if ($id == -1) {
            header("Location:index.php");
        }
    } else {
        header("Location:index.php");
    }
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

    <title>3D Folding Panel</title>
</head>
<body>
<div class="cd-fold-content single-page">
    <div class="text-center">
        <?PHP
            include '../db/OrderOpperation.php';
            $con = new OrderOpperation();
            $activeOrder = $con->getActiveOrder($id);
            //echo $activeOrder['name'];
            if ($activeOrder != -1) {
                ?>
                <h2><?PHP echo $activeOrder['name'] ?></h2>
                <p><?PHP echo $activeOrder['details'] ?></p>
                <h3 style="color: #8a6d3b  "><<< <?PHP echo $activeOrder['no'] ?> >>></h3>
                <a href="../controller/orderController.php?idToFinished=<?PHP echo $activeOrder['id'] ?>&cookerId=<?PHP echo $id ?> "
                   class="btn btn-info btn-lg">Finished</a>
                <?PHP

            } else { ?>
                <h2>No Active Order</h2>
                <?PHP
            } ?>
    </div>
</div>
</body>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

                                   <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</html>