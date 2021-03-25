<?php

class User{

    private $_id;
    private $_login;
    private $_mdp;
    private $_prenom;
    private $_MonPersonnage;

    private $_bdd;


    public function __construct($bdd){
        $this->_bdd = $bdd;
    }

    public function setUser($id,$login,$mdp,$prenom){
        $this->_id = $id;
        $this->_login = $login;
        $this->_mdp = $mdp;
        $this->_prenom = $prenom;
    }

    public function setUserById($id){
        $Result = $this->_bdd->query("SELECT * FROM `User` WHERE `id`='".$id."' ");
        if($tab = $Result->fetch()){ 
            $this->setUser($tab["id"],$tab["login"],$tab["mdp"],$tab["prenom"]);
            //chercher son personnage
            $personnage = new Personnage($this->_bdd);
            $personnage->setPersonnageById($tab["idPersonnage"]);
            $this->_MonPersonnage = $personnage;
        }
    }

    public function setPersonnage($Perso){
        $this->_MonPersonnage = $Perso;
        //je mémorise en base l'association du personnage dans user
        $req ="UPDATE `User` SET `idPersonnage`='".$Perso->getID()."' WHERE  `id` = '".$this->_id."'";
        $Result = $this->_bdd->query($req);
    }

    public function getPrenom(){
        return $this->_login;
    }

    public function getNomPersonnage(){
        return $this->_MonPersonnage->getNom();
    }

    public function ConnectToi(){

       //traitement du formulaire
    $access = false;
    if( isset($_POST["login"]) && isset($_POST["password"])){
        //verif mdp en BDD

        $Result = $this->_bdd->query("SELECT * FROM `User` WHERE `login`='".$_POST['login']."' AND `mdp` = '".$_POST['password']."'");
        if($tab = $Result->fetch()){ 

            $this->setUserById($tab["id"]);

             //si mdp = ok
            $access = true;
            $_SESSION["idUser"]= $tab["id"];
            $_SESSION["Connected"]=true;
            $afficheForm = false;
            //si on est co on affiche le formulaire de deco
            $this->DeconnectToi();
        }else{
            $afficheForm = true;
        }

    }else{
        $afficheForm = true;
    }
    
    if($afficheForm){
    ?>
    <div class="arti">
        <form class="form" action="" method="post" >

            <input class="input" type="text" name="login" id="login" placeholder="Entrez votre Pseudo" required>
            
            <input class="input" type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required>

            <input class="input" type="submit" value="Connexion" >

        </form>
    </div>

    <?php
    }

    return $access;
    }

    public function DeconnectToi(){

         //traitement du formulaire
    $afficheForm = true;
    $access = true;
    if( isset($_POST["logout"]) && isset($_POST["logout"])){
        //si on se deco on raffiche le formulaire de co
        $_SESSION["Connected"]=false;
        session_unset();
        session_destroy();
        $this->ConnectToi();
        $afficheForm = false;
        $access = false;
    }else{
        $afficheForm = true;
    }

    if($afficheForm){
    ?>
        <form action="" method="post" >
            <div class="arti2">
                <input class="input2" type="submit" value="Deconnexion" name="logout">
            </div>
        </form>

    <?php
    
    }

    return $access;
    }

}

?>