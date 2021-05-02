<?php 
require_once("../../common_files/database/database.php");
$pincode = $_POST['pincode'];
$get_delivery = "SELECT * FROM delivery_location WHERE pincode='$pincode'";
$response = $db->query($get_delivery);
if($response->num_rows != 0)
{
    $data = $response->fetch_assoc();
    echo $data['days'];
}
else{
    echo "Whoops ! delivery not available";
}
?>