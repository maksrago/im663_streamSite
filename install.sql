-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `badges`;
CREATE TABLE `badges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stream_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `badges` (`id`, `filename`, `name`, `stream_id`) VALUES
(3,	'badgeRed.png',	'redBadge',	7),
(4,	'badgeBlue.png',	'blueBadge',	7);

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `chat_messages` (`id`, `user`, `stream_id`, `message`, `date`) VALUES
(233,	'username',	7,	'hello test',	'2020-03-20'),
(235,	'username',	7,	'test',	'2020-03-20');

DROP TABLE IF EXISTS `streams`;
CREATE TABLE `streams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `embed_code` text NOT NULL,
  `chat_on` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `streams` (`id`, `name`, `username`, `description`, `embed_code`, `chat_on`) VALUES
(7,	'test',	'test',	'test',	'test',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `realname` text NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `realname`, `date_registered`) VALUES
(1,	'testUser',	'test@best.com',	'123',	'John',	'2020-03-13'),
(2,	'testUser2',	'test@testtest.com',	'234',	'Morg',	'2020-03-13'),
(3,	'testUser3',	'test@test.com',	'345',	'Jane',	'2020-03-16'),
(5,	'testUser4,	'test@testing.com',	'567',	'Rob',	'2020-03-20');

DROP TABLE IF EXISTS `user_badges`;
CREATE TABLE `user_badges` (
  `username` varchar(255) NOT NULL,
  `badge_name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `stream_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_badges` (`username`, `badge_name`, `filename`, `stream_id`) VALUES
('testUser',	'redBadge',	'badgeRed.png',	7),
('testUser2',	'blueBadge',	'badgeBlue.png',	7);

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `username` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_roles` (`username`, `role`) VALUES
('adminAcc',	'admin'),
('im663',	'user');

-- 2020-03-20 18:43:23
