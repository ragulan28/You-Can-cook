<?php

    class OrderOpperation {
        private $con;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        function insertNewOrder($userId, $shipAddress, $order) {
            $name = $order['name'];
            $quantity = $order['quantity'];
            $details = $order['details'];
            $price = $order['price'];
            $stmt = $this->con->prepare("INSERT INTO customer_order (customer_id,name,no,price,adress,details) VALUE  (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $userId, $name, $quantity, $price, $shipAddress, $details);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function getNewOrder() {

            $stmt = $this->con->prepare("SELECT id,name,no,details FROM customer_order WHERE state LIKE '0' ");
            $stmt->execute();
            $stmt->bind_result($id, $name, $no, $details);

            $orders = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['details'] = $details;
                array_push($orders, $temp);
            }

            return $orders;
        }

        function pickToCook($id, $coolerId) {
            $stmt = $this->con->prepare("UPDATE customer_order SET state=1 ,cooker_id=? WHERE id LIKE ?");
            $stmt->bind_param("ss", $coolerId, $id);
            if ($stmt->execute()) {
                header("Location:../cooker/home.php");
            } else {
                echo "error";
            }
        }

        function pickToFinisher($id, $coolerId) {
            $stmt = $this->con->prepare("UPDATE customer_order SET state=2 WHERE cooker_id=? AND id LIKE ?");
            $stmt->bind_param("ss", $coolerId, $id);
            if ($stmt->execute()) {
                header("Location:../cooker/home.php");
            } else {
                echo "error";
            }
        }

        function idOrderInProsser($cookerId) {
            $stmt = $this->con->prepare("select * from customer_order WHERE cooker_id LIKE $cookerId AND state  LIKE 1");
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        }


        function getActiveOrder($cookerId) {

            $stmt = $this->con->prepare("SELECT id,name,no,details FROM customer_order WHERE state LIKE 1 AND cooker_id LIKE ?");
            $stmt->bind_param("s", $cookerId);

            if ($stmt->execute()) {
                $stmt->bind_result($id, $name, $no, $details);
                //echo $id;
                $stmt->store_result();
                $temp = array();
                while ($stmt->fetch()) {
                    $temp['id'] = $id;
                    $temp['name'] = $name;
                    $temp['no'] = $no;
                    $temp['details'] = $details;

                    return $temp;
                }
            }

            return -1;
        }

        function getFinishedOrderById($cookerId) {

            $stmt = $this->con->prepare("SELECT name,no,details FROM customer_order WHERE state=2 AND cooker_id LIKE ?");

            $stmt->bind_param("s", $cookerId);
            $stmt->execute();
            $stmt->bind_result($name, $no, $details);
            $orders = array();

            while ($stmt->fetch()) {

                $temp = array();
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['details'] = $details;
                array_push($orders, $temp);
            }

            return $orders;
        }


        /////////////// Distrubator ///////////////

        function getNewOrderDistribute() {

            $stmt = $this->con->prepare("SELECT id,name,no,adress FROM customer_order WHERE state LIKE '2' ");
            $stmt->execute();
            $stmt->bind_result($id, $name, $no, $adress);

            $orders = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['adress'] = $adress;
                array_push($orders, $temp);
            }

            return $orders;
        }

        function pickToDistribute($id, $distributorId) {
            $stmt = $this->con->prepare("UPDATE customer_order SET state=3 ,seller_id=? WHERE id LIKE ?");
            $stmt->bind_param("ss", $distributorId, $id);
            if ($stmt->execute()) {
                header("Location:../distributor/home.php");
            } else {
                echo "error";
            }
        }

        function pickToFinisherDistribute($id, $distributorId) {
            $stmt = $this->con->prepare("UPDATE customer_order SET state=4 WHERE seller_id=? AND id LIKE ?");
            $stmt->bind_param("ss", $distributorId, $id);
            if ($stmt->execute()) {
                header("Location:../distributor/home.php");
            } else {
                echo "error";
            }
        }

        function idOrderInProsserDistribute($distributorId) {
            $stmt = $this->con->prepare("select * from customer_order WHERE seller_id LIKE $distributorId AND state  LIKE 3");
            $stmt->execute();
            $stmt->store_result();

            return $stmt->num_rows > 0;
        }


        function getActiveOrderDistribute($distributorId) {

            $stmt = $this->con->prepare("SELECT id,name,no,adress FROM customer_order WHERE state LIKE 3 AND seller_id LIKE ?");
            $stmt->bind_param("s", $distributorId);

            if ($stmt->execute()) {
                $stmt->bind_result($id, $name, $no, $adress);
                //echo $id;
                $stmt->store_result();
                $temp = array();
                while ($stmt->fetch()) {
                    $temp['id'] = $id;
                    $temp['name'] = $name;
                    $temp['no'] = $no;
                    $temp['adress'] = $adress;

                    return $temp;
                }
            }

            return -1;
        }

        function getFinishedOrderByIdDistribute($distributorId) {

            $stmt = $this->con->prepare("SELECT name,no,adress FROM customer_order WHERE state=4 AND seller_id LIKE ?");

            $stmt->bind_param("s", $distributorId);
            $stmt->execute();
            $stmt->bind_result($name, $no, $adress);
            $orders = array();

            while ($stmt->fetch()) {

                $temp = array();
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['adress'] = $adress;
                array_push($orders, $temp);
            }

            return $orders;
        }

        function getOrderByUserId($id) {
            $stmt = $this->con->prepare("SELECT name,no,price FROM customer_order WHERE customer_id LIKE ?");

            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->bind_result($name, $no, $price);
            $orders = array();

            while ($stmt->fetch()) {

                $temp = array();
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['price'] = $price;
                array_push($orders, $temp);
            }

            return $orders;
        }

        function getUnFinishedOrderByUserId($id) {
            $stmt = $this->con->prepare("SELECT name,no,price FROM customer_order WHERE customer_id LIKE ? AND state !=4");

            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->bind_result($name, $no, $price);
            $orders = array();

            while ($stmt->fetch()) {

                $temp = array();
                $temp['name'] = $name;
                $temp['no'] = $no;
                $temp['price'] = $price;
                array_push($orders, $temp);
            }

            return $orders;
        }

        function countNewOrder() {
            $stmt = $this->con->prepare("SELECT count(*) FROM customer_order WHERE  state LIKE '0'");
            $stmt->execute();
            $stmt->bind_result($count);

            $stmt->fetch();

            return $count;
        }
        function countinCookOrder() {
            $stmt = $this->con->prepare("SELECT count(*) FROM customer_order WHERE  state LIKE '1'");
            $stmt->execute();
            $stmt->bind_result($count);

            $stmt->fetch();

            return $count;
        }
        function countInDeOrder() {
            $stmt = $this->con->prepare("SELECT count(*) FROM customer_order WHERE  state LIKE '3'");
            $stmt->execute();
            $stmt->bind_result($count);

            $stmt->fetch();

            return $count;
        }

    }
