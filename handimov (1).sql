-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 jan. 2022 à 14:04
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `handimov`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessibilite`
--

DROP TABLE IF EXISTS `accessibilite`;
CREATE TABLE IF NOT EXISTS `accessibilite` (
  `etablissement` int(11) NOT NULL,
  `fauteuil` int(11) DEFAULT NULL,
  `visuel` int(11) DEFAULT NULL,
  `moteur` int(11) DEFAULT NULL,
  KEY `etablissement` (`etablissement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `accessibilite`
--

INSERT INTO `accessibilite` (`etablissement`, `fauteuil`, `visuel`, `moteur`) VALUES
(37, 4, 2, 5),
(39, 4, 3, 4),
(41, 4, 5, 4),
(43, 4, 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `amenagements`
--

DROP TABLE IF EXISTS `amenagements`;
CREATE TABLE IF NOT EXISTS `amenagements` (
  `etablissement` int(11) NOT NULL,
  `rampe` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `toilettes` tinyint(1) NOT NULL,
  `ascenseur` tinyint(1) NOT NULL,
  `douche` tinyint(1) NOT NULL,
  `lavabo` tinyint(1) NOT NULL,
  `comptoir` tinyint(1) NOT NULL,
  KEY `etablissement` (`etablissement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `amenagements`
--

INSERT INTO `amenagements` (`etablissement`, `rampe`, `parking`, `toilettes`, `ascenseur`, `douche`, `lavabo`, `comptoir`) VALUES
(37, 0, 1, 0, 1, 0, 1, 0),
(39, 0, 1, 0, 1, 0, 1, 0),
(41, 1, 0, 1, 1, 0, 1, 1),
(43, 1, 1, 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `avisetablissement`
--

DROP TABLE IF EXISTS `avisetablissement`;
CREATE TABLE IF NOT EXISTS `avisetablissement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `etablissement` int(11) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` text,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `etablissement` (`etablissement`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avisetablissement`
--

INSERT INTO `avisetablissement` (`id`, `user`, `etablissement`, `titre`, `note`, `commentaire`, `date`) VALUES
(1, 5, 37, 'Très bien', 4, '...', '2021-12-23'),
(2, 5, 37, 'Bof', 2, 'Je suis déçus, il était indiqué qu\'il y avait des toilettes adaptés aux handicapés mais c\'est faux ! il n\'y en avait pas ! ', '2021-12-23'),
(3, 6, 37, 'Excellent', 5, 'L\'établissement est parfaitement adapté à une personne en fauteuil roulant.\r\nJe recommande fortement !', '2021-12-23'),
(5, 5, 39, 'parfait', 4, 'parfait', '2022-01-05'),
(6, 5, 43, 'parfait', 5, '...', '2022-01-07'),
(7, 5, 43, 'Excellent', 5, 'top ! ', '2022-01-07');

--
-- Déclencheurs `avisetablissement`
--
DROP TRIGGER IF EXISTS `MAJnote`;
DELIMITER $$
CREATE TRIGGER `MAJnote` AFTER INSERT ON `avisetablissement` FOR EACH ROW UPDATE `etablissements` 
SET `etablissements`.`noteMoyenne` = 
	(SELECT ROUND((SUM(`avisetablissement`.`note`) /COUNT(*))) 
 	FROM `avisetablissement` 
	WHERE `avisetablissement`.`etablissement`= 			   `etablissements`.`id`)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categorieetablissement`
--

DROP TABLE IF EXISTS `categorieetablissement`;
CREATE TABLE IF NOT EXISTS `categorieetablissement` (
  `nomC` varchar(100) NOT NULL,
  PRIMARY KEY (`nomC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorieetablissement`
--

INSERT INTO `categorieetablissement` (`nomC`) VALUES
('Autre'),
('Bar'),
('Commerce'),
('Hotel'),
('Restaurant'),
('Supermarché');

-- --------------------------------------------------------

--
-- Structure de la table `estun`
--

DROP TABLE IF EXISTS `estun`;
CREATE TABLE IF NOT EXISTS `estun` (
  `etablissement` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  PRIMARY KEY (`etablissement`,`categorie`),
  KEY `categorie` (`categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `estun`
--

INSERT INTO `estun` (`etablissement`, `categorie`) VALUES
(41, 'Autre'),
(43, 'Autre'),
(39, 'Hotel'),
(37, 'Restaurant');

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomE` varchar(200) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `user` int(11) DEFAULT NULL,
  `noteMoyenne` int(11) DEFAULT NULL,
  `verif` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_image_user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `nomE`, `adresse`, `codepostal`, `ville`, `lat`, `lon`, `user`, `noteMoyenne`, `verif`) VALUES
(37, 'Le Petit Commines', '16 Rue Commines', 75003, 'Paris', 48.8620905, 2.3662163, 5, 4, 0),
(39, 'Lutetia', '45 Boulevard Raspail', 75006, 'France', 48.8473212003792, 2.3277298530425394, 5, 4, 0),
(41, 'Théâtre du Palais-Royal', '38 Rue de Montpensier', 75001, 'Paris', 48.866139, 2.3376327923875904, 5, NULL, 0),
(43, 'Université de Technologie de Troyes', '12 Rue Marie Curie', 10004, 'Troyes', 48.269078, 4.066495910506452, 5, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `imagesetablissements`
--

DROP TABLE IF EXISTS `imagesetablissements`;
CREATE TABLE IF NOT EXISTS `imagesetablissements` (
  `nom` varchar(255) NOT NULL,
  `etablissement` int(11) NOT NULL,
  PRIMARY KEY (`nom`),
  KEY `FK_image_etablissement` (`etablissement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `imagesetablissements`
--

INSERT INTO `imagesetablissements` (`nom`, `etablissement`) VALUES
('uploads/1925a8a970c4cac56de967144ad8913e.jpg', 37),
('uploads/40541005e5345f184902550211308cb3.jpg', 37),
('uploads/8acf6937c92c2f155bc3f082d2a96890.jpg', 37),
('uploads/f5b10ddab92c9a8a8c6895924c397a50.jpg', 37),
('uploads/04c78197d209529c3e3130096d5dffb1.jpg', 39),
('uploads/7f3b55b2b6310de8b5fa475fda6bd6c1.jpg', 39),
('uploads/bd22f4698767410e84a866ff3e736445.jpg', 39),
('uploads/e5eb3869f9f19da08f6b7a1502a70a12.jpg', 39),
('uploads/e950258898bb323d56d98d5d0aed3539.jpg', 39),
('uploads/0ada8b82dce8f9cb88b52a0ecad52662.jpg', 41),
('uploads/8b76a0c8c4512680183da5374d080e8d.jpg', 41),
('uploads/02dd6d1416be618c5ee26e80559034dc.jpg', 43),
('uploads/b1936640387c074344d4cbf5c085a51d.jpg', 43);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `roles`) VALUES
(5, 'theolevot', 'theo.le_vot@utt.fr', '$argon2id$v=19$m=65536,t=4,p=1$N1ltbmczaUV2cmJMMWxWNA$Aycsat5aoAyKWflXhfJVJUcDy5GhKpXda8M8b1SLq1I', '[\"ROLE_USER\"]'),
(6, 'le_treum', 'mathieuletreust@utt.fr', '$argon2id$v=19$m=65536,t=4,p=1$bDFjSmpYOGI0YWdxUncvVw$HbTMAAIWwWVnLJ4xcxYjCYdzlR4GbN/MI27KWJ9Y2Jw', '[\"ROLE_USER\"]');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accessibilite`
--
ALTER TABLE `accessibilite`
  ADD CONSTRAINT `accessibilite_ibfk_1` FOREIGN KEY (`etablissement`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `amenagements`
--
ALTER TABLE `amenagements`
  ADD CONSTRAINT `amenagements_ibfk_1` FOREIGN KEY (`etablissement`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `avisetablissement`
--
ALTER TABLE `avisetablissement`
  ADD CONSTRAINT `avisetablissement_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avisetablissement_ibfk_2` FOREIGN KEY (`etablissement`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `estun`
--
ALTER TABLE `estun`
  ADD CONSTRAINT `estun_ibfk_1` FOREIGN KEY (`categorie`) REFERENCES `categorieetablissement` (`nomC`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estun_ibfk_2` FOREIGN KEY (`etablissement`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etablissements`
--
ALTER TABLE `etablissements`
  ADD CONSTRAINT `FK_image_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `imagesetablissements`
--
ALTER TABLE `imagesetablissements`
  ADD CONSTRAINT `FK_image_etablissement` FOREIGN KEY (`etablissement`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
