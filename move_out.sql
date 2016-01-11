-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 11 Janvier 2016 à 14:26
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `categorie_evenement`
--

INSERT INTO `categorie_evenement` (`IDcategorie_evenement`, `categorie`) VALUES
(1, 'Sport'),
(2, 'Gastronomie'),
(3, 'Musique'),
(4, 'Soirée'),
(5, 'Culturel'),
(6, 'Autre'),
(7, 'Spetacle'),
(8, 'Spectacle - Danse'),
(9, 'Exposition'),
(10, 'Conférence'),
(11, 'Brocante'),
(12, 'Musique - Concert'),
(13, 'Gastronomie - Pique-nique géant');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`IDcommentaire`, `date_ajout`, `heure_ajout`, `texte`, `IDutilisateur`, `IDevenement`) VALUES
(1, '2015-12-30', '00:38:55', 'Cool!', 2, 8),
(3, '2015-12-30', '01:31:57', 'C''est génial! En plus le père noël est trop sympa.', 1, 8),
(4, '2016-01-04', '14:08:52', 'Machiavélique!', 5, 2),
(5, '2016-01-04', '20:23:51', 'Mes enfants ont adoré!', 5, 8),
(6, '2016-01-05', '09:37:28', '<strong>Haha</strong>', 2, 8),
(7, '2015-10-14', '00:00:00', 'autre', 2, 8),
(8, '2016-01-05', '09:40:00', 'autre&\r\n', 2, 8),
(9, '2016-01-05', '09:42:49', 'commentaire', 2, 8);

-- --------------------------------------------------------

--
-- Structure de la table `date`
--

CREATE TABLE IF NOT EXISTS `date` (
  `date_actuelle` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `date`
--

INSERT INTO `date` (`date_actuelle`, `id`) VALUES
('2016-01-10', 1);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE IF NOT EXISTS `departement` (
  `departement_id` int(11) NOT NULL AUTO_INCREMENT,
  `departement_code` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom_uppercase` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `departement_nom_soundex` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`departement_id`),
  KEY `departement_slug` (`departement_slug`),
  KEY `departement_code` (`departement_code`),
  KEY `departement_nom_soundex` (`departement_nom_soundex`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Contenu de la table `departement`
--

INSERT INTO `departement` (`departement_id`, `departement_code`, `departement_nom`, `departement_nom_uppercase`, `departement_slug`, `departement_nom_soundex`) VALUES
(1, '01', 'Ain', 'AIN', 'ain', 'A500'),
(2, '02', 'Aisne', 'AISNE', 'aisne', 'A250'),
(3, '03', 'Allier', 'ALLIER', 'allier', 'A460'),
(5, '05', 'Hautes-Alpes', 'HAUTES-ALPES', 'hautes-alpes', 'H32412'),
(4, '04', 'Alpes-de-Haute-Provence', 'ALPES-DE-HAUTE-PROVENCE', 'alpes-de-haute-provence', 'A412316152'),
(6, '06', 'Alpes-Maritimes', 'ALPES-MARITIMES', 'alpes-maritimes', 'A41256352'),
(7, '07', 'Ardèche', 'ARDÈCHE', 'ardeche', 'A632'),
(8, '08', 'Ardennes', 'ARDENNES', 'ardennes', 'A6352'),
(9, '09', 'Ariège', 'ARIÈGE', 'ariege', 'A620'),
(10, '10', 'Aube', 'AUBE', 'aube', 'A100'),
(11, '11', 'Aude', 'AUDE', 'aude', 'A300'),
(12, '12', 'Aveyron', 'AVEYRON', 'aveyron', 'A165'),
(13, '13', 'Bouches-du-Rhône', 'BOUCHES-DU-RHÔNE', 'bouches-du-rhone', 'B2365'),
(14, '14', 'Calvados', 'CALVADOS', 'calvados', 'C4132'),
(15, '15', 'Cantal', 'CANTAL', 'cantal', 'C534'),
(16, '16', 'Charente', 'CHARENTE', 'charente', 'C653'),
(17, '17', 'Charente-Maritime', 'CHARENTE-MARITIME', 'charente-maritime', 'C6535635'),
(18, '18', 'Cher', 'CHER', 'cher', 'C600'),
(19, '19', 'Corrèze', 'CORRÈZE', 'correze', 'C620'),
(20, '2a', 'Corse-du-sud', 'CORSE-DU-SUD', 'corse-du-sud', 'C62323'),
(21, '2b', 'Haute-corse', 'HAUTE-CORSE', 'haute-corse', 'H3262'),
(22, '21', 'Côte-d''or', 'CÔTE-D''OR', 'cote-dor', 'C360'),
(23, '22', 'Côtes-d''armor', 'CÔTES-D''ARMOR', 'cotes-darmor', 'C323656'),
(24, '23', 'Creuse', 'CREUSE', 'creuse', 'C620'),
(25, '24', 'Dordogne', 'DORDOGNE', 'dordogne', 'D6325'),
(26, '25', 'Doubs', 'DOUBS', 'doubs', 'D120'),
(27, '26', 'Drôme', 'DRÔME', 'drome', 'D650'),
(28, '27', 'Eure', 'EURE', 'eure', 'E600'),
(29, '28', 'Eure-et-Loir', 'EURE-ET-LOIR', 'eure-et-loir', 'E6346'),
(30, '29', 'Finistère', 'FINISTÈRE', 'finistere', 'F5236'),
(31, '30', 'Gard', 'GARD', 'gard', 'G630'),
(32, '31', 'Haute-Garonne', 'HAUTE-GARONNE', 'haute-garonne', 'H3265'),
(33, '32', 'Gers', 'GERS', 'gers', 'G620'),
(34, '33', 'Gironde', 'GIRONDE', 'gironde', 'G653'),
(35, '34', 'Hérault', 'HÉRAULT', 'herault', 'H643'),
(36, '35', 'Ile-et-Vilaine', 'ILE-ET-VILAINE', 'ile-et-vilaine', 'I43145'),
(37, '36', 'Indre', 'INDRE', 'indre', 'I536'),
(38, '37', 'Indre-et-Loire', 'INDRE-ET-LOIRE', 'indre-et-loire', 'I536346'),
(39, '38', 'Isère', 'ISÈRE', 'isere', 'I260'),
(40, '39', 'Jura', 'JURA', 'jura', 'J600'),
(41, '40', 'Landes', 'LANDES', 'landes', 'L532'),
(42, '41', 'Loir-et-Cher', 'LOIR-ET-CHER', 'loir-et-cher', 'L6326'),
(43, '42', 'Loire', 'LOIRE', 'loire', 'L600'),
(44, '43', 'Haute-Loire', 'HAUTE-LOIRE', 'haute-loire', 'H346'),
(45, '44', 'Loire-Atlantique', 'LOIRE-ATLANTIQUE', 'loire-atlantique', 'L634532'),
(46, '45', 'Loiret', 'LOIRET', 'loiret', 'L630'),
(47, '46', 'Lot', 'LOT', 'lot', 'L300'),
(48, '47', 'Lot-et-Garonne', 'LOT-ET-GARONNE', 'lot-et-garonne', 'L3265'),
(49, '48', 'Lozère', 'LOZÈRE', 'lozere', 'L260'),
(50, '49', 'Maine-et-Loire', 'MAINE-ET-LOIRE', 'maine-et-loire', 'M346'),
(51, '50', 'Manche', 'MANCHE', 'manche', 'M200'),
(52, '51', 'Marne', 'MARNE', 'marne', 'M650'),
(53, '52', 'Haute-Marne', 'HAUTE-MARNE', 'haute-marne', 'H3565'),
(54, '53', 'Mayenne', 'MAYENNE', 'mayenne', 'M000'),
(55, '54', 'Meurthe-et-Moselle', 'MEURTHE-ET-MOSELLE', 'meurthe-et-moselle', 'M63524'),
(56, '55', 'Meuse', 'MEUSE', 'meuse', 'M200'),
(57, '56', 'Morbihan', 'MORBIHAN', 'morbihan', 'M615'),
(58, '57', 'Moselle', 'MOSELLE', 'moselle', 'M240'),
(59, '58', 'Nièvre', 'NIÈVRE', 'nievre', 'N160'),
(60, '59', 'Nord', 'NORD', 'nord', 'N630'),
(61, '60', 'Oise', 'OISE', 'oise', 'O200'),
(62, '61', 'Orne', 'ORNE', 'orne', 'O650'),
(63, '62', 'Pas-de-Calais', 'PAS-DE-CALAIS', 'pas-de-calais', 'P23242'),
(64, '63', 'Puy-de-Dôme', 'PUY-DE-DÔME', 'puy-de-dome', 'P350'),
(65, '64', 'Pyrénées-Atlantiques', 'PYRÉNÉES-ATLANTIQUES', 'pyrenees-atlantiques', 'P65234532'),
(66, '65', 'Hautes-Pyrénées', 'HAUTES-PYRÉNÉES', 'hautes-pyrenees', 'H321652'),
(67, '66', 'Pyrénées-Orientales', 'PYRÉNÉES-ORIENTALES', 'pyrenees-orientales', 'P65265342'),
(68, '67', 'Bas-Rhin', 'BAS-RHIN', 'bas-rhin', 'B265'),
(69, '68', 'Haut-Rhin', 'HAUT-RHIN', 'haut-rhin', 'H365'),
(70, '69', 'Rhône', 'RHÔNE', 'rhone', 'R500'),
(71, '70', 'Haute-Saône', 'HAUTE-SAÔNE', 'haute-saone', 'H325'),
(72, '71', 'Saône-et-Loire', 'SAÔNE-ET-LOIRE', 'saone-et-loire', 'S5346'),
(73, '72', 'Sarthe', 'SARTHE', 'sarthe', 'S630'),
(74, '73', 'Savoie', 'SAVOIE', 'savoie', 'S100'),
(75, '74', 'Haute-Savoie', 'HAUTE-SAVOIE', 'haute-savoie', 'H321'),
(76, '75', 'Paris', 'PARIS', 'paris', 'P620'),
(77, '76', 'Seine-Maritime', 'SEINE-MARITIME', 'seine-maritime', 'S5635'),
(78, '77', 'Seine-et-Marne', 'SEINE-ET-MARNE', 'seine-et-marne', 'S53565'),
(79, '78', 'Yvelines', 'YVELINES', 'yvelines', 'Y1452'),
(80, '79', 'Deux-Sèvres', 'DEUX-SÈVRES', 'deux-sevres', 'D2162'),
(81, '80', 'Somme', 'SOMME', 'somme', 'S500'),
(82, '81', 'Tarn', 'TARN', 'tarn', 'T650'),
(83, '82', 'Tarn-et-Garonne', 'TARN-ET-GARONNE', 'tarn-et-garonne', 'T653265'),
(84, '83', 'Var', 'VAR', 'var', 'V600'),
(85, '84', 'Vaucluse', 'VAUCLUSE', 'vaucluse', 'V242'),
(86, '85', 'Vendée', 'VENDÉE', 'vendee', 'V530'),
(87, '86', 'Vienne', 'VIENNE', 'vienne', 'V500'),
(88, '87', 'Haute-Vienne', 'HAUTE-VIENNE', 'haute-vienne', 'H315'),
(89, '88', 'Vosges', 'VOSGES', 'vosges', 'V200'),
(90, '89', 'Yonne', 'YONNE', 'yonne', 'Y500'),
(91, '90', 'Territoire de Belfort', 'TERRITOIRE DE BELFORT', 'territoire-de-belfort', 'T636314163'),
(92, '91', 'Essonne', 'ESSONNE', 'essonne', 'E250'),
(93, '92', 'Hauts-de-Seine', 'HAUTS-DE-SEINE', 'hauts-de-seine', 'H32325'),
(94, '93', 'Seine-Saint-Denis', 'SEINE-SAINT-DENIS', 'seine-saint-denis', 'S525352'),
(95, '94', 'Val-de-Marne', 'VAL-DE-MARNE', 'val-de-marne', 'V43565'),
(96, '95', 'Val-d''oise', 'VAL-D''OISE', 'val-doise', 'V432'),
(97, '976', 'Mayotte', 'MAYOTTE', 'mayotte', 'M300'),
(98, '971', 'Guadeloupe', 'GUADELOUPE', 'guadeloupe', 'G341'),
(99, '973', 'Guyane', 'GUYANE', 'guyane', 'G500'),
(100, '972', 'Martinique', 'MARTINIQUE', 'martinique', 'M6352'),
(101, '974', 'Réunion', 'RÉUNION', 'reunion', 'R500');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `evenement`
--

INSERT INTO `evenement` (`IDevenement`, `nom_evenement`, `numero_de_rue`, `bis`, `rue`, `ville`, `code_postal_evenement`, `pays`, `complement_adresse`, `date_creation`, `date_debut`, `date_fin`, `heure_debut`, `heure_fin`, `description_lieu_accueil`, `nb_de_places_max`, `complet`, `gratuit`, `prix_min`, `prix_max`, `accessibilite_handicape`, `a_propos`, `lien_auxiliaire`, `IDcategorie_evenement`, `IDmultimedia`, `IDcreateur`) VALUES
(2, 'carnaval du troll', 666, NULL, 'pouet', 'yolovillz', 75, 'france', 'venez nombreux y a des sorciere', '0000-00-00', '0666-06-06', '0666-06-06', '06:06:00', '06:06:00', 'caverne lugubre', 666, 0, 1, 0, 0, 0, '', '', 0, 0, 0),
(6, 'Concerto de noël', 23, 1, 'Rivoli', 'Paris', 75, 'france', 'Salle Montesquieux au rez-de-chaussée', '0000-00-00', '2015-12-23', '2015-12-23', '18:00:00', '22:00:00', 'Une salle de réception aménagée avec gout pour l''occasion', 50, 0, NULL, 50, 55, 0, '', '', 3, 0, 2),
(8, 'Rencontre avec le père noël', 1, NULL, 'Monoprix Corentin Celton', 'Issy les Moulineaux', 92, '', 'A l''entrée du magasin', '0000-00-00', '2015-12-22', '2015-12-22', '09:00:00', '16:30:00', 'Un Stand prévu à cet affet', 200, 1, NULL, 1, 2, 0, 'Venez avec votre liste de jouets !', '', 5, 60, 2),
(9, 'Ouverture de mes cadeaux', 5, NULL, 'rue Victor Hugo', 'Paris', 75, 'france', '', '0000-00-00', '2015-12-25', '2015-12-25', '08:00:00', '08:31:00', '', 5, 0, 1, 0, 0, 0, '', '', 5, 0, 2),
(10, 'Fête de l''oignon', 5, NULL, 'Grande Place', 'Roscoff', 29, 'France', 'A côté de la mairie', '2015-12-07', '2016-08-23', '2016-08-24', '10:00:00', '05:00:00', 'Se présenter aux comptoirs', 2000, 1, 1, 1, 1, 1, 'Pour fêter la récolte et se remémorer les traditions ancestrales', 'http://www.roscoff.fr/Fete-de-l-Oignon-de-Roscoff,343.html', 10, 0, 0),
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
  `date_creation` datetime NOT NULL,
  `IDreponse` int(11) NOT NULL,
  `IDutilisateur` int(11) NOT NULL,
  `IDtopic` int(11) NOT NULL,
  PRIMARY KEY (`IDmessage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`IDmessage`, `texte`, `date_creation`, `IDreponse`, `IDutilisateur`, `IDtopic`) VALUES
(1, 'Je suis carrément d''accord avec toi', '0000-00-00 00:00:00', 0, 1, 3),
(2, 'Moi ca va plutot bien', '0000-00-00 00:00:00', 0, 2, 3),
(3, 'test\r\n', '2016-01-05 15:54:16', 0, 2, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Contenu de la table `multimedia`
--

INSERT INTO `multimedia` (`IDmultimedia`, `type`, `lien`, `IDcreateur_multimedia`) VALUES
(1, 'image', 'Images/tomorrowland.jpg', 0),
(45, '', 'Images/11149555_1648521368711034_1432529128358503931_n.png', 3),
(60, '', 'Images/perenoel.jpg', 2),
(63, '', 'Images/98f60a0f8b44fbf648162a54c29b9453_large.jpeg', 1),
(65, '', 'Images/98f60a0f8b44fbf648162a54c29b9453_large.jpeg', 2);

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
  `nombre_participants` int(11) NOT NULL,
  PRIMARY KEY (`IDparticipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `participe`
--

INSERT INTO `participe` (`IDparticipe`, `IDevenement`, `IDutilisateur`, `date_inscription`, `heure_inscription`, `nombre_participants`) VALUES
(1, 10, 2, '2015-12-08', '23:00:00', 1),
(17, 8, 1, '2015-12-30', '01:33:03', 1),
(21, 11, 2, '2016-01-08', '21:22:30', 50),
(30, 9, 2, '2016-01-09', '00:47:03', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDutilisateur`, `admin`, `pseudo`, `nom_utilisateur`, `prenom_utilisateur`, `sexe`, `adresse_mail`, `mot_de_passe`, `date_de_naissance`, `numero_departement_de_residence`, `accepte_newsletter`, `IDimage_profil`) VALUES
(1, 0, 'yolo', 'yolo', 'yolo', 1, 'yolo@yolo.fr', '9d25f3b6ab8cfba5d2d68dc8d062988534a63e87', '2015-12-31', 0, 1, 63),
(2, 0, 'azerty', 'azerty', 'azerty', 1, 'azerty@azerty.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '1995-03-10', 75006, 1, 65),
(3, 0, 'Rikum', 'Dudu', 'Antonin', 1, 'antonin.duval@hotmail.fr', '9cf95dacd226dcf43da376cdb6cbba7035218921', '1995-12-28', 75001, 1, 45),
(4, 0, 'haha', 'liyto', 'lygmify', 1, 'aa@aa.fr', '637d1f5c6e6d1be22ed907eb3d223d858ca396d8', '2015-12-12', 75000, 1, 0),
(5, 0, 'a', 'a', 'a', 1, 'a@a.a', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '2016-01-08', 1, 1, 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
