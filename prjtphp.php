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

    // Prepare SQL statement based on livestock type
    if ($livestock_type == "cow") {
        $milk_per_day = $_POST["milk_per_day"];
        $stmt = $conn->prepare("INSERT INTO cow_selling (name, phone, address, age, amount, description, milk_per_day) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $name, $phone, $address, $age, $amount, $description, $milk_per_day);
    } elseif ($livestock_type == "buffalo") {
        $milk_per_day = $_POST["milk_per_day"];
        $stmt = $conn->prepare("INSERT INTO buffalo_selling (name, phone, address, age, amount, description, milk_per_day) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $name, $phone, $address, $age, $amount, $description, $milk_per_day);
    } elseif ($livestock_type == "goat") {
        $gender = $_POST["gender"];
        $stmt = $conn->prepare("INSERT INTO goat_selling (name, phone, address, age, amount, description, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $name, $phone, $address, $age, $amount, $description, $gender);
    } elseif ($livestock_type == "horse") {
        $gender = $_POST["gender"];
        $stmt = $conn->prepare("INSERT INTO horse_selling (name, phone, address, age, amount, description, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $name, $phone, $address, $age, $amount, $description, $gender);
    } else {
        // Handle other livestock types or display an error message
        echo "Invalid livestock type";
        exit;
    }

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
