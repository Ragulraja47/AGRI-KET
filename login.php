<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #D4E6F1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $username = $_POST["username"];
        $password = $_POST["password"]; 

        $conn = new mysqli("localhost", "root", "", "agriket");

        if($conn->connect_error){
            die("LOGIN failed:".$conn->connect_error);
        }
       
        $stmt = $conn->prepare("SELECT * FROM agriket.register WHERE username=? and password=?");
        $stmt->bind_param("ss", $username, $password);

        if($stmt->execute() === TRUE){
            $res = $stmt->get_result();
            if($res->num_rows > 0){
                echo "<h1>Login Successful!</h1>";
                header("location: index.html");
                exit();
            }
            else{
                echo "<h1>Login Failed</h1>";
                echo "<p>No user found. <a href='login.html'>Try again</a></p>";
            }
        }
        else{
            echo "<h1>Error</h1>";
            echo "<p>Selection FAILED: ".$stmt->error."</p>";
        }
        ?>
    </div>
</body>
</html>