<?php
session_start();
require_once 'Dao.php';
require_once 'KLogger.php';

$dao = new Dao();
$logger = new KLogger("log.txt",KLogger::WARN);

$firstname =$_POST["firstname"];
$lastname =$_POST["lastname"];
$email =$_POST["email"];
$password =$_POST["password"];
$password =$_POST["confirmedpassword"];
$valid = true;

$errors = array();
$_SESSION['setup']=array($_POST);

function valid_length($field, $min, $max)
{
	$trimmed = trim($field);
	return (strlen($trimmed) >= $min && strlen($trimmed) <= $max);
}

if(strlen($firstname) <= 0 || strlen($firstname) > 50)
{
	$errors['firstnameError'] = "First name is required and it must be less than 50 chracters.";
	echo $firstnameError;
	$valid = false;
}

if(!preg_match("/^[a-zA-Z]*$/",$firstname))
{
	$errors['firstname']="Please check your input! Only letters are valid.";
	$valid = false;
}

if(!filter_var($firstname, FILTER_SANITIZE_STRING)) 
{		
	$errors['firstnameInvalid'] = "Must be a valid first name.";
	$valid = false;
}

if(strlen($lastname) <=0 || strlen($lastname)>80)
{ 
		  
	$errors['lastnameError'] = "Last name is required and it must be less than 80 characters.";
	echo $lastnameError;
	$valid = false;
}

if(!preg_match("/^[a-zA-Z]*$/",$lastname))
{
	$errors['lastname']="Please check your input! Only letters are valid.";
	$valid = false;
}

if(!filter_var($lastname, FILTER_SANITIZE_STRING)) 
{
	$errors['lastnameInvalid'] = "Must be a valid last name.";
	$valid = false;
}

if(strlen($email) <=0 || strlen($email)>100)
{ 
	$errors['emailError'] = "Email is required and it must be less than 100 characters.";
	echo $emailErorr;
    	$valid = false;
		  
}
	
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
	$errors['emailInvalid'] = "Must be a valid email address!";
	$valid = false;
}

if(!valid_length($password, 2, 128))
{
	$errors['passwordError'] ="Please enter a password.";
	$valid = false;

}
else if($password != $password_match)
{
	$errors['passwordMatchError'] = "Password did not match!";
	$valid = false;
}
     
if($dao->checkEmailExists($email))
{
	$errors['emailexist']="Email already exists.";
}


$rlogger ->LogDebug("Clearing the session array");

if(empty($errors)){

	 if($valid == true){
	
	
			$_SESSION['signup_page'] = true;
			$rlogger->LogInfo("User has signed up successfully [{$email}]");	   
			$password=hash("sha256", "test".$password);				
			$dao->addUser($firstname, $lastname, $email, $password);
		
			header('Location: oldmoney.html');
		
	
	 }
	 else{

		$rlogger->LogWarn("User sign up was unsuccessful [{$email}]");
         	$messages =  " User sign up was unsuccessful. ";
		$errors['messages']=$messages;
		$_SESSION['messages'] = $errors['messages'];
		$_SESSION['emailexist'] =$errors['emailexist'];
        	$_SESSION['firstnameError'] =  $errors['firstnameError'];
		$_SESSION['firstname']=$errors['firstname'];
		$_SESSION['firstnameIvalid']=$errors['firstnameInvalid'];
		$_SESSION['lastnameError']=$errors['lastnameError'];
		$_SESSION['lastnameInvalid']=$errors['lastnameInvalid'];
		$_SESSION['lastname']=$errors['lastname'];
		$_SESSION['emailInvalid']=$errors['emailInvalid'];
		$_SESSION['emailError']=$errors['emailError'];
		$_SESSION['passwordError']=$errors['passwordError'];
		$_SESSION['passwordMatchError']=$errors['passwordMatchError'];
		$_SESSION['errors'] = $errors;
		header('Location: signup.php');
	 }
}

else{

		$_SESSION["errors"] = $errors;
		$_SESSION['presets'] = array('firstname' => htmlspecialchars($firstname), 'lastname' => htmlspecialchars($lastname),'email' => htmlspecialchars($email),
		'password' => htmlspecialchars($password), 'confirmedpassword' => htmlspecialchars($confirmedpassword));
		header('Location: signup.php');
}
?>
