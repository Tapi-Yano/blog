<?php
    include 'application/bdd_connection.php';

    if (empty($_POST))
    {
        if (!array_key_exists('id',$_GET) OR !ctype_digit($_GET['id'])) 
        {
            header('Location: index.php');
            exit();
        }
        $query=$pdo->prepare('
        SELECT Id, Title, Contents
        FROM Post 
        WHERE Id=?
        ');
        $query->execute(array($_GET['id']));
        $articles=$query->fetch();

        $template='edit_post';
        include 'layout.phtml';
    }
    else
    {
        $titre=htmlspecialchars($_POST['titre']);
        $contenu=htmlspecialchars($_POST['article']);
        $id=$_POST['postId'];

        $bdd=$pdo->prepare('
            UPDATE Post 
            SET Title=?, Contents=? 
            WHERE Id=?
            ');
        $bdd->execute(array($titre, $contenu, $id));
        
        header('Location: admin.php');
        exit();
    }