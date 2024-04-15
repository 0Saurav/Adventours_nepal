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

// Retrieve packages
$packages = [];
$query = "SELECT * FROM packages";
$result = mysqli_query($connection, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $packages[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>

    <!--swiper css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!--custom css file link-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--header section starts here-->
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
    <!--header section ends here-->

    <div class="headiiing">
        <img src="packages.jpg" alt="Packages">
        <h1>PACKAGES</h1>
    </div>

<!-- Package section starts here -->
<section class="package">
    <h1 class="heading-title">Top Destinations</h1>
    <div class="box-container">
        <?php foreach ($packages as $package): ?>
            <div class="box">
                <div class="image">
                    <img src="<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>">
                </div>
                <div class="content">
                    <h3><?php echo $package['title']; ?></h3>
                    <p><?php echo $package['description']; ?></p>
                    <span class="price"><?php echo 'Rs ' . $package['price'] . ' per individual'; ?></span>
                    <a href="book.php?id=<?php echo $package['id']; ?>&title=<?php echo urlencode($package['title']); ?>&price=<?php echo $package['price']; ?>&image=<?php echo urlencode($package['image']); ?>" class="btn">Book Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>



    <!--Package section ends here-->

    <!--footer section starts here-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Adventours</h3>
                <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
                <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
                <a href="package.php"><i class="fas fa-angle-right"></i> Package</a>
                <a href="book.php"><i class="fas fa-angle-right"></i> Book</a>
            </div>
            <div class="box">
                <h3>Queries</h3>
                <a href=""><i class="fas fa-angle-right"></i> Ask Questions</a>
                <a href=""><i class="fas fa-angle-right"></i> About Us</a>
                <a href=""><i class="fas fa-angle-right"></i> Privacy Policy</a>
                <a href=""><i class="fas fa-angle-right"></i> Terms Of Use</a>
            </div>
            <div class="box">
                <h3>Contact Us</h3>
                <a href=""><i class="fas fa-phone"></i> +977 9804182646</a>
                <a href=""><i class="fas fa-phone"></i> +977 9814111903</a>
                <a href=""><i class="fas fa-envelope"></i> info@adventours.com</a>
                <a href=""><i class="fas fa-map"></i> Kathmandu, Nepal</a>
            </div>
            <div class="box">
                <h3>Follow Us</h3>
                <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#"><i class="fab fa-youtube"></i> Youtube</a>
            </div>
        </div>
        <div class="credit">Adventoures Nepal, All Rights Reserved!</div>
    </section>
    <!--footer section ends here-->

    <!--swiper js link-->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <!--custom js file link-->
    <script src="script.js"></script>
</body>
</html>
