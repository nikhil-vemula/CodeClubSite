<?php
session_start();
?>
<?php 
    include_once "./models/Post.class.php";
    include_once "./conf.php";
    try {
    $db = new PDO( $dbInfo, $dbUser, $dbPassword );
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $post = new Post($db);
    $allPosts = $post->getAllPosts();
  }catch ( Exception $e ) {
    echo "<script>alert($e);</script>";
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Coding Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="container-fluid" style="padding:0px;margin-top: 1cm">
  <?php echo include_once "./navigation.php"?>
    	<div class="jumbotron text-center">
      		<h1>&lt;/Code Club&gt;</h1>
    	</div>
  </div>
  <div id="notifications">
    <?php
      for($i=0;$i<count($allPosts);$i++)
      {
        /*echo "<div class='col-sm-4'>";
        echo "<div class='thumbnail'>";
        echo "<p><strong>New York</strong></p>";
        echo "<p>Saturday 28 November 2015</p>";
        echo "</div>";
        echo "</div>";*/
        $new ="";
        if(strtotime($allPosts[$i][3])-time() < 24*60*60)
         $new="<span class='label label-success style='margin: 20px;'>New</span>";
        echo "<a href='./post.php?post=".$allPosts[$i][0]."'>";
        echo "<div class='col-sm-3'>";  
        echo "<div class='panel panel-default' style='height:5cm'>";
        echo "<div class='panel-heading'><h4>".$allPosts[$i][0]."</h4></div>".$new;
        echo "<div class='panel-body'>".substr($allPosts[$i][1],0,100)."..."."</div>";
        echo "</div>"; 
        echo "</div>";
        echo "</a>";
        /*echo ("<tr>");
        for($j=0;$j<2;$j++)
        {
          echo ("<td>".$allPosts[$i][$j]."</td>");
        }
        echo ("</tr>");*/
      }
    ?>
  </div>
  </body>
</html>
