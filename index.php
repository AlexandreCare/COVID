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
    <link rel="stylesheet" href="CSS/class.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="" /><!--icone de l'onglet-->
    <title>COVID</title>
</head>
<body>
    <div class="space">
        <div class="arti3">
            <div class="form"> <!--classe css "form-->
                <form class="form1" action="" method="post">
                    <?php
                        form($MaBase);
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php
    }else{
        $gens = $MaBase->query("SELECT * FROM Users WHERE `id`='".$_SESSION["idUser"]."'");
        $sos=$gens->fetch();

        echo "<h1>Bienvenue ".$sos["pseudo"]."</h1>";

        deco();
    }
    ?>
</body>
</html>