<?php
include 'application/bdd_connection.php';
$query='
INSERT INTO Comment (Post_Id, NickName, Contents, CreationTimestamp)  
VALUES (?,?,?,NOW())';
$coms = $pdo->prepare($query);

$coms->execute(array($_POST['PostId'],$_POST['NickName'],$_POST['contents']));



header('Location: show_post.php?Id='.$_POST['PostId']);
exit();



