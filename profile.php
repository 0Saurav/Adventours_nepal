<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
   header('Location: login_form.php');
   exit();
}
// Get the user's name from the session
$userName = $_SESSION['user_name'];

// Establish a database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adventours_nepal';
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the user's email from the database
$selectEmail = "SELECT email FROM user_form WHERE name = '$userName'";
$resultEmail = mysqli_query($conn, $selectEmail);
if ($rowEmail = mysqli_fetch_assoc($resultEmail)) {
   $email = $rowEmail['email'];
} else {
   $email = 'email'; // Default value if email is not found
}

// Retrieve the user's booking history from the database
$bookingHistory = array();

// Perform the database query to fetch the booking history
$selectBookings = "SELECT id, name, email, phone, address, location, guests, arrivals, leaving, type FROM bookings WHERE email = '$email'";
$resultBookings = mysqli_query($conn, $selectBookings);

if ($resultBookings) {
   while ($rowBooking = mysqli_fetch_assoc($resultBookings)) {
      $bookingHistory[] = $rowBooking;
   }
}

// Update the user's profile
if (isset($_POST['update'])) {
   $newName = $_POST['name'];
   $newEmail = $_POST['email'];

   $updateProfile = "UPDATE user_form SET name = '$newName', email = '$newEmail' WHERE name = '$userName'";
   $resultProfile = mysqli_query($conn, $updateProfile);

   if ($resultProfile) {
      // Update the session with the new name
      $_SESSION['user_name'] = $newName;

      // Redirect to the profile page with the updated information
      header('Location: profile.php');
      exit();
   } else {
      // Handle the error if the profile update fails
      echo "Profile update failed: " . mysqli_error($conn);
   }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>
   <link rel="stylesheet" href="style.css">
   <style>
       body {
         background-color: #f4f4f4;
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
      }

      .profile-container {
         max-width: 900px;
         margin: 50px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .profile-container h1 {
         text-align: center;
         margin-bottom: 20px;
      }

      .profile-details {
         text-align: center;
         margin-bottom: 20px;
      }

      .profile-details img {
         width: 100px;
         height: 100px;
         border-radius: 50%;
         object-fit: cover;
         margin-bottom: 10px;
      }

      .profile-form {
         text-align: center;
         margin-bottom: 20px;
      }

      .profile-form h2 {
         margin-bottom: 10px;
      }

      .profile-form input[type="text"],
      .profile-form input[type="email"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border-radius: 3px;
         border: 1px solid #ccc;
         box-sizing: border-box;
         font-size: 16px;
      }

      .profile-form input[type="submit"] {
         width: 100%;
         padding: 10px;
         background-color: #4caf50;
         border: none;
         color: #fff;
         font-size: 16px;
         font-weight: bold;
         cursor: pointer;
         border-radius: 3px;
      }

      .booking-history {
         margin-bottom: 20px;
      }

      .booking-history h2 {
         margin-bottom: 10px;
      }

      .booking-history table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 10px;
      }

      .booking-history table th,
      .booking-history table td {
         padding: 10px;
         border: 1px solid #ccc;
      }

      .booking-history table th {
         background-color: #f4f4f4;
         font-weight: bold;
      }
   </style>
</head>
<body>

<section class="header">

<a href="home.php" class="logo">Adventours</a>

<nav class="navbar">
    <a href="home.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="package.php">Packages</a>
    <a href="book.php">Book</a>
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
</nav>

<div id="menu-btn" class="fas fa-bars"></div>


</section>
   <div class="profile-container">
      <h1>User Profile</h1>

      <div class="profile-details">
         <?php if (!empty($profilePicture)) : ?>
            <img src="<?php echo $profilePicture; ?>" alt="Profile Picture">
         <?php endif; ?>
         <h2>Welcome, <?php echo $userName; ?></h2>

      </div>

      <div class="profile-form">
         <h2>Update Profile</h2>
         <form action="" method="post">
            <input type="text" name="name" value="<?php echo $userName; ?>" placeholder="Enter your name" required>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your email" required>
            <input type="submit" name="update" value="Update Profile">
         </form>
      </div>

      <style>
  #bookingHistoryButton {
    padding: 10px 20px;
    background-color: #800080;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  #bookingHistorySection {
    display: none;
  }

  .booking-history {
    margin-top: 20px;
  }

  .booking-history h2 {
    font-size: 24px;
    margin-bottom: 10px;
    color: #800080;
  }

  .booking-history table {
    width: 100%;
    border-collapse: collapse;
  }

  .booking-history table th,
  .booking-history table td {
    padding: 10px;
    border: 1px solid #800080;
  }

  .booking-history table th {
    background-color: #800080;
    color: #fff;
  }

  .booking-history table tbody tr:nth-child(even) {
    background-color: #f5f5f5;
  }
</style>

<button id="bookingHistoryButton">Booking History</button>

<div id="bookingHistorySection">
  <div class="booking-history">
    <h2>Booking History</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Location</th>
          <th>Guests</th>
          <th>Arrivals</th>
          <th>Leaving</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($bookingHistory as $booking) { ?>
          <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['name']; ?></td>
            <td><?php echo $booking['email']; ?></td>
            <td><?php echo $booking['phone']; ?></td>
            <td><?php echo $booking['address']; ?></td>
            <td><?php echo $booking['location']; ?></td>
            <td><?php echo $booking['guests']; ?></td>
            <td><?php echo $booking['arrivals']; ?></td>
            <td><?php echo $booking['leaving']; ?></td>
            <td><?php echo $booking['type']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  var bookingHistoryButton = document.getElementById('bookingHistoryButton');
  var bookingHistorySection = document.getElementById('bookingHistorySection');

  bookingHistoryButton.addEventListener('click', function() {
    if (bookingHistorySection.style.display === 'none') {
      bookingHistorySection.style.display = 'block';
    } else {
      bookingHistorySection.style.display = 'none';
    }
  });
</script>


<br>

<!--recommendation system starts here!-->


<?php
// Connect to your database
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adventours_nepal';
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
  die('Database connection error: ' . mysqli_connect_error());
}

// Retrieve packages from the database
$packages = [];
$query = "SELECT * FROM packages";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $packages[] = $row;
  }
}

// Function to get a random package recommendation
function getRandomPackage($packages) {
  $randomIndex = array_rand($packages);
  return $packages[$randomIndex];
}

// Ensure at least three packages are available
while (count($packages) < 5) {
  $randomPackage = getRandomPackage($packages);
  $packages[] = $randomPackage;
}

// Check if redirected from bookings or submit button is clicked
$isRedirected = false;

if (isset($_SERVER['HTTP_REFERER'])) {
  $referer = $_SERVER['HTTP_REFERER'];
  if (strpos($referer, 'book.php') !== false || isset($_POST['update'])) {
    $isRedirected = true;
  }
}

// Get three random package recommendations if redirected
$randomPackages = [];
if ($isRedirected) {
  $randomPackages = array_rand($packages, 3);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <style>
    .package-container {
      display: flex;
      flex-wrap: wrap;
    }

    .package {
      flex: 0 0 33.33%;
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      background-color: #f9f9f9;
      transition: all 0.3s ease;
    }

    .package:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .package h3 {
      font-size: 18px;
      margin-bottom: 10px;
    }

    .package img {
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
    }

    .package p {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div>
    <?php if ($isRedirected): ?>
      <h1>You may also like</h1>
      <div class="package-container">
        <?php
        // Display the package recommendations
        foreach ($randomPackages as $index) {
          $package = $packages[$index];
          echo '<div class="package">';
          echo '<h3>' . $package['title'] . '</h3>';
          echo '<img src="' . $package['image'] . '" alt="Package Image">';
          echo '<p>' . $package['description'] . '</p>';
          echo 'Rs.' . $package['price'];
          echo '</div>';
        }
        ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>



<!--recommendation system ends here!-->











</body>
</html>
