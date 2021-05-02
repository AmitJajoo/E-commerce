<?php
require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$password = md5($_POST['password']);
$check_user = "SELECT * FROM users WHERE email='$email'";
$response = $db->query($check_user);
if($response->num_rows != 0){
    $data = $response->fetch_assoc();
    $status = $data['status'];
    $real_email = $data['email'];
    $real_password = $data['password'];
    if($real_email == $email && $real_password == $password)
    {
        if($status == "pending")
        {
            require("resend_otp.php");
        }
        else
        {
            session_start();
            $_SESSION['username'] = $email;
            $cookie_data = base64_encode($email);
            $cookie_time = time()+31536000;
            setcookie('_au_',$cookie_data,$cookie_time,'/');
            echo "login success";
        }
    }
    else
    {
        echo "Wrong email or password";
    }
}
else{
    echo "Please create an account";
}
?>