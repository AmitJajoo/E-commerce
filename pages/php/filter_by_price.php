<?php
require_once("../../common_files/database/database.php");
$min_price = $_POST['min_price'];
$max_price  = $_POST['max_price'];
$c_name = $_POST['c_name'];
$get_data = "SELECT * FROM products WHERE category_name='$c_name' AND price BETWEEN 
$min_price AND $max_price ";
$response = $db->query($get_data);
$all_data=[];
if($response){
    while($data = $response->fetch_assoc())
    {
        array_push($all_data,$data);
    }
    echo json_encode($all_data);
}
?>
