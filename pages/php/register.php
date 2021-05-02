<?php
require_once("../../common_files/database/database.php");
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$password = md5($_POST['password']);
$address = $_POST['address'];
$state=$_POST['state'];
$country=$_POST['country'];
$pincode=$_POST['pincode'];
$check_user = "SELECT * FROM users";
$response = $db->query($check_user);
if($response){
    $insert_users= "INSERT INTO users(firstname,lastname,email,mobile,password,
    address,state,country,pincode)VALUES('$firstname','$lastname','$email','$mobile',
    '$password','$address','$state','$country','$pincode')";
        $response_insert_users = $db->query($insert_users);
        if($response_insert_users){
            session_start();
            $random = "0123456789";
            $length = strlen($random)-1;
            $otp = [];
            $i;
            for($i=0;$i<6;$i++){
                $indexing_number=rand(0,$length);
                $otp[] = $random[$indexing_number];
            }
            $otp = implode($otp);
            $_SESSION['otp']=$otp;
            if(mail($email,"Welcome to Shop","Your OTP is ".$otp))
            {
                echo "success";
            }else{
                echo "Can't send verification code";
            }
        }
        else{
            echo "can't insert";
        }
}
else{
    $create_table_user = "CREATE TABLE users(
        id INT(11) NOT NULL AUTO_INCREMENT,
        firstname VARCHAR(255),
        lastname VARCHAR(255),
        email VARCHAR(500),
        mobile VARCHAR(20),
        password VARCHAR(500),
        address VARCHAR(500),
        state VARCHAR(80),
        country VARCHAR(100),
        pincode INT(11),
        status VARCHAR(20) DEFAULT 'pending',
        currentTime DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY(id)
    )";
    $response=$db->query($create_table_user);
    if($response){
        $insert_users= "INSERT INTO users(firstname,lastname,email,mobile,password,
        address,state,country,pincode)VALUES('$firstname','$lastname','$email','$mobile',
        '$password','$address','$state','$country','$pincode')";
        $response_insert_users = $db->query($insert_users);
        if($response_insert_users){
            session_start();
            $random = "0123456789";
            $length = strlen($random)-1;
            $otp = [];
            $i;
            for($i=0;$i<6;$i++){
                $indexing_number=rand(0,$length);
                $otp[] = $random[$indexing_number];
            }
            $otp = implode($otp);
            $_SESSION['otp']=$otp;
            if(mail($email,"Welcome to Shop","Your OTP is ".$otp))
            {
                echo "success";
            }else{
                echo "Can't send verification code";
            }
        }
        else{
            echo "can't insert";
        }
    }
    else{
        echo "Can't create table";
    }
}
?>