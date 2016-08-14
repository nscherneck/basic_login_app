<?php // register.php

session_start();

if( isset($_SESSION['user_id']) ) {
  header("Location: /");
}

require_once 'database.php';

$message = NULL;

if(!empty($_POST['email']) && !empty($_POST['password'])) {
  // enter new user into database
  $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);
  $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $hash);

  if( $stmt->execute() ) {
    $message = "Thank you.  You've been registered successfully!";
  }
  else
    $message = "Sorry, an error has occured.  You have not been registered.";
}

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <title>Register Below</title>
  </head>
  <body>

    <div class="header">
      <a href="/">Your App Name</a>
    </div>

    <h1>Register</h1>
    <span>or <a href="login.php">login</a> here</span>

    <form action="register.php" method="POST">
      <input type="text" placeholder="Enter your email" name="email">
      <input type="password" placeholder="Enter your password" name="password">
      <input type="password" placeholder="Confirm your password" name="confirm_password">
      <input type="submit" value="Submit">
    </form>

    <?php
      if (!empty($message)) {
        echo $message;
      }
     ?>

  </body>
</html>
