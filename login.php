<?php
session_unset();
session_start();
$_SESSION['usr']="";
$_SESSION['authen']=false;
error_reporting(E_ALL);
ini_set("display_errors",1);
include_once "./models/User.class.php";
include_once "./conf.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	try {
		$db = new PDO( $dbInfo, $dbUser, $dbPassword );
		$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$user = new User($db);
		if($user->authen($_POST['usrname'],$_POST['passwd'])){
			$_SESSION['authen']=true;
			$_SESSION['usr']=$_POST['usrname'];
			header("Location: ./index.php");
		}
		else
		{	echo "
			<script>
				window.onload = function() {
				var error = document.getElementById('error');
  				error.style.display='block';
				}
			</script>
			";
		}
	}catch ( Exception $e ) {
			echo "
			<script>
				window.onload = function() {
				alert('<h1>Connection failed!</h1><p>$e</p>');
				}
			</script>
			";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Coding Group</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php echo include_once "./navigation.php"; ?>
	<div class="container">
		</br></br></br>
		<div class="col-sm-3"></div>
		<div class="jumbotron col-sm-6">
			 <form class="form-horizontal" role="form" action="" method="POST">
			 	<div class="form-group  text-danger text-center" id="error" style="display:none;"><h4>Incorrect username or password</h4></div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Username:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="usrname" name="usrname" placeholder="Enter username">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">Password:</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="passwd" name="passwd" placeholder="Enter password">
					</div>
				</div>
				<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
				</div>
				</div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
</body>