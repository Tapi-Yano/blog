<?php
include 'application/bdd_connection.php';
if (!array_key_exists('Id' , $_GET) OR !ctype_digit($_GET['Id']))
{
    header('Location: index.php');
    exit();
}
$query=$pdo->prepare('
	SELECT 
		Post.Id,
		Title,
		Contents,
		CreationTimestamp,
		Author.Id,
		FirstName,
		LastName
	FROM Post
	INNER JOIN Author ON Author.Id = Post.Author_Id
	WHERE Post.Id=?
	');

$query->execute(array($_GET['Id']));
$article = $query->fetch();


$query=$pdo->prepare('
	SELECT 
		Comment.Id,
		NickName,
		Comment.Contents AS com,
		DATE_FORMAT(Comment.CreationTimestamp, "%d/%m/%Y à %H:%i:%s") AS date_comment,
		Comment.Post_Id,
		Post.Id 
	FROM Comment
	INNER JOIN Post ON Comment.Post_Id = Post.Id
	WHERE Post.Id=?
	ORDER BY date_comment DESC
	');

$query->execute(array($_GET['Id']));
$comments= $query->fetchAll();

$template = 'show_post';
include 'layout.phtml';

