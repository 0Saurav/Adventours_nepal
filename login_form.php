<?php
session_start();

require_once 'config.php';

$error = '';

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = md5($_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      if ($row['user_type'] == 'admin') {
         $_SESSION['admin_name'] = $row['name'];
         header('Location: bookings.php');
         exit();
      } elseif ($row['user_type'] == 'user') {
         $_SESSION['user_name'] = $row['name'];
         header('Location: home.php');
         exit();
      }
   } else {
      $error = 'Incorrect email or password!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

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
         <h3>Login Now</h3>
         <?php if ($error): ?>
            <span class="error-msg"><?php echo $error; ?></span>
         <?php endif; ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="Login Now" class="form-btn">
         <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
      </form>
   </div>
</body>

</html>
