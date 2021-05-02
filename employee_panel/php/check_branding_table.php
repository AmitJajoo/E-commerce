<?php
require_once("../../common_files/php/database.php");

$check_table = "SELECT id,brand_name,domain_name,email,facebook_url,twitter_url,addres,phone,about_us,privacy_policy,cookies_policy,terms_policy FROM branding";
$response_check_table = $db->query($check_table);
$all_files = [];
if($response_check_table){
    $data=$response_check_table->fetch_assoc();
    array_push($all_files,$data);
    echo json_encode($all_files);
}

?>