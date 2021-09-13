<?php
    class User
    {
        private $_id;
        private $_MDP;
        private $_admin;
        private $_nom;

        public function __construct($bdd, $id) {
            //séléction des données de l'utilisateur via son id
            $query = $bdd->query("SELECT * FROM User WHERE id = $id")->fetch();

            $this->_id = $query["id"];
            $this->_MDP = $query["MDP"];
            $this->_nom = $query["pseudo"];
            $this->_admin = $query["admin"];
            $this->_BDD = $bdd;
        }

        //formulaire pour se crée un compte avec connexion a la fin de la création du compte
        public function creationnouveauutilisateur(){

            ?>
            <form action="" method="post">

                    <h2>Inscription :</h2>

                    <input type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10" required>

                    <input type="password" placeholder="Entrez votre mot de passe" name="MDP" required>

                    <input type="password" placeholder="Confirmer le mot de passe" name="password" id="confirmpassword" required>

                    <input type="submit" name='submit' value="S'inscrire">
                    <?php
            
                        if (isset($_POST["submit"])) {

                            //Recherche des informations via le pseudo entrer dans le formulaire
                            $exist = $this->_BDD->query("SELECT COUNT(*) FROM User WHERE pseudo ='".$_POST['nom']."'");
                            $exist = $exist->fetch();

                            //vérification que l'utilisateur n'exsite pas
                            if ($exist["COUNT(*)"] > 0) { 

                                echo '<h3>Cet utilisateur existe déjà...</h3>';
                                return;
                            
                            //si l'utilisateur n'existe pas alors on vérifie ses informations
                            }else{

                                //si les mot de passe corespondents
                                if($_POST['MDP'] == $_POST['password']) { 

                                    //ajout en base du nouvel utilisateur
                                    $insert = $this->_BDD->query("INSERT INTO User(pseudo, MDP,pdp,admin) VALUES('".$_POST['nom']."','".$_POST['MDP']."','default.png','false')");
                                                
                                        if($insert->rowCount()>=1){

                                            $Result = $this->_BDD->query("SELECT * FROM `User` WHERE `pseudo`='".$_POST['nom']."' AND `MDP` = '".$_POST['MDP']."'");
                                            if($Result->rowCount()>0){ //selection des utilisateurs pour la connection

                                                $tab = $Result->fetch();
                                                //si il existe et que le mot de passe correspond -> connection
                                                $_SESSION["Logged"] = true;
                                                $_SESSION["idUser"] = $tab['id'];
                                                $_SESSION["admin"] = $tab['admin'];

                                                echo '<meta http-equiv="refresh" content="0">';
                                            }
                                        }
                    
                                }else{
                                    //message d'erreur si les mots de passes ne correspondes pas
                                    echo '<h3>Les mots de passe ne corespondes pas...</h3>';
                                }
                            }
                        }
                    ?>
                </form>
            <?php

        }

        //supprime un utilisateur de la base définiment 
        public function suppressionutilisateurs(){
            ?>

            <p>
                <h2>Supprimer mon compte</h2>
                <input type="submit" name='destroy' value="Attention, cette action est irréversible !">
            </p>  
            
            <?php

            if (isset($_POST['destroy'])){

                //suppression des commentaires
                $rep = $this->_BDD->query("DELETE FROM User WHERE id= ".$this->_id." ");

                if($rep){
                    session_destroy ();
                    echo '<meta http-equiv="refresh" content="0">';
                }else{
                    echo "une erreur est survenue";
                }
            }
        }
        
        //fonction pour se déconnecter
        public function deco(){
            //deconection de l'utilisateur
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

        //Formulaire de connexion
        public function connexionutilisateur(){

            ?>
            <input type="text" placeholder="Entrez votre Pseudo" name="nom" maxlength="10" required>

            <input type="password" placeholder="Entrez votre mot de passe" name="MDP" required>

            <input type="submit" name='submit' value="Connexion">

            <?php

            if (isset($_POST["submit"])) {
                //selection des informations de l'utilisateur via son pseudo et son mot de passe
                $Result = $this->_BDD->query("SELECT * FROM `User` WHERE `pseudo`='".$_POST['nom']."' AND `MDP` = '".$_POST['MDP']."'");
            
                if($Result->rowCount()>0){ //vérifications que le compte existe

                    $tab = $Result->fetch();
                    //si le compte existe et que le mot de passe correspond -> connection
                    $_SESSION["Logged"] = true;
                    $_SESSION["idUser"] = $tab['id'];
                    $_SESSION["admin"] = $tab['admin'];

                    echo '<meta http-equiv="refresh" content="0">';
                }
            }
        }

        //permet a l'utilisateur de modifier son mot de passe
        public function modifmdp(){
            ?>
            <p>
                <form action="" method="post">

                    <h2>Modifier votre mot de passe</h2>

                    <input type="password" placeholder="Entrez votre ancient mot de passe" name="OLDMDP" required>
                    <input type="password" placeholder="Entrez le nouveau mot de passe" name="NEWMDP" required>
                    <input type="password" placeholder="Confirmer le nouveau mot de passe" name="NEWMDPCONF" required>

                    <input type="submit" name='Modif' value="changer">

                </form>
            </p> 

            <?php
            if($_POST['Modif']) {
                //vérification que le mot de passe corespond bien a l'ancien
                if($_POST['OLDMDP'] == ".$this->_MDP."){ 
                    //vérification que l'utilisateur a bien rentrer son nouveau mot de passe
                    if($_POST['NEWMDP'] == $_POST['NEWMDPCONF']){
                        //Remplacement du mot de passe
                        $rep = $this->_BDD->query("UPDATE `User` SET `MDP`='".$_POST['NEWMDP']."' WHERE id='".$this->_id."'");
                        if($rep){
                            echo "Le mot de passe changé";
                        }
                    }else{
                        echo "les mots de passe ne correspondent pas :/";
                    }
                }else{
                    echo "votre ancien mot de passe ne correspond pas :/";
                }
            } else {
                    echo "Une erreur est survenue";
            }
        }

        //ADMIN

        //affiche tout les utilisateurs avec leurs nom, id, mot de passe, grade
        public function showutilisateur(){
            $Result = $this->_BDD->query("SELECT * FROM `User` ");
            $tab = $Result->fetch();

            //affiche l'id
            echo '<h3> '.$tab['id'].'</h3>';
            //affiche le pseudo
            echo '<h3> '.$tab['pseudo'].'</h3>';
            //affiche le mdp
            echo '<h3> '.$tab['MDP'].'</h3>';
            //affiche le statue
            echo '<h3> '.$tab['admin'].'</h3>';
        }

        //supprime un utilisateur de la base définiment version Admin
        public function suppressionuser(){
            ?>

            <p>
                <form action="" method="post">

                    <h2>Supprimer un compte</h2>

                    <input type="text" placeholder="Entrez une ID" name="ID" required>
                    <input type="submit" name='destroy' value="Attention, cette action est irréversible !">

                </form>
            </p>  
            
            <?php

            if (isset($_POST['destroy'])){

                //suppression des commentaires
                $rep = $this->_BDD->query("DELETE FROM User WHERE id='".$_POST['ID']."'");

                if($rep){
                    session_destroy ();
                    echo '<meta http-equiv="refresh" content="0">';
                }else{
                    echo "une erreur lors de la suppression est survenue";
                }
            }
        }

        //permet de modifier le mot de passe d'un utilisateur ADMIN
        public function modifmdpuser(){

            ?>
            <p>
                <form action="" method="post">

                    <h2>Modifier le mot de passe</h2>

                    <input type="text" placeholder="Entrez l'ID de l'utilisateur" name="ID" required>
                    <input type="text" placeholder="Entrez le nouveau mot de passe" name="NEWMDP" required>
                    <input type="submit" name='Modif' value="changer">

                </form>
            </p> 

            <?php
            if($_POST['Modif']) {
                //Remplacement du mot de passe
                $rep = $this->_BDD->query("UPDATE `User` SET `MDP`='".$_POST['NEWMDP']."' WHERE id='".$_POST['ID']."'");
                if($rep){
                    echo "Le mot de passe changé";
                }
            } else {
                    echo "Une erreur est survenue";
            }
        }

        //permet a l'admin de crée un utilsateur
        public function ajoutuseradmin(){
            ?>
            <form action="" method="post">

                <h2>Ajout d'utilisateurs :</h2>

                <input type="text" placeholder="Entrez le pseudo" name="nom" maxlength="10" required>

                <input type="password" placeholder="Entrez le mot de passe" name="MDP" required>

                <input type="submit" name='submit' value="inscrire un membre">

                <?php
            
                    if (isset($_POST["submit"])) {

                        //Recherche des informations via le pseudo entrer dans le formulaire
                        $exist = $this->_BDD->query("SELECT COUNT(*) FROM User WHERE pseudo ='".$_POST['nom']."'");
                        $exist = $exist->fetch();

                        //vérification que l'utilisateur n'exsite pas
                        if ($exist["COUNT(*)"] > 0) { 

                            echo '<h3>Cet utilisateur existe déjà...</h3>';
                            return;
                            
                        //si l'utilisateur n'existe pas alors on vérifie ses informations
                        }else{

                            //si les mot de passe corespondents
                            if($_POST['MDP'] == $_POST['password']) { 

                                //ajout en base du nouvel utilisateur
                                $insert = $this->_BDD->query("INSERT INTO User(pseudo, MDP,admin) VALUES('".$_POST['nom']."','".$_POST['MDP']."','false')");
                                    if($insert->rowCount()>=1){
                                        echo "l'utilisateur a été crée";
                                    }
                    
                            }else{
                                //message d'erreur si les mots de passes ne correspondes pas
                                echo '<h3>Les mots de passe ne corespondes pas...</h3>';
                            }
                        }
                    }
                ?>
            </form>
        <?php
        }
    }
?>