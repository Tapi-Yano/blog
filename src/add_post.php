<?php
include 'application/bdd_connection.php';
if(empty($_POST)){
$query='
SELECT *
FROM Author ';
$Author= $pdo->query($query);
$AuthorResult= $Author->fetchALL();

$query1='
SELECT *
FROM Category ';
$Category= $pdo->query($query1);
$CategoryResult= $Category->fetchALL();

$template='add_post';
include 'layout.phtml';
}
else{
$query3='
INSERT INTO Post (Title, Contents, CreationTimestamp, Author_Id, Category_Id)
VALUES (?, ?, NOW(), ?, ?)';

$Post_User=$pdo->prepare($query3);
$Post_User->execute(array($_POST['Title'],$_POST['contents'],$_POST['author'],$_POST['category']));



header('location: index.php');
exit();

}