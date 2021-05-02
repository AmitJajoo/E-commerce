<?php
echo '<div class="row animated slideInDown">
<div class="col-md-4 shadow-sm rounded-lg bg-white py-2">
    <h5 class="my-3">CREATE CATEGORY
    <i class="fa fa-circle-o-notch fa-spin d-none create-category-loader close" style="font-size: 18px;"></i>
    </h5>
    <form class="create-category-form">
        <input type="text" required="required" class="input form-control mb-3 w-100" placeholder="Mobiles" style="border:none;background-color:#f9f9f9;"/>
        <div class="add-field-area mb-3"></div>
        <button type="button" class="add-field-btn btn btn-primary mb-3">
            <i class="fa fa-plus"></i> Add field
        </button>
        <button type="submit" class="create-btn btn btn-danger mb-3">
            Create
        </button>
    </form>

    <div class="create-category-notice"></div>
</div>
<div class="col-md-2"></div>
<div class="col-md-6 shadow-sm rounded-lg bg-white py-2 ">
    <h5>CATEGORY LIST</h5>
    <hr/>
    <div class="category_area overflow-auto" style="height:300px;"></div>
</div>
</div>';
?>