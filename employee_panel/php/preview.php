<?php
    $photo=$_FILES['photo'];
    
    $con=file_get_contents($photo['tmp_name']);
    $en=base64_encode($con);
    $image_src='data:image/png;base64,'.$en;

    $json_data  = json_encode($_POST['data_123']);
    $tmp_data  = json_decode($json_data,true);
    $all_data = json_decode($tmp_data,true);
 
    // session_start();
    // $title = $_SESSION['title-box'];
    // $text=$json[0];
    // $h_align = $json[1];
    // $v_align = $json[2];
    
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

    <title>Document</title>
</head>
<body>
<div class="container-fluid p-0">
<div class="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" >
   <img src="<?php echo $image_src; ?>" style="width: 100%;"/>
      <div class="carousel-caption h-100"  style="display:flex;justify-content: <?php echo $all_data['h_align']; ?>;
    align-items:<?php echo $all_data['v_align']; ?>">
      <div>    
        <?php echo $all_data['title_box']; ?>
      </div>
      </div>
    </div>
    
  </div>
</div>
</div>
    
     <!-- bootstrap js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>