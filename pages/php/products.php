
<?php
require_once("../../common_files/php/database.php");
$select_brand_table = "SELECT * FROM branding";
$response_brand = $db->query($select_brand_table);
$all_information="";
if($response_brand){
    $all_information=$response_brand->fetch_assoc();
} 
$cat_name = $_GET['cat_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../common_files/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../common_files/css/animate.css" rel="stylesheet">
    <style>
    *:focus{
        box-shadow: none !important;
    }
    </style>
    <title>Shop</title>
</head>
<body class="bg-light">
<?php
    include_once("../../assests/nav.php");
?>
<div class="container-fluid" style="margin-top: 100px;">
    <a href="#" class="text-capitalize"><?php echo $cat_name; ?></a>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="bg-white  w-100 p-4 border">
                <h5>FILTER BY BRAND</h5>
                <div class="btn-group-vertical mb-4">
                    <?php
                        $get_product = "SELECT * FROM brands WHERE category_name='$cat_name'";
                        $response = $db->query($get_product);
                        if($response)
                        {
                            echo "<button class='btn text-capitalize text-left 
                                filter-btn' cat-name='".$cat_name."' brand='all'>
                                <i class='fa fa-angle-double-right'></i>
                                All
                                </button>";
                            while($data = $response->fetch_assoc())
                            {
                                echo "<button class='btn text-capitalize text-left 
                                filter-btn' cat-name='".$cat_name."' brand='".$data['brands']."'>
                                <i class='fa fa-angle-double-right'></i>
                                ".$data['brands']."
                                </button>";
                            }
                        }
                    ?>
                </div>
                <h5>FILTER BY PRICE</h5>
                <div class="btn-group-vertical shadow-sm bg-light">
                    <button class="btn">
                        <input type="number" placeholder="minimum price"
                        class="form-control min-price">
                    </button>
                    <button class="btn">
                        <input type="number" placeholder="minimum price"
                        class="form-control max-price">
                    </button>
                        
                    <button class="btn text-center price-filter-btn" 
                    cat-name=<?php echo $cat_name; ?>>GET PRODUCT</button>
                        
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white w-100 p-4 border product-result d-flex flex-wrap
            justify-content-between"></div>
        </div>
    </div>
</div>
<?php
    include_once("../../assests/footer.php");
?>
    <!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>
</body>
</html>