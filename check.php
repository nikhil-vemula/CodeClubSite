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
  $list="Related Posts: ";
  $found=false;
  for($i=0;$i<count($allPosts);$i++)
  {
  	$title = $allPosts[$i][0];
  	$key = strtolower($_GET['d']);
	if ($key!="" && strpos($title, $key) !== false) {
		$list.="<a href='./post.php?post=$title'>".$title."</a>&nbsp";
    	$found=true;
	}
  }
  echo $list;
?>