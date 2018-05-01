<?php
    session_start();
    $id = 0;
    if (isset($_SESSION['user'])) {
        $id = $_SESSION['user'];
    }

    include '../db/FoodOpperation.php';

    if (isset($_POST['ingredientId'])) {

        $con = new FoodOpperation();
        if ($con->deleteIngredients($_POST['ingredientId'])) {
            echo '1';
        }
        exit;
    }

    if (isset($_POST['foodId'])) {

        echo $_POST['foodId'];
        $con = new FoodOpperation();
        if ($con->deleteFood($_POST['foodId'])) {
            echo '1';
        }
        exit;
    }

    if (isset($_POST['foodIdInMain'])) {
        $con = new FoodOpperation();
        $food = $con->getFoodById($_POST['foodIdInMain']);
        //var_dump($food);
        echo <<<DELIMITER
        
        <div class="cd-slider-wrapper">
            <ul class="cd-slider">
                <li class="selected"><img src="./admin/{$food[0]['image']}" alt="Product 1"></li>
    
            </ul> <!-- cd-slider -->

        </div> <!-- cd-slider-wrapper -->
        <div class="cd-item-info" >
        
            <p style="font-weight: bold; font-size: 30px; color: #761c19">{$food[0]['name']}</p>
            <p style="font-size: 20px;">{$food[0]['ingredients']}</p>

            <ul class="cd-item-action">
DELIMITER;
        if ($id > 0) {
            echo <<<AAA
                <a href="#0" class="cd-add-to-cart" data-img="./admin/{$food[0]['image']}"
                   data-name="{$food[0]['name']}" data-details="{$food[0]['ingredients']}"
                   data-price="{$food[0]['price']}">Add To Cart</a>
AAA;
        } else {
            ?>
            <a href="login.php" class="btn btn-danger btn-lg">Login First</a>
            <?php
        }
        echo "
            </ul > <!--cd-item - action-->
        </div >";


    }

    if (isset($_POST['pay'])) {
        $con = new FoodOpperation();

    }
