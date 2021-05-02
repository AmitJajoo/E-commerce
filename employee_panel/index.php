<?php 
require_once("../common_files/php/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../common_files/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../common_files/css/animate.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet"> 
    
    <title>Shop</title>
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <button class="active collapse-item btn w-100 text-left" 
            style="font-size: 20px;" access-link="branding_details.php">
                <i class="fa fa-image"></i>
                Branding Update
                
            </button>

            <button class="collapse-item mt-3 btn w-100 text-left" 
            style="font-size: 20px;" access-link="delivery_area.php">
                <i class="fa fa-map-marker"></i>
                Delivery area
                
            </button>

            <button class="homepage-design-btn mt-3 btn w-100 text-left"
             style="font-size: 20px;">
                <i class="fa fa-home"></i>
                Homepage Design
                <i class="fa fa-angle-down close mt-2"></i>
                
            </button>
            <ul class="collapse homepage-design-collapse">
                <li class="border-left p-2 collapse-item"
                 access-link="header_showcase_design.php">Header Showcase</li>
                <li class="border-left p-2 collapse-item"
                 access-link="category_showcase_design.php">Category Showcase</li>
            </ul>

            <button class="stock-update-btn btn mt-3 w-100 text-left" style="font-size: 20px;">
                <i class="fa fa-shopping-cart"></i>
                Stock Update
                <i class="fa fa-angle-down close mt-2"></i>
            </button>
            <ul class="collapse stock-update-btn-menu">
                <li class="border-left p-2 collapse-item"
                 access-link="create_category_design.php"> Create category</li>
                <li class="border-left p-2 collapse-item"
                 access-link="create_brand_design.php"> Create brands</li>
                <li class="border-left p-2 collapse-item" 
                access-link="create_products_design.php"> Create products</li>
            </ul>
        </div>
    <div class="page">
        <!-- <div class="row">
            <div  class="col-md-12 d-flex justify-content-between">
                <div class="btn-group border bg-white shadow-sm">
                    <button class="btn btn-white">SORT BY</button>
                    <button class="btn btn-white">
                        <select class="form-control">
                            <option>All Data</option>
                        </select>
                    </button>
                </div>

                <div class="btn-group border bg-white shadow-sm">
                    <button class="btn btn-white">EXPORT TO</button>
                    <button class="btn btn-white">
                        <select class="form-control">
                            <option>Choose option</option>
                            <option>pdf</option>
                            <option>xls</option>
                        </select>
                    </button>
                </div>

            </div>

            <div class="col-md-12 my-4">
            <div class="table-responsive">
                <table class="table bg-white">
                    <tr>
                        <th>S/NO</th>
                        <th>Product id</th>
                        <th>Title</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Fullname</th>
                        <th>Mobile</th>
                        <th>Price</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>Pincode</th>
                        <th>Payment Mode</th>
                        <th>Purchase Date</th>
                        <th>Purchase Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $get_data = "SELECT * FROM purchase";
                        $response = $db->query($get_data);
                        if($response)
                        {
                            while($data = $response->fetch_assoc())
                            {
                                echo "<tr>";

                                echo "<td>";
                                echo $data['id'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['product_id'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['title'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['brand'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['quantity'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['fullname'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['mobile'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['price'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['email'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['address'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['country'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['state'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['pincode'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['payment_mode'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['purchase_date'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['purchase_time'];
                                echo "</td>";

                                echo "<td>";
                                echo $data['status'];
                                echo "</td>";

                                echo "<td>";
                                echo "<button class='btn btn-primary'>DISPATCH</button>";
                                echo "</td>";

                                echo "</tr>";
                            }
                        }
                    ?>
                </table>
                </div>
            </div>
        </div> -->
    </div>

    <!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>

</script>

<script src="js/index.js"></script>
<script>
 
</script>
</body>
</html>