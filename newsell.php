<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $livestock_type = $_POST["livestock_type"];
    $age = $_POST["age"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Handle image upload
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_size = $_FILES["image"]["size"];
    $image_error = $_FILES["image"]["error"];

    // Handle health certificate upload
    $certificate_name = $_FILES["health_certificate"]["name"];
    $certificate_tmp_name = $_FILES["health_certificate"]["tmp_name"];
    $certificate_size = $_FILES["health_certificate"]["size"];
    $certificate_error = $_FILES["health_certificate"]["error"];

    // Here you would insert this data into your database
    // For example, you could use MySQLi or PDO to perform the database operation

    // Example using MySQLi
    $servername = "localhost";
    $usernamedb = "root";
    $passworddb = "";
    $dbname = "agriket";
    $conn = new mysqli($servername,$usernamedb,$passworddb,$dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL INSERT statement based on livestock type
    if ($livestock_type == "cow") {
        $stmt = $conn->prepare("INSERT INTO cow_table (name, phone, address, age, amount, description, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    } elseif ($livestock_type == "buffalo") {
        $stmt = $conn->prepare("INSERT INTO buffalo_table (name, phone, address, age, amount, description, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    } elseif ($livestock_type == "goat") {
        $stmt = $conn->prepare("INSERT INTO goat_table (name, phone, address, age, amount, description, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    } elseif ($livestock_type == "horse") {
        $stmt = $conn->prepare("INSERT INTO horse_table (name, phone, address, age, amount, description, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    } else {
        // Handle other livestock types or display an error message
        echo "Invalid livestock type";
        exit;
    }

    // Bind parameters and execute statement
    $stmt->bind_param("sssissss", $name, $phone, $address, $age, $amount, $description, $image_blob, $certificate_blob);

    // Read image file as binary and bind it to parameter
    $image_blob = file_get_contents($image_tmp_name);

    // Read health certificate file as binary and bind it to parameter
    $certificate_blob = file_get_contents($certificate_tmp_name);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If form is not submitted, redirect to homepage or display an error message
    header("Location: index.html");
    exit;
}
?>
