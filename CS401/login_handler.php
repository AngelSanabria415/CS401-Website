<?php
  session_start();

 // probably check in a database using "userExists($username, $password)" or something
 // BUT... i'll just hardcode it for now...


  $username = "angelsanabria@gmail.com";
  $password = "1234";

  if ($username == $_POST['username'] && $password == $_POST['password']) {
    $_SESSION['auth'] = true;
    header("Location: https://oldmoneywebsite.herokuapp.com/");
    exit;
  } else {
    $_SESSION['auth'] = false;
    $_SESSION['message'] = "Invalid username or password";
    header("Location: https://oldmoneywebsite.herokuapp.com/login.php");
  }
?>
