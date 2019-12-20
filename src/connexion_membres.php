<?php 
include 'application/bdd_connection.php';
if(isset($_POST['pass']) && isset($_POST['pseudo']))
{
    //  Récupération de l'utilisateur et de son pass hashé
    $req = $pdo->prepare('
        SELECT
            id,
            pseudo,
            pass 
        FROM membres   
        WHERE pseudo = :pseudo
        ');
    $req->execute(array(
        'pseudo' => $pseudo
        ));
    $resultat = $req->fetch();
    var_dump($resultat);
    
    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);
   

    if (!$resultat)
    {
        echo 'Mauvais identifiant ou mot de passe !';
    }
    else
    {
        if ($isPasswordCorrect) {
            session_start();
            $_SESSION['id'] = $resultat['id'];
            $_SESSION['pseudo'] = $pseudo;
            echo 'Vous êtes connecté !';
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    }

}else {
    {
        header ('location: news_membres.php');
    }
}
    
    $template = 'connexion_membres';
    include 'layout.phtml'; 