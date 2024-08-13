<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriket";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$buyerName = $_POST['buyerName'];
$buyerPhone = $_POST['buyerPhone'];
$buyerAddress = $_POST['buyerAddress'];

// Insert buyer details into the database
$insert_sql = "INSERT INTO buyers (name, phone, address) VALUES (?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sss", $buyerName, $buyerPhone, $buyerAddress);
$insert_stmt->execute();

// Close database connection
$conn->close();

echo 'Buyer details stored successfully!';
?>
