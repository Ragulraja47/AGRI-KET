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

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- Fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- Responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
    .container-custom {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        background-color: #fff;
    }
    .left-grid, .right-grid {
        flex: 1;
        padding: 20px;
        box-sizing: border-box;
        min-width: 300px;
    }
    .customer-details, .livestock-details, .description, .health-certificate, .amount {
        background-color: #ffffff;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .customer-details h3, .livestock-details h3, .description h3, .health-certificate h3, .amount {
        color: #000000;
        margin-top: 0;
    }
    .buy-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .amount {
        font-weight: bold;
        font-size: 18px;
    }
    @media (max-width: 768px) {
        .container-custom {
            flex-direction: column;
        }
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section starts -->
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
              <ul class="navbar-nav">
                
                <li class="nav-item">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="sellDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Maintenance
                  </a>
                  <div class="dropdown-menu" aria-labelledby="sellDropdown">
                    <a class="dropdown-item" href="maintain.html">Hen</a>
                    <a class="dropdown-item" href="cowmaintain.html">Cow\Buffalo</a>
                    <a class="dropdown-item" href="horsemaintain.html">Horse</a>
                    <a class="dropdown-item" href="goatmaintain.html">Goat</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="doctor.html">Doctors</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="sellDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Selling
                  </a>
                  <div class="dropdown-menu" aria-labelledby="sellDropdown">
                    <a class="dropdown-item" href="cwselling.html">Cow</a>
                    <a class="dropdown-item" href="bsell.html">Buffalo</a>
                    <a class="dropdown-item" href="hsell.html">Horse</a>
                    <a class="dropdown-item" href="gsell.html">Goat</a>
                  </div>
                </li>
                <li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" id="sellDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Buying
                  </a>
                  <div class="dropdown-menu" aria-labelledby="sellDropdown">
                    <a class="dropdown-item" href="cwdisplay.php">Cow</a>
                    <a class="dropdown-item" href="bdisplay.php">Buffalo</a>
                    <a class="dropdown-item" href="hdisplay.php">Horse</a>
                    <a class="dropdown-item" href="gdisplay.php">Goat</a>
                  </div>
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
    
    <h2>Uploaded Data</h2>
    <?php
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

    // Retrieve all uploaded data from the database
    $sql = "SELECT id, image_data, image_type, file_data, file_type, name, phone, address, bread, milk_per_day, amount, description FROM cow_selling";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        // Output each uploaded data
        while($row = $result->fetch_assoc()) {
            $image_data = $row['image_data'];
            $image_type = $row['image_type'];
            $base64_image = base64_encode($image_data);
            $image_src = "data:$image_type;base64,$base64_image";

            // Customer details
            $seller_id = $row['id'];
            $name = $row['name'];
            $phone = $row['phone'];
            $address = $row['address'];

            // Livestock details
            $bread = $row['bread'];
            $milk_per_day = $row['milk_per_day'];
            $amount = $row['amount'];
            $description = $row['description'];

            // Display
            echo "<div class='container-custom'>";
            echo "<div class='left-grid'>";
            echo "<img src='$image_src' alt='Uploaded Image' style='max-width: 100%;'><br>";
            echo "<div class='health-certificate'>";
            echo "<h3>Health Certificate</h3>";
            $file_data = $row['file_data'];
            $file_type = $row['file_type'];
            $base64_file = base64_encode($file_data);
            $file_src = "data:$file_type;base64,$base64_file";
            echo "<a href='$file_src' download>Download File</a><br>";
            echo "</div>";
            echo "</div>";
            echo "<div class='right-grid'>";
            echo "<div class='customer-details'>";
            echo "<h3>Customer Details</h3>";
            echo "Name: $name<br>";
            echo "Phone: $phone<br>";
            echo "Address: $address<br>";
            echo "</div>";
            echo "<div class='livestock-details'>";
            echo "<h3>Livestock Details</h3>";
            echo "Breed: $bread<br>";
            echo "Milk per day: $milk_per_day<br>";
            echo "Amount: $amount<br>";
            echo "</div>";
            echo "<div class='description'>";
            echo "<h3>Description</h3>";
            echo "$description<br>";
            echo "</div>";
            echo "<div class='amount'>";
            echo "Amount: $amount<br>";
            echo "</div>";
            echo "<button class='buy-button' data-seller-id='$seller_id' data-seller-phone='$phone'>BUY</button>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "No data uploaded.";
    }

    // Close database connection
    $conn->close();
    ?>

    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="buyModalLabel">Enter Your Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="buyerForm">
              <div class="form-group">
                <label for="buyerName">Name</label>
                <input type="text" class="form-control" id="buyerName" required>
              </div>
              <div class="form-group">
                <label for="buyerPhone">Phone Number</label>
                <input type="text" class="form-control" id="buyerPhone" required>
              </div>
              <div class="form-group">
                <label for="buyerAddress">Address</label>
                <textarea class="form-control" id="buyerAddress" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
    $(document).ready(function() {
      $('.buy-button').click(function() {
        var sellerId = $(this).data('seller-id');
        var sellerPhone = $(this).data('seller-phone');
        $('#sellerId').val(sellerId);
        $('#sellerPhone').val(sellerPhone);
        $('#buyModal').modal('show');
      });

      $('#buyerForm').submit(function(event) {
        event.preventDefault();

        var buyerName = $('#buyerName').val();
        var buyerPhone = $('#buyerPhone').val();
        var buyerAddress = $('#buyerAddress').val();

        $.ajax({
          url: 'store_buyer.php',
          method: 'POST',
          data: {
            buyerName: buyerName,
            buyerPhone: buyerPhone,
            buyerAddress: buyerAddress
          },
          success: function(response) {
            alert('Buyer details stored successfully!');
            $('#buyModal').modal('hide');
          },
          error: function(xhr, status, error) {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
</body>
</html>
