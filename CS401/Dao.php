<?php

class Dao{

private $user = 'bca6b0fea2ffb4';
private $pass = '0124ed2f';
private $db = 'heroku_c8318cb02eed6b2';
private $host = 'us-cdbr-iron-east-01.cleardb.net';

	public function getConnection() 
	{
    		try {
       		$conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
    		} catch (Exception $e) {
      		echo print_r($e,1);
    		}
    		return $conn;
	}

	public function addUser ($firstname, $lastname, $email, $password) 
	{
		$conn = $this->getConnection();
		$saveInput = "insert into user (firstname, lastname, email, password) value (:firstname, :lastname, :email, :password)";
		$q=$conn->prepare($saveInput);
		$q->bindParam(":firstname", $firstname);
		$q->bindParam(":lastname", $lastname);
		$q->bindParam(":email", $email);
		$q->bindParam(":password", $password);
		$q->execute();

	}


public function getConnectionStatus()
{
		$conn = $this->getConnection();
		return $conn->getAttribute(constant("PDO::ATTR_CONNECTION_STATUSS"));
}

public function getUser($email,$password){
		$conn = $this->getConnection();

		try{
			$getuser= "select email, password from user where email=:email and password=:password";
			$q=$conn->prepare($getuser);
			$q->bindParam(":email",$email);
			$q->bindParam(":password",$password);
			$q->execute();
			$result=$q->fetchAll();
			return reset($result);
		} catch(Exception $e) {
				echo print_r($e,1);
				exit;
			}
}

public function checkEmailExists($email)
{
	$conn=$this->getConnection();
	$stmt=$conn->prepare("SELECT email from user where email = :email");
	$stmt->bindParam(':email', $email);
	$stmt->execute();
	$returnRow = $stmt->fetch(PDO::FETCH_ASSOC);
	return $returnRow;
}

public function userExists($email)
{
		$conn=$this->getConnection();
		$stmt=$conn->prepare("SELECT firstname from user where email = :email");
		$stmt ->bindParam(':email', $email);	
		$stmt ->execute();
		$returnRow = $stmt->fetch(PDO::FETCH_ASSOC);
		return $returnRow;
		
}

}

?>
