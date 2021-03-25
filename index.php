<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css.css">
    <script src="main.js"></script>
    <title>Document</title>
</head>
<body>
    
    <?php
    //c'est dans fonction que l'on gère les formulaires de Co et les sessions
    include "fonction.php"; 

    if($access){
        
        echo "<h1><u>Bienvenue ".$Joueur1->getPrenom()."</u></h1>";
        $Perso = new Personnage($mabase);
        $Perso->getChoixPersonnage();
        ?>
        <div class="esp"></div>
        <div class="esp"></div>
        <?php
        if(!$Perso->getId()==0){
            $Joueur1->setPersonnage($Perso);
        }
        
        if(!empty($Perso->getNom())){
            echo '<a class="bouton" href="combat.php">Combatre avec '.$Perso->getNom().'</a>';
        }else{
            echo '<a class="bouton" href="combat.php">Combatre avec '.$Joueur1->getNomPersonnage().'</a>';
        }
    }else{
        echo $errorMessage;
    }
    ?>
</body>
</html>