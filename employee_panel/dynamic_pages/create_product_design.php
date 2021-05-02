<?php
echo '<div class="row">
<div class="col-md-4 shadow-sm rounded-lg bg-white py-2">
<h5 class="my-3">CREATE PRODUCTS
<i class="fa fa-circle-o-notch fa-spin close" style="font-size: 18px;"></i>
</h5>
<form>
<select class="form-control mb-2">
    <option>Choose category</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
</select>

<select class="form-control">
    <option>Choose Brands</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
</select>
    <input type="text" class="form-control mb-3 w-100" placeholder="Nokia 1100" style="border:none;background-color:#f9f9f9;"/>
    <button class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Add field
    </button>
    <button class=" btn btn-danger mb-3">
        Create
    </button>
</form>
</div>
<div class="col-md-2"></div>
<div class="col-md-6 shadow-sm rounded-lg bg-white py-2">
    <h5>PRODUCT LIST</h5>
    <hr/>
</div>
</div>';
?>