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

/*Data for the table `charachter:actor` */

/*Data for the table `person` */

insert  into `person`(`id`,`name`,`surname`,`email`,`password`) values 
(1,'Omer','Bastug','omer@gmail.com','123'),
(2,'Yusuf','Selvi','yusuf@gmail.com','456'),
(3,'Mark','White','changed@email.com','123456'),
(4,'Sarah','Clarkson','sarah@gmail.com','000'),
(5,'NEW','person','newperson@gmail.com','000'),
(6,'ihsan','senel','ihsan@senel.com','ihsan123'),
(7,'Post','request','post@request.com','pwd'),
(8,'new','request','post@request.com','pwd'),
(9,'Ömer','Baştuğ','bomersami@gmail.com','123'),
(10,'Test','123','test@124.com','123'),
(11,'Ömer','Baştuğ','bomersami@gmail.com','12213'),
(12,'Adam','Sandler','adam@sandler.com','123'),
(13,'Name ','Surname','name@surname.com','12345'),
(14,'1','','asda@asdas.com','');

/*Data for the table `play` */

insert  into `play`(`id`,`name`,`author`,`durationMinutes`,`category`) values 
(1,'Pamuk Prenses','Shakespeare',70,1),
(2,'Keloglanin basi kel','Makif Ersoy',30,1),
(3,'Nasreddin Hoca 5Head','Semseddin hoca',2,1);

/*Data for the table `roles` */

insert  into `roles`(`id`,`role`) values 
(1,'TicketChecker'),
(2,'Client'),
(3,'Cleaner');

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`time`,`theatre_id`,`ticketChecker`,`cleaner`,`ticketsAvailable`,`play_id`) values 
(1,'2022-03-25 11:00:00',3,15,20,NULL,3),
(2,'2022-03-25 12:30:30',3,1,3,74,2),
(3,'2022-03-30 11:30:30',2,2,4,142,3);

/*Data for the table `theatre` */

insert  into `theatre`(`id`,`numberofrows`,`numberofcolumn`,`totalSeats`) values 
(1,11,13,143),
(2,11,13,143),
(3,9,9,81),
(4,15,20,300),
(5,15,20,292);

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
(40,1,6,10,9);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
