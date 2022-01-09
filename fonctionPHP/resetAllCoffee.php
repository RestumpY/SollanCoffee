<?php
require '../db_connection.php';

    
$update = mysqli_query($db_connection, "UPDATE coffee SET totalCoffee = 0 WHERE totalCoffee> 0");


    
    if($update){
       header('Location: ../home.php');
    }
    else{
        echo "Sign up failed!(Something went wrong).";
    }



?>
