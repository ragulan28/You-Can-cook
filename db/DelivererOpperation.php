<?php

    /**
     * Created by IntelliJ IDEA.
     * User: Ragul
     * Date: 7/15/2017
     * Time: 8:28 PM
     */
    class DelivererOpperation {
        private $con;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        function getAllDeliverer() {
            $stmt = $this->con->prepare("SELECT * FROM seller_details");
            $stmt->execute();
            $stmt->bind_result($id, $email, $password, $name);

            $deliverers = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['email'] = $email;
                $temp['password'] = $password;
                $temp['name'] = $name;
                array_push($deliverers, $temp);
            }

            return $deliverers;
        }

        function deleteDeliverer($id) {
            $stmt = $this->con->prepare("DELETE FROM seller_details WHERE id LIKE ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function editDeliverer($id, $email, $password, $name) {
            $stmt = $this->con->prepare("UPDATE seller_details SET email=?, password=?, name=? WHERE id LIKE ?");
            $stmt->bind_param("ssss", $email, $password, $name, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function newDeliverer($email, $password, $name) {
            $stmt = $this->con->prepare("INSERT INTO seller_details  (email, password, name) VALUE (?,?,?)");
            $stmt->bind_param("sss", $email, $password, $name);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function distributorAllow($email, $password) {
            $stmt = $this->con->prepare("SELECT id FROM seller_details WHERE email LIKE ? AND password LIKE ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->bind_result($id);

            if ($stmt->fetch()) {
                return $id;
            }

            return -1;
        }

        function getForChart() {
            $stmt = $this->con->prepare("SELECT seller_details.name,count(seller_details.name) AS count FROM seller_details,customer_order WHERE seller_details.id LIKE customer_order.seller_id GROUP BY seller_details.name");
            $stmt->execute();
            $stmt->bind_result($name, $count);

            $cookers = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['name'] = $name;
                $temp['count'] = $count;
                array_push($cookers, $temp);
            }

            return $cookers;
        }
    }