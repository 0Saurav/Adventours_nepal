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

<div class="container">
  <div class="headiing">
    <h1>Welcome to Adventours Nepal</h1>
  </div>
</div>




<!--about section starts here-->

<section class="about">
  <div class="image">
    <img src="about.png" alt="About Us">
  </div>

  <div class="content">
    <h3>Why Choose Us?</h3>
    <p>Discover the Difference. Our passion, expertise, and dedication ensure an extraordinary journey.
      Let our knowledgeable guides, thrilling adventures, unwavering safety, personalized service, sustainable practices, and unwavering commitment to your satisfaction make your travel dreams a reality.</p>
    <p>Expert Guides, Breathtaking Landscapes</p>
    <p>Unforgettable Adventures, Lasting Memories</p>
    <p>Safety First, Peace of Mind</p>
    <p>Personalized Service, Your Unique Journey</p>
    <p>Sustainable Tourism, Positive Impact</p>
    <p>Customer Satisfaction, Memorable Trips</p>
    <div class="icons-container">
      <div class="icons">
        <i class="fas fa-map">
          <span>Top Destinations</span>
        </i>
      </div>
      <div class="icons">
        <i class="fas fa-hand-holding-usd">
          <span>Affordable Price</span>
        </i>
      </div>
      <div class="icons">
        <i class="fas fa-headset">
          <span>24/7 Service</span>
        </i>
      </div>
      <div class="icons">
        <i class="fas fa-users">
          <span>Expert Guides</span>
        </i>
      </div>
      <div class="icons">
        <i class="fas fa-heart">
          <span>Unforgettable Experiences</span>
        </i>
      </div>
      <div class="icons">
        <i class="fas fa-shield-alt">
          <span>Safety First</span>
        </i>
      </div>
    </div>
  </div>
</section>


<!--about section ends here-->

<!--review section starts here-->
<section class="reviews">
  <h2 class="slider-header">Client Reviews</h2>
  <div class="reviews-slider">
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
    $query = "SELECT * FROM reviews WHERE status = 'approved'"; // Assuming 'status' column represents the review status
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reviews[] = $row;
        }
    }

    // Display reviews
    foreach ($reviews as $review) {
        ?>
        <div class="slide">
          <div class="stars">
            <?php for ($i = 0; $i < $review['rating']; $i++): ?>
              <i class="fas fa-star"></i>
            <?php endfor; ?>
          </div>
          <p><?php echo $review['review']; ?></p>
          <h3><?php echo $review['name']; ?></h3>
          <?php if (!empty($review['image'])): ?>
            <img src="<?php echo $review['image']; ?>" alt="Review Image">
          <?php endif; ?>
        </div>
    <?php
    }
    ?>
  </div>
</section>


  <!-- Add review form -->
  <div class="review-form">
    <h2>Leave a Review</h2>
    <form action="submit_review.php" method="POST" enctype="multipart/form-data">
  <label for="name">Your Name:</label>
  <input type="text" id="name" name="name" required>

  <label for="rating">Rating:</label>
  <select id="rating" name="rating" required>
    <option value="5">5 Stars</option>
    <option value="4">4 Stars</option>
    <option value="3">3 Stars</option>
    <option value="2">2 Stars</option>
    <option value="1">1 Star</option>
  </select>

  <label for="review">Your Review:</label>
  <textarea id="review" name="review" required></textarea>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" placeholder="Email" required>

  <label for="image">Image:</label>
  <input type="file" id="image" name="image">

  <input type="submit" value="Submit Review">
</form>

  </div>
</section>

<!--review section ends here-->


<br>



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
