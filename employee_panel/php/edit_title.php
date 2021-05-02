<?php 
require_once("../../common_files/php/database.php");
$id = $_POST['id'];
$get_header_showcase = "SELECT * FROM header_showcase WHERE id='$id'";
$response = $db->query($get_header_showcase);
if($response){
    $data = $response->fetch_assoc();
    $title_image = "data:image/png;base64,".base64_encode($data['title_image']);
    $title_font = $data['title_font'];
    $title_color = $data['title_color'];
    $title_text = $data['title_text'];

    $subtitle_font=$data['subtitle_font'];
    $subtitle_color = $data['subtitle_color'];
    $subtitle_text = $data['subtitle_text'];

    $h_align = $data['h_align'];
    $v_align = $data['v_align'];
    $button = $data['button'];
    $all_data=[$title_image,$title_font,$title_color,$title_text,$subtitle_font,
    $subtitle_color,$subtitle_text,$h_align,$v_align,$button];

    echo json_encode($all_data);
}
?>