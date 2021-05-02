<?php
require_once("../../common_files/database/database.php");
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];
$days = $_POST['days'];
$payment_mode = $_POST['payment-mode'];
$get_table = "SELECT * FROM delivery_location";
$response= $db->query($get_table);
if($response){
    $insert_data = "INSERT INTO delivery_location(country,state,city,pincode,days,payment_mode)
        VALUES('$country','$state','$city','$pincode','$days','$payment_mode')";
        $response_insert = $db->query($insert_data);
        if($response_insert)
        {
            echo "success";
        }
        else{
            echo "can't insert into table";
        }
}
else{
    $create_table = "CREATE TABLE delivery_location(
        id INT(11) NOT NULL AUTO_INCREMENT,
        country VARCHAR(100),
        state VARCHAR(100),
        city VARCHAR(100),
        pincode VARCHAR(100),
        days VARCHAR(100),
        payment_mode VARCHAR(100),
        PRIMARY KEY(id)
    )";
    $response= $db->query($create_table);
    if($response){
        $insert_data = "INSERT INTO delivery_location(country,state,city,pincode,days,payment_mode)
        VALUES('$country','$state','$city','$pincode','$days','$payment_mode')";
        $response_insert = $db->query($insert_data);
        if($response_insert)
        {
            echo "success";
        }
        else{
            echo "can't insert into table";
        }
    }
    else{
        echo  "Unable to create table";
    }
}
?>