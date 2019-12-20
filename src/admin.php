<?php
include'application/bdd_connection.php';

$query='
    SELECT 
        Post.Id,
        LastName,
        FirstName,
        Title,
        Contents,
        CreationTimestamp,
        Category_Id,
        Name
    FROM Post
    INNER JOIN Author ON Author.Id = Post.Author_Id
    INNER JOIN Category ON Post.Category_Id = Category.Id
    ORDER BY CreationTimestamp DESC';
$resultSet=$pdo->query($query);
$articles = $resultSet->fetchAll();

$template = 'admin';
include'layout.phtml';
