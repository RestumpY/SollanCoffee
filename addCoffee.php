<?php
require 'db_connection.php';

if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}

$id = $_SESSION['login_id'];

$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    header('Location: logout.php');
    exit;
}

$total = $user['totalCoffee'] + 1;
    
$update = mysqli_query($db_connection, "UPDATE users SET totalCoffee = $total WHERE google_id = '$user[google_id]'");


    
    if($update){
       header('Location: home.php');
        exit;
    }
    else{
        echo "Sign up failed!(Something went wrong).";
    }



?>
