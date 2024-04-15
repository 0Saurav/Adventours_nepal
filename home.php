
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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


<!--home section starts here-->

<section class="home">

    <div class="swiper home-slider">

      <div class="swiper-wrapper">

        <div class="swiper-slide" style="background:url(homeslide-1.jpg) no-repeat; background-size: cover; background-position: center;">

            <div class="content">

            <span>Explore, Discover, Travel</span>
            <h3>Roam around Nepal</h3>
            <a href="package.php" class="btn">Discover More</a>

          </div>

        </div>

        <div class="swiper-slide" style="background:url(homeslide-2.jpg) no-repeat; background-size: cover; background-position: center;">

            <div class="content">

            <span>Explore, Discover, Travel</span>
            <h3>Discover New Places</h3>
            <a href="package.php" class="btn">Discover More</a>

          </div>

        </div>

        <div class="swiper-slide" style="background:url(homeslide-3.jpg) no-repeat; background-size: cover; background-position: center;">

            <div class="content">

                <span>Explore, Discover, Travel</span>
            <h3>Unveil the Wonders</h3>
            <a href="package.php" class="btn">Discover More</a>

        </div>

        </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

    </div>
  </section>



<!--home section ends here-->


<!--services section starts here-->

<section class="services">

    <h1 class="heading-title"> Our Services</h1>

<div class="box-container">

<div class="box">
    <img src="raft.png" alt="Icon1">
    <h3>Adventures</h3>
</div>

<div class="box">
    <img src="trek.png" alt="Icon2">
    <h3>Trekking</h3>
</div>

<div class="box">
    <img src="tour.png" alt="Icon3">
    <h3>Tours</h3>
</div>

<div class="box">
    <img src="park.png" alt="Icon4">
    <h3>National Parks</h3>
</div>

<div class="box">
    <img src="cultural.png" alt="Icon5">
    <h3>Cultural Tours</h3>
</div>

<div class="box">
    <img src="camping.png" alt="Icon6">
    <h3>Camping</h3>
</div>

</div>

</section>


<!--services section ends here-->

<!--home's about us section starts here-->


<section class="home-about">

    <div class="image">

        <img src="home-about.jpg" alt="Home-about us">

    </div>

    <div class="content">
        <h3>About Us</h3>
        <p>We Are Adventours Nepal - Your Gateway to Adventure!<br>

            <br>With a passion for exploration and a deep love for Nepal's breathtaking landscapes, Adventours Nepal is your ultimate adventure partner.

            Our experienced guides and curated itineraries cater to all levels of adventurers, ensuring thrilling and unforgettable experiences in the heart of the Himalayas.

           <br><br> At Adventours Nepal, your safety and comfort are our top priorities. Let us guide you through awe-inspiring treks, cultural immersions, and hidden gems, creating lifelong memories along the way.

           <br> <br> Embark on a transformative journey with Adventours Nepal. Unleash your spirit of adventure and discover the magic of Nepal's wilderness.

            Welcome to an extraordinary adventure. Welcome to Adventours Nepal!</p>
        <a href="about.php" class="btn">Read More</a>

    </div>

</section>


<!--home's about us section ends here-->



<!--home offer section starts here-->

<div class="home-offer-container">
    <h2 class="section-heading">Explore The Seasons</h2>

    <div class="home-offer">
      <div class="content">
        <h3>Spring Offer</h3>
        <p>Experience the vibrant colors and blooming beauty of spring with our special offer. Book now for an unforgettable adventure in nature!</p>
        <a href="package.php" class="btn">Discover</a>
      </div>
    </div>

    <div class="home-offer">
      <div class="content">
        <h3>Summer Offer</h3>
        <p>Escape the heat and embrace the summer breeze. Take advantage of our exclusive offer and indulge in thrilling outdoor activities under the sun.</p>
        <a href="package.php" class="btn">Discover</a>
      </div>
    </div>

    <div class="home-offer">
      <div class="content">
        <h3>Fall Offer</h3>
        <p>Witness the enchanting transformation of nature as fall sets in. Avail our limited-time offer and immerse yourself in the mesmerizing beauty of autumn.</p>
        <a href="package.php" class="btn">Discover</a>
      </div>
    </div>

    <div class="home-offer">
      <div class="content">
        <h3>Winter Offer</h3>
        <p>Embrace the winter wonderland and create unforgettable memories with our exclusive winter offer. Experience the magic of snowy landscapes and cozy adventures.</p>
        <a href="package.php" class="btn">Discover</a>
      </div>
    </div>
  </div>


<!--home offer section ends here-->


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

