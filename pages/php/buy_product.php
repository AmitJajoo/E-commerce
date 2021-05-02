
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
$id = $_GET['product_id'];
$username = base64_decode($_COOKIE['_au_']);
$get_product = "SELECT * FROM products WHERE id='$id'";
$response = $db->query($get_product);
$title ="";
$brand="";
$price="";
$pic="";
$descriptions="";
$quatity="";
$category_name= "";
$stocks = "";
$front_pic = "";
$back_pic = "";
$right_pic = "";
$left_pic = "";
if($response) 
{
    $data = $response->fetch_assoc();
    $title=$data['title'];
    $brand = $data['brands'];
    $price = $data['price'];
    $pic = $data['thumb_pic'];
    $descriptions = $data['descriptions'];
    $quatity = $data['quatity'];
    $category_name = $data['category_name'];
    $stocks = $data['quatity'];
    $front_pic = $data['front_pic'];
    $back_pic = $data['back_pic'];
    $right_pic = $data['right_pic'];
    $left_pic = $data['left_pic'];
}
//show or remove add to card
$cart_btn="";
$get_cart = "SELECT * FROM cart WHERE product_id='$id' AND username='$username'";
$response_get_card=$db->query($get_cart);

if($response_get_card->num_rows != 0)
{
    $cart_btn = "";
}
else
{
    $cart_btn="<button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."'
    product-title='".$data['title']."' product-price='".$data['price']."' 
    product-brand='".$data['brands']."' product-pic='".$data['thumb_pic']."'>
    <i class='fa fa-shopping-cart'></i>
    ADD TO CART</button>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../../common_files/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../common_files/css/animate.css" rel="stylesheet">
    
    <title>Shop</title>
</head>
<body class="bg-light">
<?php
    include_once("../../assests/nav.php");
    $pincode=$_SESSION['pincode'];
    $check_pincode = "SELECT * FROM delivery_location WHERE pincode='$pincode'";
    $response= $db->query($check_pincode);
    $buy_btn = "";
    if($response->num_rows != 0)
    {
        $data = $response->fetch_assoc();
        $cod_btn="";
        if($data['payment_mode'] == "all")
        {
            $cod_btn ='<input type="radio" name="pay-mode" value="cod">CASH ON DELIVERY';
        }else{
            $cod_btn = '';
        }
        if($stocks!=0){
        $buy_btn='<button class="btn btn-primary mt-3 purchase-btn" product-id="'.$id.'"
            product-title="'.$title.'" product-brand="'.$brand.'"
            product-price = "'.$price.'">
            BUY NOW</button>';
        }else{
            $buy_btn = '<button class="btn btn-secondary mt-3">
            <i class="fa fa-shopping-cart"></i> Out of Stocks
        </button>';
        }
    }
    else{
        $buy_btn = '<button class="btn btn-info mt-3">Whoops ! product delivery not
        available in your area</button>';
    }
?>
<div class="container" style="margin-top: 80px;margin-bottom:80px;">
    <a href="#" class="text-capitalize"><?php echo $category_name; ?></a>
    >
    <a href="#" class="text-capitalize"><?php echo $brand; ?></a>
    >
    <a href="#" class="text-capitalize"><?php echo $title; ?></a>
    >
    <div class="row mt-2">
        <div class="col-md-6 bg-white py-4" align="center">
            <img src="<?php echo '../../'.$front_pic; ?>" 
            class="mb-3 preview" width="250"/><br>
            <img src="<?php echo '../../'.$back_pic; ?>" 
             class="border shadow-sm thumb_pic mr-2 p-2" width="60" />
            <img src="<?php echo '../../'.$left_pic; ?>" 
            class="border shadow-sm thumb_pic mr-2 p-2" width="60" />
            <img src="<?php echo '../../'.$right_pic; ?>" 
            class="border shadow-sm thumb_pic mr-2 p-2" width="60" />
        </div>
        <div class="col-md-6 bg-white py-2" style="border-left:5px solid #F8F9FA">
            <h4 class="p-0 m-0 text-capitalize mt-2"><?php echo $title; ?></h4>
            <p class="m-0 p-0 text-uppercase"><?php echo $brand; ?></p>
            <p class="m-0 p-0"><i class="fa fa-rupee"></i>
            <?php echo $price; ?></p>
            <h4>Description</h4>
            <span><?php echo $descriptions; ?></span>
            
            <h4>Quantity</h4>
            <?php
                if($stocks<=5)
                {
                    echo "<p class='text-success font-weight-bold'>Only
                     <span class='stocks'>".$stocks."</span> is left</p>";
                }
                else{
                    echo "<p class='text-success d-none font-weight-bold'>Only
                     <span class='stocks'>".$stocks."</span> is left</p>";
                }
            ?>
            <input type="number" required="required" class="form-control quantity" style="width: 80px;" value="1"/>
            
            <h4>Pay Now</h4>
            <input type="radio" name="pay-mode" value="online">ONLINE
            <?php echo $cod_btn; ?><br/>
            <?php echo $cart_btn; ?>
            <?php echo $buy_btn;?>

            <h4 class="my-3">CHECK PRODUCT AVAILABLITY</h4>
            <input type="number" class="form-control mb-3 w-75 pincode-field" 
            placeholder="PINCODE">
            <p class="pincode-message"></p>
            <button class="btn btn-warning px-3 py-2 pincode-btn">PROCEED</button>
        </div>
    </div>
</div>
<?php
    include_once("../../assests/footer.php");
?>
    <!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" 
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
 integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
 crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>
</body>
</html>