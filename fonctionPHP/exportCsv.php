<?php


require("../db_connection.php");

$id = $_SESSION['login_id'];


$query = "SELECT name, totalCoffee FROM users, coffee WHERE id = idUser";
if (!$result = mysqli_query($db_connection, $query)) {
    exit(mysqli_error($db_connection));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}


$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}

if ($user['type']!= NULL){

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=SollanCoffee.csv');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
$fp = fopen('php://output', 'w');
$delimiter = ";";
fputcsv($fp,array('Prénom/Nom','Total de café'),$delimiter);
if (count($users) > 0) {
    foreach ($users as $row) {
        
        fputcsv($fp, $row, $delimiter);
        
    }
}
}else{
    header('Location : home.php');
    exit;
}

?>
