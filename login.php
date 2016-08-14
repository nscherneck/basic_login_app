<?php // login.php

session_start();

if( isset($_SESSION['user_id']) ) {
  header("Location: /");
}

require_once 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])) {

  $records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
  $records->bindParam(':email', $_POST['email']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  if( count($results) > 0 && password_verify($_POST['password'], $results['password']) ) {
    $_SESSION['user_id'] = $results['id'];
    header("Location: /");
  }
  else {
    $message = "Incorrect login credentials";
  }
}


 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <title>Login Below</title>
  </head>
  <body>

    <div class="header">
      <a href="/">Your App Name</a>
    </div>

    <h1>Login</h1>
    <span>or <a href="register.php">register</a> here</span>

    <form action="login.php" method="POST">
      <input type="text" placeholder="Enter your email" name="email">
      <input type="password" placeholder="Enter your password" name="password">
      <input type="submit" value="Submit">
    </form>

    <?php
      if (!empty($message)) {
        echo $message;
      }
     ?>

  </body>
</html>
