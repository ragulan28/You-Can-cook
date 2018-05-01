<?php

class DbOperation
{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();

    }

    //Method to create a new user
    function registerUser($name, $email, $company, $phone,$password)
    {
        if (!$this->isUserExist($email)) {
            $password = md5($password);
            $stmt = $this->con->prepare("INSERT INTO users (name, email, company, phone,password) VALUES (?, ?, ?, ?,?)");
            $stmt->bind_param("sssss", $name, $email, $company, $phone,$password);
            if ($stmt->execute())
                return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }
    //Method to update a new user
    function updateUser($name, $email, $company, $phone,$keymail)
    {
        
        if (!$this->isUserExist($email)||$keymail==$email) {

            $stmt = $this->con->prepare("UPDATE users SET name=?, email=?, company=?, phone=? where email like ?");
            $stmt->bind_param("sssss", $name, $email, $company, $phone,$keymail);

            if ($stmt->execute())
                return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }
    //above update still testing KK
    
    //Method to change pass
    function changePass($email,$password,$newpassword)
    {
        if ($this->isUserExist($email)) {
            $password = md5($password);
            $newpassword = md5($newpassword);
            $stmt = $this->con->prepare("UPDATE users SET password=? where email like ? and password like ?");
            $stmt->bind_param("sss",  $newpassword,$email,$password);
            $stmt->execute();
           
            if ($stmt ->affected_rows>0)
                    return USER_CREATED;
            return USER_CREATION_FAILED;
        }
        return USER_EXIST;
    }
    //keka
    
    
    
    //Method to check if email already exist
    function isUserExist($email)
    {
        $stmt = $this->con->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    //Method to get user by email
    function getUserByEmail($email)
    {
        $stmt = $this->con->prepare("SELECT  name, email, company,phone FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result( $name, $email,$company, $phone);
        $stmt->fetch();
        $user = array();
        $user['company'] = $company;
        $user['name'] = $name;
        $user['email'] = $email;
        $user['phone'] = $phone;
        return $user;
    }
    //Method for user login
    function userLogin($email, $password)
    {
        $password = md5($password);
        $stmt = $this->con->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    //Method to get all areas
    function getAllArea(){
        $stmt = $this->con->prepare("SELECT area FROM areas");
        $stmt->execute();
        $stmt->bind_result($area);
        $areas = array();
        while($stmt->fetch()){
            $temp = array();
            $temp['area'] = $area;

            array_push($areas, $temp);
        }
        return $areas;
    }
    //Method to get subarea by area
    function getsubarea($area)
    {
        $stmt = $this->con->prepare("SELECT subarea FROM subareas s inner join areas a on s.areacode=a.areacode where a.area like ?");
        $stmt->bind_param("s", $area);
        $stmt->execute();
        $stmt->bind_result($subarea);

        $subareas = array();
        while($stmt->fetch()) {
            $temp = array();
            $temp['subarea'] = $subarea;

            array_push($subareas, $temp);
        }
        return $subareas;
    }
    //Method to get subarea by area
    function getPrice($subcode)
    {
        $stmt = $this->con->prepare("SELECT HARUALTAESGE,TOLL,FAF,DGC from subareas where subcode like ?");
        $stmt->bind_param("s", $subcode);
        $stmt->execute();
        $stmt->bind_result($HARUALTAESGE,$TOLL,$FAF,$DGC);

        $price = array();
        while($stmt->fetch()) {
            $temp = array();
            $temp['HARUALTAESGE'] = $HARUALTAESGE;
            $temp['TOLL'] = $TOLL;
            $temp['FAF'] = $FAF;
            $temp['DGC'] = $DGC;
            array_push($price, $temp);
        }
        return $price;
    }
    //price by subname
    function getsPrice($subname)
    {
        $stmt = $this->con->prepare("SELECT HARUALTAESGE,TOLL,FAF,DGC from subareas where subarea like ?");
        $stmt->bind_param("s", $subname);
        $stmt->execute();
        $stmt->bind_result($HARUALTAESGE,$TOLL,$FAF,$DGC);

        $price = array();
        while($stmt->fetch()) {
            $temp = array();
            $temp['HARUALTAESGE'] = $HARUALTAESGE;
            $temp['TOLL'] = $TOLL;
            $temp['FAF'] = $FAF;
            $temp['DGC'] = $DGC;
            array_push($price, $temp);
        }
        return $price;
    }

}
