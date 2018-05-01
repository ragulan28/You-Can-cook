<?php
    session_start();
    $id=0;
    if (isset($_SESSION['distributorId'])) {
        $id = $_SESSION['distributorId'];
        //echo $id;
        if ($id != -1) {
            header("Location:home.php");
        }
    }
?>
<html >
<head>
    <meta charset="UTF-8">
    <title>LogIn Form</title>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Hind:300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="css/login.css">


</head>

<body>
<div id="login-button">
    <img src="../img/Delivery.png">
</div>
<div id="container">
    <h1>Log In</h1>
    <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"/>
  </span>

    <form action="../controller/delivererController.php" method="post">
        <input type="text" required name="email" placeholder="User name">
        <input type="password" required name="password" placeholder="Password">
        <button type="submit" <?php if($id==-1){echo ' style="background-color:red" ';} ?>>Log in</button>
        <div id="remember-container">
            <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked" title=""/>
            <span id="remember">Remember me</span>

        </div>
    </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script src="js/login.js"></script>

</body>
</html>