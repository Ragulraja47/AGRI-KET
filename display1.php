<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <title>Agri-Ket</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <div class="hero_bg_box">
      <div class="img-box">
        <img src="wall1.png" alt="">
      </div>
    </div>

    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="contact_link-container">
            
            </a>
            <a href="" class="contact_link2">
              
            <a href="" class="contact_link3">
             
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="index.html">
              <span>
                AGRI-KET
              </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse ml-auto" id="navbarSupportedContent">
              <ul class="navbar-nav  ">
                
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Home </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="disease.html"> Disease</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="doctor.html">Doctors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="selllogo.html"> Buying</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="selling.html"> Selling </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="auction.html"> Auction </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.html">Logout</a>
                </li>
               
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 100px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border: 2px solid #ccc;
        overflow: hidden;
    }
    .treatment {
        text-align: center;
        font-size: 20px;
        line-height: 1.6;
        padding: 20px;
        color: #333;
    }
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        margin-top: 20px;
    }
    .btn:hover {
        background-color: #45a049;
    }
    /* Additional CSS */
    .header {
        text-align: center;
        margin-bottom: 30px;
    }
    .header h1 {
        color: #333;
        font-size: 32px;
        margin: 0;
    }
    .footer {
        text-align: center;
        margin-top: 20px;
        color: #888;
        font-size: 14px;
    }
</style>
</head>
<body>
<div class="container">
    <?php
    // Establish a database connection (replace placeholders with actual credentials)
    $db = mysqli_connect("localhost", "root", "", "agriket");
    if (!$db) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Get the disease ID from the form submission
    $id = $_POST['id'];
    $id = mysqli_real_escape_string($db, $id); // Sanitize the input

    // Retrieve the treatment for the specified disease
    $query = "SELECT treatment FROM diseaset WHERE id='$id'";
    $result = mysqli_query($db, $query);

    // Fetch the treatment
    if ($row = mysqli_fetch_assoc($result)) {
        $treatment = $row['treatment'];
    } else {
        $treatment = "No treatment found for the given ID.";
    }

    // Close the database connection
    mysqli_close($db);
    ?>
    <div class="header">
        <h1>Disease Treatment</h1>
    </div>
    <div class="treatment">
        <p>Treatment: <?php echo $treatment; ?></p>
    </div>
    <div style="text-align: center;">
        <a href="doctor.html" class="btn">Contact Doctor</a>
    </div>
    <div class="footer">
        &copy; 2024 Agri