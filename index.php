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
                    <p>
                        <?php
                            //sélection du nombre d'utilisateur
                            $nb = $MaBase->query("SELECT COUNT(*) FROM Users");
                            $gens = $nb->fetch();

                            echo '<h1>Déjà '.$gens['COUNT(*)'].' membres !</h1>';
                        ?>
                    </p>
                    <u>
                        <h2 class="gris">Connexion :</h2>
                    </u>
                    <input class="input" type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10" required> <!--champ texte pour entrer sont pseudo-->

                    <input class="input" type="password" placeholder="Entrez votre mot de passe" name="MDP" required>

                    <input class="input" type="submit" name='submit' value="connexion">  <!-- bouton d'inscription-->
                    <?php
                        if (isset($_POST["submit"])) {

                            $Result = $MaBase->query("SELECT * FROM `Users` WHERE `pseudo`='".$_POST['nom']."' AND `MDP` = '".$_POST['MDP']."'");
                            if($Result->rowCount()>0){ //selection des utilisateurs pour la connection

                                $tab = $Result->fetch();
                                //si il existe et que le mot de passe correspond -> connection
                                $_SESSION["Logged"] = true;
                                $_SESSION["idUser"] = $tab['id'];

                                echo '<meta http-equiv="refresh" content="0">';
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
    <?php
    }else{
        header("location: acceuil.php");
    }
    ?>
</body>
</html>