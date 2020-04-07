<?php
  session_start();

  $email = $_POST['email'];
  $password = $_POST['password'];

  // to prevent mysql injections
  $email = stripcslashes($email);
  $password = stripcslashes($password);
  $email = mysql_real_escape_string($email);
  $password = mysql_real_escape_string($password);

  // connect to the serever and select database
  mysql_connect("us-cdbr-iron-east-01.cleardb.net", "bca6b0fea2ffb4", "0124ed2f");
  msql_select_db("clearDB_heroku");

  //Query the database for the user
  $result = mysql_query("select * from user where email = '$email' and password = '$password'") or die("Failed to query database " mysql_error());
  $row = mysql_fetch_array($result);

  //Default parameters to check if the login works 
  $email = "angelsanabria415@gmail.com";
  $password = "12345";

  if ($email == $_POST['email'] && $password == $_POST['password']) {
    $_SESSION['auth'] = true;
    header("Location: https://oldmoneywebsite.herokuapp.com/");
    exit;
  } else {
    $_SESSION['auth'] = false;
    $_SESSION['message'] = "Invalid email or password";
    header("Location: https://oldmoneywebsite.herokuapp.com/login.php");
  }
?>
