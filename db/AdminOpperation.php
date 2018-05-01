<?php


    class AdminOpperation
    {

        private $con;

        function __construct()
        {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        function checkValideAdmin($userName, $password){

            $result = $this->con->query("select * from admin_details WHERE email LIKE  '$userName' AND password LIKE '$password'");
            if ($result->num_rows > 0) {
                // output data of each row
                $row = $result->fetch_assoc();

                return $row['id'];

            } else {
                return -1;
            }
        }
    }