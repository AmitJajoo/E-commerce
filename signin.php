
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
</head>
<body class="bg-light">
<?php
    include_once("assests/nav.php");
?>
<div class="container p-5 bg-white shadow-lg" style="margin-top: 180px;">
    <h2>LOGIN WITH US</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <form class="signup-form">
                <div class="form-group">
                    <label for="email">E-mail<sup class="text-danger">*</sup></label>
                    <input type="email" placeholder="er@gmail.com" name="email" id="email" 
                    class="form-control email bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="password">Password<sup class="text-danger">*</sup></label>
                    <input type="password" placeholder="****" name="password" id="password" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary border login-btn shadow-sm" type="submit">Login now</button>
                </div>

            </form>
            <form>
                <div class="form-group d-none otp-form">
                    <div class="btn btn-group shadow-sm">
                        <button class="btn btn-light" type="button">
                            <input type="number" placeholder="123456" name="otp"
                             class="form-control otp">
                        </button>
                        <button class="btn btn-light vertify-btn" type="button">VERIFY</button>
                        <button class="btn btn-light resend-btn" type="button">RESEND OTP</button>
                    </div>
                </div>
            </form>
            <div class="login-notice"></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h4>New Customer</h4>
            <p>If you don't have account please register with us</p>
            <a href="signup.php" class="btn btn-danger py-2">Create an accont</a>
        </div>
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
    $(".signup-form").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"pages/php/login.php",
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend:function(){
                $(".login-btn").html("Please wait...");
            },
            success:function(response){
                if(response.trim() == "success"){
                $(".signup-form").addClass("d-none");
                $(".otp-form").removeClass("d-none");
                //verify otp
                $(".vertify-btn").click(function(){
                        
                        var email = $(".email").val();
                        $.ajax({
                            type:"POST",
                            url:"pages/php/verify_otp.php",
                            data:{
                                otp:$(".otp").val(),
                                email:email
                            },
                            beforeSend:function(){
                                $(".vertify-btn").html("Please wait...");
                            },
                            success:function(response){
                                
                                if(response.trim()=="success"){
                                    window.location = "signin.php";
                                }
                                else{
                                    $(".vertify-btn").html(response);
                                    $(".otp").val("");
                                    setTimeout(function(){
                                        $(".vertify-btn").html("VERIFY");
                                    },3000);
                                }
                            }
                        });
                    });
                    //resend otp
                    $(".resend-btn").click(function(){
                        $.ajax({
                              type:"POST",
                              url:"pages/php/resend_otp.php",
                              data:{
                                email : $(".email").val()
                              },
                              beforeSend:function(){
                                  $(".resend-btn").html("Please wait...");
                              },
                              success:function(response){
                                  if(response.trim()=="success"){
                                    $(".resend-btn").html("OTP has been send");
                                  }
                                  else{
                                      $(".resend-btn").html(response);
                                      setTimeout(function(){
                                          $(".resend-btn").html("RESEND OTP");
                                      },3000);
                                  }
                              }
                        });
                    });
            
                }
                else if(response.trim()=="login success")
                {
                    window.location = "index.php";
                }  
                else{
                    var div=document.createElement("DIV");
                    div.className="alert alert-warning";
                    div.innerHTML = "<b>"+response+"</b>";
                    $(".login-notice").append(div);
                    setTimeout(function(){
                        $(".login-notice").html("");
                        $(".signup-form").trigger('reset');
                    },3000);
                }  
            }
        });
    });
});
</script>
</body>
</html>