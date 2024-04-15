<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

if (isset($_GET['booking_id'])) {
    $bookingId = $_GET['booking_id'];

    // Database connection
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'adventours_nepal';

    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement to fetch the booking details
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Fetch the booking details
        $booking = $result->fetch_assoc();

        // Close the database connection
        $stmt->close();
        $conn->close();

        // Email content
        $to = $booking['email'];
        $subject = 'Booking Confirmation';
        $messageBody = 'Dear ' . $booking['name'] . "\n";
        $messageBody .= 'Thank you for booking with Adventours Nepal. Your booking has been confirmed.' . "\n";
        $messageBody .= 'For Your Booking Details,' . "\n";
        $messageBody .= 'We will contact you via phone within few hours.';
        // Add other booking details here

        // Creating the SMTP transport
        $transport = new Swift_SmtpTransport('smtp.mail.me.com', 587, 'tls');
        $transport->setUsername('sauravthakuri014@icloud.com');  // Apple Mail ID (email address)
        $transport->setPassword('ptwp-fgxh-zuhi-fjms');  // Apple Mail password

        // Creating the Mailer using the created transport
        $mailer = new Swift_Mailer($transport);

        // Creating the message
        $emailMessage = (new Swift_Message($subject))
            ->setFrom(['sauravthakuri014@icloud.com' => 'Adventours Nepal'])
            ->setTo($to)
            ->setBody($messageBody);

        try {
            // Send the email
            $result = $mailer->send($emailMessage);
            echo 'Email sent successfully.';
        } catch (\Swift_TransportException $e) {
            echo 'An error occurred while sending the email: ' . $e->getMessage();
        }
    } else {
        echo 'Booking not found.';
    }
} else {
    echo 'No booking ID specified.';
}


