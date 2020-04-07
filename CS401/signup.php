<?php
session_start();
?>

<html>
<form action="signup_handler.php" method="post">
 <head>
    <title>Sign Up</title>
 <h1>Please Sign Up</h1>
 </head>
  <body>
	<div>First Name: <input type="text" id="firstname" 
		name="firstname"></div>
	<div>Last Name: <input type="text" id="lastname" 
		name="lastname"></div>
	<div>Email: <input type="email" id="email"
		name="email"></div>
	<div>Password: <input type="password" id="password"
		name="password"></div>
	<div>Confirm Password: <input type="password" id="confirmedpassword"
                name="confirmedpassword"></div>
        <button type="submit" name="signup-button">Sign Up</button>
  </body>
</form>
</html>	

