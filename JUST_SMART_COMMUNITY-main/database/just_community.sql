CREATE DATABASE  IF NOT EXISTS `just_community` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `just_community`;
-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: just_community
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cafeterias`
--

DROP TABLE IF EXISTS `cafeterias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cafeterias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cafeterias`
--

LOCK TABLES `cafeterias` WRITE;
/*!40000 ALTER TABLE `cafeterias` DISABLE KEYS */;
INSERT INTO `cafeterias` VALUES (64,'Medical Cafterial','Logos/cafeteriaLogo.png'),(65,'Engineering Cafteria','Logos/cafeteriaLogo.png'),(66,'BLK Cafe','Logos/BLKLogo.png'),(67,'Camel','Logos/Camellogo.png'),(68,'Ta\'miah','Logos/Ta\'miahLogo.webp'),(69,'Shalmoaneh','Logos/ShalmonehLogo.png'),(70,'Cloud Cafe','Logos/CloudLogo.jfif');
/*!40000 ALTER TABLE `cafeterias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lost_items`
--

DROP TABLE IF EXISTS `lost_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lost_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `status` enum('lost','found') DEFAULT 'lost',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `lost_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lost_items`
--

LOCK TABLES `lost_items` WRITE;
/*!40000 ALTER TABLE `lost_items` DISABLE KEYS */;
INSERT INTO `lost_items` VALUES (3,NULL,'سماعات تلفون','سماعات ايفون','medical cafeteria','lost','2026-05-28 11:54:41'),(5,NULL,'Notebook','Its color is green and has my name Asma on it','SE labs','lost','2026-05-28 20:29:48');
/*!40000 ALTER TABLE `lost_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meals`
--

DROP TABLE IF EXISTS `meals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafeteria_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `cafeteria_id` (`cafeteria_id`),
  CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`cafeteria_id`) REFERENCES `cafeterias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meals`
--

LOCK TABLES `meals` WRITE;
/*!40000 ALTER TABLE `meals` DISABLE KEYS */;
INSERT INTO `meals` VALUES (1,68,'falafel','Fresh falafel with tahini sauce',0.80,'Meals/falafel.jpg','sandwich',1,'2026-05-19 06:32:30'),(2,67,'Shawrmah','Juicy chicken shawarma wrapped with garlic sauce, pickles, and fresh vegetables.',1.25,'Meals/shawrma.jfif','sandwich',1,'2026-05-19 06:44:31'),(3,67,'Zenjar','Crispy chicken zinger sandwich served with lettuce, pickles, and special sauce in a toasted bun.',1.25,'Meals/zenjar.jfif','sandwich',1,'2026-05-19 06:44:38'),(4,67,'Potato Sandwich','Golden crispy french fries seasoned and served hot.',1.00,'Meals/Batata.jfif','sandwich',1,'2026-05-19 06:44:44');
/*!40000 ALTER TABLE `meals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `status` enum('preparing','completed') DEFAULT 'preparing',
  `payment_status` enum('paid','unpaid') DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `meal_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `meal_id` (`meal_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (12,48,'completed','unpaid','2026-05-28 18:29:54',3,5);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_requests`
--

DROP TABLE IF EXISTS `product_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_requests`
--

LOCK TABLES `product_requests` WRITE;
/*!40000 ALTER TABLE `product_requests` DISABLE KEYS */;
INSERT INTO `product_requests` VALUES (6,1,6,35,'How can I contact with you?','2026-05-28 15:41:49');
/*!40000 ALTER TABLE `product_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,35,'أقلام جافة ','أقلام للاستخدام اليومي',0.25,'uploads/1779969035_قلم.jfif','approved','2026-05-28 11:50:35'),(2,48,'مطرزات','مطرزات يدوية بأشكال مختلفة مصنوعة بحب',0.50,'uploads/1779994365_وردة.jpg','approved','2026-05-28 18:52:45');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'student',
  `proof_file` varchar(255) DEFAULT NULL,
  `faculty` varchar(30) DEFAULT NULL,
  `pending` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'asma','asma@gmail.com','$2y$10$7G2EX0LzkkPnyz00FNzFsuRFpm2MvVtI1c8KkYvdK5M6jcgfEQ/x6','student',NULL,NULL,0),(2,'barah','barah@just.edu.jo','$2y$10$V1FJgkkDc/C2vth8vYmrV.6Vey4Od15WpjljW6BAAbB4dPWexWyhS','student',NULL,NULL,0),(4,'Asma','1234@just.edu.jo','$2y$10$aMDfCFFthyPg9f5eUr5owe7gIt3PSn6TzozewgowiZ3/vT1gRLRfe','student',NULL,NULL,0),(5,'Asma','12345@just.edu.jo','$2y$10$Wy38sOHFf9ISr96oL6I5y.K/D5l0GJUTZXIHyd69QuN8lAAQZPQay','student',NULL,NULL,0),(6,'Asma','123456@just.edu.jo','$2y$10$Oo/2l6jhJtH6x9LlL8rn3OMM05.8.12gDlRmHKDqotp/BXhDiiu4y','student',NULL,NULL,0),(8,'Asma','123@just.edu.jo','$2y$10$579iO8R.lNUqqtWCbYE3MOscOy2p8.E9d.T3Uj6ZCi6j7e/xkOKGi','student',NULL,NULL,0),(10,'barah','ss2@just.edu.jo','$2y$10$oNC4Z1kH64NGNxCl77wHG.gnQDsUNIkILYn6AGfDs.uUBbcrSXl3G','student',NULL,NULL,0),(12,'asm','1111@just.edu.jo','$2y$10$lfkuBaCpj4KD6Wye7fgtm.qGYzlA6mqtq3xDxrC6/AbsLu4XOFnZO','student',NULL,NULL,0),(15,'amal','ama@just.edu.jo','$2y$10$FZNFvuwrmNkEQnITy6ydKun5jcJkZNNFd.Tn6Aa3SBXrQWtWyqhHq','student',NULL,NULL,0),(16,'ahmad','ahmad@just.edu.jo','$2y$10$YmzrJrXa7F3fYqp6fSFZOuceAZJkRjckeCJATYUsyBmcpWqHiHb6.','student',NULL,NULL,0),(29,'Asma Jarrah','aijarrah20@cit.just.edu.jo','$2y$10$E.xb.kz3Uqnt063NtAs8n.nROzR2Qip.XHgueNS/ZpyXh1cAxYEJi','student',NULL,'IT',0),(30,'Eman','eman@den.just.edu.jo','$2y$10$r2Lcp6E3dFS5MxaoDhpwpu5rFdDkHLyQrChhmjvX3NZSjF0Q8WiaG','student',NULL,'Dentistry',0),(31,'Asm','asm@just.edu.jo','$2y$10$.As6HSrEv9XKRfEfVNzhWOFiovIP9MglWmbqxP04himzI2zw0XvgS','student',NULL,'Medicine',0),(32,'aj3','aj3@just.edu.jo','$2y$10$OWTi4WmuMp6J7PUT0oyqcuKYMxsjsBQ.V.NpvRaYcVrMEcq2JI0q2','student',NULL,'Agriculture',0),(33,'taima','taima@just.edu.jo','$2y$10$WdCVN.t.81EwrgFLxoJMmeUAcr2oY2uFDjxelOt8OCkLiTleB1k1S','student',NULL,'Nursing',0),(34,'asmm','asmm@just.edu.jo','$2y$10$CEKYrQYGPheRhOfplMka2OZabMvjmW2zB1hyhKIJQM4SgHmyvlD4K','student',NULL,'Agriculture',0),(35,'Eman','eman@med.just.edu.jo','$2y$10$KxvVhfE5Q.cg/8Tk2aDBl.EskXd78IrdoH8GZh8Rq4P5FN/tfZIRS','admin',NULL,'',0),(47,'Mohammed','mohammed@gmail.com','$2y$10$hrzmftmPAmtIrVwgGc6q0uA9TKnrBpvLqvJnGwpWPC.fQ7aZB.MhG','canteen','../assets/images/6a1843743cb86.jpg',NULL,0),(48,'Malek','malek@just.edu.jo','$2y$10$DILXwUqCgQhFTo75EFQtweboZbuPV79wiGX0vNp1pUlAfv/hUg8KW','student',NULL,'',0),(49,'Hamzah','hamzeh@gmail.com','$2y$10$AVKYH5WuBFVhzPSFVf3k5.48UP1mEFZ9oVMmr7mNOmwaj/OkIGUMe','admin','../assets/images/6a18a72556c1a.jpg',NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-30 16:51:22
