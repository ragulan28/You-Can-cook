<?php include '../../db/CookerOpperation.php';
    $con = new CookerOpperation();
    $id = $email = $password = $name = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['update'])) {
            if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) {
                $id = $_POST['id'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $name = $_POST['name'];
                //echo $id,$email,$password,$name;
                $con->editCooker($id, $email, $password, $name);
                header("Location:../home.php");
            }
        }

        if (isset($_POST['newCooker'])) {

            if (isset($_POST['newemail']) && isset($_POST['newpassword']) && isset($_POST['newname'])) {

                $email = $_POST['newemail'];
                $password = $_POST['newpassword'];
                $name = $_POST['newname'];
                //echo $email,$password,$name;
                $con->newCooker($email, $password, $name);
                header("Location:../home.php");
            }
        }
    }