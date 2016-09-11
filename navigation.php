<?php	
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(!$_SESSION['authen']){
	$i ="
		<li><a href='#'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
		<li><a href='./login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
	";
}
else{
	$i ="
	<li><a href='./edit.php'>Add Post</a></li>
	<li><a href='./logout.php'><span class='glyphicon glyphicon-log-out'></span> Log out</a></li>
	";
}

return "
<nav class='navbar navbar-inverse navbar-fixed-top' style='margin-bottom: 10px;'>
		<div class='container-fluid'>
			<div class='navbar-header'>
				<a class='navbar-brand' href='./index.php'>Code Club</a>
			</div>
		<ul class='nav navbar-nav'>
			<li><a href='./index.php'>Home</a></li>
			<li><a href='./news.php'>News</a></li>
		</ul>
		<ul class='nav navbar-nav navbar-right'>
		 $i
		</ul>
		</div>
</nav>";
?>