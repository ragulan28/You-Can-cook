<?php

    /**
     * Created by IntelliJ IDEA.
     * User: Ragul
     * Date: 7/15/2017
     * Time: 8:28 PM
     */
    class FoodOpperation
    {
        private $con;

        function __construct()
        {
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();

        }

        ////////Ingredients/////////////
        function getAllIngredients()
        {
            $stmt = $this->con->prepare("SELECT * FROM ingredients");
            $stmt->execute();
            $stmt->bind_result($id, $name, $icon, $image, $price);

            $ingredients = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['icon'] = $icon;
                $temp['image'] = $image;
                $temp['price'] = $price;
                array_push($ingredients, $temp);
            }

            return $ingredients;
        }

        function deleteIngredients($id)
        {
            $stmt = $this->con->prepare("DELETE FROM ingredients WHERE id LIKE ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function editIngredients($id, $name, $price)
        {
            $stmt = $this->con->prepare("UPDATE ingredients SET name=?, price=? WHERE id LIKE ?");
            $stmt->bind_param("sss", $name, $price, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function newIngredients($name, $image, $details, $price)
        {
            $stmt = $this->con->prepare("INSERT INTO ingredients  (name, icon, image, price) VALUE (?,?,?,?)");
            $stmt->bind_param("ssss", $name, $image, $details, $price);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        /////////////////////   Food   ///////////////////////////

        function getAllFood()
        {
            $stmt = $this->con->prepare("SELECT * FROM mainfood");
            $stmt->execute();
            $stmt->bind_result($id, $name, $image, $ingredients, $price);

            $foods = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['image'] = $image;
                $temp['price'] = $price;
                array_push($foods, $temp);
            }

            return $foods;
        }

        function getFoodById($id)
        {
            $stmt = $this->con->prepare("SELECT * FROM mainfood WHERE id LIKE '$id'");
            $stmt->execute();
            $stmt->bind_result($id, $name, $image, $ingredients, $price);

            $foods = array();
            while ($stmt->fetch()) {
                $temp = array();
                $temp['id'] = $id;
                $temp['name'] = $name;
                $temp['image'] = $image;
                $temp['price'] = $price;
                $temp['ingredients'] = $ingredients;
                array_push($foods, $temp);
            }

            return $foods;
        }

        function deleteFood($id)
        {
            $stmt = $this->con->prepare("DELETE FROM mainfood WHERE id LIKE ?");
            $stmt->bind_param("s", $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }

        function editFood($id, $name, $price)
        {
            $stmt = $this->con->prepare("UPDATE mainfood SET name=?, price=? WHERE id LIKE ?");
            $stmt->bind_param("sss", $name, $price, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function newFood($name, $image, $ingredients, $price)
        {
            $stmt = $this->con->prepare("INSERT INTO mainfood  (name, image, ingredients, price) VALUE (?,?,?,?)");
            $stmt->bind_param("ssss", $name, $image, $ingredients, $price);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;


        }

        function addNewOrder($customer_id, $no, $price, $adress, $details)
        {
            $stmt = $this->con->prepare("INSERT INTO customer_order (customer_id, no, price, adress, details) VALUE (?,?,?,?,?)");
            $stmt->bind_param("sssss", $customer_id, $no, $price, $adress, $details);
            $stmt->execute();
            if ($stmt->affected_rows > 0)
                return true;

            return false;
        }
    }