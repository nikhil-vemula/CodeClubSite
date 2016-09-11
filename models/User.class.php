<?php 
class User{
	private $db;
	public function __construct($db){
		$this->db=$db;
	}
	public function authen($usr,$pass)
	{
		//echo $usr." ".$pass;
		$sql = "SELECT * FROM authen WHERE usrname='$usr' and pass=SHA1('$pass')";
		//Use the PDO connection to create a PDOStatement object
		$statement = $this->db->prepare($sql);
		//tell MySQL to execute the statement
		$statement->execute();
		//retrieve the first row of data from the table
		$user = $statement->fetchObject();
		//print_r(isset($user));
		return is_object($user);
	}
}
?>