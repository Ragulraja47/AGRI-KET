<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"]) && isset($_FILES["health_certificate"])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $livestock_type = $_POST["livestock_type"];
    $age = $_POST["age"];
    $amount = $_POST["amount"];
    $description = $_POST["description"];

    // Database connection details
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

    // Prepare the image data
    $image = file_get_contents($_FILES["image"]["tmp_name"]);
    $health_certificate = file_get_contents($_FILES["health_certificate"]["tmp_name"]);

    // Insert the image data into the database
    $sql = "";
    switch ($livestock_type) {
        case "cow":
        case "buffalo":
            $milk_per_day = $_POST["milk_per_day"];
            $sql = "INSERT INTO cow_selling (name, phone, address, age, amount, description, milk_per_day, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $milk_per_day, $image, $health_certificate);
            break;
        case "goat":
        case "horse":
            $gender = $_POST["gender"];
            $sql = "INSERT INTO ".$livestock_type."_selling (name, phone, address, age, amount, description, gender, image, health_certificate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssisssss", $name, $phone, $address, $age, $amount, $description, $gender, $image, $health_certificate);
            break;
        default:
            echo json_encode(["msg" => "Invalid livestock type"]);
            exit;
    }

    if ($stmt->execute()) {
        echo json_encode(["msg"=>"Images uploaded successfully"]);
    } else {
        echo json_encode(["msg"=>"Error uploading images: " . $stmt->error]);
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
