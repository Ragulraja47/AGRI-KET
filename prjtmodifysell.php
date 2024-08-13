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
    $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement based on livestock type
    if ($livestock_type == "cow") {
        $milk_per_day = $_POST["milk_per_day"];
        $stmt = $conn->prepare("INSERT INTO cow_selling (name, phone, address, age, amount, description, milk_per_day, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $milk_per_day, $image_name, $certificate_name);
    } elseif ($livestock_type == "buffalo") {
        $milk_per_day = $_POST["milk_per_day"];
        $stmt = $conn->prepare("INSERT INTO buffalo_selling (name, phone, address, age, amount, description, milk_per_day, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $milk_per_day, $image_name, $certificate_name);
    } elseif ($livestock_type == "goat") {
        $gender = $_POST["gender"];
        $stmt = $conn->prepare("INSERT INTO goat_selling (name, phone, address, age, amount, description, gender, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $gender, $image_name, $certificate_name);
    } elseif ($livestock_type == "horse") {
        $gender = $_POST["gender"];
        $stmt = $conn->prepare("INSERT INTO horse_selling (name, phone, address, age, amount, description, gender, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $gender, $image_name, $certificate_name);
    } else {
        // Handle other livestock types or display an error message
        echo "Invalid livestock type";
        exit;
    }

    // Read image and health certificate files as binary and bind them to parameters
    $image_blob = file_get_contents($image_tmp_name);
    $certificate_blob = file_get_contents($certificate_tmp_name);

    // Execute statement
    if ($stmt->execute()) {
        // Upload image
        move_uploaded_file($image_tmp_name, "uploads/" . $image_name);
        // Upload health certificate
        move_uploaded_file($certificate_tmp_name, "uploads/" . $certificate_name);
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
