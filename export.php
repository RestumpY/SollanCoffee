<?php
/*
// Database Connection
require("db_connection.php");

// get Users
$query = "SELECT name, totalCoffee FROM users";
if (!$result = mysqli_query($db_connection, $query)) {
    exit(mysqli_error($db_connection));
}



$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$fp = fopen('php://output', 'w');

fputcsv($fp,array('Nom',';TotalCoffee'));
if (count($users) > 0) {
    foreach ($users as $row) {
        
        fputcsv($fp, $row);
        
    }
}
*/
?>
