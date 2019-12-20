<?php
include 'application/bdd_connection.php';
$query='
SELECT 
    LastName,
    FirstName,
    Title,
    Post.Contents,
    DATE_FORMAT(CreationTimestamp, "%d/%m/%Y à %H:%i:%s") AS date_article,
    Post.Id
FROM Post
INNER JOIN Author ON Author.Id = Post.Author_Id
ORDER BY date_article DESC';
$resultSet=$pdo->query($query);
$articles = $resultSet->fetchAll();

$template = 'index';
include 'layout.phtml';







