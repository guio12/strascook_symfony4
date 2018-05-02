-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 02 mai 2018 à 18:06
-- Version du serveur :  5.7.21
-- Version de PHP :  7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `strascook`
--

-- --------------------------------------------------------

--
-- Structure de la table `actu`
--

CREATE TABLE `actu` (
  `id` int(11) NOT NULL,
  `titre` varchar(45) DEFAULT NULL,
  `contenu` text,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actu`
--

INSERT INTO `actu` (`id`, `titre`, `contenu`, `image`) VALUES
(3, 'C\'est le printemps', 'Voici donc les longs jours, lumière, amour, délire !\r\nVoici le printemps ! mars, avril au doux sourire,\r\nMai fleuri, juin brûlant, tous les beaux mois amis !\r\nLes peupliers, au bord des fleuves endormis,\r\nSe courbent mollement comme de grandes palmes ;\r\nL’oiseau palpite au fond des bois tièdes et calmes ;\r\nIl semble que tout rit, et que les arbres verts\r\nSont joyeux d’être ensemble et se disent des vers.\r\nLe jour naît couronné d’une aube fraîche et tendre ;\r\nLe soir est plein d’amour ; la nuit, on croit entendre,\r\nA travers l’ombre immense et sous le ciel béni,\r\nQuelque chose d’heureux chanter dans l’infini.', 'image.5ae99b79876a9.jpg'),
(4, 'C\'est bientôt l\'été', 'Gentils oiseaux, venez à ma fenêtre, \r\nCe blanc duvet est pour vos petits nids ; \r\nJe sens aussi que le printemps va naître, \r\nMon cœur ému s\'épanche au sein des nuits. \r\nLes fleurs déjà dégagent leurs corolles, \r\nLeur corset vert ne craint plus les autans ; \r\nVoici les jours des jeux, des danses folles, \r\nJolis oiseaux, célébrons le printemps.', 'image.5ae9c4151cdd1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE `actualite` (
  `id` int(11) NOT NULL,
  `actualite_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `actualite`
--

INSERT INTO `actualite` (`id`, `actualite_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `Fk_menu_id` int(11) DEFAULT NULL,
  `Fk_client_id` int(11) DEFAULT NULL,
  `convives` int(11) DEFAULT NULL,
  `Fk_menu_titre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'Chacha', 'Chacha12');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `fk_type_menu` int(11) NOT NULL,
  `titre` varchar(30) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `introduction` varchar(50) DEFAULT NULL,
  `entree` varchar(100) DEFAULT NULL,
  `d_entree` text,
  `plat` varchar(100) DEFAULT NULL,
  `d_plat` text,
  `dessert` varchar(100) DEFAULT NULL,
  `d_dessert` text,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `fk_type_menu`, `titre`, `image`, `introduction`, `entree`, `d_entree`, `plat`, `d_plat`, `dessert`, `d_dessert`, `prix`) VALUES
(1, 1, 'Menu Printanier', 'egg-salad.jpg', 'Un menu renaissance', 'Asperges et œufs en cocotte, pointe de piment d\'Espelette', 'Les oeufs sont cuits façon cocotte et associés à des pointes d\'asperges vertes, du parmesan, de la crème et une pointe de piment d\'Espelette pour un résultat à la fois croquant et fondant irrésistible !\r\nŒufs originaires de la Ferme Fix, Pfettisheim, et Asperges en provenance de la ferme Maurer, Dorlisheim.', 'Gigot de sept heures accompagné de légumes nouveaux', 'Véritable recette de grand-mère, le gigot d\'agneau et sa cuisson Sept Heures saura vous combler.\r\nTellement fondant qu\'il se sert à la cuillère !\r\nAgneau originaire de la Ferme Meyer, Mittelschaeffolsheim.', 'Tartelette Fraise-Balsamique sans sucre', 'Originale, l\'alliance entre les fraises, le vinaigre balsamique et le vin rouge va vous étonner agréablement. Garnies également de ricotta pour le côté crémeux, ces petites tartelettes sont par ailleurs réalisées sans sucre.\r\nFraises originaires de l\'EARL de Jardin de Hanau, Ringendorf', 49),
(2, 1, 'Menu Gourmand', 'pintade.jpg', 'Un menu gourmand et délicat', 'Timbale de Saumon Fumé au fromage frais', 'Un plat au goût très fin et bien parfumé pour une entrée toujours réussie !\r\nSaumon originaire de l\'entreprise Delpierre, Wisches.', 'Fondant de Pintade sur son lit de haricots', 'Savoureuse, légère et gourmande, la Pintade se joue des saisons et promet de séduire le plus grand nombre. Servie sur un lit de haricots, elle séduira les palais les plus délicats.\r\nPintade originaire de la Ferme Schmitt, Bischoffsheim.', 'Variation de trois Chocolats et accompagnement fruité', 'Toute les typicités du chocolat nuancées par ses infinies variations. L\'une apporte de la rondeur, l\'autre de la longueur en bouche, quand une touche de chocolat noir rehausse les saveurs des fruits… À tester sans hésiter !\r\nChocolat issu de la chocolaterie Anthony, Avolsheim.', 59),
(3, 1, 'Menu Tradition', 'onglet.jpg', 'Un menu très fin en bouche', 'Salade de Gésiers et Foies de Volaille', 'Gésiers et foies de volailles comptent parmi les abats les plus appréciés des gourmets : cette salade les ravira à coup sûr !\r\nGésiers et foies originaies de chez Feyel, Schiltigheim.', 'Onglet de Bœuf «Angus » à la Fondue d’Echalotes', 'Grand classique de la cuisine traditionnelle française cet onglet marie une viande forte en goût sublimée par les échalotes.\r\nOnglet de bœuf Angus originaire de la ferme de l\'Oberfeld, Geispolsheim.', 'Kougelhopf Glacé au Marc de Gewurztraminer', 'Ce kougelhopf glacé est idéal pour une fin de repas tout en fraîcheur et légèreté : le Marc de Gewurztraminer relève délicatement ses saveurs.\r\nMarc de Gewurztraminer originaire du Domaine Schlumberger, Guebwiller.', 79),
(4, 2, 'Menu Banquet', 'gratin.jpg', 'Un menu gourmand et convivial', 'Tarte Feuilletée aux jeunes pousses d\'Épinards et Chèvre', 'Le mélange fin des jeunes pousses d\'épinards et du chèvre mêlés à cette tarte est une vraie douceur… on a du mal à ne pas se resservir !\r\nÉpinards originaires du Jardin de Marthe, la Robertsau.', 'Gratin de ravioles aux Cèpes, pointe de Comté Vieille Réserve', 'Un plat chaleureux qui apport une touche raffinée et gourmande au traditionnel gratin dauphinois avec cette version aux cèpes. \r\nCèpes cueillis dans les forêts Bas-Rhinoises.', 'Tarte au Citron et sa Meringue caramélisée', 'Délicieuse et raffinée, cette tarte au citron meringuée est composée d\'un fond de tarte de pâte sablée qui se marie au goût acidulé du citron jaune ainsi que de la meringue qui lui apporte une touche de douceur.\r\nCitrons bio, originaires du Sud de la France', 49),
(5, 2, 'Menu Citadin', 'burger_vege.jpg', 'Un menu inspiré de la ville', 'Velouté Brocolis-Roquefort à la pointe de crème', 'Cette recette végétarienne offre une grande originalité de goût et une grande diversité de saveurs ! Le brocoli allié au poireau et au roquefort est une vraie réussite gustative !\r\nBrocolis et poireaux originaires du Jardin de Marthe, la Robertsau.', 'Burger au Tofu et son Pain Noir, pousses de Roquette', 'Ce Burger végétarien aux goûts exotiques est étonnament goûtu ! L’houmous crémeux crée une base savoureuse alors que pain noir apporte le croustillant et les légumes la fraîcheur.\r\nLégumes originaires de la Ferme Maurer, Dorlisheim', 'Carrot Cake comme à New York et ses épices', 'Cette version du carrot cake contient la juste dose d\'épices et de carottes, ainsi que des noix de Pécan pour le croquant ! Original, ce dessert ravira les fins gourmets !\r\nCarottes originaires de la ferme Maurer, Dorlisheim.', 59),
(6, 2, 'Menu Dégustation', 'risotto.jpg', 'Un menu particulièrement délicat', 'Salade de betteraves, grenades et noix de pécan', 'Des betteraves rôties, des noix de pécan, des grenades, accompagnées d’une vinaigrette à la figue et à l’orange, quoi de mieux pour débuter un repas sous le signe de la dégustation ?\r\nLégumes originaires de la Ferme Maurer, Dorlisheim.', 'Risotto végétarien aux légumes de printemps', 'Grande spécialité italienne, découvrez ce risotto végétarien aux légumes de printemps, asperges et fèves. Très simple mais d’une grande finesse et particulièrement savoureux !\r\nLégumes originaires de la Ferme Maurer, Dorlisheim.', 'Crème Brûlée et sa touche de Vanille des Îles', 'Une recette classique mais qui apporte toujours autant de douceur et de rondeur en bouche. Incontournabe !\r\nŒufs et crème originaires de la ferme Maurer, Dorlisheim.', 79),
(7, 3, 'Menu Léger', 'salade_tempeh.jpg', 'Un menu léger et très vert', 'Galette 5 céréales aux légumes de printemps', 'Ces galettes aux flocons de 5 céréales sont un classique de la cuisine végane, et font la part belle aux légumes nouveaux de printemps.\r\nLégumes originaires du Jardin de Marthe, la Robertsau.', 'Salade composée avec Tempeh et légumes croquants', 'Une salade légère et équilibrée, avec un apport en protéines grâce au Tempeh, délicatement balancé par le croquant des petits légumes. \r\nLégumes originaires de la ferme Maurer, Dorlisheim.', 'Sorbet express Pomme-Framboise, épices exotiques', 'Léger et aérien, ce sorbet mêle pommes et framboises originaires d\'Alsace avec des épices plus exotiques, le tout pour une explosion de saveurs !\r\nFruits originaires du Jardin de Marthe, la Robertsau.', 49),
(8, 3, 'Menu Saveurs', 'tartine.jpg', 'Un menu exaltant les saveurs', 'Sushis et Maquis Végans à la Courge Butternut', 'Ce n’est pas parce qu’on est vegan qu’on doit se priver de sushis ! Ces sushis 100% végétaux vous permettront de partager avec vos amis un superbe plateau de suhis et makis !\r\nCourge originaire du Jardin de Marthe, la Robertsau.', 'Tartines croquantes Échalottes-Houmous, pain sans gluten', 'Ces tartines gourmandes de pain sans gluten sont rehaussées d\'un Houmous maison particulièrement savoureux, et accompagnées d\'une salade de jeunes pousses croquantes à souhait !\r\nLégumes originaires de la Ferme Maurer, Dorlisheim.', 'Tarte à la Rhubarbe, compotée de fraises', 'Un dessert classique, ici revisité dans sa version végane : la pâte est 100% végétale et sans gluten, et le flan également.\r\nRhubarbe et Fraises originaires de la ferme Maurer, Dorlisheim.', 59),
(9, 3, 'Menu Fête', 'banh_bao.jpg', 'Un menu festif et avec cruauté', 'Tartinade de marrons et son Tofu fumé', 'De délicieux toasts sublimés par une tartinade de marrons façon foie-gras, servis avec un Tofu fumé et accompagnés d\'un chutney ou d\'un confit de figues ou d\'oignons.\r\nLégumes originaires de la Ferme Maurer, Dorlisheim.', 'Banh-Bao Végan, farci aux Truffes et à sa crème d\'Amandes', 'Découvrez le Banh-Bao, cette délicieuse brioche vietnamienne cuite à la vapeur. Ici nous vous proposons une version végan avec une farce aux Truffes relevée d\'une pointe de crème d\'amandes.\r\nLégumes originaires de la Ferme Maurer, Dorlisheim.', 'Charlotte Royale au Cacao et fruits rouges', 'Mon dessert préféré et ma spécialité : la Charlotte aux fruits rouges ! Ce dessert léger est ici revisité dans sa version végane.\r\nFruits originaires de la ferme Maurer, Dorlisheim.', 99),
(14, 1, 'Menu Carnivore', 'image5ae9c3c7894f6.jpeg', 'Intro qui va bien', 'Entrée', 'Détails entrée', 'Plat', 'Détails plat', 'Dessert', 'Détails dessert', 89);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `Fk_menu_id` int(11) DEFAULT NULL,
  `Fk_client_id` int(11) NOT NULL,
  `convives` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `type_menu`
--

CREATE TABLE `type_menu` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_menu`
--

INSERT INTO `type_menu` (`id`, `nom`) VALUES
(1, 'Classique'),
(2, 'Végétarien'),
(3, 'Vegan');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actu`
--
ALTER TABLE `actu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_titre_idx` (`Fk_menu_id`),
  ADD KEY `fk_client_id_idx` (`Fk_client_id`),
  ADD KEY `Fk_menu_id` (`Fk_menu_id`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_type_menu` (`fk_type_menu`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu_titre_idx` (`Fk_menu_id`),
  ADD KEY `fk_client_id_idx` (`Fk_client_id`);

--
-- Index pour la table `type_menu`
--
ALTER TABLE `type_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actu`
--
ALTER TABLE `actu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `actualite`
--
ALTER TABLE `actualite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`Fk_menu_id`) REFERENCES `menus` (`id`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `fk_type_menu` FOREIGN KEY (`fk_type_menu`) REFERENCES `type_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
