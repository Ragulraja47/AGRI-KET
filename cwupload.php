<?php
session_start();

if(isset($_FILES['image']) && isset($_FILES['file']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['bread']) && isset($_POST['milk_per_day']) && isset($_POST['amount']) && isset($_POST['description'])) {

    // Image
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_data = file_get_contents($image_tmp);
    $image_type = mime_content_type($image_tmp);

    // File
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_data = file_get_contents($file_tmp);
    $file_type = mime_content_type($file_tmp);

    // Other data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bread = $_POST['bread'];
    $milk_per_day = $_POST['milk_per_day'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agriket";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO buff_selling (image_data, image_type, file_data, file_type, name, phone, address, bread, milk_per_day, amount, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $image_data, $image_type, $file_data, $file_type, $name, $phone, $address, $bread, $milk_per_day, $amount, $description);

    if($stmt->execute()) {
        echo "Data uploaded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
