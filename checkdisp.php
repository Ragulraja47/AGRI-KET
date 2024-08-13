<?php
// Check if the ID was provided (for example, via a GET request)
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert the ID to an integer for safety

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "agriket";

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch the specific record based on the ID
    $sql = "SELECT * FROM cow_selling WHERE id = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("31", $id); // Bind the ID to the query
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the specific record
        $row = $result->fetch_assoc();

        // Display the details
        echo "<h1>Animal Selling Details</h1>";
        echo "<p><strong>ID:</strong> " . $row["id"] . "</p>";
        echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
        echo "<p><strong>Phone:</strong> " . $row["phone"] . "</p>";
        echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
        echo "<p><strong>Age:</strong> " . $row["age"] . "</p>";
        echo "<p><strong>Amount:</strong> " . $row["amount"] . "</p>";
        echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";
        
        // Display the image if it exists
        if (!empty($row["image"])) {
            $imageData = base64_encode($row["image"]);
            echo "<p><strong>Image:</strong> <img src='data:image/jpeg;base64,$imageData' alt='Cow Image' style='max-width:200px;'></p>";
        } else {
            echo "<p>No Image</p>";
        }

    } else {
        echo "No record found with ID $id"; // Handle cases where the ID doesn't exist
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo "No ID provided"; // Handle cases where no ID is given
}
?>
