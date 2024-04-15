<?php
if (isset($_POST['send'])) {
  // Retrieve the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $location = $_POST['location'];
  $guests = $_POST['guests'];
  $arrivals = $_POST['arrivals'];
  $leaving = $_POST['leaving'];
  $type = $_POST['type'];
  $title = isset($_POST['package_title']) ? $_POST['package_title'] : '';
  $price = isset($_POST['package_price']) ? $_POST['package_price'] : '';

  // Create a connection to the database.
  $connection = mysqli_connect('localhost', 'root', '', 'adventours_nepal');

  // Check if the connection was successful.
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute the SQL statement to insert the form data into the database.
  $sql = "INSERT INTO bookings (name, email, phone, address, location, guests, arrivals, leaving, type, title, price)
          VALUES ('$name', '$email', '$phone', '$address', '$location', '$guests', '$arrivals', '$leaving', '$type', '$title', '$price')";

  if (mysqli_query($connection, $sql)) {
    mysqli_close($connection);
    header('Location: profile.php?message=Booking done successfully');
    exit();
  } else {
    echo 'Error: ' . $sql . '<br>' . mysqli_error($connection);
  }

  // Close the database connection.
  mysqli_close($connection);
} else {
  echo 'Something went wrong, please try again.';
}
?>


