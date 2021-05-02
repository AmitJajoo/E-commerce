<?php
require_once("../../common_files/php/database.php");
echo '<div class="row">
<div class="col-md-4 p-4 bg-white rounded-lg shadow-sm">
    <form class="header-showcase-form">
        <div class="form-group">
            <label for="title-image">Title Image 
            <span>(200kb 1920*978)</span></label>
            <input type="file" required="required" accept="image/*" name="title-image"
             id="title-image"
            class="form-control-file"/>

        </div>

        <div class="form-group">
            <label for="title-text">Title Text
            <span class="title-limit">0</span><span>/40</span>
            </label>
            <textarea class="form-control" maxlength="40" required="required"
             rows="1" id="title-text" name="title-text"></textarea>
        </div>

        <div class="form-group">
            <label for="subtitle-text">Subtitle Text 
                <span class="subtitle-limit">0</span><span>/100</span>
            </label>
            <textarea class="form-control" maxlength="100" required="required"
             rows="5" id="subtitle-text" name="subtitle-text"></textarea>
        </div>

        <div class="form-group">

            <label for="create-button">Create buttons</label>
            <i class="fa fa-trash close delete-btn d-none"></i>
            <div id="create-button" class="input-group mb-2">
                <input type="url" name="btn-url" class="form-control btn-url"
                placeholder="https:google.com"/>
                <input type="text" name="btn-name" class="form-control btn-name"
                placeholder="Button 1"/>
            </div>

            <div class="input-group  mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">BG COLOR</span>
                </div>
                <input type="color" name="btn-bgcolor" 
                class="form-control btn-bgcolor"/>

                <div class="input-group-prepend">
                    <span class="input-group-text">TEXT COLOR</span>
                </div>
                <input type="color" name="btn-textcolor" 
                class="form-control btn-textcolor"/>
            </div>

            <div class="input-group  mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">SIZE</span>
                </div>
                <select  class="form-control btn-size">
                    <option value="16px">Small</option>
                    <option value="20px">Medium</option>
                    <option value="24px">Large</option>
                </select>

                <div class="input-group-append add-btn">
                    <span class="input-group-text text-white bg-danger"
                    style="cursor: pointer;">
                        Add
                    </span>
                </div>
            </div>

        </div>
        <div class="form-group">
            <button class="py-2 btn btn-primary add-showcase" type="submit"
            >Add Showcase</button>
            <button class="py-2 btn btn-primary real-preview-btn" type="button"
            >Real Preview</button>
        </div>
        <div class="form-group">
        <label for="edit-title">Edit Title</label>
        <i class="fa fa-trash delete-title close d-none"></i>
        <select class="form-control" id="edit-title">
            <option>Choose Title</option>'; ?>
            <?php 
                $get_table_header_show = "SELECT * FROM header_showcase";
                $response_header_show = $db->query($get_table_header_show);
                if($response_header_show){
                    $count = 0 ;
                    while($data=$response_header_show->fetch_assoc()){
                        $count+=1;
                        echo "<option value=".$data['id'].">".$count."</option>";
                    }
                }
            ?>
        <?php echo'</select>
        </div>
    </form>
</div>
<div class="col-md-1"></div>
<div class="col-md-7 p-4 bg-white rounded-lg shadow-sm positive-relative 
showcase-preview" style="display: flex;height:340px;">
    <div class="title-box">
        <h1 class="showcase-title target">TITLE</h1>
        <h4 class="showcase-subtitle target">SUBTITLE</h4>
        <div class="title-button my-3"></div>
    </div>
    <div class="showcase-formating d-flex justify-content-around
    align-items-center">
    <div class="btn-group">
        <button class="btn btn-light">Color</button>
        <button class="btn btn-light">
            <input type="color" class="color-selector" name="color-selector"/>
        </button>
    </div> 
    
    <div class="btn-group">
        <button class="btn btn-light">Font Size</button>
        <button class="btn btn-light">
            <input type="range" min="100" max="500" class="font-size"
             name="font-size"/>
        </button>
    </div> 

    <div class="btn-group">
        <button class="btn btn-light dropdown-toggle" data-toggle="dropdown">
        <span>Alignment</span>
            <div class="dropdown-menu">
                <span class="dropdown-item alignment" align-position="h"
                align-value="flex-start">LEFT</span>
                <span class="dropdown-item alignment" align-position="h"
                align-value="center">CENTER</span>
                <span class="dropdown-item alignment" align-position="h"
                align-value="flex-end">RIGHT</span>
                <span class="dropdown-item alignment"  align-position="v"
                align-value="flex-start">TOP</span>
                <span class="dropdown-item alignment" align-position="v"
                align-value="center">V-CENTER</span>
                <span class="dropdown-item alignment"  align-position="v"
                align-value="flex-end">BOTTOM</span>
            </div>
        </button>

    </div>
    
    </div>
</div>

</div>';
?>