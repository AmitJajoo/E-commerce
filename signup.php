
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
    <h2>CREATE AN ACCOUNT</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <form class="signup-form">
                <div class="form-group">
                    <label for="firstname">Firstname<sup class="text-danger">*</sup></label>
                    <input type="text" placeholder="Mr. Raj" name="firstname" id="firstname" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname<sup class="text-danger">*</sup></label>
                    <input type="text" placeholder="Sharma" name="lastname" id="lastname" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="email">Email<sup class="text-danger">*</sup></label>
                    <input type="email" placeholder="amitkumarjajoo@gmail.com" name="email" id="email" 
                    class="form-control email bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile<sup class="text-danger">*</sup></label>
                    <input type="number" placeholder="****9450" name="mobile" id="mobile" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="password">Password<sup class="text-danger">*</sup></label>
                    <input type="password" placeholder="****" name="password" id="password" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="address">Address<sup class="text-danger">*</sup></label>
                    <input type="text" name="address" id="address" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="state">State<sup class="text-danger">*</sup></label>
                    <input type="text" placeholder="Rajasthan" name="state" id="state" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="country">Country<sup class="text-danger">*</sup></label>
                    <input type="text" placeholder="India" name="country" id="country" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <label for="pincode">Pin Code<sup class="text-danger">*</sup></label>
                    <input type="number" placeholder="324005" name="pincode" id="pincode" 
                    class="form-control bg-light" required="required"/>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary border register-btn shadow-sm" type="submit">
                    Register Now</button>
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
        </div>
        <div class="col-md-6"></div>
        
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
            url:"pages/php/register.php",
            data : new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            beforeSend:function(){
                $(".register-btn").html("Please Wait...");
            },
            success:function(response){
                if(response.trim()=="success"){
                    $(".register-btn").html("Register Now");
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
                                    $(".otp").html("");
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
                else{
                    alert(response);
                }
            }
        });
    });
});
</script>
</body>
</html>