<?php

    /**
     * Created by IntelliJ IDEA.
     * User: Ragul
     * Date: 7/15/2017
     * Time: 8:28 PM
     */
    class CookerOpperation {
        private $con;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        function getAllCooker() {
            $stmt = $this->con->prepare("SELECT * FROM cooker_details");
            $stmt->execute();
            $stmt->bind_result($id, $email, $password, $name);

            $cookers = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['email'] = $email;
                $temp['password'] = $password;
                $temp['name'] = $name;
                array_push($cookers, $temp);
            }

            return $cookers;
        }

        function deleteCooker($id) {
            $stmt = $this->con->prepare("DELETE FROM cooker_details WHERE id LIKE ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function editCooker($id, $email, $password, $name) {
            $stmt = $this->con->prepare("UPDATE cooker_details SET email=?, password=?, name=? WHERE id LIKE ?");
            $stmt->bind_param("ssss", $email, $password, $name, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function newCooker($email, $password, $name) {
            $stmt = $this->con->prepare("INSERT INTO cooker_details  (email, password, name) VALUE (?,?,?)");
            $stmt->bind_param("sss", $email, $password, $name);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function cookerAllow($email, $password) {
            $stmt = $this->con->prepare("SELECT id FROM cooker_details WHERE email LIKE ? AND password LIKE ?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->bind_result($id);

            if ($stmt->fetch()) {
                return $id;
            }

            return -1;
        }

        function getForChart() {
            $stmt = $this->con->prepare("SELECT cooker_details.name,count(cooker_details.name) AS count FROM cooker_details,customer_order WHERE cooker_details.id LIKE customer_order.cooker_id GROUP BY cooker_details.name");
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

        function resetPassword($id,$password) {

            $stmt = $this->con->prepare("UPDATE cooker_details SET password=? WHERE id LIKE ?");
            $stmt->bind_param("ssss",$id,$password);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }
    }