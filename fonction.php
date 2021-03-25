<?php 
include "class/User.php";
include "class/Personnage.php";

//GESTION DE LA BASE -----------------------
$mabase = null;
$access = null;
$errorMessage="";

try{
    $mabase = new PDO("mysql:host=mysql-woolfty.alwaysdata.net; dbname=woolfty_virus; charset=utf8", "woolfty_site", "Ale761mioNW2002");
        
}catch(Exception $e){
    $errorMessage .= $e->getMessage();
}

$Joueur1 = new User($mabase); 

//GESTION DES SESSION -----------------------
if(!is_null($mabase)){
    if (isset($_SESSION["Connected"]) && $_SESSION["Connected"]===true){
        $access = true;
        if(isset($_SESSION["idUser"])){
            $Joueur1->setUserById($_SESSION["idUser"]);
        }
        $access = $Joueur1->deconnectToi();
    }else{
        $access = false;
        $errorMessage.= "Vous devez vous connectez";
        // Affichage de formulaire si pas deconnexion
        $access = $Joueur1->ConnectToi();
    }
}else{
    $errorMessage.= "Vous n'avez pas les bases";
}
?>