<?php
// Fetching data from the cow_selling table for display in another HTML file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agriket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select all values from the cow_selling table
$sql = "SELECT * FROM cow_selling";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    // Fetch associative array of the result
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No records found";
}

// Close connection
$conn->close();

// Pass the data to the HTML file
$data_json = json_encode($data);
?>


