
            <?php
            require_once("../../common_files/database/database.php");
            echo '<div class="row">';
            $dir = ['top-left','bottom-left','center','top-right','bottom-right'];
            $top_left_image = "../common_files/images/small_sample.png";
            $top_left_label = "";

            $bottom_left_image = "../common_files/images/small_sample.png";
            $bottom_left_label = "";

            $center_image = "../common_files/images/large_sample.png";
            $center_label = "";

            $top_right_image = "../common_files/images/small_sample.png";
            $top_right_label = "";

            $bottom_right_image = "../common_files/images/small_sample.png";
            $bottom_right_label = "";

            for($i=0;$i<count($dir);$i++)
            {
                $get_data = "SELECT * FROM category_showcase WHERE direction='$dir[$i]'";
                $response_get_data=$db->query($get_data);
                if($response_get_data)
                {
                    $data = $response_get_data->fetch_assoc();
                    if($dir[$i] == 'top-left')
                    {
                        if($response_get_data->num_rows !=0)
                        {
                            $top_left_image = "data:image/png;base64,".base64_encode($data['image']);
                            $top_left_label = $data['label'];
                        }
                    }
                    if($dir[$i] == 'bottom-left')
                    {
                        if($response_get_data->num_rows !=0){
                        $bottom_left_image = "data:image/png;base64,".base64_encode($data['image']);
                        $bottom_left_label = $data['label'];
                        }
                    }
                    if($dir[$i] == 'center')
                    {
                        if($response_get_data->num_rows !=0){
                        $center_image = "data:image/png;base64,".base64_encode($data['image']);
                        $center_label = $data['label'];
                        }
                    }
                    if($dir[$i] == 'top-right')
                    {
                        if($response_get_data->num_rows !=0){
                        $top_right_image = "data:image/png;base64,".base64_encode($data['image']);
                        $top_right_label = $data['label'];
                        }
                    }
                    if($dir[$i] == 'bottom-right')
                    {
                        if($response_get_data->num_rows !=0){
                        $bottom_right_image = "data:image/png;base64,".base64_encode($data['image']);
                        $bottom_right_label = $data['label'];
                        }
                    }
                }
            }
            ?>
              <?php echo '<div class="col-md-4">
                    <div class="position-relative">
                        <div class="btn-group shadow-sm border position-absolute" 
                        style="width: 327px;z-index:10;">
                            <button class="btn btn-dark position-relative">
                                <input type="file" accept="image/*" class="upload-icon position-absolute" 
                                style="width: 100%;height:100%;top:0;left:0;opacity:0"/>
                                <i class="fa fa-upload"></i>
                            </button>
                            <button class="btn">
                                <input type="text" class="form-control upload-label"
                                placeholder="Mobile" value="';?><?php echo $top_left_label; ?><?php echo'"/>
                            </button>
                            <button class="btn btn-dark set-btn" disabled="disabled" 
                            img-dir="top-left">
                                SET
                            </button>
                        </div>
                        <img src="';?><?php echo $top_left_image; ?><?php echo '" alt="small sample" 
                        class="w-100 mb-3" />
                    </div>
                    <div class="position-relative">
                        <div class="btn-group shadow-sm border position-absolute" 
                        style="width: 327px;z-index:10;">
                        <button class="btn btn-dark position-relative">
                                <input type="file" accept="image/*" class="upload-icon position-absolute" 
                                style="width: 100%;height:100%;top:0;left:0;opacity:0"/>
                                <i class="fa fa-upload"></i>
                            </button>
                            <button class="btn">
                                <input type="text" class="form-control upload-label"
                                placeholder="Mobile" value="';?><?php echo $bottom_left_label; ?><?php echo'"/>
                            </button>
                            <button class="btn btn-dark set-btn" disabled="disabled"
                            img-dir="bottom-left">
                                SET
                            </button>
                        </div>
                        <img src="';?><?php echo $bottom_left_image; ?><?php echo'" alt="small sample" 
                    class="w-100"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="btn-group shadow-sm border position-absolute" 
                        style="width: 327px;z-index:10;">
                            <button class="btn btn-dark position-relative">
                                <input type="file" accept="image/*" class="upload-icon position-absolute" 
                                style="width: 100%;height:100%;top:0;left:0;opacity:0"/>
                                <i class="fa fa-upload"></i>
                            </button>
                            <button class="btn">
                                <input type="text" class="form-control upload-label"
                                placeholder="Mobile" value="';?><?php echo $center_label; ?><?php echo'"/>
                            </button>
                            <button class="btn btn-dark set-btn" disabled="disabled" 
                            img-dir="center">
                                SET
                            </button>
                        </div>
                        <img src="';?><?php echo $center_image; ?><?php echo'" alt="large sample" 
                    class="w-100 mb-3"/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative">
                        <div class="btn-group shadow-sm border position-absolute" 
                        style="width: 327px;z-index:10;">
                            <button class="btn btn-dark position-relative">
                                <input type="file" accept="image/*" class="upload-icon position-absolute" 
                                style="width: 100%;height:100%;top:0;left:0;opacity:0"/>
                                <i class="fa fa-upload"></i>
                            </button>
                            <button class="btn">
                                <input type="text" class="form-control upload-label"
                                placeholder="Mobile" value="';?><?php echo $top_right_label; ?><?php echo'"/>
                            </button>
                            <button class="btn btn-dark set-btn" disabled="disabled" 
                            img-dir="top-right">
                                SET
                            </button>
                        </div>
                        <img src="';?><?php echo $top_right_image; ?><?php echo'" alt="small sample" 
                        class="w-100 mb-3"/>
                    </div>
                    <div class="position-relative">
                        <div class="btn-group shadow-sm border position-absolute" 
                        style="width: 327px;z-index:10;">
                            <button class="btn btn-dark position-relative">
                                <input type="file" accept="image/*" class="upload-icon position-absolute" 
                                style="width: 100%;height:100%;top:0;left:0;opacity:0"/>
                                <i class="fa fa-upload"></i>
                            </button>
                            <button class="btn">
                                <input type="text" class="form-control upload-label"
                                placeholder="Mobile" value="';?><?php echo $bottom_right_label; ?><?php echo'"/>
                            </button>
                            <button class="btn btn-dark set-btn" disabled="disabled" 
                            img-dir="bottom-right">
                                SET
                            </button>
                        </div>
                        <img src="';?><?php echo $bottom_right_image; ?><?php echo'" alt="small sample" 
                    class="w-100"/>
                    </div>
                </div>
            </div>
        </div>';?>
