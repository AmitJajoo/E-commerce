<?php

require_once("../../common_files/php/database.php");
$product_id = $_POST['product_id'];
$product_title = $_POST['product_title'];
$product_brand = $_POST['product_brand'];
$product_price= $_POST['product_price'];
$product_pic = $_POST['product_pic'];
$username = base64_decode($_COOKIE['_au_']);
$get_data = "SELECT * FROM cart WHERE product_id='$product_id' AND username='$username'";
$response_get_data = $db->query($get_data);
if($response_get_data)
{
    if($response_get_data->num_rows == 0)
    {
        $insert_table = "INSERT INTO cart(product_id,product_title,product_brand,
        product_price,product_pic,username)VALUES('$product_id','$product_title','$product_brand',
        '$product_price','$product_pic','$username')";
        $response_insert_table = $db->query($insert_table);
        if($response_insert_table)
        {
            echo "success";
        }
        else
        {
            echo "Can't create table";
        }
    }
    else{
        echo "Product already exit in cart";
    }
}
else
{
    $create_table = "CREATE TABLE cart(
        id INT(11) NOT NULL AUTO_INCREMENT,
        product_id INT(11),
        product_title VARCHAR(500),
        product_brand VARCHAR(200),
        product_price FLOAT(20),
        product_pic VARCHAR(500),
        username VARCHAR(500),
        PRIMARY KEY(id)
    )";
    $response_create_table = $db->query($create_table);
    if($response_get_data)
    {
        $insert_table = "INSERT INTO cart(product_id,product_title,product_brand,
        product_price,product_pic,username)VALUES('$product_id','$product_title','$product_brand',
        '$product_price','$product_pic','$username')";
        $response_insert_table = $db->query($insert_table);
        if($response_insert_table)
        {
            echo "success";
        }
        else
        {
            echo "Can't create table";
        }
    }
    else{
        echo "Can't create table";
    }
}
?>