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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php
        include "menu.php";

        $user = new User($MaBase, $_SESSION["idUser"],1,1);

        $user->creationnouveauutilisateur();

    }else{
        header("Location: index.php");
    }
    ?>
</body>
</html>