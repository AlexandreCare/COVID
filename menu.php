<nav>
    <div class="menu">
        <div class="esp"></div>
        <?php
            if(check()){
                ?>
                    <h5>
                        <a class="text" href="connexion.php">Connexion</a>
                    </h5>
                <?php
            }else{
                //selection dans ma base de l'utilisateur
                $utilisateurs = $MaBase->query("SELECT * FROM `User` WHERE `id`='".$_SESSION["idUser"]."'");
                $utilisateurs = $utilisateurs->fetch();

                //Affiche l'image de profil de l'utilisateur via son id
                echo '<h2 class="text">'.$utilisateurs['pseudo'].'</h2>';
                    
            
            }
            ?>
                <h6>
                    <!--bouton pour aller sur la page d'acceuil-->
                    <a class="text" href="index.php">Accueil</a>
                </h6>
            <?php

            if(check()){
            
            }else{
                //si l'utilisateur est connecter
                if(admin()){
                    //si l'utilisateur est Admin, vivion du lien vers la page d'administration
                    ?>
                        <h5>
                            <!--Bouton vers la page d'administration-->
                            <a class="admin" href="admin.php">Administration</a>
                        </h5>
                    <?php
                }
            }

            if(check()){
                echo '<h5> OuO </h5>';
            }else{
                //fonction de déconnexion
                deco();
            }

        ?>
    </div>
</nav>