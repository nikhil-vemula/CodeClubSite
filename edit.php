<?php
session_start();
if(!$_SESSION['authen'])
{
	header("Location: ./login.php");
	exit();
}
include_once "./conf.php";
include_once "./models/Post.class.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  try {
      $db = new PDO( $dbInfo, $dbUser, $dbPassword );
      $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $post = new Post($db);
      $title = htmlspecialchars($_POST['title']);
      $desc = htmlspecialchars($_POST['description']);
      $post->addPost($title,$desc,$_SESSION['usr']);
      header("Location: ./index.php");
    }catch ( Exception $e ) {
      echo "<h1>Connection failed!</h1><p>$e</p>";
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $('.noEnterSubmit').keypress(function(event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
  });
});
  function load(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demo").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("GET", "check.php?d="+document.getElementById('title').value, true);
  xhttp.send();
}
</script>
</head>
<body>
	<?php echo include_once "./navigation.php"?>
  <div class="container" style='margin-top: 2cm'>
  <form role="form" action="" method="post" id="editForm" name="editForm">
    <div class="alert alert-warning fade in" style='display:none;' id='error'>
    <strong>Fill All Fields</strong>
    </div>
  <div class="form-group  text-success text-left" id="demo" style="font-size: 20px"></div>   
  <div class="form-group">
  <label for="usr">Title:</label>
  <input type="text" class="form-control noEnterSubmit" name="title" id='title' onkeyup="load()">
  </div>
  <div class="form-group">
    <label for="comment">Description:</label>
    <textarea name='description' class="form-control" rows="5" id="description"></textarea>
  </div>
  <script>
  function validate()
  {
    var t = document.getElementById('title').value;
    var d = document.getElementById('description').value;
    if(t==""||t==null||d==""||d==null){
      document.getElementById('error').style.display='block';
    }
    else{
      document.getElementById('editForm').submit();
    }
  }
  </script>
  <button type="button" onclick="validate()"class="btn btn-default">Add</button>
  </form>
  </div>
</body>