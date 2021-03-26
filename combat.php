<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Css.css">
    <link rel="shortcut icon" href="IMG/logo.ico">
    <script src="main.js"></script>
    <title>Combat</title>
</head>
<body>
    
    <?php
    include "fonction.php"; 

    if($access){

        ?>
            <form action="index.php" method="post" >
                <div class="arti2">
                    <input class="input2" type="submit" value="Menu">
                </div>
            </form>
        <?php

        echo "<h1>Bienvenue au combat ".$Joueur1->getPrenom();
        echo " ton personnage est  ".$Joueur1->getNomPersonnage().".</h1>";

    }else{
        echo $errorMessage;
    }
    ?>
</body>
</html>