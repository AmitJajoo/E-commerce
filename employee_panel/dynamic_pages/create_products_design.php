<?php
require_once("../../common_files/php/database.php");
echo '<div class="row slideInDown">
<div class="col-md-12 py-2 bg-white rounded-lg shadow-sm">
    <h5 class="my-3">CREATE PRODUCTS</h5>
    <form class="create-products-form">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="title" placeholder="ENTER PRODUCT TITLE" class="form-control mb-3" required="required">

            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <select class="form-control brands-name" name="brands" required="required">
                    <option>Choose Category</option>';
                    $get_data = "SELECT * FROM brands";
                    $response=$db->query($get_data);
                    if($response){
                        while($data = $response->fetch_assoc())
                        {
                            echo "<option c-name='".$data['category_name']."'>".$data['brands']."</option>";
                        }
                    }
                echo '</select>
            </div>
            <div class="col-md-12">
                <label for="description">DESCRIPTION</label>
                <textarea rows="10" class="form-control mb-3" id="description" name="description" required="required">
                </textarea>
                <div class="row">
                    <div class="col-md-6">
                    <label for="price" class="form-label">PRICE</label>
                    <input class="form-control mb-3" id="price" name="price" required="required">
                    </div>

                    <div class="col-md-6">
                    <label for="quatity" class="form-label">QUATITY</label>
                    <input class="form-control mb-3" id="quatity" name="quatity" required="required">
                    </div>
                </div>
                
            </div>
            <div class="col-md-12">
                <div class="row">

                    <div class="col-md-2" >
                    
                            <div class="file-input-wrapper mb-3 py-3 px-0">
                            <button class="btn btn-dark btn-file-input p-2">
                            <i class="fa fa-camera-retro" style="font-size:30px;"></i><br/>
                            <span class="text-center font-size">THUMB</span><br>
                            <span class="text-center font-size">250*316</span>
                            </button>
                            <input type="file" name="thumb" accept="image/*" id="thumb"/>
                            
                            </div>
                    </div>

                    <div class="col-md-2" >
                    
                    <div class="file-input-wrapper mb-3 py-3 px-0">
                            <button class="btn btn-dark btn-file-input p-2">
                            <i class="fa fa-camera-retro" style="font-size:30px;"></i><br/>
                            <span class="text-center font-size ">FRONT</span><br>
                            <span class="text-center font-size ">350*615</span>
                            </button>
                            <input type="file" name="front" accept="image/*" id="front"/>
                            
                            </div>
            </div>

            <div class="col-md-2" >
                    
            <div class="file-input-wrapper mb-3 py-3 px-0">
            <button class="btn btn-dark btn-file-input p-2">
            <i class="fa fa-camera-retro" style="font-size:30px;"></i><br/>
            <span class="text-center font-size ">BACK</span><br>
            <span class="text-center font-size ">315*615</span>
            </button>
            <input type="file" name="back" accept="image/*" id="top"/>
            
            </div>

               </div>


            <div class="col-md-2" >
                    
            <div class="file-input-wrapper mb-3 py-3 px-0">
            <button class="btn btn-dark btn-file-input p-2">
            <i class="fa fa-camera-retro" style="font-size:30px;"></i><br/>
            <span class="text-center font-size ">LEFT</span><br>
            <span class="text-center font-size ">350*615</span>
            </button>
            <input type="file" name="left" accept="image/*" id="left"/>
            
            </div>

               </div>


               <div class="col-md-2" >
                    
            <div class="file-input-wrapper mb-3 py-3 px-0">
            <button class="btn btn-dark btn-file-input p-2">
            <i class="fa fa-camera-retro" style="font-size:30px;"></i><br/>
            <span class="text-center font-size ">RIGHT</span><br>
            <span class="text-center font-size ">350*615</span>
            </button>
            <input type="file" name="right" accept="image/*" id="right"/>
            
            </div>

               </div>


            
            </div>
                <div class="col-md-10">
                    <button class="btn py-2 w-100">
                        <div class="progress">
                            <div class="progress-bar create-products-progess d-none"></div>
                        </div>
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-12 float-right">
                        <button type="submit" class="btn btn-danger float-right font-size px-3 py-2 mb-3 create-products-form">SUBMIT</button>
                    </div>
               </div>
        </div>
    </form>
</div>
</div>';
?>