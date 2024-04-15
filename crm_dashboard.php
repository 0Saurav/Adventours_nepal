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

// Check if search form is submitted
if (isset($_GET['submit'])) {
    // Retrieve search criteria
    $search_name = $_GET['name'];
    $search_location = $_GET['location'];
    $search_month = $_GET['month'];
    $search_year = $_GET['year'];
    $search_type = $_GET['type'];

    // Construct the query based on the search criteria
    $query = "SELECT * FROM bookings WHERE 1=1";
    if (!empty($search_name)) {
        $query .= " AND name LIKE '%$search_name%'";
    }
    if (!empty($search_location)) {
        $query .= " AND location LIKE '%$search_location%'";
    }
    if (!empty($search_month) && !empty($search_year)) {
        $query .= " AND MONTH(arrivals) = '$search_month' AND YEAR(arrivals) = '$search_year'";
    }
    if (!empty($search_type)) {
        $query .= " AND type LIKE '%$search_type%'";
    }
    $query .= " ORDER BY id DESC";
} else {
    // Default query without search criteria
    $query = "SELECT * FROM bookings ORDER BY id DESC";
}

// Retrieve bookings data
$bookings = [];
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="stylee.css">
    <style>
        .booking-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .booking-card {
            flex-basis: calc(30.33% - 20px);
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .booking-card h4 {
            margin-top: 0;
        }
        .booking-details {
            margin-top: 10px;
        }
        .booking-details div {
            margin-bottom: 5px;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container label {
            display: block;
            margin-bottom: 5px;
        }
        .search-container input[type="text"],
        .search-container select,
        .search-container input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .search-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: #45a049;
        }
    </style>
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
        <h2>Customer Details</h2>
        <!-- Search form -->
        <div class="search-container">
            <form method="GET">
                <label for="name">Search by Name:</label>
                <input type="text" name="name" id="name">
                <label for="location">Search by Location:</label>
                <input type="text" name="location" id="location">
                <label for="month">Search by Month:</label>
                <select name="month" id="month">
                    <option value="">Select Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label for="year">Search by Year:</label>
                <input type="number" name="year" id="year" min="1900" max="2099" step="1" value="<?php echo date('Y'); ?>">
                <label for="type">Search by Type:</label>
                <input type="text" name="type" id="type">
                <button type="submit" name="submit">Search</button>
            </form>
        </div>

        <!-- Booking cards -->
        <div class="booking-cards">
            <?php foreach ($bookings as $booking): ?>
                <div class="booking-card">
                    <h4><?php echo $booking['name']; ?></h4>
                    <div class="booking-details">
                        <div><strong>Email:</strong> <?php echo $booking['email']; ?></div>
                        <div><strong>Phone:</strong> <?php echo $booking['phone']; ?></div>
                        <div><strong>Address:</strong> <?php echo $booking['address']; ?></div>
                        <div><strong>Type:</strong> <?php echo $booking['Type']; ?></div>
                        <div><strong>Location:</strong> <?php echo $booking['location']; ?></div>
                        <div><strong>Guests:</strong> <?php echo $booking['guests']; ?></div>
                        <div><strong>Arrivals:</strong> <?php echo $booking['arrivals']; ?></div>
                        <div><strong>Leaving:</strong> <?php echo $booking['leaving']; ?></div>
                        <div><strong>Price:</strong> <?php echo $booking['price']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<footer class="admin-footer">
    <div class="admin-container">
        <p>&copy; 2023 Adventours. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
