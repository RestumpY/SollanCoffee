<?php


require("../db_connection.php");


$query = "SELECT name, totalCoffee FROM users, coffee WHERE id = idUser
";
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
header('Content-Disposition: attachment; filename=SollanCoffee.csv');
$fp = fopen('php://output', 'w');
$delimiter = ";";
fputcsv($fp,array('Nom','TotalCoffee'),$delimiter);
if (count($users) > 0) {
    foreach ($users as $row) {
        
        fputcsv($fp, $row, $delimiter);
        
    }
}

?>
