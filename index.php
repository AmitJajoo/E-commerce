
<?php
require_once("common_files/database/database.php");
$select_brand_table = "SELECT * FROM branding";
$response_brand = $db->query($select_brand_table);
$all_information="";
if($response_brand){
    $all_information=$response_brand->fetch_assoc();
    // array_push($all_information,$address);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="common_files/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="common_files/css/animate.css" rel="stylesheet">
    
    <title>Shop</title>
    <style>
    *:focus{
        box-shadow: none !important;
    }
    .carousel-caption{
        line-height: 80px;
        height: 100%;
    }
    @media(max-width:78px)
    {
        .carousel-caption{
            justify-content: center !important;
        }
        #top-slider h1{
            margin-top: 20%;
            font-size: 180% !important;
        }
        #top-slider h4{
            font-size: 120% !important;
        }
        #top-slider button a{
            font-size: 15px !important;
        }
    }
    @media(max-width:576px)
    {
        #category-showcase img{
            width: 80%;
            margin-right: 10%;
            margin-left: 10%;
        }
    }
    </style>
</head>
<body class="bg-white">
<?php
    include_once("assests/nav.php");
?>
<div  class="container-fluid p-0" style="margin-top:64px ;">
    <div class="carousel slide" data-ride="carousel" data-interval="500" id="top-slider">
        <div class="carousel-inner">
            <?php 
                $showcase = "SELECT * FROM header_showcase";
                $response = $db->query($showcase);
                if($response){
                    while($data = $response->fetch_assoc()){
                        $h_align=$data['h_align'];
                        $text_align = "";
                        if($h_align == "center"){
                            $text_align = "text-center";
                        }
                        else{
                            $text_align = "text-left";
                        }
                        $v_align = $data['v_align'];
                        $title_size= $data['title_font'];
                        $title_color =  $data['title_color'];

                        $subtitle_size= $data['subtitle_font'];
                        $subtitle_color =  $data['subtitle_color'];
                        echo "<div class='carousel-item carousel-item-control'>";
                        $image = "data:image/png;base64,".base64_encode($data['title_image']);
                        echo "<img src='".$image."' class='w-100' />";
                        echo "<div class='carousel-caption ".$text_align." d-flex' style='justify-content:".$h_align.";
                        align-items:".$v_align."'>";
                        echo "<div>";
                        echo "<h1 style='font-size:".$title_size.";color:".$title_color.";'>".$data['title_text']."</h1>";
                        echo "<h4 style='font-size:".$subtitle_size.";color:".$subtitle_color.";'>".$data['subtitle_text']."</h4>";
                        echo  $data['button'];
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>

<!-- start category showcase -->
<div class="container animated zoomIn" id="category-showcase">
    <h4 class="text-center my-4">CATEGORY SHOWCASE</h4>
    <div class="row">
        <?php
            $dir = ['top-left','bottom-left','center','top-right','bottom-right'];
            $top_left_image = "";
            $top_left_label = "";

            $bottom_left_image = "";
            $bottom_left_label = "";

            $center_image = "";
            $center_label = "";

            $top_right_image = "";
            $top_right_label = "";

            $bottom_right_image = "";
            $bottom_right_label = "";

            for($i=0;$i<count($dir);$i++)
            {
                $get_data = "SELECT * FROM category_showcase WHERE direction='$dir[$i]'";
                $response_get_data=$db->query($get_data);
                if($response_get_data->num_rows!=0)
                {
                    $data = $response_get_data->fetch_assoc();
                    if($dir[$i] == 'top-left')
                    {
                        $top_left_image = "data:image/png;base64,".base64_encode($data['image']);
                        $top_left_label = $data['label'];
                    }
                    if($dir[$i] == 'bottom-left')
                    {
                        $bottom_left_image = "data:image/png;base64,".base64_encode($data['image']);
                        $bottom_left_label = $data['label'];
                    }
                    if($dir[$i] == 'center')
                    {
                        $center_image = "data:image/png;base64,".base64_encode($data['image']);
                        $center_label = $data['label'];
                    }
                    if($dir[$i] == 'top-right')
                    {
                        $top_right_image = "data:image/png;base64,".base64_encode($data['image']);
                        $top_right_label = $data['label'];
                    }
                    if($dir[$i] == 'bottom-right')
                    {
                        $bottom_right_image = "data:image/png;base64,".base64_encode($data['image']);
                        $bottom_right_label = $data['label'];
                    }
                }
            }
            echo '<div class="col-md-4"> 
            <div class="position-relative mb-3">
                <button class="btn px-2 border text-uppercase shadow-sm bg-white" style="position:absolute;
                top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;">'.$top_left_label.'</button>
            
                <img src='.$top_left_image.' width="100%"/>
            </div>

            <div class="position-relative mb-3">
                <button class="btn px-2 border text-center shadow-sm bg-white" style="position:absolute;
                top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;">'.$bottom_left_label.'</button>
            
                <img src='.$bottom_left_image.' width="100%"/>
            </div>
            </div>';
            echo '<div class="col-md-4">
                <div class="position-relative mb-3">
                    <button class="btn px-2 border text-center shadow-sm bg-white" style="position:absolute;
                    top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;">'.$center_label.'</button>
                
                    <img src='.$center_image.' width="100%"/>
                </div>
            </div>';

            echo '<div class="col-md-4"> 
            <div class="position-relative mb-3">
                <button class="btn px-2 border text-uppercase shadow-sm bg-white" style="position:absolute;
                top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;">'.$top_right_label.'</button>
            
                <img src='.$top_right_image.' width="100%"/>
            </div>

            <div class="position-relative mb-3">
                <button class="btn px-2 border text-uppercase shadow-sm bg-white" style="position:absolute;
                top:50%;left:50%;transform:translate(-50%,-50%);font-size:18px;">'.$bottom_right_label.'</button>
            
                <img src='.$bottom_right_image.' width="100%"/>
            </div>
            </div>';
        ?>
    </div>
</div>
<!-- end category showcase -->

<div class="container-fluid">
    <h4 class="my-4 text-center">PRODUCTS FOR YOU</h4>
    <div class="row">
        <?php
            $get_data = "SELECT * FROM products ORDER BY RAND() LIMIT 12";
            $response = $db->query($get_data);
            if($response)
            {
                while($data=$response->fetch_assoc())
                {
                    echo "<div class='col-md-3 py-5' align='center'>";
                    echo "<img src='".$data['thumb_pic']."' width='250' height='316' /><br>";
                    echo "<span class='text-uppercase font-weight-bold'>".$data['brands']."</span>";
                    echo "<i class='fa fa-star text-warning'></i>";
                    echo "<i class='fa fa-star text-warning'></i>";
                    echo "<i class='fa fa-star-o text-warning'></i>";
                    echo "<i class='fa fa-star-o text-warning'></i>";
                    echo "<i class='fa fa-star-o text-warning'></i>";
                    echo "<br/><span>".$data['title']."</span>";
                    echo "<br/><span><i class='fa fa-rupee'></i>".$data['price']."</span>";
                    echo "<br/><button class='btn btn-danger mt-3 cart-btn' product-id='".$data['id']."'
                    product-title='".$data['title']."' product-price='".$data['price']."' 
                    product-brand='".$data['brands']."' product-pic='".$data['thumb_pic']."'>
                    <i class='fa fa-shopping-cart'></i>
                    ADD TO CART</button> <button class='btn mt-3 btn-primary buy-now' product-id='".$data['id']."'>
                    <i class='fa fa-shopping-bag'></i>
                    BUY NOW</button>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</div>
<?php
    include_once("assests/footer.php");
?>
    <!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    var carousel_item = document.querySelector(".carousel-item-control");
    $(carousel_item).addClass("active");
});
</script>
<script src="pages/js/index.js"></script>
</body>
</html>