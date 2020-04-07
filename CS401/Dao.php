<?php
require_once 'Klogger.php';

class Dao {

private $username = 'bca6b0fea2ffb4';
private $password = '0124ed2f';
private $dbname = 'clearDB_heroku';
private $host = 'us-cdbr-iron-east-01.cleardb.net';
private $logger;

public function __construct() 
{
	$this->logger = new KLogger("log.txt", KLogger::WARN);
}

public function getConnection() 
{
    try {
       $connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
    } catch (Exception $e) {
      $this->logger->LogError("Couldn't connect to the database: " . $e->getMessage());
      return null;
    }
    return $connection;
}

public function saveUser () 
{
	$this->logger->LogDebug("Saving the user [{$firstname,$lastname}]");
	$conn = $this->getConnection();
	$saveQuery = "insert into user (firstname, lastname, email, password) values (:firstname, :lastname, :email, :password)";
	$q = $conn->prepare($saveQuery);
	$q->bindParam(":firstname", $firstname);
	$q->bindParam(":lastname", $lastname);
	$q->bindParam(":email", $email);
	$q->bindParam(":password", $password);
	$q->execute();

}
}
?>
