<?php
session_start();
include_once "./conf.php";
include_once "./models/Post.class.php";
include_once "./models/Question.class.php";
{
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	try {
	      $db = new PDO( $dbInfo, $dbUser, $dbPassword );
	      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	      $post = new Post($db);
		  $question = new Question($db);
	      $i = $post->getPost($_GET['post']);
	      if($i!=0){
	      	$title = $i['title'];
	      	$description= $i['description'];
			$allQuestions = $question->getQuestions($i['post_id']);
	      }
	      else{
	   		echo "<h2>Post not found</h2>";
	    	exit();
	   		}
		if(isset($_GET['del'])&&$_GET['del'])
		{
			//$post->delPost($_GET['post']);
			header("Location:./index.php");
		}
		if(isset($_GET['question'])&&$_GET['question'])
		{
			$question->addQuestion($i[post_id],$_GET['question']);
			$loc = "Location:./post.php?post=".$i['title'];
			header($loc);
		}
	}catch ( Exception $e ) {
		echo $e;
	} 
}
?>
<?php 
  if($_SESSION['authen']==true)
  	$delbut="<button type='submit' class='btn btn-warning' data-toggle='modal' data-target='#myModal' id ='del' name='del' value='true'>Delete</button>";
  else
  	$delbut="";
?>
<html lang="en">
<head>
  <title>Coding Group</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src=".///ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="./maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php echo include_once "./navigation.php"?>
  <div class="container-fluid" style='margin-top: 1cm' >
  <div class="panel panel-default" style="margin-top: 25px;margin-bottom: 0px;">
  <div class="panel-heading"><h2><?php echo $title; ?></h2></div>
  <div class="panel-body"><p><?php echo $description; ?></p></div>
  <div class="panel-footer text-center">
  <form action="./post.php" method="get" id='delForm'>
  <input type="hidden" name='post' value='<?php echo $_GET['post']?>'></input>
  <?php echo $delbut; ?>
  </form>
  </div>
  </div>
  <div class="panel panel-default" style="margin-top: 25px;margin-bottom: 0px;">
  <div class="panel-heading" style="padding: 10px;">
  <h2>Questions</h2>
   <button class="btn btn-success" data-toggle="collapse" data-target="#demo">Ask Question</button>
	<div id="demo" class="collapse">
		<div class="container" style='margin-top: 2cm'>
		  <form role="form" action="" method="get" id="editForm" name="editForm">
			<div class="alert alert-warning fade in" style='display:none;' id='error'>
			<strong>Fill All Fields</strong>
			</div>   
		  <div class="form-group">
		  <label for="usr">Question:</label>
		  <input type="text" class="form-control noEnterSubmit" name="question" id='question'>
		  <input type="hidden" name="post" value="<?php echo $_GET['post']?>" id='question'>
		  </div>
		  
		  <script>
		  function validate()
		  {
			var t = document.getElementById('question').value;
			if(t==""||t==null){
			  document.getElementById('error').style.display='block';
			}
			else{
			  document.getElementById('editForm').submit();
			}
		  }
		  </script>
		  <button type="button" id="ask" name="ask" onclick="validate()"class="btn btn-default">Ask</button>
		  </form>
		</div>
	 </div>
  <div class="panel-body">
	<?php
	for($i=0;$i<count($allQuestions);$i++)
	{
		echo "<div class='panel panel-default' style='margin-top: 25px;margin-bottom: 0px;'>";
		echo "<div class='panel-heading'><p>".$allQuestions[$i][1]."</p></div>";
		echo "<div class='panel-body'>";
		echo "</div>";
		echo "</div>";
	}
	?>
  </div>
  
  </div>
</body>