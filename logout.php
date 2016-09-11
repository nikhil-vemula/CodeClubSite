<?php
	session_start();
	$_SESSION['usr']="";
	$_SESSION['authen']=false;
	header("Location: ./index.php");
?>