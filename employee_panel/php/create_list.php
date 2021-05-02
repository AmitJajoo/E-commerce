<?php
require_once("../../common_files/php/database.php");
$get_cateogry = "SELECT * FROM category";
$response = $db->query($get_cateogry);
$category_list=[];
if($response)
{
    while($data = $response->fetch_assoc())
    {
        array_push($category_list,$data);
    }
    echo json_encode($category_list);
}
else{
    echo "<b>No category found!</b>";
}

?>