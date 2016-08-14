<?php // index.php

session_start();

require_once 'database.php';

if( isset($_SESSION['user_id']) ) {
  $records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
  $records->bindParam(':id', $_SESSION['user_id']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $user = NULL;

  if( count($results) > 0) {
    $user = $results;
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <title>Welcome to the login Web App!</title>
  </head>
  <body>

    <div class="header">
      <a href="/">Your App Name</a>
    </div>

<?php if( !empty($user) ): ?>

  <br>Welcome, <?= $user['email']; ?>.
  <br>You are successfully logged in.
  <br><a href = "logout.php">Logout?</a>


<?php else: ?>

  <h1>Please login or register</h1>
  <a href="login.php">Login</a> or <a href="register.php">Register</a>

<?php endif; ?>

  </body>
</html>
