-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 06 Juin 2019 à 14:16
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `theconnectedflower`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `image`) VALUES
(3, 'Cactus', '\'This category is not yet described.\'', 'cactus'),
(4, 'Succulents', '\'This category is not yet described.\'', 'succulents'),
(5, 'Flowering plants', '\'This category is not yet described.\'', 'floweringplants'),
(6, 'Fruiting plants', '\'This category is not yet described.\'', 'fruitingplants'),
(8, 'Green plants', '\'This category is not yet described.\'', 'greenplants');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_date`, `title`, `comment`, `answer_id`, `subcategory_id`, `user_id`) VALUES
(33, '2019-05-27 12:17:37', 'I think you\'re wrong...', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pretium leo at iaculis hendrerit. Vivamus interdum leo enim, et ultrices erat bibendum in. Integer malesuada ac velit eu accumsan. Fusce ut nunc quis leo maximus vulputate. Vestibulum placerat lacinia volutpat. Phasellus sagittis urna ut eros faucibus elementum. Aenean ipsum massa, aliquet vel elit quis, sagittis sodales ligula. Etiam nec sollicitudin orci. Etiam iaculis risus id purus bibendum consequat. Nam quis varius quam.', 32, 5, 2),
(32, '2019-05-27 10:59:03', 'Comments about how to plant bambous', '\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pretium leo at iaculis hendrerit. Vivamus interdum leo enim, et ultrices erat bibendum in. Integer malesuada ac velit eu accumsan. Fusce ut nunc quis leo maximus vulputate. Vestibulum placerat lacinia volutpat. Phasellus sagittis urna ut eros faucibus elementum. Aenean ipsum massa, aliquet vel elit quis, sagittis sodales ligula. Etiam nec sollicitudin orci. Etiam iaculis risus id purus bibendum consequat. Nam quis varius quam.', NULL, 5, 1),
(35, '2019-06-05 13:50:21', 'qsdsq', 'qsd', 34, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `histories`
--

CREATE TABLE `histories` (
  `history_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `temperature` float DEFAULT NULL,
  `humidity` float DEFAULT NULL,
  `light` float NOT NULL,
  `is_flowering` int(11) NOT NULL,
  `is_fruiting` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `subcategory_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `periods`
--

INSERT INTO `periods` (`period_id`, `type_id`, `start`, `end`, `subcategory_id`) VALUES
(1, 3, '2019-03-01', '2019-04-30', 1),
(2, 3, '2019-09-01', '2019-11-30', 1),
(3, 1, '2019-05-01', '2019-11-30', 1),
(4, 3, '2019-03-01', '2019-04-30', 2),
(5, 3, '2019-08-01', '2019-10-31', 2),
(6, 1, '2019-03-01', '2019-08-31', 2),
(7, 2, '2019-05-01', '2019-10-31', 2),
(8, 3, '2019-08-01', '2019-11-30', 5),
(9, 5, '2018-12-01', '2019-02-28', 5),
(10, 4, '2018-12-01', '2019-02-28', 5),
(11, 3, '2019-01-01', '2019-12-31', 4),
(12, 1, '2019-06-01', '2019-09-30', 4);

-- --------------------------------------------------------

--
-- Structure de la table `plants`
--

CREATE TABLE `plants` (
  `plant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `temperature` float DEFAULT NULL,
  `humidity` float DEFAULT NULL,
  `light` float DEFAULT NULL,
  `planting_date` date NOT NULL,
  `is_flowering` int(11) NOT NULL DEFAULT '0',
  `is_fruiting` int(11) NOT NULL DEFAULT '0',
  `is_haversted` int(11) NOT NULL DEFAULT '0',
  `is_trimmed` int(11) NOT NULL DEFAULT '0',
  `subcategory_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `plants`
--

INSERT INTO `plants` (`plant_id`, `name`, `temperature`, `humidity`, `light`, `planting_date`, `is_flowering`, `is_fruiting`, `is_haversted`, `is_trimmed`, `subcategory_id`, `user_id`) VALUES
(1, 'Home Geranium', 15, 30, 3, '2019-05-14', 1, 0, 0, 0, 1, 1),
(2, 'My strawberry', -3, 18, 2, '2019-05-14', 0, 1, 0, 0, 2, 1),
(4, 'Garden Parodia', 0, 0, 0, '2019-05-01', 0, 0, 0, 0, 4, 1),
(5, 'My Crassula Ovata', 0, 0, 0, '2019-05-03', 0, 0, 0, 0, 3, 1),
(6, 'All the bambou', 0, 0, 0, '2019-02-05', 0, 0, 0, 0, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_size` float NOT NULL,
  `max_size` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sizes`
--

INSERT INTO `sizes` (`size_id`, `name`, `min_size`, `max_size`) VALUES
(1, 'Petit', 0, 0.5),
(2, 'Petit-Moyen', 0, 1.5),
(3, 'Moyen', 0.5, 1.5),
(4, 'Moyen-Grand', 0.5, 2),
(5, 'Grand', 1.5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `min_temperature` float NOT NULL DEFAULT '-50',
  `max_temperature` float NOT NULL DEFAULT '50',
  `min_humidity` float NOT NULL DEFAULT '0',
  `max_humidity` float NOT NULL DEFAULT '100',
  `min_light` float NOT NULL DEFAULT '0',
  `max_light` float NOT NULL DEFAULT '12',
  `size_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `name`, `description`, `min_temperature`, `max_temperature`, `min_humidity`, `max_humidity`, `min_light`, `max_light`, `size_id`, `category_id`) VALUES
(1, 'Geranium', 'Ses longues tiges retombent en cascade. Il possède un beau feuillage découpé. Ses feuilles deviennent rouge ou bronze en automne.\r\n\r\nSes fleurs régulières possèdent 5 pétales disposés en étoile, en coupe ou à plat. Les coloris sont multiples et très variés : rouge, rose, lilas, blanc, bleu, mauve, violet, noir ; uni ou veiné de pourpre ou de blanc.', 0, 50, 15, 35, 0, 12, 2, 5),
(2, 'Fraisier', 'Originaire à la fois d’Europe, d’Amérique et d’Asie, le fraisier, Fragaria en latin, s’est développé dans des régions aux climats très divers, faisant preuve d’une grande capacité d’adaptation. On en dénombre aujourd’hui 46 espèces qui peuvent prendre des formes très diverses : petite ou grosse, rouge, rose, blanche ou jaune, au parfum suave ou plus discret, avec ou sans stolons, remontante ou unifère.\r\n\r\nLa fraise est un fruit particulier, c’est en réalité un faux fruit : c’est le support de la fleur qui se gonfle et rougit et à sa surface se trouvent les akènes beiges (les « graines »), qui sont les véritables fruits.', -50, 50, 15, 35, 4, 12, 1, 6),
(3, 'Crassula ovata', 'L’arbre de jade appartient à la très vaste famille des Crassulacées et au genre Crassula, qui comprend lui-même près de 300 espèces provenant surtout d’Afrique du Sud. Crassula ovata est l’une des plus connues.\r\n\r\nCette plante grasse est un arbuste à port dressé qui peut atteindre dans de bonnes conditions de culture 1,20 m de haut et plus (jusqu’à 2 m environ) sur autant en largeur… au bout d’un certain nombre d’années.\r\n\r\nSes tiges épaisses et charnues se ramifient et portent des feuilles très charnues vert brillant, arrondies, d’environ 4 cm de long. Selon les cultivars, ces feuilles peuvent varier de taille, de forme et de couleur. Elles sont souvent bordées de rouge.\r\n\r\nLes fleurs étoilées en petites ombelles, le plus souvent blanches, parfois roses, apparaissent en automne ou en hiver sur les plantes âgées.\r\n\r\nLe crassula pousse bien en intérieur à condition d’avoir assez de lumière. Mais vous pouvez aussi le cultiver en extérieur, en pot ou en pleine terre, uniquement si la température ne descend pas en dessous de -4 °C.', 0, 50, 5, 15, 8, 12, 1, 4),
(4, 'Parodia', 'Les espèces actuellement et historiquement incluses dans le genre Parodia sp (famille des Cactacées) sont très populaires dans la culture des cactus. Beaucoup d’entre elles sont faciles à cultiver, ont des fleurs et des épines intrigantes, et les floraisons s’obtiennent facilement avec des fleurs aux couleurs vives. Ceci, combiné à leur taille relativement petite, fait en sorte que presque tous les producteurs de cactus auront probablement un représentant de ce groupe (environ 60 à 100 espèces selon les sources). Les amateurs avancés peuvent développer un grand nombre d’espèces et sous-espèces différentes, en différenciant les anciens genres Notocactus et Eriocactus qui sont inclus dans le genre Parodia.\r\n\r\nÀ l\'état naturel, ce genre se développe dans l’est de l’Amérique du Sud, couvrant un large éventail d’habitats et d’emplacements. Les Parodia sont originaires des hauts plateaux secs (presque désertiques) de la Colombie, du Brésil, de la Bolivie, du Paraguay, d’Argentine et de l’Uruguay.\r\n\r\nLes Parodia se présentent sous forme de cylindres globuleux ou courts qui peuvent être des touffes solitaires ou groupées. Les tiges sont généralement côtelées, mais peuvent aussi être fortement tuberculées ; les épines sont surtout minces, peu denses et raides. Le système racinaire reste très superficiel.\r\n\r\nLes fleurs chez toutes les espèces proviennent de bourgeons floraux, généralement avec des poils à l’apex. Elles sont en forme de cuvette et pointent directement vers le haut. Les espèces Parodia, plus strictement, ont souvent des fleurs orange rouge, qui peuvent être de seulement 1 cm en taille. Le stigmate sur toutes les espèces est prononcé et est d’une couleur très contrastée avec de longs lobes qui peuvent être souvent utiles pour l’identification.\r\n\r\nLes fruits sont parfois épineux et généralement secs, cramponnés à la plante longtemps après que les petites graines noires commencent à se répandre.', 0, 50, 5, 15, 8, 12, 1, 3),
(5, 'Bambou', 'Le bambou, de la famille des Poacées (= graminées), pousse naturellement en Asie (Chine, Corée, Japon…) mais aussi dans certains pays d’Afrique, d’Amérique centrale et du Sud ainsi que d’Océanie. En Europe, toutes les variétés présentes ont été importées. Elles se sont parfaitement adaptées.\r\n\r\nLa floraison du bambou est irrégulière et peut n’intervenir qu’à plusieurs dizaines d’années d’intervalle. Le bambou meurt souvent après la floraison, mais pas toujours. D’ailleurs, la rumeur selon laquelle tous les bambous de la même espèce fleurissent en même temps dans le monde entier avant de mourir est fausse, cela peut arriver, mais c’est plutôt rare.\r\n\r\nVous pouvez les utiliser comme ornement dans tous types de jardins ou de jardinières, aussi bien isolés qu’en haie ou en massif, en extérieur comme en intérieur. De plus, outre leur intérêt ornemental, les haies de bambou sont, à l’instar de toutes les autres haies, utiles écologiquement :\r\n\r\nElles protègent les sols et servent de brise-vent et sont un refuge pour toutes sortes d’animaux, à commencer par les oiseaux.\r\nLes feuilles tombées au sol forment un paillage naturel. Elles nourrissent les insectes et produisent, par dégradation, de l’humus.\r\nCertaines espèces sont également comestibles lorsque les pousses cueillies très jeunes sont débarrassées de leur gaine protectrice. Cet usage n’est toutefois pas très répandu en Europe.\r\n\r\nIl est aussi très utile au jardin pour construire des barrières, des tonnelles, fournir des piquets, des tuteurs…', -10, 50, 75, 95, 0, 12, 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `types`
--

INSERT INTO `types` (`type_id`, `name`) VALUES
(1, 'Flowering'),
(2, 'Fruiting'),
(3, 'Planting'),
(4, 'Trimming'),
(5, 'Harvesting');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `mail`, `password`) VALUES
(1, 'test', 'test@abc.xyz', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08'),
(2, 'test2', 'test2@abc.xyz', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`vote_id`, `type`, `comment_id`, `user_id`) VALUES
(43, 1, 1, 1),
(29, 0, 3, 1),
(39, 0, 4, 1),
(44, 1, 2, 1),
(37, 0, 5, 1),
(45, 0, 32, 2),
(46, 1, 33, 2),
(47, 1, 33, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `response_id` (`answer_id`),
  ADD KEY `subcategorie_id` (`subcategory_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- Index pour la table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`period_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Index pour la table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`plant_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Index pour la table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Index pour la table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `plants`
--
ALTER TABLE `plants`
  MODIFY `plant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
