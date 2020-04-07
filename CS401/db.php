<?php

$db_user = "bca6b0fea2ffb4";
$db_pass = "0124ed2f";
$db_name = "clearDB_heroku";
$database = "heroku_c8318cb02eed6b2";
$host = "us-cdbr-iron-east-01.cleardb.net";

$db = new PDO('mysql:host=us-cdbr-iron-east-01.cleardb.net;dbname=clearDB_heroku', $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
