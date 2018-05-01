<?php include '../../db/FoodOpperation.php';
    session_start();
    $con = new FoodOpperation();
    $id = $name = $image = $price = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /////// Ingredient //////////////
        if (isset($_POST['updateIngredient'])) {

            if (isset($_POST['priceIngredient']) && isset($_POST['nameIngredient'])) {

                $id = $_POST['idIngredient'];

                $price = $_POST['priceIngredient'];
                $name = $_POST['nameIngredient'];
                //echo $id,$email,$password,$name;
                $con->editIngredients($id, $name, $price);

            }
        }

        if (isset($_POST['newIngredient'])) {
            if (isset($_POST['newPriceIngredient']) && isset($_POST['newNameIngredient'])) {

                $image = "foods/ingredients/" . basename($_FILES['imageIngredient']['name']);
                $imageIcon = "foods/ingredients/icon/" . basename($_FILES['imageIconIngredient']['name']);
                $name = $_POST['newNameIngredient'];
                $price = $_POST['newPriceIngredient'];

                if ($con->newIngredients($name, $imageIcon, $image, $price)) {

                    if (move_uploaded_file($_FILES['imageIngredient']['tmp_name'],("../".$image)) && move_uploaded_file($_FILES['imageIconIngredient']['tmp_name'], ("../".$imageIcon))) {
                        //header("Location:food.php");

                    }
                }
            }
        }

        ///////////// food //////////////

        if (isset($_POST['updateFood'])) {

            if (isset($_POST['priceFood']) && isset($_POST['nameFood'])) {

                $id = $_POST['idFood'];

                $price = $_POST['priceFood'];
                $name = $_POST['nameFood'];
                //echo $id,$email,$password,$name;
                $con->editFood($id, $name, $price);

            }
        }

        if (isset($_POST['newFood'])) {

            if (isset($_POST['newFoodPrice']) && isset($_POST['newFoodName'])) {


                $details = $_POST['newFoodDetails'];
                $image = "foods/food/" . basename($_FILES['newImageFood']['name']);
                $name = $_POST['newFoodName'];
                $price = $_POST['newFoodPrice'];

                if ($con->newFood($name, $image, $details, $price)) {

                    if (move_uploaded_file($_FILES['newImageFood']['tmp_name'], ("../".$image))) {


                    }
                }
            }
        }
        header("Location:../home.php");

    }
