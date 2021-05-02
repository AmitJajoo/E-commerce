<?php
require_once("../../common_files/php/database.php");
$cat_name = $_POST['cat_name'];
$get_data  = "SELECT * FROM brands WHERE category_name='$cat_name'";
$response = $db->query($get_data);
$result=[];
if($response->num_rows != 0){
while($data=$response->fetch_assoc()){
    array_push($result,$data);
}
echo json_encode($result);
}else{
    echo "<b>No brands has been created yet in this category</b>";
}
?>