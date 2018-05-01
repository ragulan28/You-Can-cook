<?php
    session_start();
    include '../db/DelivererOpperation.php';
    $con=new  DelivererOpperation();
    if (isset($_POST['deleteid'])) {
        echo $_POST['deleteid'];
        $con = new DelivererOpperation();
        if ($con->deleteDeliverer($_POST['deleteid'])) {
            echo '1';
        } else {
            echo '0';
        }
        exit;
    }

    if (isset($_POST['email'])) {

        $_SESSION['distributorId']=$con->distributorAllow($_POST['email'],$_POST['password']);
        if ($_SESSION['distributorId']==-1){
            header("Location:../distributor/index.php");
        } else {
            header("Location:../distributor/home.php");
        }
        exit;
    }
