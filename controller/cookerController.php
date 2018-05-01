<?php
    session_start();
    include '../db/CookerOpperation.php';
    $con = new CookerOpperation();
    if (isset($_POST['deleteid'])) {
        //echo $_POST['deleteid'];

        if ($con->deleteCooker($_POST['deleteid'])) {
            echo '1';
        } else {
            echo '0';
        }
        exit;
    }

    if (isset($_POST['email'])) {

        $_SESSION['cookerId']=$con->cookerAllow($_POST['email'],$_POST['password']);
        if ($_SESSION['cookerId']==-1){
            header("Location:../cooker/index.php");
        } else {
            header("Location:../cooker/home.php");
        }
        exit;
    }



