<?php include '../../db/DelivererOpperation.php';
    $con = new DelivererOpperation();
    $id = $email = $password = $name = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['update'])) {
            if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])) {
                $id = $_POST['id'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $name = $_POST['name'];
                //echo $id,$email,$password,$name;
                $con->editDeliverer($id, $email, $password, $name);
                header("Location:../home.php");
            }
        }

        if (isset($_POST['newDis'])) {

            if (isset($_POST['newemailDis']) && isset($_POST['newpasswordDis']) && isset($_POST['newnameDis'])) {

                $email = $_POST['newemailDis'];
                $password = $_POST['newpasswordDis'];
                $name = $_POST['newnameDis'];
                //echo $email,$password,$name;
                $con->newDeliverer($email, $password, $name);
                header("Location:../home.php");
            }
        }
    }