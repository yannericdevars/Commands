-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 30 Avril 2013 à 08:34
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `commands`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Symfony'),
(2, 'PHP'),
(3, 'Shell');

-- --------------------------------------------------------

--
-- Structure de la table `Remind`
--

CREATE TABLE `Remind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9EBDCC7BC54C8C93` (`type_id`),
  KEY `IDX_9EBDCC7B12469DE2` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `Remind`
--

INSERT INTO `Remind` (`id`, `name`, `text`, `comment`, `number`, `rate`, `type_id`, `category_id`) VALUES
(1, 'Création d''un bundle', 'php app/console generate:bundle --namespace=Acme/HelloBundle --format=yml', NULL, 1, 1, 2, 1),
(7, 'Vider le cache de prod', 'php app/console cache:clear --env=prod --no-debug', 'Le cache de prod doit être vidé manuellement', 3, 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Type`
--

CREATE TABLE `Type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Type`
--

INSERT INTO `Type` (`id`, `name`) VALUES
(1, 'Lien'),
(2, 'Commande');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Remind`
--
ALTER TABLE `Remind`
  ADD CONSTRAINT `FK_9EBDCC7B12469DE2` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`),
  ADD CONSTRAINT `FK_9EBDCC7BC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `Type` (`id`);
