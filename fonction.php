<?php
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
            header("Location: index.php");
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

