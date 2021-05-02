<?php
require_once("../../common_files/php/database.php");
$c_name = $_POST['cat_name'];
$brand = $_POST['brand'];
if($brand != 'all')
{
    $get_product = "SELECT * FROM products WHERE category_name='$c_name' AND brands='$brand'";
    $response = $db->query($get_product);
    $all_data=[];
    if($response)
    {
        while($data = $response->fetch_assoc()){
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    else{
        echo "No product is available";
    }
}
else{
    $get_product = "SELECT * FROM products WHERE category_name='$c_name'";
    $response = $db->query($get_product);
    $all_data=[];
    if($response)
    {
        while($data = $response->fetch_assoc()){
            array_push($all_data,$data);
        }
        echo json_encode($all_data);
    }
    else{
        echo "No product is available";
    }
}
?>