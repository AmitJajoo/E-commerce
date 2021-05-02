<?php
require_once("../../common_files/php/database.php");
$c_name = $_POST['c_name'];
$b_name = $_POST['b_name'];

$delete_rows = "DELETE brands FROM brands WHERE category_name='$c_name' AND brands='$b_name'";
$response = $db->query($delete_rows);
if($response){
    echo "Delete success";
}
else{
    echo "Unable to delete";
}
?>