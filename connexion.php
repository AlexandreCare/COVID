<?php
    session_start();
    include "fonction.php";
    if(check()){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php
        include "menu.php";

        $user = new User($MaBase, $_SESSION["idUser"]);

        $user->connexionutilisateur();

        ?>
            <a href="inscription.php">Inscription</a>
        <?php

    }else{
        header("Location: index.php");
    }
    ?>
</body>
</html>