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
    function formconnect($MaBase){
        ?>
            <u>
                <h2 class="gris">Connexion :</h2>
            </u>
            <input class="input" type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10"> <!--champ texte pour entrer sont pseudo-->

            <input class="input" type="password" placeholder="Entrez votre mot de passe" name="MDP">

            <input class="input" type="submit" name='co' value="connexion">  <!-- bouton d'inscription-->
            <?php
                if (isset($_POST["co"])) {

                    $Result = $MaBase->query("SELECT * FROM `Users` WHERE `pseudo`='".$_POST['nom']."' AND `mdp` = '".$_POST['MDP']."'");
                    if($tab = $Result->fetch()){ //selection des utilisateurs pour la connection
                        //si il existe et que le mot de passe correspond -> connection
                        $_SESSION["Logged"] = true;
                        $_SESSION["idUser"] = $tab['id'];
                        //echo '<meta http-equiv="refresh" content="0">';
                    }
                }
            ?>
        <?php
    }
    //formulaire pour l'inscription de l'utilisateur
    function forminscri($MaBase){
        ?>
            <u>
                <h2>Inscription :</h2>
            </u>
            
            <input class="input" type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10"> <!--champ texte pour entrer sont pseudo-->

            <input class="input" type="password" placeholder="Entrez votre mot de passe" name="MDP">

            <input class="input" type="password" placeholder="Confirmer le mot de passe" name="password" id="confirmpassword">

            <input class="input" type="submit" name='ins' value="S'inscrire">  <!-- bouton d'inscription-->
            <?php
                if (isset($_POST["ins"])) {

                    $exist = $MaBase->query("SELECT COUNT(*) FROM Users WHERE pseudo ='".$_POST['nom']."'");
                    $exist = $exist->fetch(); //selection le nom d'utilisateur

                    if ($exist["COUNT(*)"] > 0) { // on verifier que l'utilisateur n'existe pas

                        echo '<h3 class="desct">Cet utilisateur existe déjà...</h3>';
                        return;
                            
                    }else{

                        if($_POST['MDP'] == $_POST['password']) { //si les mot de passe corespondent 
                            $insert = $MaBase->query("INSERT INTO Users(pseudo, mdp) VALUES('".$_POST['nom']."','".$_POST['MDP']."')");
                                                //insertion dans la base des utilisateur du pseudo et du mot de passe
                            if($insert->rowCount()>=1){

                                $Result = $MaBase->query("SELECT * FROM `Users` WHERE `pseudo`='".$_POST['nom']."' AND `mdp` = '".$_POST['MDP']."'");
                                if($Result->rowCount()>0){ //selection des utilisateurs pour la connection

                                    $tab = $Result->fetch();
                                    //si il existe et que le mot de passe correspond -> connection
                                    $_SESSION["Logged"] = true;
                                    $_SESSION["idUser"] = $tab['id'];

                                    echo '<meta http-equiv="refresh" content="0">';
                                }
                            }
                    
                        }else{
                            //message d'erreur si les mots de passes ne correspondes pas
                            echo '<h3 class="desct">Les mots de passe ne corespondes pas...</h3>';
                        }
                    }
                }
    }
    //fonction pour choisir quels formulaire utilisé
    function connect($MaBase){
        ?>
            <input class="input" type="submit" name='connect' value="Se connecter">

            <input class="input" type="submit" name='inscri' value="Inscription">
        <?php
        if(isset($_POST["connect"])) {
            formconnect($MaBase);
        }
        if(isset($_POST["inscri"])) {
            forminscri($MaBase);
        }
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
    //function pour afficher le pseudo et le prénom de l'utilisateur
    function name($MaBase){
        $gens = $MaBase->query("SELECT * FROM Users WHERE `id`='".$_SESSION["idUser"]."'");
        $sos=$gens->fetch();

        echo "<h1>Bienvenue ".$sos["pseudo"].$sos["prenom"]."</h1>";

        deco();
    }
    //fonction qui affiche le nombre d'utilisateur en base
    function countuser($MaBase){
        //sélection du nombre d'utilisateur
        $nb = $MaBase->query("SELECT COUNT(*) FROM Users");
        $gens = $nb->fetch();
        echo '<h1>Déjà '.$gens['COUNT(*)'].' membres !</h1>';
    }
?>