<?php
//require_once 'Dao.php';
session_start();
$_SESSION['message'] = '';

$db_user = "bca6b0fea2ffb4";
$db_pass = "0124ed2f";
$db_name = "heroku_c8318cb02eed6b2";
$host = "us-cdbr-iron-east-01.cleardb.net";

//$dao = new Dao();


//Create connection
$mysqli = new mysqli('us-cdbr-iron-east-01.cleardb.net', 'bca6b0fea2ffb4', '0124ed2f','heroku_c8318cb02eed6b2');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//two passwords are equal to each other
	if ($_POST['password'] == $_POST['confirmedpassword'])
	{
		$firstname = $mysqli->real_escape_string($_POST['firstname']);
		$lastname = $mysqli->real_escape_string($_POST['lastname']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$password = md5($_POST['password']);
		
		// to prevent mysql injection
		$firstname = stripcslashes($firstname);
		$lastname = stripcslashes($lastname);
		$email = stripcslashes($email);
		$password = stripcslashes($password);
		$firstname = mysql_real_escape_string($firstname);
		$lastname = mysql_real_escape_string($lastname);
		$email = mysql_real_escape_string($email);
		$password = mysql_real_escape_string($password);


		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		
		$sql = "INSERT INTO user (firstname, lastname, email, password) " . "VALUES ('$firstname', '$lastname', '$email', '$password')";
		
		//$dao->saveUser();
		//exit;
		//if the query is successful, redirect to home page
		if($mysqli->query($sql) === true)
		{
			$_SESSION['message'] = 'Sign Up was successful';
			header("location: https://oldmoneywebsite.herokuapp.com/");
		}

		else
		{
			header("location: https://oldmoneywebsite.herokuapp.com/signup.php");
			$_SESSION['message'] = "An error occured and sign up was not successful. Please try again.";

		}
	}

	else
	{
		header("location: https://oldmoneywebsite.herokuapp.com/signup.php");
		$_SESSION['message'] = "The two passwords you entered did not match.";
	}
}



?>
