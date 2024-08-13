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
                
                <li class="nav-item ">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="disease.html"> Disease</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="doctor.html">Doctors</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="selllogo.html"> Selling </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="buylogo.html"> Buying</a>
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
       

        /* Styling for the doctor list container */
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        h2 {
            color: #5D6975;
            border-bottom: 2px solid #5D6975;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* Paragraph styling */
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        /* Styling for individual doctor entries */
        .doctor-entry {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-left: 5px solid #7D3C98;
            transition: all 0.3s ease;
        }

        /* Hover effect for doctor entries */
        .doctor-entry:hover {
            background: #e9e9e9;
            border-left-color: #5B2C6F;
        }

        /* Styling for the phone number to make it stand out */
        .phone-number {
            display: block;
            background: #7D3C98;
            color: #fff;
            text-align: center;
            padding: 5px;
            margin-top: 10px;
        }

        /* Horizontal rule styling */
        hr {
            border: none;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- search_doctors.php -->
        <?php
        // Connect to MySQL database (replace with your actual database credentials)
        $servername = "localhost";
        $usernamedb = "root";
        $passworddb = "";
        $dbname = "agriket";
        $conn = new mysqli($servername,$usernamedb,$passworddb,$dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user input
        $state = $_POST['state'];
        $district = $_POST['district'];

        // Query the database for doctors in the specified district
        $sql = "SELECT * FROM doctors WHERE state = ? AND district = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $state, $district);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the results
        if ($result->num_rows > 0) {
            echo "<h2>Doctors in " . htmlspecialchars($district) . ", " . htmlspecialchars($state) . ":</h2>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='doctor-entry'>";
                echo "<p>Name: " . htmlspecialchars($row['doctor_name']) . "</p>";
                echo "<p>Experience: " . htmlspecialchars($row['experience']) . " years</p>";
                echo "<p>Place: " . htmlspecialchars($row['place']) . "</p>";
              
                echo "<p class='phone-number'>Phone Number: <a href='https://wa.me/" . htmlspecialchars($row['phone_number']) . "' target='_blank'>" . htmlspecialchars($row['phone_number']) . "</a></p>";
                // Chat button
              
                
                
            
                echo "</div>";
            }
        } else {
            echo "<p>No doctors found in " . htmlspecialchars($district) . ", " . htmlspecialchars($state) . ".</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

   
</body>
</html>
