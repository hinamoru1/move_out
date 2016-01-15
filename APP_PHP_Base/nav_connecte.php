<nav>
                <div class="gauche">
                    <a href="index.php"><img class="logo" src="Images/Logocomplet.png" alt="Accueil"/></a>
                    <a href="index.php"><img class="home" src="Images/home.png"/></a>
                </div>
                <div class="gauche">
                    <ul>
                        <li><a href="recherche_avancee.php">Rechercher un évènement</a></li>
                    </ul>
                </div>
                
                <div class="droite">
                    <ul>
                        <li><a href="deconnexion.php">Déconnexion</a></li>
                        <li><a href="faq.php">Aide</a></li>
                    </ul>
                </div>
                 <div class="droite">
                     <a href="profil.php"><img src="Images/Profil.png" alt="Mon Profil"/></a>
                </div>
                <?php
                if(isset($_SESSION['admin']))
                {echo '
                <div class="droite">
                    <a href="back_office.php"><img id="back_office" src="Images/Back_office.png" alt="Back Office"/></a>
                </div>';}?>

</nav>
