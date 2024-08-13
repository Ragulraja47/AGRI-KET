<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Selling Records</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Animal Selling Records</h1>
    <div class="container">
        <?php
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

// Fetch records from the appropriate table based on livestock type
$query = "SELECT * FROM cow_selling";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='animal'>";
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p>Phone: " . $row["phone"] . "</p>";
        echo "<p>Address: " . $row["address"] . "</p>";
        echo "<p>Age: " . $row["age"] . "</p>";
        echo "<p>Amount: " . $row["amount"] . "</p>";
        echo "<p>Description: " . $row["description"] . "</p>";
        echo "<p>Milk per Day: " . $row["milk_per_day"] . "</p>";
        // Display image
        echo "<img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' />";
        // Display health certificate (assuming it's a PDF)
        echo "<embed src='data:application/pdf;base64," . base64_encode($row["health_certificate"]) . "' width='300' height='200'>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

    </div>
</body>
</html>
