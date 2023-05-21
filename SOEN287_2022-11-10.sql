# ************************************************************
# Sequel Ace SQL dump
# Version 20035
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 8.0.23)
# Database: SOEN287
# Generation Time: 2022-11-11 03:11:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Evaluation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Evaluation`;

CREATE TABLE `Evaluation` (
  `evaluation_id` int NOT NULL AUTO_INCREMENT,
  `evaluation_name` text NOT NULL,
  `evaluation_score` double NOT NULL,
  `evaluation_weight` double NOT NULL,
  `updated_by` text NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`evaluation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Evaluation` WRITE;
/*!40000 ALTER TABLE `Evaluation` DISABLE KEYS */;

INSERT INTO `Evaluation` (`evaluation_id`, `evaluation_name`, `evaluation_score`, `evaluation_weight`, `updated_by`, `updated_at`)
VALUES
	(8,'Midterm',100,35,'test','2022-11-07 05:27:36'),
	(9,'Project',100,10,'test','2022-11-11 12:34:22'),
	(10,'Final',100,45,'test','2022-11-08 05:05:02');

/*!40000 ALTER TABLE `Evaluation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Grades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Grades`;

CREATE TABLE `Grades` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `evaluation_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `teacher` text,
  `grade` double NOT NULL,
  `graded_at` datetime NOT NULL,
  `student_id` int NOT NULL,
  `assessment` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Grades` WRITE;
/*!40000 ALTER TABLE `Grades` DISABLE KEYS */;

INSERT INTO `Grades` (`id`, `evaluation_name`, `comments`, `teacher`, `grade`, `graded_at`, `student_id`, `assessment`)
VALUES
	(1,'Final','Good Work','test',95,'2022-10-06 21:23:52',40174152,1),
	(2,'Midterm',NULL,'test',90,'2022-11-08 11:12:00',40107608,2),
	(3,'Midterm',NULL,'test',78,'2022-11-08 11:13:00',40174152,2),
	(15,'Midterm',NULL,'test',60,'2022-11-10 03:07:33',43220098,NULL),
	(23,'Final','good work','test',94,'2022-11-11 12:14:55',45091234,NULL),
	(24,'Midterm',NULL,'test',70,'2022-11-11 12:29:02',12345678,NULL),
	(25,'Midterm',NULL,'test',55,'2022-11-11 12:29:33',12345679,NULL),
	(26,'Midterm',NULL,'test',85,'2022-11-11 12:29:45',12345670,NULL),
	(27,'Midterm',NULL,'test',75,'2022-11-11 12:33:54',12345670,NULL),
	(28,'Project',NULL,'test',74,'2022-11-11 12:33:54',12345670,NULL),
	(29,'Project',NULL,'test',87,'2022-11-11 12:33:54',12345670,NULL),
	(30,'Final',NULL,'test',87,'2022-11-11 12:33:54',12345670,NULL),
	(31,'Midterm',NULL,'test',80,'2022-11-11 12:33:54',12345670,NULL),
	(32,'Midterm',NULL,'test',64,'2022-11-11 12:33:54',12345670,NULL),
	(33,'Midterm',NULL,'test',90,'2022-11-11 12:33:54',12345670,NULL),
	(34,'Midterm',NULL,'test',84,'2022-11-11 12:33:54',12345670,NULL),
	(35,'Midterm',NULL,'test',62,'2022-11-11 12:33:54',12345670,NULL),
	(36,'Midterm',NULL,'test',75,'2022-11-11 12:33:54',12345670,NULL),
	(37,'Project',NULL,'test',84,'2022-11-11 12:33:54',12345670,NULL),
	(38,'Project',NULL,'test',65,'2022-11-11 12:33:54',12345670,NULL),
	(39,'Final',NULL,'test',75,'2022-11-11 12:33:54',12345670,NULL);

/*!40000 ALTER TABLE `Grades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Student_Login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Student_Login`;

CREATE TABLE `Student_Login` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registered_on` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT '0',
  `firstname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` VARCHAR(254),
  `program` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Student_Login` WRITE;
/*!40000 ALTER TABLE `Student_Login` DISABLE KEYS */;

INSERT INTO `Student_Login` (`id`, `user`, `password`, `registered_on`, `last_login`, `validate`, `firstname`, `lastname`)
VALUES
	(1,'40174152','$2y$10$i/Dazb2FDaUozWXpXFVBbeYie9hr01yPQ48EK97p3MvRCpu/0l8dS','2022-10-06 21:23:52','2022-11-03 14:51:07',1,'',''),
	(3,'40107608','$2y$10$QWy5VaW/pPYjNTo7L90BDOiqAdfF9cbHjR6Qm8u6kqcunIDsFv.fK','2022-11-08 15:54:51','2022-11-11 00:36:59',1,'Haelang','Park'),
	(5,'12345678','$2y$10$QTVOmvYh.286CdMZV/zSMOHdRGnb3wIo1iiq6n5TlkM.wrttd5nvO','2022-11-11 00:35:55','2022-11-11 00:36:20',1,'Random','Test'),
  (2, '40104902', '$2y$10$KJE1GBAGw1VL6kfInmy8Ru.XtXKlZB1NBqr03/kQfR8O1Wm6JBeEO', '2022-11-29 21:14:43','2022-11-29 21:14:43',1,'Sandy','Fang');

/*!40000 ALTER TABLE `Student_Login` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Teacher_Login
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Teacher_Login`;

CREATE TABLE `Teacher_Login` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registered_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `validate` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `Teacher_Login` WRITE;
/*!40000 ALTER TABLE `Teacher_Login` DISABLE KEYS */;

INSERT INTO `Teacher_Login` (`id`, `user`, `password`, `registered_on`, `last_login`, `validate`)
VALUES
	(1,'test','$2y$10$i/Dazb2FDaUozWXpXFVBbeYie9hr01yPQ48EK97p3MvRCpu/0l8dS','2022-10-06 21:23:52','2022-11-11 00:36:01',1);

/*!40000 ALTER TABLE `Teacher_Login` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
