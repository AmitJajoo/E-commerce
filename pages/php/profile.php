
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
    <link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../../common_files/css/animate.css" rel="stylesheet">
    
    <title>Shop</title>
</head>
<body class="bg-light">
<?php
    include_once("../../assests/nav.php");
?>
<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#personal" class="active nav-link" data-toggle="tab">
                    PERSONAL
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#privacy" class="nav-link" data-toggle="tab">
                    PRIVACY
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#purchase" class="nav-link" data-toggle="tab">
                    PURCHASE HISTORY
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="personal">
                    
                    <div class="jumbotron py-3 my-4 bg-white shadow-sm border-right 
                    border-top border-bottom" style="border-left:5px solid blue;">
                        <form class="personal-form">
                            <div class="form-group">
                                <label for="firstname">FIRSTNAME</label>
                                <input type="text" name="firstname" id="firstname"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="lastname">LASTNAME</label>
                                <input type="text" name="lastname" id="lastname"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="email">E-MAIL</label>
                                <input type="email" name="email" id="email"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="mobile">MOBILE</label>
                                <input type="number" name="mobile" id="mobile"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="state">STATE</label>
                                <input type="text" name="state" id="state"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="country">COUNTRY</label>
                                <input type="text" name="country" id="country"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="pincode">PINCODE</label>
                                <input type="text" name="pincode" id="pincode"
                                class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="address">ADDRESS</label>
                                <textarea name="address" class="form-control">
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>

                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="privacy">
                    <h1>privacy</h1>
                </div>
                <div class="tab-pane fade" id="purchase">
                    <h1>Purchase</h1>
                </div>
            </div>
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