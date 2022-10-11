/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB : Database - theaterdatabase
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`theaterdatabase` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `theaterdatabase`;

/*Table structure for table `charachter:actor` */

DROP TABLE IF EXISTS `charachter:actor`;

CREATE TABLE `charachter:actor` (
  `play_id` int(11) NOT NULL,
  `charachter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_id` int(11) NOT NULL,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `charachter:actor` */

/*Table structure for table `favoriteplay` */

DROP TABLE IF EXISTS `favoriteplay`;

CREATE TABLE `favoriteplay` (
  `person_id` int(10) unsigned NOT NULL,
  `play_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`person_id`,`play_id`),
  KEY `play_id` (`play_id`),
  CONSTRAINT `favoriteplay_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`),
  CONSTRAINT `favoriteplay_ibfk_2` FOREIGN KEY (`play_id`) REFERENCES `play` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `favoriteplay` */

insert  into `favoriteplay`(`person_id`,`play_id`) values 
(1,2),
(1,3),
(9,1),
(9,3),
(50,3);

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

CREATE TABLE `person` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `person_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `person` */

insert  into `person`(`id`,`name`,`surname`,`email`,`password`,`role_id`) values 
(1,'Omer','Bastug','omer@gmail.com','123',4),
(2,'Yusuf','Selvi','yusuf@gmail.com','456',1),
(3,'Mark','White','changed@email.com','123456',1),
(4,'Sarah','Clarkson','sarah@gmail.com','000',2),
(5,'NEW','person','newperson@gmail.com','000',2),
(6,'ihsan','senel','ihsan@senel.com','ihsan123',2),
(7,'Post','request','post@request.com','pwd',2),
(8,'new','request','post@request.com','pwd',2),
(9,'Ömer','Baştuğ','bomersami@gmail.com','123',4),
(10,'Test','123','test@124.com','123',3),
(11,'Ömer','Baştuğ','bomersami@gmail.com','12213',3),
(12,'Adam','Sandler','adam@sandler.com','123',4),
(13,'Name ','Surname','name@surname.com','12345',4),
(15,'Omer','Bastug','omerbastug@email.com','omer123',2),
(16,'İhsan','Şenel','124@gmail.com','123',2),
(17,'Ali','Şenel','aliihsansenel0@gmail.com','123456789',1),
(18,'Beatrice','Musgrave','bmusgrave2@bbb.org','XPyuXR',2),
(19,'Tuesday','Vlahos','tvlahos3@usnews.com','HWX2Ka0',1),
(20,'Ashlan','Ganniclifft','aganniclifft4@reuters.com','fMo9mUai',4),
(21,'Flori','Pyett','fpyett5@nifty.com','AkOXxzcR',3),
(22,'Phillipp','Witherbed','pwitherbed6@tiny.cc','1nzUTpxe41PR',3),
(23,'Johnny','Blesdill','jblesdill7@blogspot.com','3lJPP2Y',1),
(24,'Patric','Jannasch','pjannasch8@bizjournals.com','MJ6DPV2ncilx',1),
(25,'Leonora','Weale','lweale9@exblog.jp','aqKSTsD',4),
(26,'Cam','Scrowston','cscrowstona@imgur.com','BqvL0p',4),
(27,'Lidia','Tidman','ltidmanb@liveinternet.ru','yKqLxYOOAGJ',4),
(28,'Marilee','Badcock','mbadcockc@google.com','aMz6VBDE',2),
(29,'Ganny','Gohn','ggohnd@chicagotribune.com','2k3EfB8S',2),
(30,'Petunia','English','penglishe@desdev.cn','weBoxTy',1),
(31,'Editha','Davson','edavsonf@google.ca','mvkaoBp',4),
(32,'Joya','Stroban','jstrobang@wix.com','Tk54kM',4),
(33,'Skipper','Mogey','smogeyh@xinhuanet.com','0L24FYGrtH',2),
(34,'Blondelle','Bidder','bbidderi@java.com','BBnbjWyS',2),
(35,'Margie','McCloud','mmccloudj@amazonaws.com','nflzqKNsr7',3),
(36,'Martita','Iggo','miggok@statcounter.com','JYgsJBr9l8',2),
(37,'Jaquenetta','McNabb','jmcnabbl@plala.or.jp','8I6aN6b0yRX',3),
(38,'Arturo','Kelleway','akellewaym@blogspot.com','8PLqSwJ7VZ',3),
(39,'Lora','Hakonsson','lhakonssonn@bloglovin.com','vKdQaw',3),
(40,'Hall','Serot','hseroto@prweb.com','dtl9yucI',4),
(41,'Mike','Whitticks','mwhitticksp@cdc.gov','6H7FuoRZ',3),
(42,'Latrena','Caddies','lcaddiesq@stumbleupon.com','2C2QKB6plDj',4),
(43,'Randi','Georgeot','rgeorgeotr@is.gd','9cBuDoiuFBv',2),
(44,'Tawnya','Spivey','tspiveys@cnet.com','UmgHYK',1),
(45,'Easter','Ceney','eceneyt@amazon.co.jp','b6mcGD29G3B',2),
(46,'iam','legit','iam@legit.com','741258',2),
(47,'new','name','new@a','123',2),
(48,'first','ss','sad@new.mail','1234',2),
(50,'name','surname','email@e','password',5),
(52,'Ö','B','b@gmail.com','123',1);

/*Table structure for table `play` */

DROP TABLE IF EXISTS `play`;

CREATE TABLE `play` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `durationMinutes` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  CONSTRAINT `play_ibfk_1` FOREIGN KEY (`category`) REFERENCES `playcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `play` */

insert  into `play`(`id`,`name`,`author`,`durationMinutes`,`category`) values 
(1,'Pamuk Prenses','Shakespeare',70,1),
(2,'Keloglanin basi kel','Makif Ersoy',30,5),
(3,'Nasreddin Hoca 5Head','Semseddin hoca',2,1),
(4,'asdasd','sss',12321,1);

/*Table structure for table `playcategory` */

DROP TABLE IF EXISTS `playcategory`;

CREATE TABLE `playcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `playcategory` */

insert  into `playcategory`(`id`,`name`) values 
(1,'Comedy'),
(2,'Tragedy'),
(3,'Historical'),
(4,'Theatre of the Absurd'),
(5,'Musical theatre');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`) values 
(1,'TicketChecker'),
(2,'Client'),
(3,'Cleaner'),
(4,'Actor'),
(5,'Admin');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`time`,`theatre_id`,`ticketChecker`,`cleaner`,`ticketsAvailable`,`play_id`) values 
(1,'2022-03-25 11:00:00',3,15,20,NULL,3),
(2,'2022-03-25 12:30:30',3,1,3,74,2),
(3,'2022-03-30 11:30:30',2,2,4,142,3),
(4,'2022-04-02 00:00:00',1,3,1,66,8),
(5,'2022-05-17 00:00:00',5,2,5,21,10),
(6,'2021-07-12 00:00:00',1,3,3,22,5),
(7,'2021-10-23 00:00:00',3,1,1,35,10),
(8,'2021-10-28 00:00:00',3,3,1,13,1),
(9,'2022-04-02 00:00:00',1,3,1,66,8),
(10,'2022-02-11 00:00:00',4,2,3,1,4),
(11,'2022-03-09 00:00:00',2,1,1,64,7),
(12,'2022-03-11 00:00:00',2,1,1,86,8),
(13,'2021-12-27 00:00:00',2,3,5,20,10),
(14,'2021-09-28 00:00:00',1,3,1,41,1),
(15,'2022-04-05 00:00:00',5,1,1,88,6),
(16,'2021-08-23 00:00:00',5,5,3,59,6),
(17,'2022-04-05 00:00:00',2,4,2,31,5),
(18,'2021-09-15 00:00:00',2,1,4,90,3),
(19,'2022-02-11 00:00:00',4,5,3,14,2);

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ticketspurchased` */

insert  into `ticketspurchased`(`id`,`session_id`,`seatRow`,`seatColumn`,`personID`) values 
(1,2,1,2,4),
(4,2,3,4,1),
(10,3,6,7,4),
(11,1,5,3,1),
(12,1,4,3,1),
(13,1,3,3,1),
(14,1,3,2,1),
(15,1,3,1,1),
(16,3,1,13,1),
(17,3,1,13,1),
(18,1,1,1,1),
(19,1,3,9,2),
(20,1,1,8,1),
(21,3,2,10,1),
(22,3,9,10,1),
(23,3,2,6,1),
(24,1,2,1,1),
(25,3,2,1,1),
(26,3,2,13,1),
(27,3,1,11,1),
(28,3,2,4,1),
(29,3,2,5,1),
(30,1,1,9,1),
(31,1,1,7,1),
(32,1,8,8,1),
(33,1,9,9,1),
(34,3,5,7,1),
(35,3,10,10,1),
(36,1,6,6,1),
(37,1,6,6,1),
(38,1,6,6,9),
(39,1,6,9,9),
(40,1,6,10,9),
(41,3,2,14,4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
