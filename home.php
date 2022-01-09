<?php
require 'db_connection.php';

if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}
$date = new DateTime('now');
$id = $_SESSION['login_id'];



$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);

}
else{
    header('Location: logout.php');
    exit;
}

if (isset($_SESSION['style'])){
    $style = "display : block;";

}
else{

    $style = "display : none;";
}

$get_coffee = mysqli_query($db_connection, "SELECT * FROM `coffee` WHERE idUser = '$user[id]'");
if(mysqli_num_rows($get_coffee) > 0){
    $coffee = mysqli_fetch_assoc($get_coffee);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $user['name']; ?></title>

</head>

<body>
    <div id="notif" class="_notif" style="<?php echo $style;?>">
        Votre café à bien été ajouté !
    </div>
    <br>
    <div class="_container">

        <div class="_img">
            <img src="<?php echo $user['profile_image'];?>"></img>
        </div>

        <div class="_info">

            <p><?php echo $date->format( 'd/m/Y' );?></p>
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>

            <a style="background-color : green;" href="fonctionPHP/addCoffee.php">+1 <i class="fas fa-coffee"></i></a>
            <a style="background-color : #E53E3E;" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>

            <br>

            <h4>Vous avez bu : <?php echo  $coffee['totalCoffee']; ?> cafés ! </h4>
            <p>Solde : <?php echo number_format($coffee['totalCoffee']*0.35,2); ?>€</p>
            <!--<img src="css/sollan.png" style="width:50px;"></img>-->


        </div>
        <center>
            <a style="color : black;" href="fonctionPHP/exportCsv.php">
                <i class="fas fa-file-download"></i></a>
                <a style="color : red;" href="fonctionPHP/resetAllCoffee.php"><i class="fas fa-redo"></i></a>

        </center>
    </div>
    <script>
        function pasNotif() {
            var div = document.getElementById('notif');
            div.style.display = 'none';
        }

        setInterval(pasNotif, 2000);
    </script>
</body>

</html>