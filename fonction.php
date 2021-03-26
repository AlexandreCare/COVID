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
function img(){
    ?>
    <div class="">
        <img src='IMG/deroulant/1.jpg' id="bg" style="display: block;">  <!-- image 1-->
        <img src='IMG/deroulant/2.jpg' id="bg" style="display: none;" >  <!-- image 2-->
        <img src='IMG/deroulant/3.jpg' id="bg" style="display: none;" > <!-- image 3-->
        <img src='IMG/deroulant/4.jpg' id="bg" style="display: none;" > <!-- image 4-->
        <img src='IMG/deroulant/5.jpg' id="bg" style="display: none;" > <!-- image 5-->
        <img src='IMG/deroulant/6.jpg' id="bg" style="display: none;" > <!-- image 6-->
        <script type="text/javascript">
            // image deffilante 
            I = 0 ;
            Imax = document.images.length - 1 ;  
            setTimeout(suivante, 3000) ;   // definition du temps de passage des images         

            function suivante(){
                document.images[I].style.display = "none" ; 
                if ( I < Imax )  //boucle defilante 
                    I++;
                else
                    I=0;    
                document.images[I].style.display = "block";
                setTimeout(suivante, 3000) ;
            }
        </script>
    </div>
    <?php
}
?>