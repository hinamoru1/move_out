<header>
    <h1>Bienvenue dans le Back Office</h1>
    <h2>D'ici, vous pouvez gérer l'ensemble du site.</h2>
</header>
<section class="partie_gauche">
    <article>
        <h2>Outils de gestion :</h2>
        <ul>
            <li>Choisissez un utilisateur déja exitant et faites-en un administrateur :</li>
            <a href="back_office_recherche_utilisateur.php?action=admin">Ajouter un administrateur</a>
            <li>Modifier/Supprimer n'importe quel évènement simplement en accédant à sa page :</li>
            <a href="recherche_avancee.php">Modifier/Supprimer un évènement</a>
            <li>Modifier/Supprimer le profil de n'importe quel utilisateur du site :</li>
            <a href="back_office_recherche_utilisateur.php?action=voir">Rechercher un utilisateur</a>
        </ul>
    </article>
    <article>
        <h2>Informations : </h2>
        <p>Nombre d'inscrits : <?php echo $nb_inscrits; ?></p>
        <p>Nombre d'évènements : <?php echo $nb_evts; ?></p>
        <p>Nombres de messages sur le forum : <?php echo $nb_messages; ?></p>
    </article>
    <article>
        <h2>Gestion de l'apparence du site :</h2>
        <h3>Page d'accueil:</h3>
        <h3>Page d'aide:</h3>
    </article>
    
</section>
<section class="partie_droite">
    <article>
        <h2>Reports d'abus :</h2>
    </article>
</section>

