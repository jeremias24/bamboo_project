/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.24-MariaDB : Database - bamboo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bamboo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bamboo`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_sku` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(11,2) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` int(3) NOT NULL,
  `add_to_cart_date` datetime DEFAULT NULL,
  `pay_method` varchar(50) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cart` */

insert  into `cart`(`cart_id`,`product_sku`,`qty`,`price`,`client_id`,`status`,`add_to_cart_date`,`pay_method`,`order_date`,`paid_date`) values 
(55,'BAM001',1,200.00,2,0,'2022-10-25 03:39:09',NULL,'2022-10-25 03:42:10',NULL),
(56,'BAM001',1,200.00,2,3,'2022-10-25 03:42:02','0','2022-10-25 03:42:14','2022-10-26 08:01:32'),
(58,'BAM002',1,150.00,2,3,'2022-10-25 03:42:07','0','2022-10-25 03:42:12','2022-10-26 08:01:32'),
(59,'BAM002',1,150.00,2,1,'2022-10-25 03:42:26',NULL,NULL,NULL),
(60,'BAM002',2,150.00,2,3,'2022-10-25 03:42:27','1','2022-10-25 08:10:05','2022-10-26 08:01:20'),
(61,'BAM002',1,150.00,2,1,'2022-10-25 03:42:27',NULL,NULL,NULL);

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(225) NOT NULL,
  `ClientId` varchar(225) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Company` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL,
  `Picture` varchar(225) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `clients` */

insert  into `clients`(`id`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`ClientId`,`Phone`,`Company`,`Address`,`Status`,`Picture`,`date`) values 
(1,'Yahuza','Abdul-Hakim','Vendetta','musheabdulhakim@protonmail.ch','$2y$10$xU1zDRigag7ZMGs0Egcqoei0SrtZJRX/p425h4qOi5OMKFz32k0UC','CLT-613498','233209229025','Microsoft Inc','Live from home',1,'d41d8cd98f00b204e9800998ecf8427e1601112041','2020-09-26'),
(2,'Vendetta','Alkaline','alkaline','musheabdulhakim99@gmail.com','$2y$10$qUL2APr762X.vvJuNQvqludvabDa.Y3TRHOa.M/qq8WFoeoh7IaWG','CLT-217594','233209229025','Falcon Systems','Live from home',1,'d41d8cd98f00b204e9800998ecf8427e1601112339','2020-09-26');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(14) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

insert  into `products`(`product_id`,`name`,`sku`,`price`,`image`) values 
(1,'Bamboo A','BAM001',200,'images/bamboo.jpg'),
(2,'Bamboo B','BAM002',150,'images/bamboo.jpg'),
(3,'Bamboo C','BAM003',180,'images/bamboo.jpg');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(200) NOT NULL,
  `LastName` varchar(200) NOT NULL,
  `UserName` varchar(200) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `UserType` varchar(50) NOT NULL,
  `Picture` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`FirstName`,`LastName`,`UserName`,`Email`,`Password`,`Phone`,`Address`,`UserType`,`Picture`,`dateTime`) values 
(1,'System','Admin','Super Admin','admin@bamboo.com','admin123','9876543210','Los Angeles, California','Administrator','default.jpg','2020-09-21 19:04:47'),
(2,'Client','','Client','client@bamboo.com','client','233209229025','San Francisco Bay Area','Costumer','default.jpg','2020-09-21 19:05:43'),
(9,'Seller','','Seller','seller@bamboo.com','seller','0921-294-6607','asdf','Seller','default.jpg','2022-10-10 09:09:04'),
(10,'Boyet','adfasdf','asdf','nelmardapulang@yahoo.com','$2y$10$AgxfCLHMSX1BcSpfv8LTCe6m8tSZLdOWTgBzA9w.sBEJUIy8GK7b2','0921-294-6607','asdf','Seller','signin.png','2022-10-10 09:43:13'),
(11,'test','test','test','test@test.com','$2y$10$93iDOrJ8oVg5b6/GM6QnZ.wEfCVCSKo1JRwXGorSX703gJ7xDoEW.','0921-294-6607','test','Costumer','recover.png','2022-10-10 09:49:38');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
