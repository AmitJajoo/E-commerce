<?php
require_once("../../common_files/php/database.php");
$photo = "";
$image = "";
if($_FILES)
{
    $photo = $_FILES['photo'];
    $image=addslashes(file_get_contents($photo['tmp_name']));
}
$label = $_POST['text'];
$direction = $_POST['direction'];
$get_data = "SELECT * FROM category_showcase WHERE direction='$direction'";
$response = $db->query($get_data);
if($response)
{
    if($response->num_rows != 0)
    {
        if($photo !="")
        {
            $update = "UPDATE category_showcase SET image='$image',label='$label' WHERE direction='$direction'";
            $response_update=$db->query($update);
            if($response_update)
            {
                echo "success";
            }
            else{
                echo "can't update";
            }
        }
        else{
            $update = "UPDATE category_showcase SET label='$label' WHERE direction='$direction'";
            $response_update=$db->query($update);
            if($response_update)
            {
                echo "success";
            }
            else{
                echo "can't update";
            }
        }
    }
    else{
        $insert_value = "INSERT INTO category_showcase(image,label,direction)VALUES(
            '$image','$label','$direction'
        )";
        $response_insert = $db->query($insert_value);
        if($response_insert)
        {
            echo "success";
        }
        else
        {
           echo "can't insert";
        }
    }
}
else
{
    $create_table = "CREATE TABLE category_showcase(
        id INT(11) NOT NULL AUTO_INCREMENT,
        image MEDIUMBLOB,
        label VARCHAR(50),
        direction VARCHAR(50),
        PRIMARY KEY(id) 
    )";
    $respsone = $db->query($create_table);
    if($respsone)
    {
        $insert_value = "INSERT INTO category_showcase(image,label,direction)VALUES(
            '$image','$label','$direction'
        )";
        $response_insert = $db->query($insert_value);
        if($response_insert)
        {
            echo "success";
        }
        else
        {
           echo "can't insert";
        }
    }
    else{
        echo "can't create table";
    }
}
?>