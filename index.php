<?php
    session_start();// ouverture de la session
    include "fonction.php"; //appel de la page de fonction 
    if(check()){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="" /><!--icone de l'onglet-->
    <title>COVID</title>
</head>
<body>
    <div class="arti">
        <form class="form" action="" method="POST">
            <?php
                countuser($MaBase);
                connect($MaBase);
            ?>
        </form>   
    </div>
    <?php
    }else{
        name($MaBase);
    }
    ?>
</body>
</html>