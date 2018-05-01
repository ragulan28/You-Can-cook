<?php
    session_start();

    include '../db/OrderOpperation.php';
    $con = new OrderOpperation();

    if (isset($_POST['payConform'])) {

        // var_dump($_POST['orders']);
        $userId = $_SESSION['user'];
        $id = $_SESSION['user'];
        $shipAddress = $_POST['shipAddress'];
        $orders = $_POST['orders'];
        for ($i = 0; $i < count($orders); $i++) {
            echo $con->insertNewOrder($userId, $shipAddress, $orders[$i]);
        }
    }

    //echo "ii";
    if (isset($_GET['id']) && isset($_GET['cookerId'])) {
        $cookerId = $_GET['cookerId'];
        echo $cookerId;
        $con->pickToCook($_GET['id'], $cookerId);
    }
    if (isset($_GET['idToFinished']) && isset($_GET['cookerId'])) {
        $cookerId = $_GET['cookerId'];
        $con->pickToFinisher($_GET['idToFinished'], $cookerId);
    }

    if (isset($_GET['id']) && isset($_GET['distributorId'])) {
        $distributorId = $_GET['distributorId'];
        //echo $cookerId;
        $con->pickToDistribute($_GET['id'], $distributorId);
    }
    if (isset($_GET['idToFinished']) && isset($_GET['distributorId'])) {
        $distributorId = $_GET['distributorId'];
        $con->pickToFinisherDistribute($_GET['idToFinished'], $distributorId);

    }