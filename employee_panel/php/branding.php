<?php
require_once("../../common_files/php/database.php");
$brand = $_POST['brand_name'];
$file = $_FILES['logo'];
$location="";
$logo="";

if($file['name']==""){
    $location="";
    $logo="";
}
else{
    $location = $file['tmp_name'];
    $logo = addslashes(file_get_contents($location));
}

$email = $_POST['email'];
$domain = $_POST['domain'];
$facebook_url = $_POST['facebook-url'];
$twitter_url = $_POST['twitter-url'];
$address = addslashes($_POST['address']);
$phone = $_POST['phone'];
$about_us = addslashes($_POST['about-us']);
$privacy = addslashes($_POST['privacy']);
$cookies = addslashes($_POST['cookies']);
$terms = addslashes($_POST['terms']);

$check_branding_table = "SELECT * FROM branding";
$resposne_create_table = $db->query($check_branding_table);

if($resposne_create_table){
    if($logo == ""){
        $update = "UPDATE branding SET brand_name='$brand',domain_name='$domain',email='$email',facebook_url='$facebook_url',twitter_url='$twitter_url',addres='$address',phone='$phone',about_us='$about_us',privacy_policy='$privacy',cookies_policy='$cookies',terms_policy='$terms'";
        $response_update = $db->query($update);
    if($response_update)
    {
        echo "Edit Success";
    }
    else{
        echo "edit failed";
    }
    }
    else{
        $update = "UPDATE branding SET brand_name='$brand',brand_logo='$logo',domain_name='$domain',email='$email',facebook_url='$facebook_url',twitter_url='$twitter_url',addres='$address',phone='$phone',about_us='$about_us',privacy_policy='$privacy',cookies_policy='$cookies',terms_policy='$terms'";
        $response_update = $db->query($update);
        if($response_update)
        {
            echo "Edit Success";
        }
        else{
        echo "edit failed";
        }
    }
}
else{
    $create_table="CREATE TABLE branding(
        id INT(11) NOT NULL AUTO_INCREMENT,
        brand_name VARCHAR(100),
        brand_logo MEDIUMBLOB,
        domain_name VARCHAR(500),
        email VARCHAR(500),
        facebook_url VARCHAR(500),
        twitter_url VARCHAR(500),
        addres VARCHAR(100),
        phone VARCHAR(50),
        about_us MEDIUMTEXT,
        privacy_policy MEDIUMTEXT,
        cookies_policy MEDIUMTEXT,
        terms_policy MEDIUMTEXT,
        PRIMARY KEY(id)
    )";
    $resposne = $db->query($create_table);
    if($resposne)
    {
        $store_data = "INSERT INTO branding(brand_name,brand_logo,domain_name,email,facebook_url,twitter_url,addres,phone,about_us,privacy_policy,cookies_policy,terms_policy)VALUES('$brand','$logo','$domain','$email','$facebook_url','$twitter_url','$address','$phone','$about_us','$privacy','$cookies','$terms')";

        $response = $db->query($store_data);
        if($resposne)
        {
            echo "success satu";
        }
        else{
            echo "can't insert details in table";
        }
    }
    else{
        echo "table not created";
    }
}

// ,brand_logo,domain_name,email,
//         facebook_url,twitter_url,addres,phone,about_us,privacy_policy,cookies_policy,
//         terms_policy
// ,'$logo','$domain','$email','$facebook_url',
//         '$twitter_url','$address','$phone',$about_us,'$privacy','$cookies','$terms'
?>
