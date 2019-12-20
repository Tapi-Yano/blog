<?php
include'application/bdd_connection.php';
$query='
SELECT *
FROM Post 
';
$yann = $_GET['id'];
$article =$pdo->prepare('
	DELETE 
	FROM Post
	WHERE Post.Id=?');
	$article->execute(array($yann));

header('location: admin.php');
exit();
