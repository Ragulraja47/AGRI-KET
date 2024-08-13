<?php 

include "config.php";
$query = "SELECT * FROM biddings";

$result = mysqli_query($conn, $query);


$res = array();
while($row = mysqli_fetch_array($result)){
    $res[] = $row;
}

echo json_encode($res);
