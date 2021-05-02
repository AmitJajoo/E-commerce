<div class="container-fluid bg-white border-top py-3" style="margin-top: 100px;">
    <div class="container d-flex justify-content-between">
    <div class="input-group w-50">
        <input type="email" placeholder="email@gmail.com" name="subscribe-email" class="form-control"/>
        <div class="input-group-append">
            <span class="input-group-text">SUBSCRIBE</span>
        </div>
    </div>

    <div class="btn-group">
    <button class="btn btn-dark">FOLLOW US</button>
    <button class="btn border px-3"><a href="<?php echo $all_information['facebook_url'] ?>"><i class="fa fa-facebook"></i></a></button>
    <button class="btn border px-3"><a href="<?php echo $all_information['twitter_url'] ?>"><i class="fa fa-twitter"></i></a></button>
    </div>

    </div>
</div>

<div class="container-fluid bg-dark">
    <div class="container py-3">
    <div class="row">
        <div class="col-md-3">
            <h5 class="text-light">CATEGORY</h5>
            <?php
            $get_menu = "SELECT DISTINCT category_name FROM category";
            $response = $db->query($get_menu);
            if($response){
                while($nav = $response->fetch_assoc()){
                    echo '<a href="#" class="d-block py-2 text-capitalize" style="color: #CAD5E2;">'.$nav['category_name'].'</a>';
                }
            }
      ?>
    </ul>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <h5 class="text-light">POLICIES</h5>
            <a href="privacy.php" class="d-block py-2" style="color: #CAD5E2;">PRIVACY POLICY</a>
            <a href="cookies.php" class="d-block py-2" style="color: #CAD5E2;">COOKIES POLICY</a>
            <a href="terms.php" class="d-block py-2" style="color: #CAD5E2;">TERM AND CONDITION</a>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <h5 class="text-light">CONTACTS</h5>
            <p  style="color: #CAD5E2;">VENUE : <?php echo $all_information['addres'] ?></p>
            <p  style="color: #CAD5E2;">CALL : <?php  echo $all_information['phone'] ?></p>
            <p  style="color: #CAD5E2;">EMAIL : <?php  echo $all_information['email'] ?></p>
            <p style="color: #CAD5E2;">WEBSITE : <?php  echo $all_information['domain_name'] ?></p>
        </div>
    </div>
    </div>
</div>