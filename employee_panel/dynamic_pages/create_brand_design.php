<?php

require_once("../../common_files/php/database.php");
$get_category_name = "SELECT DISTINCT * FROM category";
$response = $db->query($get_category_name);
$multi_array = [];

if($response){
    while($data = $response->fetch_assoc())
    {
        array_push($multi_array,$data['category_name']);
    //    echo"<option>".$data['category_name']."</option>";
    }
}

echo '<div class="row">
<div class="col-md-4 shadow-sm rounded-lg bg-white py-2">
<h5 class="my-3">CREATE BRANDS
<i class="fa fa-circle-o-notch fa-spin close brand-loader d-none" style="font-size: 18px;"></i>
</h5>
<form class="brand-form">
<select class="form-control select_category mb-3">
    <option>Choose Category</option>';
    for($i=0;$i<count($multi_array);$i++)
    {
        echo"<option>".$multi_array[$i]."</option>";
    }
    

echo '</select>
    <input type="text" class="form-control mb-3 w-100 brand-input" placeholder="Nokia" style="border:none;background-color:#f9f9f9;"/>
    <div class="brand-field-area"></div>
    <button class="btn btn-primary add-brand-btn mb-3" type="button">
        <i class="fa fa-plus"></i> Add field
    </button>
    <button class=" btn btn-danger create-brand-btn mb-3" type="submit">
        Create
    </button>
    <div class="brand-field-notice my-3"></div>
</form>
</div>
<div class="col-md-2"></div>
<div class="col-md-6 shadow-sm rounded-lg bg-white py-2">
<select  class="form-control my-3 display-brand">
<option>Choose Category</option>';
    for($i=0;$i<count($multi_array);$i++)
    {
        echo"<option>".$multi_array[$i]."</option>";
    }

echo '</select>
    <h5 class="my-3">BRAND LIST
    <i class="fa fa-circle-o-notch fa-spin display-brand-loader d-none close"></i>
    </h5>
    <hr/>

    <div class="brand-list-area my-3"></div>
</div>
</div>';
?>