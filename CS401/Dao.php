<?php
require_once 'Klogger.php';

class Dao {

private $db_user = "bca6b0fea2ffb4";
private $db_pass = "0124ed2f";
private $db_name = "clearDB_heroku";
private $database = "heroku_c8318cb02eed6b2";
private $host = "us-cdbr-iron-east-01.cleardb.net";

public function __construct() {
$this->logger = new KLogger("log.txt", KLogger::WARN);
}

public function getConnection() {
    try {
       $connection = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->db_user, $this->db_pass);
    } catch (Exception $e) {
      $this->logger->LogError("Couldn't connect to the database: " . $e->getMessage());
      return null;
    }
    return $connection;
}

public function saveUser ($firstname, $lastname, $email, $password) {
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
