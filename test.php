<?php

    include 'db/UserOpperation.php';
    $con = new UserOpperation();
    $cookersGraph = $con->getUserDataByEmail("Ragulan28@gmail.coma");
    $_SESSION['s']=$cookersGraph['name'];
    if (isset($cookersGraph)) {
        if ($cookersGraph>0){
            echo  $_SESSION['s'];
        }else{
            echo "aaaa";
        }
    } else  {  var_dump($cookersGraph);
    }
?>