<?php

// Database connection parameters
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "agriket";
$conn = new mysqli($servername,$usernamedb,$passworddb,$dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $livestock_type = $_POST["livestock_type"];
    $milk_per_day = isset($_POST["milk_per_day"]) ? $_POST["milk_per_day"] : null;
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
    $age = $_POST["age"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Check livestock type and insert data into corresponding table
    if ($livestock_type === "cow") {
        // Insert data into cow table
        $stmt = $conn->prepare("INSERT INTO cow_selling (name, phone, address, livestock_type, age, amount, description) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
    } else if ($livestock_type === "buffalo") {
        // Insert data into buffalo table
        $stmt = $conn->prepare("INSERT INTO buffalo_selling (name, phone, address, livestock_type,  age, amount, description) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
    } else if ($livestock_type === "goat") {
        // Insert data into goat table
        $stmt = $conn->prepare("INSERT INTO goat_selling (name, phone, address, livestock_type, age, amount, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    } else if ($livestock_type === "horse") {
        // Insert data into horse table
        $stmt = $conn->prepare("INSERT INTO horse_selling (name, phone, address, livestock_type, age, amount, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
    } else {
        echo "Invalid livestock type.";
        exit; // Stop further execution
    }

    // Bind parameters
    if ($stmt) {
        if ($livestock_type === "cow") {
            $stmt->bind_param("ssssisd", $name, $phone, $address, $livestock_type,   $age, $amount, $description);
        } else if ($livestock_type === "buffalo") {
            $stmt->bind_param("ssssisd", $name, $phone, $address, $livestock_type,  $age, $amount, $description);
        } else if ($livestock_type === "goat") {
            $stmt->bind_param("ssssid", $name, $phone, $address, $livestock_type, $age, $amount, $description);
        } else if ($livestock_type === "horse") {
            $stmt->bind_param("ssssid", $name, $phone, $address, $livestock_type, $age, $amount, $description);
        }

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        echo "Error: Unable to prepare statement.";
    }
    header("Location: thank_you.php");
exit;
    
    // Close connection
    $conn->close();
}
?>
