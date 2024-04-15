<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];
    $image = $_FILES["image"];

    // Validate the form data (you can add your own validation logic here)
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($rating)) {
        $errors[] = "Rating is required";
    }
    if (empty($review)) {
        $errors[] = "Review is required";
    }
    if (empty($image["tmp_name"])) {
        $errors[] = "Image is required";
    }

    // If there are no validation errors, process the form data
    if (empty($errors)) {
        // Include your database connection file
        $hostname = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'adventours_nepal';
        $connection = mysqli_connect($hostname, $username, $password, $database);

        if (!$connection) {
            die('Database connection error: ' . mysqli_connect_error());
        }

        // Prepare and execute the SQL statement to insert the review into the database
        $stmt = $connection->prepare("INSERT INTO reviews (name, email, rating, review, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssiss', $name, $email, $rating, $review, $image["name"]);

        $stmt->execute();

        // Move the uploaded file to the target directory
        $targetDirectory = "images/";
        $targetFilePath = $targetDirectory . $image["name"];
        if (move_uploaded_file($image["tmp_name"], $targetFilePath)) {
            // File moved successfully
        } else {
            // Failed to move the file
            $errors[] = "Failed to move the uploaded file";
        }

        // Close the statement and database connection
        $stmt->close();
        $connection->close();

        // Redirect to a success page or display a success message
        header("Location: about.php");
        exit;
    }
}
?>


