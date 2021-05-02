<?php
$menu ="";
$cart_number="";
$get_branding_data="SELECT * FROM branding";
$resposne_brand=$db->query($get_branding_data);
if($resposne_brand){
  $branding_result = $resposne_brand->fetch_assoc();
}
if(empty($_COOKIE['_au_']))
{
  $menu = '<a href="signup.php" class="dropdown-item"><i class="fa fa-user"></i> Sign Up</a>
  <a href="signin.php" class="dropdown-item"><i class="fa fa-sign-in"></i> Sign In</a>';
}
else {
  $username = base64_decode($_COOKIE['_au_']);
  $fullname = "";
  $get_data = "SELECT * FROM users WHERE email='$username'";
  $response = $db->query($get_data);
  if($response){
    $data = $response->fetch_assoc();
    $fullname = $data['firstname']." ".$data['lastname'];
    $mobile = $data['mobile'];
    session_start();
    $_SESSION['mobile'] = $mobile;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['pincode'] = $data['pincode'];
  }
  $menu = '<a href="#" class="text-capitalize dropdown-item"><i class="fa fa-user"></i> '.$fullname.'</a>
  <a href="pages/php/signout.php" class="dropdown-item"><i class="fa fa-sign-out"></i> Sign Out</a>';
  $get_cart = "SELECT count(id) AS result FROM cart WHERE username = '$username'";
  $response_get_cart = $db->query($get_cart);
  if($response_get_cart->num_rows != 0)
  {
    $data = $response_get_cart->fetch_assoc();
    if($data['result'] != 0){
      $cart_number = '<div style="position:absolute;background:red;color:whitesmoke;width:25px;
      height:25px;font-weight:bold;border-radius:50%;z-index:10000;top:-10px;left:25px;"
      class="cart-notification">
        <span>'.$data['result'].'</span>
      </div>'; 
    }
  }
}
?>

<div class="cotainer-fluid bg-white shadow-sm fixed-top">
<div class="container">
<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <a href="http://localhost/shop/index.php" class="text-uppercase navbar-brand d-flex align-items-center p-2 shadow-sm
  border">
  <?php 
    $logo_string= base64_encode($branding_result['brand_logo']);
    $complete_src = "data:image/png;base64,".$logo_string;
    echo "<img src='".$complete_src."' width='20' />";
    echo "&nbsp";
    echo "<small>".$branding_result['brand_name']."</small>";

  ?>
  </a>
  
  <div class="collapse navbar-collapse" id="menu-box">
    <ul class="navbar-nav">
      <?php
            $get_menu = "SELECT DISTINCT category_name FROM category";
            $response = $db->query($get_menu);
            if($response){
                while($nav = $response->fetch_assoc()){
                    echo '<li class="nav-item">
                    <a href="http://localhost/shop/pages/php/products.php?cat_name='.$nav["category_name"].'" 
                    class="nav-link text-uppercase text-dark">'.$nav['category_name'].'</a></li>';
                }
            }
      ?>
    </ul>
</div>
    <div class="btn-group ml-auto">
            <button class="btn border navbar-toggler" data-toggle="collapse" 
            data-target="#menu-box"><i class="fa fa-bars"></i></button>
            <button class="btn border shadow-sm"><a href="http://localhost/shop/pages/php/cart_page.php" 
            style="color:#212529;" class="cart-link"><i class="fa fa-shopping-cart"></i>
              <?php echo $cart_number; ?>
              </a>
            </button>
            <button class="btn border shadow-sm"><i class="fa fa-search"></i></button>
            <button class="btn border dropdown shadow-sm">
              <i class="fa fa-user nav-link dropdown-toggle" data-toggle="dropdown"></i>
              <div class="dropdown-menu">
                <?php echo $menu;?>
              </div>
            </button>
    </div>
  
</nav>
</div>
</div>