<?php 
require_once("../../common_files/php/database.php");
$product_id = $_POST['product_id'];
$username = base64_decode($_COOKIE['_au_']);
$delete_product = "DELETE FROM cart WHERE product_id='$product_id' AND username='$username'";
$response  = $db->query($delete_product);
if($response){
    echo "success";
}
else{
    echo "can't delete";
}
?>