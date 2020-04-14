<?php

function redirectError($location,$errors,$presets=NULL)
{	 
	 $SESSION["errors"]=$errors;
	 
	 if($presets) {
		 $_SESSION['presets']=$presets;
	 }
	 header("Location: $location");
	 die;
}

function redirectSuccess($location,$user=NULL)
{
	if($user){
		$_SESSION['user']=$user;
	}
	header("Location: $location");
}

function ensure_logged_in(){
	if(!isset($_SESSION["username"]))
	{
		redirect("login.php", "You must be logged in to view that page");
	
	}
}

function redirect ($url, $flash_message = null)
{
	if($flash_message){
		$_SESSION["flash"]= $flash_message;
	}
	header("Location: $url");
	die;
}

function hashingPassword($password)
{
    $password=hash("sha256", $password."qwert12345asdfg");
   return $password;
}

?>
