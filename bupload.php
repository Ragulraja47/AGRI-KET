<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$imageData = file_get_contents($_FILES['image']['tmp_name']);
$imageType = $_FILES['image']['type'];

$fileData = file_get_contents($_FILES['file']['tmp_name']);
$fileType = $_FILES['file']['type'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$bread = $_POST['bread'];
$milk_per_day = $_POST['milk_per_day'];
$amount = $_POST['amount'];
$description = $_POST['description'];

$stmt = $conn->prepare("INSERT INTO buff_selling (image_data, image_type, file_data, file_type, name, phone, address, bread, milk_per_day, amount, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $imageData, $imageType, $fileData, $fileType, $name, $phone, $address, $bread, $milk_per_day, $amount, $description);

if ($stmt->execute()) {
  echo "Form submitted successfully!";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
