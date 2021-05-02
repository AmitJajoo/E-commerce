<?php
require_once("../../common_files/database/database.php");
$country_id=$_POST['country_id'];
$get_state = "SELECT * FROM states WHERE country_id='$country_id'";
$response = $db->query($get_state);
$state=[];
if($response)
{
    while($data=$response->fetch_assoc())
    {
        array_push($state,$data);
    }
    echo  json_encode($state);
}
?>