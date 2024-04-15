<?php
// Include your database connection file
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adventours_nepal';
$connection = mysqli_connect($hostname, $username, $password, $database);

if (!$connection) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Retrieve reviews
$reviews = [];
$query = "SELECT * FROM reviews";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row;
    }
}

// Handle delete and approve actions
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete"])) {
        $reviewId = $_POST["delete"];
        $deleteQuery = "DELETE FROM reviews WHERE id = $reviewId";
        mysqli_query($connection, $deleteQuery);
        // Redirect to the same page to refresh the reviews list
        header("Location: reviews.php");
        exit;
    } elseif (isset($_POST["approve"])) {
        $reviewId = $_POST["approve"];
        $approveQuery = "UPDATE reviews SET status = 'approved' WHERE id = $reviewId";
        mysqli_query($connection, $approveQuery);
        // Redirect to the same page to refresh the reviews list
        header("Location: reviews.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Content -->
    <div class="review-container">
        <h1>Reviews</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($reviews as $review): ?>
   <tr>
      <td><?php echo $review['id']; ?></td>
      <td><?php echo $review['name']; ?></td>
      <td><?php echo $review['email']; ?></td>
      <td><?php echo $review['rating']; ?></td>
      <td><?php echo $review['review']; ?></td>
      <td><?php echo $review['status']; ?></td>
      <td>
         <?php if ($review['status'] !== 'approved'): ?>
            <form method="post" class="review-approval-form">
               <input type="hidden" name="approve" value="<?php echo $review['id']; ?>">
               <button type="submit" class="approval-button">Approve</button>
            </form>
         <?php endif; ?>
         <form method="post" class="review-delete-form">
            <input type="hidden" name="delete" value="<?php echo $review['id']; ?>">
            <button type="submit" class="delete-button">Delete</button>
         </form>
      </td>
   </tr>
<?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="admin-footer">
        <div class="admin-container">
            <p>&copy; 2023 Adventours. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
