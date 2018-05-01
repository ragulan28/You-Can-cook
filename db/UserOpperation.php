<?php
    /**
     * Created by IntelliJ IDEA.
     * User: Ragul
     * Date: 7/22/2017
     * Time: 7:15 PM
     */

    class UserOpperation {
        private $con;

        function __construct() {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        function checkValideUser($userName, $password) {

            $result = $this->con->query("select * from customer WHERE email LIKE  '$userName' AND password LIKE '$password'");
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();

                return $row['customer_id'];

            } else {
                return -1;
            }
        }

        function newUser($email, $password, $name) {
            $stmt = $this->con->prepare("INSERT INTO customer  (email, password, name) VALUE (?,?,?)");
            $stmt->bind_param("sss", $email, $password, $name);
            $stmt->execute();

            return $this->checkValideUser($email, $password);
        }

        function getUserDataById($id) {
            $stmt = $this->con->prepare("SELECT name,email FROM customer WHERE customer_id LIKE ?");

            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->bind_result($name, $email);
            $c = array();

            while ($stmt->fetch()) {
                $c['name'] = $name;
                $c['email'] = $email;
            }

            return $c;
        }

        function resetPassword($id,$password){
            $stmt = $this->con->prepare("UPDATE customer SET password=? WHERE customer_id LIKE ?");
            $stmt->bind_param("ss", $password, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function editEmail($id,$email,$name){
            $stmt = $this->con->prepare("UPDATE customer SET email=? , name=? WHERE customer_id LIKE ?");
            $stmt->bind_param("sss", $email, $name,$id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }


        function getUserDataByEmail($email) {
            $stmt = $this->con->prepare("SELECT customer_id,name,email FROM customer WHERE email LIKE ?");

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id,$name, $emails);
            $c = array();

            $c['name'] = -1;
            $c['id'] = -1;
            $c['email'] = -1;
            $c['valide']=-1;
            //echo count($c['name']);
            echo ("<br>");
            while ($stmt->fetch()) {
                $c['name'] = $name;
                $c['id'] = $id;
                $c['email'] = $emails;

                break;
            }
            echo $c['name'];
            if ($c['name']!=-1){
                $c['valide']=1;

            }
//echo count($c['name']);
            return $c;

        }


        function deleteUser($id){
            $stmt = $this->con->prepare("delete from customer WHERE customer_id like ?");
            $stmt->bind_param("s",$id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }
    }