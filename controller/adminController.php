<?php
    session_start();
    include '../db/AdminOpperation.php';
    $con = new AdminOpperation();
    if (isset($_POST['adminLogin'])) {
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $_SESSION['adminUser'] = $con->checkValideAdmin($userName, $password);
//echo $_SESSION['adminUser'];
        if ($_SESSION['adminUser'] != -1) {
            header("Location:../admin/home.php");
        } else {
            header("Location:../admin/index.php");
        }

    } ?>