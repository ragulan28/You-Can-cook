<?php
    session_start();
    session_unset();
    session_destroy();
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'admin') {
            header( "refresh:2;url=../admin/index.php" );

        }

        if ($action == 'user') {
            header( "refresh:2;url=../index.html" );

        }

        if ($action == 'cooker') {

            header( "refresh:2;url=../cooker/index.php" );
        }

        if ($action == 'distributor') {

            header( "refresh:2;url=../distributor/index.php" );
        }

    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>CSS3 Infinite Loader</title>
    <title>CSS3 infinite loader</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">


    <style>
        /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
        /*
  * Infinite Loader
  *
  * Author: Jonathan Silva
  * Url: https://portfolio.jonathansilva.com.br
  *
  */
        /* ----- Base ----- */
        /* ----- Loader ----- */
        body {
            background-color: #55c1FA;
        }

        .loader-wrapper {
            width: 148px;
            height: 100px;
            position: absolute;
            margin: -50px 0 0 -74px;
            left: 50%;
            top: 60%;
        }

        .loader {
            width: 148px;
            height: 100px;
            top: 0;
            left: 0;
            position: absolute;
        }

        .loader:after {
            content: "";
            top: auto;
            position: absolute;
            display: block;
            animation: shadow 1.2s infinite linear;
            -moz-animation: shadow 1.2s infinite linear;
            bottom: 0em;
            left: 0;
            height: .25em;
            width: 1em;
            border-radius: 50%;
            background-color: #034466;
            opacity: 0.3;
        }

        .roller,
        .roller:last-child {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 0;
            left: 0;
            -webkit-animation: rollercoaster 1.2s infinite linear;
            -webkit-transform: rotate(135deg);
            -moz-animation: rollercoaster 1.2s infinite linear;
            -moz-transform: rotate(135deg);
            animation: rollercoaster 1.2s infinite linear;
            transform: rotate(135deg);
        }

        .roller:last-child {
            left: auto;
            right: 0;
            -webkit-transform: rotate(-45deg);
            -webkit-animation: rollercoaster2 1.2s infinite linear;
            -moz-transform: rotate(-45deg);
            -moz-animation: rollercoaster2 1.2s infinite linear;
            transform: rotate(-45deg);
            animation: rollercoaster2 1.2s infinite linear;
        }

        .roller:before,
        .roller:last-child:before {
            content: "";
            display: block;
            width: 15px;
            height: 15px;
            background: #000;
            border-radius: 50%;
        }

        @-webkit-keyframes rollercoaster {
            0% {
                -webkit-transform: rotate(135deg);
            }
            8% {
                -webkit-transform: rotate(240deg);
            }
            20% {
                -webkit-transform: rotate(300deg);
            }
            40% {
                -webkit-transform: rotate(380deg);
            }
            45% {
                -webkit-transform: rotate(440deg);
            }
            50% {
                -webkit-transform: rotate(495deg);
                opacity: 1;
            }
            50.1% {
                -webkit-transform: rotate(495deg);
                opacity: 0;
            }
            100% {
                -webkit-transform: rotate(495deg);
                opacity: 0;
            }
        }

        @-webkit-keyframes rollercoaster2 {
            0% {
                opacity: 0;
            }
            49.9% {
                opacity: 0;
            }
            50% {
                opacity: 1;
                -webkit-transform: rotate(-45deg);
            }
            58% {
                -webkit-transform: rotate(-160deg);
            }
            70% {
                -webkit-transform: rotate(-240deg);
            }
            80% {
                -webkit-transform: rotate(-300deg);
            }
            90% {
                -webkit-transform: rotate(-340deg);
            }
            100% {
                -webkit-transform: rotate(-405deg);
            }
        }

        @-webkit-keyframes shadow {
            0% {
                opacity: .3;
                -webkit-transform: translateX(65px) scale(0.5, 0.5);
            }
            8% {
                -webkit-transform: translateX(30px) scale(2, 2);
            }
            13% {
                -webkit-transform: translateX(0px) scale(1.3, 1.3);
            }
            30% {
                -webkit-transform: translateX(-15px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            50% {
                -webkit-transform: translateX(60px) scale(1.2, 1.2);
                opacity: 0.3;
            }
            60% {
                -webkit-transform: translateX(130px) scale(2, 2);
                opacity: 0.05;
            }
            65% {
                -webkit-transform: translateX(145px) scale(1.2, 1.2);
            }
            80% {
                -webkit-transform: translateX(120px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            90% {
                -webkit-transform: translateX(80px) scale(0.8, 0.8);
            }
            100% {
                -webkit-transform: translateX(60px);
                opacity: 0.3;
            }
        }

        /* Moz */
        @-moz-keyframes rollercoaster {
            0% {
                -moz-transform: rotate(135deg);
            }
            8% {
                -moz-transform: rotate(240deg);
            }
            20% {
                -moz-transform: rotate(300deg);
            }
            40% {
                -moz-transform: rotate(380deg);
            }
            45% {
                -moz-transform: rotate(440deg);
            }
            50% {
                -moz-transform: rotate(495deg);
                opacity: 1;
            }
            50.1% {
                -moz-transform: rotate(495deg);
                opacity: 0;
            }
            100% {
                -moz-transform: rotate(495deg);
                opacity: 0;
            }
        }

        @-moz-keyframes rollercoaster2 {
            0% {
                opacity: 0;
            }
            49.9% {
                opacity: 0;
            }
            50% {
                opacity: 1;
                -moz-transform: rotate(-45deg);
            }
            58% {
                -moz-transform: rotate(-160deg);
            }
            70% {
                -moz-transform: rotate(-240deg);
            }
            80% {
                -moz-transform: rotate(-300deg);
            }
            90% {
                -moz-transform: rotate(-340deg);
            }
            100% {
                -moz-transform: rotate(-405deg);
            }
        }

        @-moz-keyframes shadow {
            0% {
                opacity: .3;
                -moz-transform: translateX(65px) scale(0.5, 0.5);
            }
            8% {
                -moz-transform: translateX(30px) scale(2, 2);
            }
            13% {
                -moz-transform: translateX(0px) scale(1.3, 1.3);
            }
            30% {
                -moz-transform: translateX(-15px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            50% {
                -moz-transform: translateX(60px) scale(1.2, 1.2);
                opacity: 0.3;
            }
            60% {
                -moz-transform: translateX(130px) scale(2, 2);
                opacity: 0.05;
            }
            65% {
                -moz-transform: translateX(145px) scale(1.2, 1.2);
            }
            80% {
                -moz-transform: translateX(120px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            90% {
                -moz-transform: translateX(80px) scale(0.8, 0.8);
            }
            100% {
                -moz-transform: translateX(60px);
                opacity: 0.3;
            }
        }

        /* No-prefix */
        @keyframes rollercoaster {
            0% {
                transform: rotate(135deg);
            }
            8% {
                transform: rotate(240deg);
            }
            20% {
                transform: rotate(300deg);
            }
            40% {
                transform: rotate(380deg);
            }
            45% {
                transform: rotate(440deg);
            }
            50% {
                transform: rotate(495deg);
                opacity: 1;
            }
            50.1% {
                transform: rotate(495deg);
                opacity: 0;
            }
            100% {
                transform: rotate(495deg);
                opacity: 0;
            }
        }

        @keyframes rollercoaster2 {
            0% {
                opacity: 0;
            }
            49.9% {
                opacity: 0;
            }
            50% {
                opacity: 1;
                transform: rotate(-45deg);
            }
            58% {
                transform: rotate(-160deg);
            }
            70% {
                transform: rotate(-240deg);
            }
            80% {
                transform: rotate(-300deg);
            }
            90% {
                transform: rotate(-340deg);
            }
            100% {
                transform: rotate(-405deg);
            }
        }

        @keyframes shadow {
            0% {
                opacity: .3;
                transform: translateX(65px) scale(0.5, 0.5);
            }
            8% {
                transform: translateX(30px) scale(2, 2);
            }
            13% {
                transform: translateX(0px) scale(1.3, 1.3);
            }
            30% {
                transform: translateX(-15px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            50% {
                transform: translateX(60px) scale(1.2, 1.2);
                opacity: 0.3;
            }
            60% {
                transform: translateX(130px) scale(2, 2);
                opacity: 0.05;
            }
            65% {
                transform: translateX(145px) scale(1.2, 1.2);
            }
            80% {
                transform: translateX(120px) scale(0.5, 0.5);
                opacity: 0.1;
            }
            90% {
                transform: translateX(80px) scale(0.8, 0.8);
            }
            100% {
                transform: translateX(60px);
                opacity: 0.3;
            }
        }

        #loader2:after {
            -webkit-animation-delay: 0.15s;
            animation-delay: 0.15s;
        }

        #loader2 .roller {
            -webkit-animation-delay: 0.15s;
            animation-delay: 0.15s;
        }

        #loader3:after {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }

        #loader3 .roller {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>

<div class="loader-wrapper">
    <div class="loader">
        <div class="roller"></div>
        <div class="roller"></div>
    </div>

    <div id="loader2" class="loader">
        <div class="roller"></div>
        <div class="roller"></div>
    </div>

    <div id="loader3" class="loader">
        <div class="roller"></div>
        <div class="roller"></div>
    </div>

</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


</body>
</html>


