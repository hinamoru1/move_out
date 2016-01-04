-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 30 Décembre 2015 à 13:42
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `move_out`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_evenement`
--

CREATE TABLE IF NOT EXISTS `categorie_evenement` (
  `IDcategorie_evenement` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`IDcategorie_evenement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `categorie_evenement`
--

INSERT INTO `categorie_evenement` (`IDcategorie_evenement`, `categorie`) VALUES
(1, 'sport'),
(2, 'gastronomie'),
(3, 'musique'),
(4, 'soirée'),
(5, 'culturel'),
(6, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_public_vise`
--

CREATE TABLE IF NOT EXISTS `categorie_public_vise` (
  `IDcatégorie_public` int(11) NOT NULL AUTO_INCREMENT,
  `catégorie_public` varchar(255) NOT NULL COMMENT 'sous cathegories?',
  PRIMARY KEY (`IDcatégorie_public`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `IDcommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` date NOT NULL,
  `heure_ajout` time NOT NULL,
  `texte` text NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDcommentaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`IDcommentaire`, `date_ajout`, `heure_ajout`, `texte`, `IDutilisateur`, `IDevenement`) VALUES
(1, '2015-12-30', '00:38:55', 'Cool!', 2, 8),
(3, '2015-12-30', '01:31:57', 'C''est génial! En plus le père noël est trop sympa.', 1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `IDevenement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_evenement` varchar(255) NOT NULL,
  `numero_de_rue` int(11) NOT NULL,
  `bis` tinyint(1) DEFAULT NULL,
  `rue` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `code_postal_evenement` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `complement_adresse` text NOT NULL,
  `date_creation` date NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `description_lieu_accueil` text NOT NULL,
  `nb_de_places_max` int(11) NOT NULL,
  `complet` tinyint(1) NOT NULL,
  `gratuit` tinyint(1) DEFAULT NULL,
  `prix_min` int(11) NOT NULL,
  `prix_max` int(11) NOT NULL,
  `accessibilite_handicape` tinyint(1) DEFAULT NULL,
  `a_propos` text NOT NULL,
  `lien_auxiliaire` text NOT NULL,
  `IDcategorie_evenement` int(11) NOT NULL,
  `IDmultimedia` int(11) NOT NULL,
  `IDcreateur` int(11) NOT NULL,
  PRIMARY KEY (`IDevenement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`IDevenement`, `nom_evenement`, `numero_de_rue`, `bis`, `rue`, `ville`, `code_postal_evenement`, `pays`, `complement_adresse`, `date_creation`, `date_debut`, `date_fin`, `heure_debut`, `heure_fin`, `description_lieu_accueil`, `nb_de_places_max`, `complet`, `gratuit`, `prix_min`, `prix_max`, `accessibilite_handicape`, `a_propos`, `lien_auxiliaire`, `IDcategorie_evenement`, `IDmultimedia`, `IDcreateur`) VALUES
(2, 'carnaval du troll', 666, NULL, 'pouet', 'yolovillz', 75, 'france', 'venez nombreux y a des sorciere', '0000-00-00', '0666-06-06', '0666-06-06', '06:06:00', '06:06:00', 'caverne lugubre', 666, 0, 0, 0, 0, NULL, '', '', 0, 0, 0),
(6, 'Concerto de noël', 23, 1, 'Rivoli', 'Paris', 75, 'france', 'Salle Montesquieux au rez-de-chaussée', '0000-00-00', '2015-12-23', '2015-12-23', '18:00:00', '22:00:00', 'Une salle de réception aménagée avec gout pour l''occasion', 50, 0, NULL, 50, 55, 0, '', '', 3, 0, 2),
(8, 'Rencontre avec le père noël', 1, NULL, 'Monoprix Corentin Celton', 'Issy les Moulineaux', 92, 'france', '', '0000-00-00', '2015-12-22', '2015-12-22', '09:00:00', '16:30:00', '', 200, 0, NULL, 0, 0, 0, '', '', 5, 60, 2),
(9, 'Ouverture de mes cadeaux', 5, NULL, 'rue Victor Hugo', 'Paris', 75, 'france', '', '0000-00-00', '2015-12-25', '2015-12-25', '08:00:00', '08:31:00', '', 5, 0, 0, 0, 0, 0, '', '', 5, 0, 2),
(10, 'Fête de l''oignon', 5, NULL, 'Grande Place', 'Roscoff', 29, 'France', 'A côté de la mairie', '2015-12-07', '2016-08-23', '2016-08-24', '10:00:00', '05:00:00', 'Se présenter aux comptoirs', 2000, 1, 0, 1, 1, 1, 'Pour fêter la récolte et se remémorer les traditions ancestrales', 'http://www.roscoff.fr/Fete-de-l-Oignon-de-Roscoff,343.html', 10, 0, 0),
(11, 'Tomorrowland', 0, NULL, ' ', 'BOOM', 0, 'Belgique', '', '2015-12-17', '2016-07-22', '2016-07-24', '08:00:00', '23:00:00', '', 30000, 0, NULL, 50, 200, 1, 'L''épicentre de la musique electronique', '', 3, 1, 0),
(12, 'Cop 21', 1, NULL, 'Grand Palais', 'Paris', 75008, 'france', '', '0000-00-00', '2015-12-01', '2015-12-08', '09:00:00', '19:00:00', 'Cop 21', 100, 0, NULL, 5, 5, 1, 'zsz', '', 5, 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `infos_administration`
--

CREATE TABLE IF NOT EXISTS `infos_administration` (
  `lien_facebook_du_site` text NOT NULL,
  `lien_twitter_du_site` text NOT NULL,
  `lien_instagram_du_site` text NOT NULL,
  `lien_google+_du_site` text NOT NULL,
  `titre_page_accueil` varchar(255) NOT NULL,
  `sous_titre_page_accueil` varchar(255) NOT NULL,
  `IDadmin_principal` int(11) NOT NULL,
  `catégorie_mise_en_avant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `IDmessage` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `date_creation` date NOT NULL,
  `IDreponse` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDtopic` int(11) NOT NULL,
  PRIMARY KEY (`IDmessage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`IDmessage`, `texte`, `date_creation`, `IDreponse`, `IDutilisateur`, `IDtopic`) VALUES
(1, 'Je suis carrément d''accord avec toi', '0000-00-00', 0, 1, 3),
(2, 'Moi ca va plutot bien', '0000-00-00', 0, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `multimedia`
--

CREATE TABLE IF NOT EXISTS `multimedia` (
  `IDmultimedia` int(11) NOT NULL AUTO_INCREMENT,
  `type` set('image','vidéo') NOT NULL,
  `lien` text NOT NULL,
  `IDcreateur_multimedia` int(11) NOT NULL,
  PRIMARY KEY (`IDmultimedia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Contenu de la table `multimedia`
--

INSERT INTO `multimedia` (`IDmultimedia`, `type`, `lien`, `IDcreateur_multimedia`) VALUES
(1, 'image', 'Images/tomorrowland.jpg', 0),
(45, '', 'Images/11149555_1648521368711034_1432529128358503931_n.png', 3),
(60, '', 'Images/perenoel.jpg', 2),
(62, '', 'Images/fallout.jpg', 2),
(63, '', 'Images/98f60a0f8b44fbf648162a54c29b9453_large.jpeg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `multimedia_associe`
--

CREATE TABLE IF NOT EXISTS `multimedia_associe` (
  `IDmultimedia_associe` int(11) NOT NULL AUTO_INCREMENT,
  `IDevenement` int(11) NOT NULL,
  `IDmultimedia` int(11) NOT NULL,
  PRIMARY KEY (`IDmultimedia_associe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE IF NOT EXISTS `participe` (
  `IDparticipe` int(11) NOT NULL AUTO_INCREMENT,
  `IDevenement` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `heure_inscription` time NOT NULL,
  PRIMARY KEY (`IDparticipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `participe`
--

INSERT INTO `participe` (`IDparticipe`, `IDevenement`, `IDutilisateur`, `date_inscription`, `heure_inscription`) VALUES
(1, 10, 2, '2015-12-08', '23:00:00'),
(13, 11, 2, '0000-00-00', '00:00:00'),
(17, 8, 1, '2015-12-30', '01:33:03');

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE IF NOT EXISTS `preference` (
  `IDpreference` int(11) NOT NULL AUTO_INCREMENT,
  `IDutilisateur` int(11) NOT NULL,
  `IDcategorie_evenement` int(11) NOT NULL,
  PRIMARY KEY (`IDpreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `repot_abus`
--

CREATE TABLE IF NOT EXISTS `repot_abus` (
  `IDabus` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `IDredacteur` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDtopic` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDabus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie_evenement`
--

CREATE TABLE IF NOT EXISTS `sous_categorie_evenement` (
  `IDsous_categorie_evenement` int(11) NOT NULL AUTO_INCREMENT,
  `sous_categorie_evenement` varchar(50) NOT NULL,
  `IDcategorie_evenement` int(11) NOT NULL,
  `IDcreateur` int(11) NOT NULL,
  PRIMARY KEY (`IDsous_categorie_evenement`),
  UNIQUE KEY `sous_categorie_evenement` (`sous_categorie_evenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `IDthème` int(11) NOT NULL AUTO_INCREMENT,
  `nom_thème` varchar(255) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDtopic` int(11) NOT NULL,
  PRIMARY KEY (`IDthème`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `IDtopic` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `message_source` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDtheme` int(11) NOT NULL,
  PRIMARY KEY (`IDtopic`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `topic`
--

INSERT INTO `topic` (`IDtopic`, `titre`, `message_source`, `date_creation`, `IDutilisateur`, `IDtheme`) VALUES
(1, 'Le dernier concert de Nirvana !!', '', '2015-11-10 00:00:00', 3, 0),
(3, 'Bonjour tout le monde', 'Wesh ca va vous ?', '2015-12-15 00:00:00', 3, 0),
(6, 'Test date', 'test date', '2015-12-17 11:24:58', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IDutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `nom_utilisateur` varchar(50) CHARACTER SET utf32 NOT NULL,
  `prenom_utilisateur` varchar(50) NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `adresse_mail` varchar(90) NOT NULL,
  `mot_de_passe` varchar(50) CHARACTER SET utf32 NOT NULL,
  `date_de_naissance` date NOT NULL,
  `numero_departement_de_residence` int(5) NOT NULL,
  `accepte_newsletter` tinyint(1) NOT NULL,
  `IDimage_profil` int(11) NOT NULL,
  PRIMARY KEY (`IDutilisateur`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `pseudo_2` (`pseudo`),
  UNIQUE KEY `adresse_mail` (`adresse_mail`),
  UNIQUE KEY `adresse_mail_2` (`adresse_mail`),
  UNIQUE KEY `adresse_mail_3` (`adresse_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDutilisateur`, `admin`, `pseudo`, `nom_utilisateur`, `prenom_utilisateur`, `sexe`, `adresse_mail`, `mot_de_passe`, `date_de_naissance`, `numero_departement_de_residence`, `accepte_newsletter`, `IDimage_profil`) VALUES
(1, 0, 'yolo', 'yolo', 'yolo', 1, 'yolo@yolo.fr', '9d25f3b6ab8cfba5d2d68dc8d062988534a63e87', '2015-12-31', 0, 1, 63),
(2, 0, 'azerty', 'azerty', 'azerty', 1, 'azerty@azerty.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '1995-03-10', 75006, 1, 62),
(3, 0, 'Rikum', 'Dudu', 'Antonin', 1, 'antonin.duval@hotmail.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '1995-12-28', 75001, 1, 45),
(4, 0, 'haha', 'liyto', 'lygmify', 1, 'aa@aa.fr', '637d1f5c6e6d1be22ed907eb3d223d858ca396d8', '2015-12-12', 75000, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `vise`
--

CREATE TABLE IF NOT EXISTS `vise` (
  `IDvise` int(11) NOT NULL AUTO_INCREMENT,
  `IDevenement` int(11) NOT NULL,
  `IDcategorie_publique` int(11) NOT NULL,
  PRIMARY KEY (`IDvise`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `IDutilisateur` int(11) NOT NULL,
  `IDevenement` int(11) NOT NULL,
  PRIMARY KEY (`IDutilisateur`,`IDevenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `wishlist`
--

INSERT INTO `wishlist` (`IDutilisateur`, `IDevenement`) VALUES
(2, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
