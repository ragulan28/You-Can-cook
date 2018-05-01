<?php
    session_start();
    $id=0;
    if (isset($_SESSION['distributorId'])) {
        $id = $_SESSION['distributorId'];
        //echo $id;
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
    <link href='http://fonts.googleapis.com/css?family=Vollkorn|Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="css/ihover.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->


</head>
<body>
<main class="cd-main">
    <ul class="cd-gallery">
        <li class="cd-item" style="background-color: #8a6d3b">
            <a href="newOrder.php">
                <div>
                    <h2>New Order</h2>

                </div>
            </a>
        </li>

        <li class="cd-item" style="background-color: #761c19">
            <a href="activeOrder.php">
                <div>
                    <h2>Active Order</h2>

                </div>
            </a>
        </li>

        <li class="cd-item" style="background-color: #888888">
            <a class="dark-text" href="finishedOrder.php">
                <div>
                    <h2>Finish Order</h2>

                </div>
            </a>
        </li>

        <li class="cd-item" style="background-color: #265a88">
            <a href="newProduct.php">
                <div>
                    <h2>Profil</h2>

                </div>
            </a>
        </li>
    </ul> <!-- .cd-gallery -->
</main> <!-- .cd-main -->

<div class="cd-folding-panel">

    <div class="fold-left"></div> <!-- this is the left fold -->

    <div class="fold-right"></div> <!-- this is the right fold -->

    <div class="cd-fold-content">
        <!-- content will be loaded using javascript -->
    </div>

    <a class="cd-close" href="#0"></a>
</div> <!-- .cd-folding-panel -->

<script src="js/jquery-2.1.1.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>