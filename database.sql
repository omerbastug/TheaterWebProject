/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB : Database - cinemaproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cinemaproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `cinemaproject`;

/*Table structure for table `charachter:actor` */

DROP TABLE IF EXISTS `charachter:actor`;

CREATE TABLE `charachter:actor` (
  `play_id` int(11) NOT NULL,
  `charachter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `charachter:actor` */

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `person` */

insert  into `person`(`id`,`name`,`surname`,`email`) values 
(1,'Omer','Bastug','omer@gmail.com'),
(2,'Yusuf','Selvi','yusuf@gmail.com'),
(3,'Mark','White','mark@gmail.com'),
(4,'Sarah','Clarkson','sarah@gmail.com'),
(5,'NEW','person','newperson@gmail.com');

/*Table structure for table `play` */

DROP TABLE IF EXISTS `play`;

CREATE TABLE `play` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `durationMinutes` int(11) NOT NULL,
  `asd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `play` */

insert  into `play`(`id`,`name`,`author`,`durationMinutes`,`asd`) values 
(1,'Pamuk Prenses','Shakespeare',70,1),
(2,'Keloglanin basi kel','Makif Ersoy',30,1),
(3,'Nasreddin Hoca 5Head','Semseddin hoca',2,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`) values 
(1,'TicketChecker'),
(2,'Client'),
(3,'Cleaner');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  `theatre_id` int(11) NOT NULL,
  `ticketChecker` int(11) NOT NULL,
  `cleaner` int(11) NOT NULL,
  `ticketsAvailable` int(11) DEFAULT NULL,
  `play_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`time`,`theatre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`time`,`theatre_id`,`ticketChecker`,`cleaner`,`ticketsAvailable`,`play_id`) values 
(1,'2022-03-25 11:00:00',3,15,20,NULL,1),
(2,'2022-03-25 12:30:30',3,1,3,74,1),
(3,'2022-03-30 11:30:30',2,2,4,142,3);

/*Table structure for table `theatre` */

DROP TABLE IF EXISTS `theatre`;

CREATE TABLE `theatre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numberofrows` int(11) NOT NULL,
  `numberofcolumn` int(11) NOT NULL,
  `totalSeats` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `theatre` */

insert  into `theatre`(`id`,`numberofrows`,`numberofcolumn`,`totalSeats`) values 
(1,11,13,143),
(2,11,13,143),
(3,9,9,81),
(4,15,20,300),
(5,15,20,292);

/*Table structure for table `ticketspurchased` */

DROP TABLE IF EXISTS `ticketspurchased`;

CREATE TABLE `ticketspurchased` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `seatRow` int(11) NOT NULL,
  `seatColumn` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ticketspurchased` */

insert  into `ticketspurchased`(`id`,`session_id`,`seatRow`,`seatColumn`,`personID`) values 
(1,2,1,2,4),
(3,2,1,2,4),
(4,2,3,4,1),
(5,2,3,4,1),
(6,2,3,4,1),
(7,2,3,4,1),
(8,2,3,4,1),
(9,2,3,4,1),

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
