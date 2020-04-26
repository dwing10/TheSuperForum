-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for thesuperforum
CREATE DATABASE IF NOT EXISTS `thesuperforum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `thesuperforum`;

-- Dumping structure for table thesuperforum.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `postId` int(11) NOT NULL AUTO_INCREMENT,
  `topicId` int(11) NOT NULL,
  `postText` text,
  `postTimeCreated` datetime DEFAULT NULL,
  `postOwner` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`postId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table thesuperforum.posts: ~11 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`postId`, `topicId`, `postText`, `postTimeCreated`, `postOwner`) VALUES
	(1, 1, 'He is strong', '2020-03-23 14:13:49', 'testemail@yahoo.com'),
	(2, 2, 'Batman is cool.', '2020-03-23 14:28:04', 'testemail@yahoo.com'),
	(3, 3, 'Batman is cool.', '2020-03-23 14:28:40', 'testemail@yahoo.com'),
	(4, 4, 'Green lantern is green.', '2020-03-23 14:36:32', 'anotherEmail@website.com'),
	(5, 5, 'What if he was bitten by a radioactive dung beetle, instead of a spider?', '2020-03-25 13:47:17', 'theDude@gmail.com'),
	(6, 5, 'Then he would be called Dungman!', '2020-03-25 14:21:42', 'BilboSwaggins@gamail.com'),
	(7, 4, 'Replying to a post with some more text.', '2020-03-30 12:34:30', 'BilboSwaggins@gamail.com'),
	(8, 3, 'Yes he is!', '2020-03-30 12:38:31', 'BilboSwaggins@gamail.com'),
	(9, 3, 'I like your username!', '2020-03-30 12:39:07', 'TheDude@gmail.com'),
	(10, 6, 'Which comic book company is better?', '2020-03-30 12:43:34', 'SomeDude@yahoo.com'),
	(11, 7, 'Some words', '2020-03-30 12:45:58', 'testemail@yahoo.com');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table thesuperforum.topics
CREATE TABLE IF NOT EXISTS `topics` (
  `topicId` int(11) NOT NULL AUTO_INCREMENT,
  `topicTitle` varchar(150) DEFAULT NULL,
  `timeCreated` datetime DEFAULT NULL,
  `topicOwner` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`topicId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table thesuperforum.topics: ~7 rows (approximately)
DELETE FROM `topics`;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`topicId`, `topicTitle`, `timeCreated`, `topicOwner`) VALUES
	(1, 'Superman\'s Strength', '2020-03-23 14:13:49', 'testemail@yahoo.com'),
	(2, 'Batman', '2020-03-23 14:28:04', 'testemail@yahoo.com'),
	(3, 'Batman', '2020-03-23 14:28:40', 'testemail@yahoo.com'),
	(4, 'Green Lantern', '2020-03-23 14:36:32', 'anotherEmail@website.com'),
	(5, 'Spiderman', '2020-03-25 13:47:17', 'theDude@gmail.com'),
	(6, 'Marvel Vs DC', '2020-03-30 12:43:34', 'SomeDude@yahoo.com'),
	(7, 'Test topic', '2020-03-30 12:45:58', 'testemail@yahoo.com');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
