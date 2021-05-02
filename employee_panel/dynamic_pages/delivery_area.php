<?php
echo '<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 bg-white">
    <div class="jumbotron bg-white py-3">
        <h4>SET DELIVERY LOCATION</h4>
        <form class="set-area-form">
            <select class="form-control mb-3 country" name="country" required="required">
                <option>Choose Country</option>';?>
                <?php
                require_once("../../common_files/database/database.php");
                $get_countries = "SELECT * FROM countries";
                $response= $db->query($get_countries);
                if($response)
                {
                    while($data=$response->fetch_assoc())
                    {
                        echo "<option country-id='".$data['id']."'>".$data['name']."</option>";
                    }
                }
                ?>
            <?php 
            echo '</select>
            <select class="form-control mb-3 state" name="state" required="required">
                <option>Choose State</option>
            </select>
            <select class="form-control mb-3 city" name="city" required="required">
                <option>Choose City</option>
            </select>
            <input type="number" name="pincode" 
            required="required" class="form-control mb-3 pincode"
             placeholder="Pincode">
            <input type="text" name="days" required="required" class="
            form-control mb-3"
             placeholder="Delivery Within 5 to 6 Days">
             <select class="form-control mb-3" name="payment-mode" 
             required="required">
                <option>Choose Payment mode</option>
                <option>Online</option>
                <option>all</option>
             </select>
            <button class="btn btn-primary set-area-btn" type="submit">SET AREA</button>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
</div>';?>
