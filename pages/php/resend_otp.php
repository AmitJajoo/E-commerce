<?php
session_start();
$email = $_POST['email'];
$random = "0123456789";
            $length = strlen($random)-1;
            $otp = [];
            $i;
            for($i=0;$i<6;$i++){
                $indexing_number=rand(0,$length);
                $otp[] = $random[$indexing_number];
            }
            $otp = implode($otp);
            $_SESSION['otp']=$otp;
            if(mail($email,"Welcome to Shop","Your OTP is ".$otp))
            {
                echo "success";
            }else{
                echo "Can't send verification code";
            }
?>