<?php
require_once("../../common_files/php/database.php");
$message="";
$c_name = $_GET['c_name'];
$title = $_POST['title'];
$brands = $_POST['brands'];
$dir="";
//get category
$get_category = "SELECT category_name FROM brands WHERE brands='$brands'";
$response = $db->query($get_category); 
if($response){
    $data = $response->fetch_assoc();
}
$description = $_POST['description'];
$price = $_POST['price'];
$quatity = $_POST['quatity'];
$select_data = "SELECT * FROM products";
$response_select_data = $db->query($select_data);


$all_files = [$_FILES['thumb'],$_FILES['front'],$_FILES['back'],$_FILES['left'],
                $_FILES['right']];
$length = count($all_files);
$file_path = ['thumb_pic','front_pic','back_pic','left_pic','right_pic'];
$check_dir = is_dir('../../stocks/'.$data['category_name'].'/'.$brands.'/'.$title);
if($check_dir)
{
    echo "Folder already exits";
}
else{
    $dir = mkdir('../../stocks/'.$data['category_name'].'/'.$brands.'/'.$title);
}



if($response_select_data){
    $store_data = "INSERT INTO products(category_name,title,brands,descriptions,price,quatity)
         VALUES('$c_name','$title','$brands','$description','$price','$quatity')";
        $response = $db->query($store_data);
        if($response)
        {
            $current_id = $db->insert_id;
            if($dir)
            {
                    for($i=0;$i<$length;$i++)
                    {
                        $file = $all_files[$i];
                        
                        $file_name=$file['name'];

                        $location = $file['tmp_name'];
                        $destination = "stocks/".$data["category_name"]."/".$brands."/".$title."/".$file_name;
                        if(move_uploaded_file($location,"../../".$destination))
                        {
                            $update_path = "UPDATE products SET $file_path[$i] = '$destination' WHERE id='$current_id'";
                            $response_update=$db->query($update_path);

                            if($response_update){
                                $message= "success";
                            }
                            else{
                                $message= "Unable to update";
                            }
                        }

                    }
                    echo $message;
            }
        }
        else{
            echo "Unable to insert";
        }
}
else{
    $create_table="CREATE TABLE products(
        id INT(11) NOT NULL AUTO_INCREMENT,
        category_name VARCHAR(500),
        title VARCHAR(500),
        brands VARCHAR(500),
        descriptions VARCHAR(15000),
        price FLOAT(20),
        quatity INT(11),
        thumb_pic VARCHAR(500) NULL,
        front_pic VARCHAR(500) NULL,
        back_pic VARCHAR(500) NULL,
        
        left_pic VARCHAR(500) NULL,
        right_pic VARCHAR(500) NULL,
        PRIMARY KEY(id)
    )";

    $response=$db->query($create_table);
    if($response){
        $store_data = "INSERT INTO products(category_name,title,brands,descriptions,price,quatity)
         VALUES('$c_name','$title','$brands','$description','$price','$quatity')";
        $response = $db->query($store_data);
        if($response){
            $current_id = $db->insert_id;
            if($dir)
            {
                    for($i=0;$i<$length;$i++)
                    {
                        $file = $all_files[$i];
                        
                        $file_name=$file['name'];

                        $location = $file['tmp_name'];
                        $destination = "stocks/".$data["category_name"]."/".$brands."/".$title."/".$file_name;
                        if(move_uploaded_file($location,"../../".$destination))
                        {
                            $update_path = "UPDATE products SET $file_path[$i] = '$destination' WHERE id='$current_id'";
                            $response=$db->query($update_path);

                            if($response){
                                $message="success";
                            }
                            else{
                                $message = "Unable to update";
                            }
                        }

                    }
                    echo $message;
            }
        }
        else{
            echo "Unable to insert";
        }
    }else{
        echo "Unable to create table";
    }
}


?>