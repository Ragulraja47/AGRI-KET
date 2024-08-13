<?php
require 'vendor/autoload.php';

use Twilio\Rest\Client;

// Twilio credentials
$account_sid = 'your_account_sid';
$auth_token = 'your_auth_token';
$twilio_number = 'your_twilio_number';

$buyerName = $_POST['buyerName'];
$buyerPhone = $_POST['buyerPhone'];
$buyerAddress = $_POST['buyerAddress'];
$sellerId = $_POST['sellerId'];
$sellerPhone = $_POST['sellerPhone'];

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

// Insert buyer details into the database
$insert_sql = "INSERT INTO buyers (name, phone, address) VALUES (?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sss", $buyerName, $buyerPhone, $buyerAddress);
$insert_stmt->execute();

// Retrieve seller details from the database
$seller_sql = "SELECT name, phone, address FROM cow_selling WHERE id = ?";
$seller_stmt = $conn->prepare($seller_sql);
$seller_stmt->bind_param("i", $sellerId);
$seller_stmt->execute();
$seller_result = $seller_stmt->get_result();

if($seller_result->num_rows > 0) {
    $row = $seller_result->fetch_assoc();
    $sellerName = $row['name'];
    $sellerAddress = $row['address'];

    // Create Twilio client
    $client = new Client($account_sid, $auth_token);

    // Send message to buyer
    $buyerMessage = "Owner of the Livestock:\nName: $sellerName\nPhone: $sellerPhone\nAddress: $sellerAddress";
    $client->messages->create(
        $buyerPhone,
        array(
            'from' => $twilio_number,
            'body' => $buyerMessage
        )
    );

    // Send message to seller
    $sellerMessage = "Buyer Details:\nName: $buyerName\nPhone: $buyerPhone\nAddress: $buyerAddress";
    $client->messages->create(
        $sellerPhone,
        array(
            'from' => $twilio_number,
            'body' => $sellerMessage
        )
    );

    echo 'Messages sent successfully!';
} else {
    echo 'Seller not found.';
}

// Close database connection
$conn->close();
?>
