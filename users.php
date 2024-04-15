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

// Retrieve users
$users = [];
$query = "SELECT * FROM user_form";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="stylee.css">
</head>
<body>
    <!-- Navbar -->
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
    <div class="user-container">
        <h1>Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>User Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                        <td><?php echo $user['user_type']; ?></td>

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
