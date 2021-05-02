
<?php
require_once("../../common_files/php/database.php");
if(empty($_COOKIE['_au_'])){
    header("Location:../../signin.php");
    exit;
}
$select_brand_table = "SELECT * FROM branding";
$response_brand = $db->query($select_brand_table);
$all_information="";
if($response_brand){
    $all_information=$response_brand->fetch_assoc();
} 


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
    
    <title>Shop</title>
</head>
<body class="bg-light">
<?php
    include_once("../../assests/nav.php");
?>
<div class="container-fluid" style="margin-top: 80px;margin-bottom:80px;box-sizing:border-box">
    <div class="row">
        <div class="col-md-8 p-4" style="box-sizing: border-box;">
            <div class="bg-white">
                <?php
                    
                    $username = base64_decode($_COOKIE['_au_']);
                    $get_data = "SELECT * FROM cart WHERE username='$username'";
                    
                    
                    $response_get_data = $db->query($get_data);
                    
                    if($response_get_data->num_rows != 0)
                    {
                        
                        while($data=$response_get_data->fetch_assoc()){
                            
                            echo "<div class='media border shadow-sm mb-3'>
                            <div class='media-left mr-2'>
                                <img src='../../".$data['product_pic']."' width='100'/>
                            </div>
                            <div class='media-body'>
                                <h5 class='text-captalize p-0 m-0'>".$data['product_title']."
                                </h5><span>".$data['product_brand']."</span><br/>
                                <span><i class='fa fa-rupee'></i> ".$data['product_price']."
                                </span><br/>
                                <div class='btn-group'>
                                    <button class='btn btn-primary delete-card-btn'
                                    product-id=".$data['product_id'].">
                                    <i class='fa fa-trash'>
                                    </i></button>
                                    <button class='btn btn-danger buy-now' 
                                    product-id=".$data['product_id'].">BUY NOW</button>
                                </div>
                            </div>
                            </div>";
                        }
                    }
                    else{
                        echo "<h1 class='text-center' style='font-size:50px'>
                        <i class='fa fa-shopping-cart'></i>Your cart is empty</h1>";
                    }
                ?>
            </div>
        </div>
        <div class="col-md-4">
        testing-2
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