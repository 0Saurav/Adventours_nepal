<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
   <link rel="stylesheet" href="stylee.css">
</head>

<body>
   <header class="admin-header">
      <div class="admin-container">
         <h1 class="logo">Adventours Nepal</h1>
         <nav class="admin-navbar">
            <a href="bookings.php">Manage Bookings</a>
            <a href="read_package.php">Packages</a>
            <a href="users.php">Users</a>
            <a href="reviews.php">Reviews</a>
            <a href="analytics.php" class="active">Analytics</a>
            <a href="crm_dashboard.php" class="active">Customer Details</a>
            <a href="logout.php">Logout</a>
         </nav>
      </div>
   </header>

   <section class="admin-content">
      <div class="admin-container">
         <h2>Manage Bookings</h2>
 <!-- Your booking management functionality and data representation go here -->
<?php
   // Database connection
   $hostname = 'localhost';
   $username = 'root';
   $password = '';
   $database = 'adventours_nepal';
   $conn = mysqli_connect($hostname, $username, $password, $database);

   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

   // Query the database to retrieve bookings
   $sql = "SELECT * FROM bookings ORDER BY id DESC";
   $result = $conn->query($sql);

   if ($result && $result->num_rows > 0) {
      // Display the bookings
      echo "<table class='admin-bookings-table'>";
      echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Type</th><th>Location</th><th>Guests</th><th>Arrivals</th><th>Leaving</th><th>Title</th><th>Price</th><th>Confirmation</th></tr>";

      while ($row = $result->fetch_assoc()) {
         echo "<tr>";
         echo "<td>".$row["id"]."</td>";
         echo "<td>".$row["name"]."</td>";
         echo "<td>".$row["email"]."</td>";
         echo "<td>".$row["phone"]."</td>";
         echo "<td>".$row["address"]."</td>";
         echo "<td>".(isset($row["type"]) ? $row["type"] : "")."</td>";
         echo "<td>".$row["location"]."</td>";
         echo "<td>".$row["guests"]."</td>";
         echo "<td>".$row["arrivals"]."</td>";
         echo "<td>".$row["leaving"]."</td>";
         echo "<td>".(isset($row["title"]) ? $row["title"] : "")."</td>";

         $totalPrice = isset($row["price"]) ? ($row["price"] * $row["guests"]) : "";
         echo "<td>".$totalPrice."</td>";

         // Display a placeholder for confirmation button
         echo "<td><a href='send_confirmation.php?booking_id=".$row["id"]."' class='confirmation-button'>Confirm</a></td>";

         echo "</tr>";
      }

      echo "</table>";
   } else {
      echo "No bookings available";
   }

   $conn->close();
?>

      </div>
   </section>

   <footer class="admin-footer">
      <div class="admin-container">
         <p>&copy; 2023 Adventours. All rights reserved.</p>
      </div>
   </footer>

</body>

</html>

