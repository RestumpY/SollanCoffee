<?php
require '../db_connection.php';

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


    
$update = mysqli_query($db_connection, "UPDATE coffee SET totalCoffee = totalCoffee + 1 WHERE idUser = '$user[id]'");



    
    if($update){
       header('Location: ../home.php');
       $_SESSION['style'] = 1 ;

        exit;
    }
    else{
        echo "Sign up failed!(Something went wrong).";
    }



?>
