-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 mai 2020 à 00:50
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecogram`
--

-- --------------------------------------------------------

--
-- Structure de la table `Actualite`
--

CREATE TABLE `Actualite` (
  `id_actualite` int(100) NOT NULL,
  `dateA` date NOT NULL,
  `heureA` time NOT NULL,
  `contenue` text NOT NULL,
  `id_annonceur` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Actualite`
--

INSERT INTO `Actualite` (`id_actualite`, `dateA`, `heureA`, `contenue`, `id_annonceur`) VALUES
(1, '2020-04-19', '15:00:00', 'La mairie de Paris a annocé la fermeture définitive d\'un parc ! Où vont allez tous ces pauvres petit lapin?!', 5),
(2, '2020-04-19', '15:02:00', 'Finallement j\'avais mal compris ! Il vont agrandir le parc! Ouf sauver !', 5),
(3, '2020-04-19', '18:05:54', 'Je participe a la marche organiser par ma ville ! Hâte d\'y être !', 4),
(4, '2020-04-19', '20:00:00', 'L’événement de la semaine dernière était vraiment mal organiser... C\'est une honte !\r\n#OnNousMent', 3),
(5, '2020-04-20', '15:01:00', 'Renseigner vous avant de dire des bêtises !', 2),
(6, '2020-05-02', '16:18:29', 'test de commentaire en esperant que ca marche', 1),
(10, '2020-05-02', '17:15:13', 'Bon ben ca marche', 1);

-- --------------------------------------------------------

--
-- Structure de la table `annonceur`
--

CREATE TABLE `annonceur` (
  `id_annonceur` int(100) NOT NULL,
  `pseudonyme` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code_postal` int(5) NOT NULL DEFAULT 0,
  `ville` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse_mail` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonceur`
--

INSERT INTO `annonceur` (`id_annonceur`, `pseudonyme`, `nom`, `prenom`, `adresse`, `code_postal`, `ville`, `date_naissance`, `adresse_mail`, `description`, `image`, `password`) VALUES
(1, 'Deteross', 'Clément', 'Eloire', '8 rue des Huppes', 82210, 'Saint-Nicolas', '1999-02-02', 'adresse@gmail.com', 'J\'aime l\'écologie et je fais ce que je peux pour l\'aider!', 'image/roi-echec.png', '123'),
(2, 'Gribli', 'Frédéric', 'Dupuis', '5 avenue des Cerises', 78000, 'Andrésy', '1986-06-06', 'fred.dupuis@gmail.com', 'Moi l\'écologie c\'est ma passion !', 'image/puit.png', '456'),
(3, 'Jidua', 'Maeva', 'Lafevre', 'Boulevard Charles de Gaule', 69520, 'Grigni', '0000-00-00', 'Maeva69520@gmail.com', 'Sauvons la planète ! ', 'image/test.png', '789'),
(4, 'xXkillerXx', 'Enzo', 'Trad', '85 bis rue de la métaphore', 45200, 'Montargis', '1980-10-10', 'trad.e@gmail.com', 'Nouvel événement dans les mois qui viennent.', 'image/feuillemorte.png', 'abc'),
(5, 'Albafica', 'Alice', 'Merveille ', 'Rue du Lapin', 44440, 'Pannécé', '1980-12-12', 'Pays.Merveille@gmail.com', 'J\'adore les lapins! Protégeons les lapins! ', 'image/lapin.png', 'def');

-- --------------------------------------------------------

--
-- Structure de la table `Document`
--

CREATE TABLE `Document` (
  `id_document` int(100) NOT NULL,
  `libelle_doc` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `id_annonceur` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Document`
--

INSERT INTO `Document` (`id_document`, `libelle_doc`, `description`, `id_annonceur`) VALUES
(1, 'Planning de la Marche', '16H - Place du marché puis direction la mairie\r\n', 2),
(2, 'Projet de lois anti-écologie', 'Vous trouverez ci-joint le projet de loi du 13/04/2020 !', 3);

-- --------------------------------------------------------

--
-- Structure de la table `Evenement`
--

CREATE TABLE `Evenement` (
  `id_evenement` int(100) NOT NULL,
  `nom_event` varchar(50) NOT NULL,
  `ville_event` varchar(50) DEFAULT NULL,
  `code_postal_event` int(5) DEFAULT NULL,
  `adresse_event` varchar(100) DEFAULT NULL,
  `DateE` date NOT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `description_event` text DEFAULT NULL,
  `id_type` int(100) NOT NULL,
  `id_annonceur` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Evenement`
--

INSERT INTO `Evenement` (`id_evenement`, `nom_event`, `ville_event`, `code_postal_event`, `adresse_event`, `DateE`, `heure_debut`, `heure_fin`, `longitude`, `latitude`, `description_event`, `id_type`, `id_annonceur`) VALUES
(1, 'Marche verte organiser par le club de rugby', 'Toulouse', 31000, 'Jardin des Plantes', '2020-04-18', '15:00:00', '18:00:00', 1.263, 44.152, 'Marche Verte organiser pas le Stade toulousain. Départ à 15h au jardin des Plantes. Venez nombreux!', 1, 5),
(2, 'Manifestation pour le climat', 'Toulouse', 31000, 'Place du Capitole', '2020-04-15', '14:30:00', '16:00:00', 1.563, 44.532, 'Manifestation pour le climat. Faisons bouger les choses ensembles.', 3, 5),
(3, 'Journée mondiale des lapins', 'Toulouse', 31000, 'Prairies des Filtres', '2020-04-07', '09:30:00', '19:00:00', 1.845, 44.451, 'Journée Mondiale pour la protection des Lapins, des activités sont disponibles pour en apprendre plus sur les lapins et autres rongeur. Venez avec vos enfant.', 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `likes_dislikes`
--

CREATE TABLE `likes_dislikes` (
  `id_annonc` int(100) NOT NULL,
  `id_post` int(100) NOT NULL,
  `action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `likes_dislikes`
--

INSERT INTO `likes_dislikes` (`id_annonc`, `id_post`, `action`) VALUES
(1, 1, 'like'),
(1, 2, 'like'),
(1, 3, 'like'),
(1, 4, 'dislike'),
(1, 5, 'dislike'),
(1, 6, 'like'),
(1, 7, 'like'),
(1, 10, 'like'),
(2, 2, 'dislike');

-- --------------------------------------------------------

--
-- Structure de la table `Participer`
--

CREATE TABLE `Participer` (
  `id_annonceur` int(100) NOT NULL,
  `id_evenement` int(100) NOT NULL,
  `id_type` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Participer`
--

INSERT INTO `Participer` (`id_annonceur`, `id_evenement`, `id_type`) VALUES
(1, 1, 1),
(1, 2, 3),
(1, 3, 4),
(2, 2, 3),
(2, 3, 4),
(3, 3, 4),
(4, 1, 1),
(5, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `Suivre`
--

CREATE TABLE `Suivre` (
  `id_annonceur1` int(100) NOT NULL,
  `id_annonceur2` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Suivre`
--

INSERT INTO `Suivre` (`id_annonceur1`, `id_annonceur2`) VALUES
(1, 3),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(5, 2),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Structure de la table `TypeEvent`
--

CREATE TABLE `TypeEvent` (
  `id_type` int(100) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TypeEvent`
--

INSERT INTO `TypeEvent` (`id_type`, `libelle`, `description`) VALUES
(1, 'Marche verte', 'Une Marche qui consista a nettoyer les rues d\'une ville, d\'une foret, etc'),
(2, 'Assemblé Général', 'Assemblé Général d\'une association, d\'une mairie,etc ... portant sur le thème de l\'écologie.'),
(3, 'Manifestation', 'Manifestation contre le climat ou contre des lois non écologique'),
(4, 'Journée Mondial', 'Événement organiser en l\'honneur d\'une Journée Mondial.'),
(5, 'Rassemblement', 'Rassemblement organiser pour l\'ouverture d\'un parc, d\'un marché bio, etc..');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisation`
--

CREATE TABLE `Utilisation` (
  `id_evenement` int(100) NOT NULL,
  `id_type` int(100) NOT NULL,
  `id_Document` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisation`
--

INSERT INTO `Utilisation` (`id_evenement`, `id_type`, `id_Document`) VALUES
(1, 1, 1),
(2, 3, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Actualite`
--
ALTER TABLE `Actualite`
  ADD PRIMARY KEY (`id_actualite`),
  ADD KEY `Foreign_key_actualite` (`id_annonceur`);

--
-- Index pour la table `annonceur`
--
ALTER TABLE `annonceur`
  ADD PRIMARY KEY (`id_annonceur`),
  ADD UNIQUE KEY `Pseudonyme` (`pseudonyme`),
  ADD UNIQUE KEY `Adresse_Mail` (`adresse_mail`);

--
-- Index pour la table `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `Foreign_key_doc` (`id_annonceur`);

--
-- Index pour la table `Evenement`
--
ALTER TABLE `Evenement`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `Foreign_key_event1` (`id_annonceur`),
  ADD KEY `Foreign_key_event2` (`id_type`);

--
-- Index pour la table `likes_dislikes`
--
ALTER TABLE `likes_dislikes`
  ADD UNIQUE KEY `id_annonc` (`id_annonc`,`id_post`);

--
-- Index pour la table `Participer`
--
ALTER TABLE `Participer`
  ADD PRIMARY KEY (`id_annonceur`,`id_evenement`,`id_type`),
  ADD KEY `Foreign_key_participer2` (`id_evenement`),
  ADD KEY `Foreign_key_participer3` (`id_type`);

--
-- Index pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD PRIMARY KEY (`id_annonceur1`,`id_annonceur2`),
  ADD KEY `Foreign_key_suivre2` (`id_annonceur2`);

--
-- Index pour la table `TypeEvent`
--
ALTER TABLE `TypeEvent`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `Utilisation`
--
ALTER TABLE `Utilisation`
  ADD PRIMARY KEY (`id_evenement`,`id_type`,`id_Document`),
  ADD KEY `Foreign_key_utilisation1` (`id_Document`),
  ADD KEY `Foreign_key_utilisation3` (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Actualite`
--
ALTER TABLE `Actualite`
  MODIFY `id_actualite` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `annonceur`
--
ALTER TABLE `annonceur`
  MODIFY `id_annonceur` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Document`
--
ALTER TABLE `Document`
  MODIFY `id_document` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Evenement`
--
ALTER TABLE `Evenement`
  MODIFY `id_evenement` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `TypeEvent`
--
ALTER TABLE `TypeEvent`
  MODIFY `id_type` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Actualite`
--
ALTER TABLE `Actualite`
  ADD CONSTRAINT `Foreign_key_actualite` FOREIGN KEY (`id_annonceur`) REFERENCES `annonceur` (`id_annonceur`);

--
-- Contraintes pour la table `Document`
--
ALTER TABLE `Document`
  ADD CONSTRAINT `Foreign_key_doc` FOREIGN KEY (`id_annonceur`) REFERENCES `annonceur` (`id_annonceur`);

--
-- Contraintes pour la table `Evenement`
--
ALTER TABLE `Evenement`
  ADD CONSTRAINT `Foreign_key_event1` FOREIGN KEY (`id_annonceur`) REFERENCES `annonceur` (`id_annonceur`),
  ADD CONSTRAINT `Foreign_key_event2` FOREIGN KEY (`id_type`) REFERENCES `TypeEvent` (`id_type`);

--
-- Contraintes pour la table `Participer`
--
ALTER TABLE `Participer`
  ADD CONSTRAINT `Foreign_key_participer1` FOREIGN KEY (`id_annonceur`) REFERENCES `annonceur` (`id_annonceur`),
  ADD CONSTRAINT `Foreign_key_participer2` FOREIGN KEY (`id_evenement`) REFERENCES `Evenement` (`id_evenement`),
  ADD CONSTRAINT `Foreign_key_participer3` FOREIGN KEY (`id_type`) REFERENCES `TypeEvent` (`id_type`);

--
-- Contraintes pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD CONSTRAINT `Foreign_key_suivre1` FOREIGN KEY (`id_annonceur1`) REFERENCES `annonceur` (`id_annonceur`),
  ADD CONSTRAINT `Foreign_key_suivre2` FOREIGN KEY (`id_annonceur2`) REFERENCES `annonceur` (`id_annonceur`);

--
-- Contraintes pour la table `Utilisation`
--
ALTER TABLE `Utilisation`
  ADD CONSTRAINT `Foreign_key_utilisation1` FOREIGN KEY (`id_Document`) REFERENCES `Document` (`id_document`),
  ADD CONSTRAINT `Foreign_key_utilisation2` FOREIGN KEY (`id_evenement`) REFERENCES `Evenement` (`id_evenement`),
  ADD CONSTRAINT `Foreign_key_utilisation3` FOREIGN KEY (`id_type`) REFERENCES `TypeEvent` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
