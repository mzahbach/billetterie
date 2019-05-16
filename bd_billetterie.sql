-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 10 mai 2019 à 12:21
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_billetterie`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `titre`) VALUES
(3, 'Cinema'),
(4, 'Stand Up'),
(5, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `category_price`
--

DROP TABLE IF EXISTS `category_price`;
CREATE TABLE IF NOT EXISTS `category_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_22FB6D9071F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category_price`
--

INSERT INTO `category_price` (`id`, `event_id`, `titre`, `discount`) VALUES
(1, 17, 'tarif etudiant', 0.2),
(2, 17, 'tarif standar', 0),
(3, 17, 'tarif senior', 0.3),
(4, 23, 'tarif standar', 0),
(5, 23, 'tarif etudiant', 0.2),
(6, 23, 'tarif senior', 0.3),
(8, 18, 'tarif standar', 0),
(9, 28, 'tarif standar', 0),
(10, 20, 'tarif standar', 0),
(11, 21, 'tarif standar', 0),
(12, 26, 'tarif standar', 0),
(13, 19, 'tarif standar', 0),
(14, 24, 'tarif standar', 0),
(15, 22, 'tarif standar', 0),
(16, 25, 'tarif standar', 0),
(18, 30, 'tarif Standar', 0);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `evenement_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C67B3B43D` (`users_id`),
  KEY `IDX_9474526CFD02F13` (`evenement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `users_id`, `evenement_id`, `created_at`, `content`) VALUES
(2, 1, 23, '2019-03-21 13:52:19', 'aaaaa'),
(3, 8, 23, '2019-03-26 16:10:01', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `devise`
--

DROP TABLE IF EXISTS `devise`;
CREATE TABLE IF NOT EXISTS `devise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `devise`
--

INSERT INTO `devise` (`id`, `titre`) VALUES
(1, '$'),
(2, '£'),
(3, 'dt');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_at` datetime NOT NULL,
  `fin_at` datetime NOT NULL,
  `prix` double NOT NULL,
  `nbr_place` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieux` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `devises_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B26681E12469DE2` (`category_id`),
  KEY `IDX_B26681E658D0DB4` (`devises_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `titre`, `debut_at`, `fin_at`, `prix`, `nbr_place`, `image`, `description`, `lieux`, `category_id`, `devises_id`) VALUES
(17, 'Aquaman', '2019-05-12 12:00:00', '2019-05-12 13:17:00', 15, 50, '9fbd6ed9ae991eddfdcc3e289af13713.jpeg', 'Les origines d\'un héros malgré lui, dont le destin est d\'unir deux mondes opposés, la terre et la mer. Cette histoire épique est celle d\'un homme ordinaire destiné à devenir le roi des Sept Mers : Aquaman.', 'Pathé tunis city', 3, 3),
(18, 'Avengers Infinity War', '2019-05-14 11:00:00', '2019-05-14 12:30:00', 15, 50, '86a23d551f9dcef00f4383b394a42a10.jpeg', 'Alors que les Avengers et leurs alliés ont continué de protéger le monde face à des menaces bien trop grandes pour être combattues par un héros seul, un nouveau danger est venu de l\'espace : Thanos. Despote craint dans tout l\'univers, Thanos a pour objectif de recueillir les six Pierres d\'Infinité, des artefacts parmi les plus puissants de l\'univers, et de les utiliser afin d\'imposer sa volonté sur toute la réalité. Tous les combats que les Avengers ont menés culminent dans cette bataille.', 'tunis Rio', 3, 3),
(19, 'Black Panther', '2019-03-19 13:00:00', '2019-03-19 14:30:00', 12, 60, 'e1d22bb489a18e721e1f37edd6722340.jpeg', 'Après les événements qui se sont déroulés dans Captain America : Civil War, T\'Challa revient chez lui prendre sa place sur le trône du Wakanda, une nation africaine technologiquement très avancée mais lorsqu\'un vieil ennemi resurgit, le courage de T\'Challa est mis à rude épreuve, aussi bien en tant que souverain qu\'en tant que Black Panther. Il se retrouve entraîné dans un conflit qui menace non seulement le destin du Wakanda mais celui du monde entier.', 'tunis internationale', 3, 3),
(20, 'Deadpool 2', '2019-04-01 09:00:00', '2019-04-01 10:30:00', 20, 50, '8f325eeb2a9c666352330a3ad384bf3b.jpeg', 'L\'insolent mercenaire de Marvel est de retour. Dans cet opus, Deadpool devra réunir une équipe de mutants dissidents pour protéger un garçon aux habilités extraordinaires de Cable, un super-soldat cyborg malveillant voyageant dans le temps. Bottage de fesses en perspective, car pour faire le bien, il faut parfois savoir faire le mal..', 'Pathé tunis city', 3, 3),
(21, 'Dragon Ball Super Broly', '2019-05-02 13:00:00', '2019-05-02 14:30:00', 15, 50, '0963f1b9971b131d263bf9f7ae3f4850.jpeg', 'Dragon Ball Super: Broly est le vingtième film d\'animation japonais de l\'univers Dragon Ball, sorti en 2018. Il s\'agit du troisième long métrage basé sur la série Dragon Ball Super, l\'intrigue reprenant juste après l\'arc Survie de l\'Univers.', 'Pathé tunis city', 3, 3),
(22, 'Fittest on Earth', '2019-05-30 16:00:00', '2019-05-30 16:30:00', 20, 50, '651c2992731fa7265d3221d1d57abece.jpeg', 'In 2017 the fittest athletes on Earth took on the unknown and unknowable during four of the most intense days of competition in CrossFit Games history. \"The Redeemed and the Dominant', 'agora Marsa tunis', 5, 3),
(23, 'Froning The Fittest Man in History', '2019-05-29 17:00:00', '2019-05-29 18:30:00', 13, 50, 'e99432dcd0475914319f1329db4a2a22.jpeg', 'Rich Froning Jr. is a legend in CrossFit and the Sport of Fitness. In this biopic, take a look at his childhood, follow his quest for a fourth CrossFit Games title, and see him as a son, a husband and a new father.', 'tunis internationale', 3, 3),
(24, 'Les Indestructibles 2', '2019-03-17 14:00:00', '2019-03-17 15:30:00', 20, 50, 'edcbf10ed520d44be0e66b20664d29b9.jpeg', 'Hélène se retrouve sur le devant de la scène et laisse à Bob le soin de mener à bien les mille et une missions de la vie quotidienne et de s\'occuper de Violette, Flèche et de bébé Jack-Jack. C\'est un changement de rythme difficile pour la famille d\'autant que personne ne mesure réellement l\'étendue des incroyables pouvoirs du petit dernier. Lorsqu\'un nouvel ennemi fait surface, les familles et Frozone vont devoir s\'allier comme jamais pour déjouer son plan machiavélique.', 'agora Marsa tunis', 3, 3),
(25, 'Mission impossible  Fallout', '2019-03-30 12:30:00', '2019-03-30 14:00:00', 12, 50, '3ed46c16cafb5be1d12715117514c9b3.jpeg', 'Les meilleures intentions finissent souvent par se retourner contre vous. Dans ce film, Ethan Hunt, accompagné de son équipe de l\'IMF - Impossible Mission Force - et de quelques fidèles alliées sont lancés dans une course contre la montre, suite au terrible échec d\'une mission.', 'Pathé tunis city', 3, 3),
(26, 'Solo A Star Wars Story', '2019-04-01 16:00:00', '2019-04-01 17:00:00', 12, 50, '39ec8f56cd2d37c2db7fd68912051aea.jpeg', 'Le jeune Han Solo s\'allie à une bande de contrebandiers intergalactiques et à un vieux Wookie de 190 ans nommé Chewbacca. Ayant une dette auprès du gangster Dryden Vos, l\'équipe met en place un plan pour dérober du Coaxium en provenance des mines de Kessel. Ils ont désespérément besoin d\'un vaisseau ultra-rapide, Solo rencontre donc Lando Calrissian, propriétaire du vaisseau parfait : le Faucon Millenium.', 'agora Marsa tunis', 3, 3),
(27, 'Tomb Raider', '2019-03-07 12:00:00', '2019-03-07 13:30:00', 12, 50, 'b0e2b22d1cef55408a1eed2de569e6be.jpeg', 'Lara Croft, 21 ans, n\'a ni projet, ni ambition : fille d\'un explorateur excentrique porté disparu depuis sept ans, cette jeune femme rebelle et indépendante refuse de reprendre l\'empire de son père. Convaincue qu\'il n\'est pas mort, elle met le cap sur la destination où son père a été vu pour la dernière fois : la tombe légendaire d\'une île mythique au large du Japon. Le voyage se révèle des plus périlleux et il lui faudra affronter d\'innombrables ennemis et repousser ses propres limites.', 'agora Marsa tunis', 3, 3),
(28, 'Venom', '2019-03-13 13:00:00', '2019-03-13 14:30:00', 15, 50, '39ad85aad811deffc01feb463c49feed.jpeg', 'Venom est un film de super-héros américain réalisé par Ruben Fleischer, sorti en 2018. Il s\'agit de l’adaptation cinématographique du personnage Venom, ennemi de Spider-Man, publié par Marvel Comics.', 'tunis internationale', 3, 3),
(30, 'Double face', '2019-05-16 17:00:00', '2019-05-16 18:00:00', 6, 50, 'ba9c41c64248a46a83c56f50119538ba.jpeg', 'spectacle de stand up tunisien  pour karim gharbi et bassem hamraoui trjvnj ergqsnd q sd fd ds dsg f df d fd dfq pdj qfsdf df', 'tunis internationale', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `ext`
--

DROP TABLE IF EXISTS `ext`;
CREATE TABLE IF NOT EXISTS `ext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_total` double NOT NULL,
  `transaction` tinyint(1) NOT NULL,
  `descrption_facture` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `devis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `titre`, `user_name`, `prix_total`, `transaction`, `descrption_facture`, `devis`) VALUES
(24, 'Dragon Ball Super Broly', 'bechir', 60, 1, '+ le nombre de billets reservez est de 4 du Pack : tarif standar + ', 'dt'),
(25, 'Dragon Ball Super Broly', 'bechir', 15, 1, '+ le nombre de billets reservez est de 1 du Pack : tarif standar + ', 'dt');

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'bechir', 'bechir', 'bechir.mzah@esprit.tn', 'bechir.mzah@esprit.tn', 1, NULL, '$2y$13$MXW83o3YLfKM.HQkeuCSj.SuAlabHu.OP3kl6KPkNHfOBB9eF8qJS', '2019-05-10 11:36:22', 'MFdBs-RbEVE4Ns0nZSFJp0qbMzKF2PbfGTjy8a2JyOg', '2019-03-18 09:09:33', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'test', 'test', 'test@test.com', 'test@test.com', 0, NULL, 'azeqsd', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(3, 'test12', 'test12', 'tttt@zz.z', 'tttt@zz.z', 1, NULL, '$2y$13$2.wQjPeOrGInyo.800dEAuFO5IkJWSPbTqS1uG5JcZWuniVDMi1eC', NULL, NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(4, 'baha', 'baha', 'baha@b.c', 'baha@b.c', 1, NULL, '$2y$13$mx./zAqffhK7eX/OKmkdueLZNHuPQ8Vz.ZXk6uj8V3GVxjdrl43zu', '2019-03-04 14:54:05', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(5, 'iheb', 'iheb', 'iheb@em.e', 'iheb@em.e', 1, NULL, '$2y$13$YjUJKs7Jnpw0Xo13jZ0G6eAVvefUenC2U4VJSx6E3MJHaEwd6k8mu', '2019-03-05 16:03:59', NULL, NULL, 'a:0:{}'),
(6, 'test123', 'test123', 'bechir@hotmail.fr', 'bechir@hotmail.fr', 1, NULL, '$2y$13$gQ7CuZ..C0I7BWVJZzZbJenyZj120LHf0k.ML3UM0vG6x07EYArRS', '2019-03-04 16:21:26', NULL, NULL, 'a:0:{}'),
(7, 'saif', 'saif', 'saif@saif.tn', 'saif@saif.tn', 1, NULL, '$2y$13$6L65JGNhAI7hzVKv/2aE2eMDQvsVZJzTqrYFKdiEjKQWwDtddBeam', '2019-03-08 14:36:46', NULL, NULL, 'a:0:{}'),
(8, 'anwaar', 'anwaar', 'anwaar@gmail.com', 'anwaar@gmail.com', 1, NULL, '$2y$13$TTnckcaXALhRzwMf2E6Mcu43/kJc6WAU2hhpyX/R5XkYlBinRsWla', '2019-05-10 12:06:02', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190221135014', '2019-02-21 13:50:38'),
('20190221135821', '2019-02-21 13:58:43'),
('20190226133836', '2019-02-26 13:38:56'),
('20190227105213', '2019-02-27 10:52:24'),
('20190302160546', '2019-03-02 16:06:02'),
('20190321093821', '2019-03-21 09:39:50'),
('20190327165008', '2019-03-27 16:50:45'),
('20190328133217', '2019-03-28 13:32:35'),
('20190328134536', '2019-03-28 13:45:49'),
('20190328135220', '2019-03-28 13:52:32'),
('20190403102242', '2019-04-03 10:24:11'),
('20190407141831', '2019-04-07 14:19:39'),
('20190415151740', '2019-04-15 15:18:00'),
('20190426093440', '2019-04-26 09:35:33'),
('20190426093844', '2019-04-26 09:38:52');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `nom`, `email`, `subject`, `message`) VALUES
(2, 'test', 'ttt@tt.t', 'tttt', 'ttttttttt'),
(3, 'bechir', 'mzah.bechir@gmail.com', 'test', 'guide el  map ta3 l application  we ya3tik sa7a :p'),
(4, 'bechir', 'bechir.mzah@esprit.tn', 'test', 'haya 3ad emchi aman fadit haka :('),
(5, 'test', 'bechir.mzah@esprit.tn', 'haya', 'haya e5dem aman :('),
(6, 'test', 'bbbb@b.b', 'test', 'test tetet t t e  te e e e t e'),
(7, 'bechir', 'test@at.n', 'test', 's s g fsg fdg dfg df gfg dfg fdg dfg dfgdf g dfgfd gdf hh jujuy yjfd g dgdfghfg ghgf');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `nbr_place` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_24CC0DF267B3B43D` (`users_id`),
  KEY `IDX_24CC0DF21919B217` (`pack_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post_like`
--

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE IF NOT EXISTS `post_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_653627B84B89032C` (`post_id`),
  KEY `IDX_653627B8A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post_like`
--

INSERT INTO `post_like` (`id`, `post_id`, `user_id`) VALUES
(2, 22, 8),
(6, 17, 1),
(9, 20, 1),
(23, 26, 1),
(24, 23, 1),
(26, 22, 1),
(27, 28, 1),
(28, 24, 1),
(30, 23, 8),
(35, 21, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category_price`
--
ALTER TABLE `category_price`
  ADD CONSTRAINT `FK_22FB6D9071F7E88B` FOREIGN KEY (`event_id`) REFERENCES `evenement` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C67B3B43D` FOREIGN KEY (`users_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_9474526CFD02F13` FOREIGN KEY (`evenement_id`) REFERENCES `evenement` (`id`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_B26681E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_B26681E658D0DB4` FOREIGN KEY (`devises_id`) REFERENCES `devise` (`id`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF21919B217` FOREIGN KEY (`pack_id`) REFERENCES `category_price` (`id`),
  ADD CONSTRAINT `FK_24CC0DF267B3B43D` FOREIGN KEY (`users_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `post_like`
--
ALTER TABLE `post_like`
  ADD CONSTRAINT `FK_653627B84B89032C` FOREIGN KEY (`post_id`) REFERENCES `evenement` (`id`),
  ADD CONSTRAINT `FK_653627B8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
