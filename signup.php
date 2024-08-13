<?php
$username = $_POST["username"];
$password = $_POST["password"]; 
$email = $_POST["email"];

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "agriket";


$conn = new mysqli($servername,$usernamedb,$passworddb,$dbname);


if($conn->connect_error){
     die("Registration failed:".$conn->connect_error);
}
else{
    echo"Registred Sucessfully!!!";
}


// Here we want to give as per in the database table...
$stmt = $conn->prepare("INSERT INTO agriket.register(username,password,email) VALUES(?,?,?)");


// Here we want to give trhe variable name as per in the above POST Method....
$stmt->bind_param("sss",$username,$password,$email);

if($stmt->execute() === TRUE){
    echo"DB Updated Sucessfuly!";
    header("Location: login.html");
    exit();
}
else{
    echo"FAILED".$stmt->error;
}


?>