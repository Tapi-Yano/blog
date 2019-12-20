<?php
include 'application/bdd_connection.php';
if(isset($_POST['pass']) && isset($_POST['repeatpassword']))
{
    if($_POST['pass'] == $_POST['repeatpassword'])
    {
        // hachage du mot de passe 
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        // insertion des nouveau dans la bdd "membres"
        $req = $pdo->prepare('
        INSERT INTO membres(pseudo, pass, email, date_inscription)
        VALUES (?, ?, ?, CURDATE())
        ');
        $req->execute(array(
            $_POST['pseudo'],
            $pass_hache,
            $_POST['email']
        ));
    }else
    {
        echo 'le mot de passe est incorrecte';
    }
}

$template = 'news_membres';
include 'layout.phtml'; 
