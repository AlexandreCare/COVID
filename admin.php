<?php
    session_start();
    include "fonction.php";
    if(check()){
        if(admin()){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php
        include "menu.php";

        $user = new User($MaBase, $_SESSION["idUser"],1,1);

        //permet d'ajouter un nouvel utilisateur
        $user->ajoutuseradmin();

        //permet de supprimer un utilisateur
        $user->suppressionuser();

        //permet de modifier le mot de passe d'un utilisateur
        $user->modifmdpuser();

        //permet de voir tout les utilisateurs du site
        $user->showutilisateur();

        }
    }else{
        header("Location: index.php");
    }
    ?>
</body>
</html>