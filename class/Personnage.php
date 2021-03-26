<?php

class Personnage{
    
    private $_id;
    private $_nom;
    private $_vie;
    private $_degat;

    private $_bdd;

    public function __construct($bdd){
        $this->_bdd = $bdd;
    }

    public function setPersonnage($id,$nom,$vie,$degat){
        $this->_id = $id;
        $this->_nom = $nom;
        $this->_vie = $vie;
        $this->_degat = $degat;
    }

    public function getNom(){
        return $this->_nom;
    }
    public function getId(){
        return $this->_id;
    }

    public function setPersonnageById($id){
        $Result = $this->_bdd->query("SELECT * FROM `Personnage` WHERE `id`='".$id."' ");
        if($tab = $Result->fetch()){ 

            $this->setPersonnage($tab["id"],$tab["nom"],$tab["vie"],$tab["degat"]);
        }
    }

    //Retourne une liste HTML de tous les personnages
    //et permet d'attribuer un perso à un user
    // retour un objet personnage
    public function getChoixPersonnage(){
        $Result = $this->_bdd->query("SELECT * FROM `Personnage` ");
        
        ?>
        <form action="" method="post" onchange="this.submit()">
            <select name="idPersonnage" id="idPersonnage">
            <option value=""> Choisi un personnage</option>;
                <?php while($tab=$Result->fetch()){
                    echo '<option value="'.$tab["id"].'"> '.$tab["nom"].'</option>';
                }
                ?>
            </select>
        </form>
            <h1><u>Séléction du personnage :</u></h1>
        <?php       
        while($tab=$Result->fetch()){
            ?>
                <div class="space">
                    <img class="img" onclick="getId(<?php echo $tab['id'];?>)" id="<?php echo $tab['id'];?>" src="IMG/pp/<?php echo $tab['pdp']; ?>">
                    <?php
                        echo "<h1 class='nom'>".$tab["nom"]."</h1>";
                    ?>
                </div>
            <?php
        }
        $this->setPersonnageById(?><script>getId()</script><?php);
        
        return $this;
    }
}

?>