<?php
session_start();
require_once('Dao.php');
$dao = new Dao();
$dao->saveUser($_POST['user']);
header("Location: https://oldmoneywebsite.herokuapp.com/signup.php");
echo "Succesfully signed up";
?>
