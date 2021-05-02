<?php
require_once("../../common_files/php/database.php");
$file="";
$file_binary="";
if($_FILES){
    $file=$_FILES['file_data'];
    $file_binary=addslashes(file_get_contents($file['tmp_name']));
}


$json_data  = json_encode($_POST['css_data']);
$tmp_data  = json_decode($json_data,true);
$all_data = json_decode($tmp_data,true);

$options =$all_data['options'];
$title_font = $all_data['title_font'];
$title_color = $all_data['title_color'];
$subtitle_font = $all_data['subtitle_font'];
$subtitle_color = $all_data['subtitle_color'];
$h_align = $all_data['h_align'];
$v_align = $all_data['v_align'];
$title_text = addslashes($all_data['title_text']);
$subtitle_text = addslashes($all_data['subtitle_text']);
$button = addslashes($all_data['button']);

$check_table = "SELECT count(id) AS result FROM header_showcase";
$response_check_table = $db->query($check_table);

if($response_check_table)
{
    $data = $response_check_table->fetch_assoc();
    $result = $data['result'];
    if($result<3)
    {
        if($options == "Choose Title")
        {
            $store_data="INSERT INTO header_showcase(title_image,title_font,title_color,
            title_text,subtitle_font,subtitle_color,subtitle_text,h_align,v_align,button)VALUES(
            '$file_binary','$title_font','$title_color','$title_text','$subtitle_font',
            '$subtitle_color','$subtitle_text','$h_align','$v_align','$button')";
            $response_store_data = $db->query($store_data);
            if($response_store_data){
                echo "success";
            }
            else{
                echo "failed to insert in database";
            }
        }
        else
        {
            if($file == "")
            {
                $update_data = "UPDATE header_showcase SET title_font='$title_font',
                title_color='$title_color',title_text='$title_text',subtitle_font='$subtitle_font',
                subtitle_color='$subtitle_color',subtitle_text='$subtitle_text',h_align='$h_align',
                v_align='$v_align',button='$button' WHERE id='$options'";
                $response_update_data=$db->query($update_data);
                if($response_update_data)
                {
                    echo "edit success";
                }
                else
                {
                    echo "edit failed";
                }
            }
            else
            {
                $update_data = "UPDATE  header_showcase SET title_image='$file_binary',
                title_font='$title_font',title_color='$title_color',title_text='$title_text',subtitle_font='$subtitle_font',
                subtitle_color='$subtitle_color',subtitle_text='$subtitle_text',h_align='$h_align',
                v_align='$v_align',button='$button' WHERE id='$options'";
                $response_update_data=$db->query($update_data);
                if($response_update_data)
                {
                    echo "edit success";
                }
                else
                {
                    echo "edit failed";
                }
            }
        }
    }
    else if($result>=3){
        if($options == "Choose Title")
        {
        echo "You can add 3 photos only";
        }
        else
        {
            if($file == "")
            {
                $update_data = "UPDATE header_showcase SET title_font='$title_font',
                title_color='$title_color',title_text='$title_text',subtitle_font='$subtitle_font',
                subtitle_color='$subtitle_color',subtitle_text='$subtitle_text',h_align='$h_align',
                v_align='$v_align',button='$button' WHERE id='$options'";
                $response_update_data=$db->query($update_data);
                if($response_update_data)
                {
                    echo "edit success";
                }
                else
                {
                    echo "edit failed";
                }
            }
            else
            {
                $update_data = "UPDATE  header_showcase SET title_image='$file_binary',
                title_font='$title_font',title_color='$title_color',title_text='$title_text',subtitle_font='$subtitle_font',
                subtitle_color='$subtitle_color',subtitle_text='$subtitle_text',h_align='$h_align',
                v_align='$v_align',button='$button' WHERE id='$options'";
                $response_update_data=$db->query($update_data);
                if($response_update_data)
                {
                    echo "edit success";
                }
                else
                {
                    echo "edit failed";
                }
            }
        }
    }
}
else
{
    $create_table = "CREATE TABLE header_showcase(

        id INT(11) NOT NULL AUTO_INCREMENT,
        title_image MEDIUMBLOB,
        title_font VARCHAR(250),
        title_color VARCHAR(20),
        title_text VARCHAR(500),
        subtitle_font VARCHAR(250),
        subtitle_color VARCHAR(20),
        subtitle_text VARCHAR(500),
        h_align VARCHAR(100),
        v_align VARCHAR(100),
        button MEDIUMTEXT,
        PRIMARY KEY(id)
    )";
    $response_create_table = $db->query($create_table);
    if($response_create_table){
        $store_data="INSERT INTO header_showcase(title_image,title_font,title_color,
        title_text,subtitle_font,subtitle_color,subtitle_text,h_align,v_align,button)VALUES(
        '$file_binary','$title_font','$title_color','$title_text','$subtitle_font',
        '$subtitle_color','$subtitle_text','$h_align','$v_align','$button')";
        $response_store_data = $db->query($store_data);
        if($response_store_data){
            echo "success";
        }
        else{
            echo "failed to insert in database";
        }
        
    }
    else{
        echo "Can't create table";
    }
}

?>