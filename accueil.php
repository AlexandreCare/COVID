<?php
    session_start();
    include "fonction.php";
    if(check()){
        echo "tu n'est pas connecter";
        ?>
            <a href="index.php">retourner a l'inscription</a>
        <?php
    }else{
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID</title>
</head>
<body>
    <?php
        $gens = $MaBase->query("SELECT * FROM Users");
        $sos=$gens->fetch();

        echo "<h1>Bienvenue ".$sos["pseudo"]."</h1>";

        deco();
    }
    ?>
</body>
</html>