<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!--swiper css link-->
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

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

<div class="headieng">
    <img src="<?php echo isset($_GET['image']) ? urldecode($_GET['image']) : 'default_image.jpg'; ?>" alt="Bookings" class="headieng-image">
    <h1 class="headieng-text"><?php echo isset($_GET['title']) ? urldecode($_GET['title']) : 'Bookings'; ?></h1>
</div>





<!--book section starts from here -->

<section class="booking">
    <h1 class="heading-title">Book Your Adventure with Adventours Nepal!</h1>
    <form action="book_form.php" method="post" class="book-form">
        <div class="flex">
            <div class="inputBox">
                <span>Full Name :</span>
                <input type="text" placeholder="Enter Your Full Name" name="name" required>
            </div>

            <div class="inputBox">
                <span>Email :</span>
                <input type="email" placeholder="Enter Your Email" name="email" required>
            </div>

            <div class="inputBox">
                <span>Phone :</span>
                <input type="tel" placeholder="Enter Your Phone Number" name="phone" required>
            </div>

            <div class="inputBox">
                <span>Address :</span>
                <input type="text" placeholder="Enter Your Address" name="address" required>
            </div>

            <div class="inputBox">
                <span>Destination :</span>
                <input type="text" placeholder="Enter Your Desired Destination" name="location" value="<?php echo isset($_GET['title']) ? $_GET['title'] : ''; ?>" required>
            </div>

            <div class="inputBox">
                <span>Number of Guests :</span>
                <input type="number" placeholder="Enter the Number of Guests" name="guests" id="guests" required>
            </div>

            <div class="inputBox">
            <span>Arrival Date :</span>
            <input type="date" id="arrivalDate" name="arrivals" min="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="inputBox">
            <span>Departure Date :</span>
            <input type="date" id="departureDate" name="leaving" min="<?php echo date('Y-m-d'); ?>" required>
        </div>

            <div class="inputBox">
                <span>Type :</span>
                <select name="type">
                    <option value="">Select Type</option>
                    <option value="Trekking">Trekking</option>
                    <option value="National Parks">National Parks</option>
                    <option value="Adventure">Adventure</option>
                    <option value="Camping">Camping</option>
                    <option value="Tours">Tours</option>
                    <option value="Cultural Tours">Cultural Tours</option>
                </select>
            </div>

            <?php
            // Calculate the total price
            $packagePrice = isset($_GET['price']) ? floatval($_GET['price']) : 0;
            echo '<div class="inputBox">';
            echo '<span>Total Price : </span>';
            echo '<span id="total-price">Rs ' . number_format($packagePrice, 2) . '</span>';
            echo '<input type="hidden" name="package_price" value="' . $packagePrice . '">';
            echo '</div>';
            ?>

        </div>

        <input type="submit" value="Submit" class="btn" name="send">
    </form>
</section>

<script>
    // Update the total price when the number of guests changes
    document.getElementById('guests').addEventListener('input', function () {
        var guests = parseInt(this.value) || 0;
        var total = guests * <?php echo $packagePrice; ?>;
        document.getElementById('total-price').textContent = 'Rs ' + total.toFixed(2);
    });
</script>






<!-- book section ends  here -->







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
            <a href="facebook.com"><i class="fab fa-facebook-f"></i> Facebook</a>
            <a href="twitter.com"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="instagram.com"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="youtube.com"><i class="fab fa-youtube"></i> Youtube</a>


        </div>



    </div>


    <div class="credit">Adventours Nepal, All Rights Reserved!</div>
</section>



<!--footer section ends here-->





<!--swiper js link-->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!--custom js file link-->
    <script src="script.js"></script>
</body>
</html>
