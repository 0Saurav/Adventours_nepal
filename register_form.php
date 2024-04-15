<?php
session_start();

require_once 'config.php';

$error = '';
$success = '';

if (isset($_POST['submit'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);
   $cpassword = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Check if the password and confirm password match
   if ($password !== $cpassword) {
      $error = 'Passwords do not match!';
   } else {
      // Check if the email is already registered
      $select = "SELECT * FROM user_form WHERE email = '$email'";
      $result = mysqli_query($conn, $select);
      if (mysqli_num_rows($result) > 0) {
         $error = 'Email is already registered!';
      } else {
         // Insert the user into the database
         $insert = "INSERT INTO user_form (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
         if (mysqli_query($conn, $insert)) {
            $success = 'Registration successful!';
            header('Location: login_form.php');
            exit();
         } else {
            $error = 'Registration failed. Please try again!';
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="style.css">
   <style>
      body {
         background-color: #f4f4f4;
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
      }

      .form-container {
         max-width: 400px;
         margin: 50px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .form-container h3 {
         text-align: center;
         margin-bottom: 20px;
      }

      .form-container .error-msg {
         display: block;
         color: #ff0000;
         margin-bottom: 10px;
      }

      .form-container .success-msg {
         display: block;
         color: #4caf50;
         margin-bottom: 10px;
      }

      .form-container input[type="text"],
      .form-container input[type="email"],
      .form-container input[type="password"] {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border-radius: 3px;
         border: 1px solid #ccc;
         box-sizing: border-box;
         font-size: 16px;
      }

      .form-container select {
         width: 100%;
         padding: 10px;
         margin-bottom: 10px;
         border-radius: 3px;
         border: 1px solid #ccc;
         box-sizing: border-box;
         font-size: 16px;
      }

      .form-container input[type="submit"] {
         width: 100%;
         padding: 10px;
         background-color: #4caf50;
         border: none;
         color: #fff;
         font-size: 16px;
         font-weight: bold;
         cursor: pointer;
         border-radius: 3px;
      }

      .form-container p {
         margin-top: 20px;
         text-align: center;
         font-size: 14px;
      }

      .form-container p a {
         color: #4caf50;
         text-decoration: none;
      }
   
   </style>
</head>

<body>
   <div class="form-container">
      <form action="" method="post">
         <h3>Register Now</h3>
         <?php if (isset($error)): ?>
            <span class="error-msg"><?php echo $error; ?></span>
         <?php elseif (isset($success)): ?>
            <span class="success-msg"><?php echo $success; ?></span>
         <?php endif; ?>
         <input type="text" name="name" required placeholder="Enter your name">
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="password" name="cpassword" required placeholder="Confirm your password">
         <select name="user_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
         </select>
         <input type="submit" name="submit" value="Register Now" class="form-btn">
         <p>Already have an account? <a href="login_form.php">Login Now</a></p>
      </form>
   </div>
</body>

</html>
