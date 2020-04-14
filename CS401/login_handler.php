<?php
session_start();
require_once 'form_helper.php';
require_once 'Dao.php';
require_once 'KLogger.php';
$logger = new KLogger("log.txt",KLogger::WARN );
$email =  $_POST['email'];
$password = $_POST['password'];
$vaild = true;
$error=array();

function valid_length($field, $min, $max) {
	$trimmed = trim($field);
 	return (strlen($trimmed) >= $min && strlen($trimmed) <= $max);
}

if(!valid_length($password, 3, 256)){
	$error['password'] ="Please enter a password that has a greater length than 2.";
	$valid = false;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$error['emailerror1'] = "Must be a valid email address.";
	$valid = false;
}

if(!valid_length($email, 2, 100)){
	$error['emailerror2'] ="Please enter an email that has a character length of 2 and less than 100 characters.";
	$valid = false;
}

// email match using regular expressions
if(!preg_match('/\w+@\w+\.[a-zA-Z]{2,4}/',$email)){
	$error['emailerror3']="Please check your input.";
	$valid = false;
}

$logger ->LogDebug("Clearing the session array");

if($valid){
	$_SESSION['logged_in'] = true;
	$logger->LogInfo("User login successful [{$email}]");

}

else{
	$logger->LogWarn("User login failed [{$email}]");
	$_SESSION['invalid'] = "Invalid email or password";
}


$dao= new Dao();


try{
	$password=hash("sha256", "test".$password);

	$user = $dao->getUser($email,$password);


	$_SESSION['username'] = $dao->userExists($email);

	ensure_logged_in();

	if($user){
		$_SESSION["access_granted"]= true;
		$_SESSION["sentiment"]= "good";
		session_regenerate_id(true);
		$_SESSION['emailerror1'] = null;
		$_SESSION['emailerror2'] = null;
		$_SESSION['emailerror3'] = null;
		$_SESSION['password'] = null;
		redirectSuccess("oldmoney.html",NULL);
	}
	else{

		$_SESSION['sentiment']="bad";
		$errors['message'] = "Invalid username or password";
		$_SESSION['error']=$error;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		redirectError("login.php?error=true",$error,$presets);
	 }




}catch(Exception $e){
echo print_r($e,1);
}

?>
