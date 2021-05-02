<?php
echo '<div class="row animated fadeIn">
<div class="col-md-2"></div>
<div class="col-md-8 p-4 bg-white rounded-lg shadow-sm">
    <form class="branding-form">

        <div class="form-group">
            <label for="brand_name" class="font-weight-bold">Enter Brand Name</label>
            <i class="fa fa-edit branding-edit" style="cursor:pointer">Edit details</i>
            <input type="text" class="form-control" name="brand_name"
            id="brand_name" placeholder="shop">
        </div>

        <div class="form-group">
            <label for="logo" class="font-weight-bold">Upload Brand Logo</label>
            <input type="file" accept="image/*" class="form-control-file" name="logo"
            id="logo">
        </div>

        <div class="form-group">
            <label for="domain" class="font-weight-bold">Enter Domain Name</label>
            <input type="text" class="form-control" name="domain"
            id="domain" placeholder="www.flipkart.com">
        </div>

        <div class="form-group">
            <label for="email" class="font-weight-bold">E-mail</label>
            <input type="email" class="form-control" name="email"
            id="email" placeholder="amitkumarjajoo@gmail.com">
        </div>

        <div class="form-group">
            <label for="social" class="font-weight-bold">Socail Media Handle</label>
            <input type="text" class="form-control mb-2" name="facebook-url"
            id="facebook-url" placeholder="facebook page url">
            <input type="text" class="form-control" name="twitter-url"
            id="twitter-url" placeholder="twitter page url">
        </div>

        <div class="form-group">
            <label for="address" class="font-weight-bold">Address</label>
            <textarea class="form-control" rows="3" name="address"
            id="address"></textarea>
        </div>

        <div class="form-group">
            <label for="phone" class="font-weight-bold">Phone</label>
            <input type="text" class="form-control" name="phone"
            id="phone" placeholder="1800 1200 4005">
        </div>

        <div class="form-group">
            <label for="about-us" class="font-weight-bold">About-us 
            <small class="about-us-count">0</small><small>/5000</small>
            
            </label>
            <textarea class="form-control" rows="20" name="about-us"
            id="about-us" maxlength="5000"></textarea>
        </div>

        <div class="form-group">
            <label for="privacy" class="font-weight-bold">Privacy Policy
            <small class="privacy-us-count">0</small><small>/5000</small>
            </label>
            <textarea class="form-control" rows="20" name="privacy"
            id="privacy" maxlength="5000"></textarea>
        </div>

        <div class="form-group">
            <label for="cookies" class="font-weight-bold">Cookies
            <small class="cookies-us-count">0</small><small>/5000</small>
            </label>
            <textarea class="form-control" rows="20" name="cookies"
            id="cookies" maxlength="5000"></textarea>
        </div>

        <div class="form-group">
            <label for="terms" class="font-weight-bold">Terms And Condition
            <small class="terms-us-count">0</small><small>/5000</small>
            </label>
            <textarea class="form-control" rows="20" name="terms"
            id="terms" maxlength="5000"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit your information</button>


    </form>
</div>
<div class="col-md-2"></div>
</div>

</div>';

?>