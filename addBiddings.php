<?php 
include "config.php";
$Name = $_POST["Name"];
$Amount = $_POST["amount"];
$Number = $_POST["number"];
$query = "INSERT INTO biddings (Name,amount,number) VALUES ('$Name','$Amount','$Number')";
if(mysqli_query($conn,$query)){
    $res = ["status"=>200,
    
    "msg"=>"bidding made successfully"];
    echo  json_encode($res);
}
else{
    $res = ["status"=>500,
    "msg"=>"bidding failed"];
    echo  json_encode($res);
}


