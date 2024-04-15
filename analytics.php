<?php
// Establish database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'adventours_nepal';
$connection = mysqli_connect($hostname, $username, $password, $database);

// Check connection
if (!$connection) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Fetch data for analytics
// Fetch booking type data
$bookingTypesData = [];
$query = "SELECT type, COUNT(*) AS count FROM bookings GROUP BY type";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookingTypesData[$row['type']] = $row['count'];
    }
}

// Fetch bookings per month data
$bookingsPerMonthData = [];
$query = "SELECT MONTH(arrivals) AS month, COUNT(*) AS count FROM bookings GROUP BY MONTH(arrivals)";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Convert month number to month name
        $monthName = date('F', mktime(0, 0, 0, $row['month'], 1));
        $bookingsPerMonthData[$monthName] = $row['count'];
    }
}

// Fetch booking trend data
$bookingTrendData = [];
$query = "SELECT DATE_FORMAT(arrivals, '%Y-%m') AS month, COUNT(*) AS count FROM bookings GROUP BY DATE_FORMAT(arrivals, '%Y-%m')";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookingTrendData[$row['month']] = $row['count'];
    }
}

// Sales Analysis
// Total Bookings
$totalBookingsQuery = "SELECT COUNT(*) AS total_bookings FROM bookings";
$totalBookingsResult = mysqli_query($connection, $totalBookingsQuery);
$totalBookings = mysqli_fetch_assoc($totalBookingsResult)['total_bookings'];

// Bookings by Type
$bookingsByTypeQuery = "SELECT type, COUNT(*) AS total FROM bookings GROUP BY type";
$bookingsByTypeResult = mysqli_query($connection, $bookingsByTypeQuery);
$bookingsByTypeData = [];
while ($row = mysqli_fetch_assoc($bookingsByTypeResult)) {
    $bookingsByTypeData[$row['type']] = $row['total'];
}

// Total Revenue
$totalRevenueQuery = "SELECT SUM(price) AS total_revenue FROM bookings";
$totalRevenueResult = mysqli_query($connection, $totalRevenueQuery);
$totalRevenue = mysqli_fetch_assoc($totalRevenueResult)['total_revenue'];

// Revenue by Type
$revenueByTypeQuery = "SELECT type, SUM(price) AS total FROM bookings GROUP BY type";
$revenueByTypeResult = mysqli_query($connection, $revenueByTypeQuery);
$revenueByTypeData = [];
while ($row = mysqli_fetch_assoc($revenueByTypeResult)) {
    $revenueByTypeData[$row['type']] = $row['total'];
}


$turnoverRatioData = [];
foreach ($bookingsPerMonthData as $month => $bookings) {
    $turnoverRatioData[$month] = $bookings > 0 ? ($totalRevenue / $bookings) : 0;
}

// Fetch review ratings distribution data
$reviewRatingsDistribution = [];
$query = "SELECT rating, COUNT(*) AS count FROM reviews GROUP BY rating";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviewRatingsDistribution[$row['rating']] = $row['count'];
    }
}

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Analytics</title>
    <link rel="stylesheet" href="stylee.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Ensure fixed size for the chart container */
        .chart-container {
            width: 49%;
            height: 300px;
            position: relative;
            margin-right: 1%;
            margin-bottom: 20px;
            float: left;
        }
        /* Ensure fixed size for the canvas */
        canvas {
            width: 100% !important;
            height: 100% !important;
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
            <h2>Analytics</h2>

            <!-- Booking Type Distribution Chart -->
            <div>
                <h3>Booking Type Distribution</h3>
                <p>This pie chart displays the distribution of bookings by type.</p>
            </div>
            <div class="chart-container">
                <canvas id="bookingTypeChart"></canvas>
            </div>

            <!-- Bookings Per Month Chart -->
            <div>
                <h3>Bookings Per Month</h3>
                <p>This bar chart shows the number of bookings made each month.</p>
            </div>
            <div class="chart-container">
                <canvas id="bookingsPerMonthChart"></canvas>
            </div>

            <!-- Booking Trend Chart -->
            <div>
                <h3>Booking Trend</h3>
                <p>This line chart illustrates the trend of bookings over time.</p>
            </div>
            <div class="chart-container">
                <canvas id="bookingTrendChart"></canvas>
            </div>

            <!-- Sales Analysis Chart -->
            <div>
                <h3>Sales Analysis</h3>
                <p>This pie chart presents the distribution of bookings by type, aiding in sales analysis.</p>
            </div>
            <div class="chart-container">
                <canvas id="salesAnalysisChart"></canvas>
            </div>

            <!-- Revenue Analysis Chart -->
            <div>
                <h3>Revenue Analysis</h3>
                <p>This pie chart provided insights into revenue distribution based on booking types.</p>
            </div>
            <div class="chart-container" style="margin-bottom: 20px;">
                <canvas id="revenueAnalysisChart"></canvas>
            </div>
            <br>
            <!-- Turnover Ratio Chart -->
            <div>
                <h3>Turnover Ratio</h3>
                <p>This line chart shows the turnover ratio over time.</p>
            </div>
            <div class="chart-container" style="margin-bottom: 20px;">
                <canvas id="turnoverRatioChart"></canvas>
            </div>

            <!-- Review Ratings Distribution Chart -->
            <div>
                <h3>Review Ratings Distribution</h3>
                <p>This bar chart displays the distribution of review ratings.</p>
            </div>
            <div class="chart-container" style="margin-bottom: 20px;">
                <canvas id="reviewRatingsDistributionChart"></canvas>
            </div>

            <script>
                // Retrieve booking type data from PHP
                var bookingTypesData = <?php echo json_encode($bookingTypesData); ?>;
                // Retrieve bookings per month data from PHP
                var bookingsPerMonthData = <?php echo json_encode($bookingsPerMonthData); ?>;
                // Retrieve booking trend data from PHP
                var bookingTrendData = <?php echo json_encode($bookingTrendData); ?>;
                // Retrieve sales analysis data from PHP
                var salesAnalysisData = <?php echo json_encode($bookingsByTypeData); ?>;
                // Retrieve revenue analysis data from PHP
                var revenueAnalysisData = <?php echo json_encode($revenueByTypeData); ?>;
                // Retrieve turnover ratio data from PHP
                var turnoverRatioData = <?php echo json_encode($turnoverRatioData); ?>;
                // Retrieve review ratings distribution data from PHP
                var reviewRatingsDistributionData = <?php echo json_encode($reviewRatingsDistribution); ?>;

                // Create pie chart for booking types using Chart.js
                var ctx1 = document.getElementById('bookingTypeChart').getContext('2d');
                var bookingTypeChart = new Chart(ctx1, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(bookingTypesData),
                        datasets: [{
                            label: 'Booking Types',
                            data: Object.values(bookingTypesData),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'right',
                        }
                    }
                });

                // Create bar chart for bookings per month using Chart.js
                var ctx2 = document.getElementById('bookingsPerMonthChart').getContext('2d');
                var bookingsPerMonthChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(bookingsPerMonthData),
                        datasets: [{
                            label: 'Bookings Per Month',
                            data: Object.values(bookingsPerMonthData),
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Create line chart for booking trend using Chart.js
                var ctx3 = document.getElementById('bookingTrendChart').getContext('2d');
                var bookingTrendChart = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: Object.keys(bookingTrendData),
                        datasets: [{
                            label: 'Bookings Trend',
                            data: Object.values(bookingTrendData),
                            backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red color with alpha (transparency)
                            borderColor: 'rgba(255, 99, 132, 1)', // Solid red color
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Create pie chart for sales analysis using Chart.js
                var ctx4 = document.getElementById('salesAnalysisChart').getContext('2d');
                var salesAnalysisChart = new Chart(ctx4, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(salesAnalysisData),
                        datasets: [{
                            label: 'Sales Analysis',
                            data: Object.values(salesAnalysisData),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                // Add more colors as needed
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                // Add more colors as needed
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'right',
                        }
                    }
                });

                // Create pie chart for revenue analysis using Chart.js
                var ctx5 = document.getElementById('revenueAnalysisChart').getContext('2d');
                var revenueAnalysisChart = new Chart(ctx5, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(revenueAnalysisData),
                        datasets: [{
                            label: 'Revenue Analysis',
                            data: Object.values(revenueAnalysisData),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                                // Add more colors as needed
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                // Add more colors as needed
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            position: 'right',
                        }
                    }
                });

                // Create line chart for turnover ratio using Chart.js
                var ctx6 = document.getElementById('turnoverRatioChart').getContext('2d');
                var turnoverRatioChart = new Chart(ctx6, {
                    type: 'line',
                    data: {
                        labels: Object.keys(turnoverRatioData),
                        datasets: [{
                            label: 'Turnover Ratio',
                            data: Object.values(turnoverRatioData),
                            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Green color with alpha (transparency)
                            borderColor: 'rgba(75, 192, 192, 1)', // Solid green color
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

                // Create bar chart for review ratings distribution using Chart.js
                var ctx7 = document.getElementById('reviewRatingsDistributionChart').getContext('2d');
                var reviewRatingsDistributionChart = new Chart(ctx7, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(reviewRatingsDistributionData),
                        datasets: [{
                            label: 'Review Ratings Distribution',
                            data: Object.values(reviewRatingsDistributionData),
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
        </div>
    </section>

    <footer class="admin-footer">
        <div class="admin-container">
            <p>&copy; <?php echo date('Y'); ?> Adventours. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
