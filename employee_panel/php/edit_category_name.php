<?php
require_once("../../common_files/php/database.php");
$id  = $_POST['id'];
$change_name = $_POST['change_name'];

$update_data = "UPDATE category SET category_name = '$change_name' WHERE id = '$id' ";
$response = $db->query($update_data);

if($response)
{
    echo  "success";
}
else
{
    echo "Unable to change category name";
}

?>