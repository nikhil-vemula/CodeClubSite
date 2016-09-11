<?php 
class Question{
	private $db;
	public function __construct($db){
		$this->db=$db;
	}
	public function getQuestions($post_id)
	{
		$sql = "SELECT * FROM question WHERE post_id=$post_id;";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return $statement->fetchAll();
		else
			return 0;
	}
	public function addQuestion($post_id,$question)
	{
		$question=strtolower($question);
		$sql = "INSERT INTO question(post_id,question) VALUES($post_id,'$question')";
		$statement = $this->db->prepare($sql);
		$statement->execute();
	}
	public function delQuestion($title)
	{
		$sql = "UPDATE posts set visible=false WHERE title='$title';";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		echo $statement->rowCount();
	}
	public function getAnswers($post_id)
	{
		$sql = "SELECT * FROM question WHERE post_id=$post_id;";
		$statement = $this->db->prepare($sql);
		$statement->execute();
		if(!($statement->rowCount()==0))
			return $statement->fetchAll();
		else
			return 0;
	}
}
?>