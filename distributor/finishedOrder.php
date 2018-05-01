<?php
    session_start();
    $id=0;

    if (isset($_SESSION['distributorId'])) {
        $id = $_SESSION['distributorId'];
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
    <link rel="stylesheet" href="css/bootstrap.css"> <!-- CSS reset -->
                                                     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

                                                     <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

    <title>3D Folding Panel</title>
</head>
<body>
<div class="cd-fold-content single-page">
    <div class="container-fluid">
        <div class="row">
            <?PHP
                include '../db/OrderOpperation.php';
                $con = new OrderOpperation();

                $orders = $con->getFinishedOrderByIdDistribute($id);
                foreach ($orders as $order) {
                    ?>
                    <div class="panel panel-body panel-info col-lg-3 text-center">
                        <h2><?PHP echo $order['name'] ?></h2>
                        <p><?PHP echo $order['adress'] ?></p>
                        <p><?PHP echo $order['no'] ?></p>
                    </div>
                    <?PHP
                }
            ?>
        </div>
    </div>
</body>
<script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
                                   <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</html>