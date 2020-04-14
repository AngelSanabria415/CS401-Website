<?php
session_start();
require_once 'Dao.php';
?>

<html>
<body>
<div class = "login">
<header><title>Log In</title></header>
 <h1>Please log in</h1>
    <form method ="POST" id="loginform" action="login_handler.php" autocomplete = "off">
      <div>
	<label for="email">Email:</label><br>
		<input type="email" id="email" name="email" placeholder="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"required/>
	</div>
	<br>

	<div>
	<label for="password">Password:
	<input type="password" id="password" name="password" placeholder="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password' : ''; ?>]"required/>
	</div>

	  <div>
	<button type="submit" value = "submit" id="login">Submit</button>
	</div>
    </form>

<div class="sessionerr">
	<?php if (isset($_SESSION['error']['email'])) { ?>
	<span  class="message"><?php echo $_SESSION['error']['email'] ?></span>
	<?php } ?>

	<?php if (isset($_SESSION['error']['password'])) { ?>
	<span  class="message"><?php echo $_SESSION['error']['password'] ?></span>
	<?php } ?>

	<?php if (isset($_SESSION['error']['message'])) { ?>
	<span  class="message"><?php echo $_SESSION['error']['message'] ?></span>
	<?php } ?>	
</div>

	<?php
	$error = isset($_GET['error']) ? $_GET['error'] : false;
	if($error == true){
	?>
	<span id="errorwarn"> Oh! no, your input was incorrect!</span>
	<button id="fadeoutbutton">Click to fade out warning</button>
	<?php }
	?>

</div>
</body>
</html> 
