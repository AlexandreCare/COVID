<?php
        $MaBase = null;
    //connection a la base
    try{

        $MaBase = new PDO("mysql:host=mysql-woolfty.alwaysdata.net; dbname=woolfty_virus; charset=utf8", "woolfty_site", "Ale761mioNW2002");
        
    }catch(Exeption$e){
        echo $e->getMessage();
    }
    

    //fonction pour vérifier si l'utilisateur est bien connecter
    function check() {
        if($_SESSION && ( $_SESSION["Logged"] == true )) {
            return false;
        } else {
            return true;
        }
    }
    
    //formulaire pour la connexion de l'utilisateur
    function form($MaBase){
        ?>
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
                    if($tab = $Result->fetch()){ //selection des utilisateurs pour la connection
                        //si il existe et que le mot de passe correspond -> connection
                        $_SESSION["Logged"] = true;
                        $_SESSION["idUser"] = $tab['id'];

                        echo '<meta http-equiv="refresh" content="0">';
                    }
                }
            ?>
        <?php
    }
    //fonction de déconnection
    function deco(){
        //deconection
        ?>
            <form class="deco" action="" method="post">
                <input class="deco" type="submit" name="deco" value="Déconnexion">
            </form>
        <?php
        //déconnection
        if(isset($_POST["deco"])){
            $_SESSION["Logged"] = false;
            session_destroy();
            echo '<meta http-equiv="refresh" content="0">';
        }
    }
//fonction de session  pour les utilisateur admin
    function admin(){
        if($_SESSION && ( $_SESSION["admin"] == true )) {
            return false;
        } else {
            return true;
        }
    }
?>

