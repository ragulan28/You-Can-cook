<?php
    session_start();
    $id = 0;
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
    }
    include '../db/UserOpperation.php';
    $con = new UserOpperation();

    if (isset($_POST['userLogin'])) {
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $_SESSION['user'] = $con->checkValideUser($userName, $password);
        //echo $_SESSION['adminUser'];
        if ($_SESSION['user'] != -1) {
            header("Location:../home.php");
        } else {
            header("Location:../login.php");
        }

    }

    if (isset($_POST['newUser'])) {
        $email = $_POST['email'];
        $password = $_POST['pass_confirmation'];
        $name = $_POST['name'];
        //echo $email;

        $_SESSION['user'] = $con->newUser($email, $password, $name);
        echo $_SESSION['user'];
        if ($_SESSION['user'] != -1) {
            header("Location:../home.php");
        } else {
            header("Location:../login.php");
        }

    }

    if (isset($_POST['reset'])) {
        $password = $_POST['password'];
        if ($con->resetPassword($id, $password)) {
            header("Location:../profile.php");
        } else {
            echo "Error";
        }

    }

    if (isset($_POST['editUser'])) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        if ($con->editEmail($id, $email, $name)) {
            header("Location:../profile.php");
        } else {
            echo "Error";
        }

    }

    if (isset($_POST['search'])) {
        $email = $_POST['email'];
        $result = $con->getUserDataByEmail($email);
        if (isset($result)) {
            $_SESSION['searchUser'] = $result['valide'];
            $_SESSION['searchUserName'] = $result['name'];
            $_SESSION['searchUserId'] = $result['id'];
        }
        echo $_SESSION['searchUser'];
        header("Location:../admin/home.php");
    }
    if (isset($_GET['deleteUser'])) {
        $deleteUser = $_SESSION['searchUser']['id'];
        if ($con->deleteUser($deleteUser)) {
            $_SESSION['searchUser'] = 0;
        }
        $_SESSION['searchUser'] = 0;
        $_SESSION['searchUserName'] = 0;
        $_SESSION['searchUserId'] = 0;
        header("Location:../admin/home.php");
    }

?>