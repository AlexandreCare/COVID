<?php
    session_start();   // ouverture de la session
    include "fonction.php"; //appel de la page de fonction 
    if(check()){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/class.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <?php
        include "menu.php"; //appel le menu

        $user = new User($MaBase, $_SESSION["idUser"],1,1);

        //permet a l'utilisateur de se dconecter
        $user->deco();

        //permet a l'utilisateur de modifier son mdp
        $user->modifmdp();

        //permet a l'utilisateur de supprimer son compte
        $user->suppressionutilisateurs();

    }else{
        header("Location: index.php");
    }
    ?>
</body>
</html>