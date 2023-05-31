-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ts_db
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Parfait','assets/images/categorias/20230508213050.jpg',1),(2,'Tartas','assets/images/categorias/20230508213810.jpg',1),(3,'Paletas','assets/images/categorias/20230508213844.jpg',1),(4,'Helados','assets/images/categorias/20230508213901.jpg',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(100) NOT NULL DEFAULT 'default.png',
  `token` varchar(100) DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Mariela Campbell','marielakmpbell@gmail.com','$2y$10$B6ubMWW7uNOk/oJcayCM0up.QR7kr0uwE1kyXNVbq8Grwcw73H8rC','default.png',NULL,1),(2,'Jennifer Gonzalez','jennifergzalez@gmail.com','$2y$10$ZG5HddJ2Hblxg41k3mwWROVrIfPDm8FDU4373kb2r4vTtwaXGw0zG','default.png',NULL,1),(3,'Yoberth Malave','yjmalave06@gmail.com','$2y$10$8CIu2mmU2vKQ3lBlHfTI3u9rmbGRBjhP7aOeWzlLfO7dtf7wULx4i','default.png',NULL,1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES (1,'Tarta de arándanos',15.00,1,1,6),(2,'Parfait de fresa y banana',6.50,2,1,10);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel`
--

DROP TABLE IF EXISTS `nivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel`
--

LOCK TABLES `nivel` WRITE;
/*!40000 ALTER TABLE `nivel` DISABLE KEYS */;
INSERT INTO `nivel` VALUES (1,'Gerente'),(2,'Administrador'),(3,'Cliente');
/*!40000 ALTER TABLE `nivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pago` enum('Pago movil','Transferencia','PayPal') DEFAULT NULL,
  `id_transaccion` varchar(80) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `email_user` varchar(80) DEFAULT NULL,
  `proceso` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'Transferencia','15452',30.00,'2023-05-31','yjmalave06@gmail.com','2');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` longtext NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Helado de fresa','Refrescante postre sabor a fresa, perfecto para los días calurosos.',5.00,20,'assets/images/productos/20230508214742.jpg',4,1),(2,'Helado de mango','Refrescante postre sabor a mango, perfecto para los días calurosos.',5.00,20,'assets/images/productos/20230508214826.jpg',4,1),(3,'Paleta de durazno','Deliciosas y nutritivas paletas de helado de yogurt con trozos de durazno. Estas paletas son un postre fresco y saludable que podemos comer sin culpa con la excusa perfecta de incorporar más fruta a nuestra dieta.',2.50,20,'assets/images/productos/20230508215224.jpg',3,1),(4,'Paleta de fresa y arándano','Deliciosas y nutritivas paletas de helado de yogurt con trozos de fresa y arándanos. Estas paletas son un postre fresco y saludable que podemos comer sin culpa con la excusa perfecta de incorporar más fruta a nuestra dieta.',2.50,20,'assets/images/productos/20230508215359.jpg',3,1),(5,'Paleta de fresa','Deliciosas y nutritivas paletas de helado de yogurt con trozos de fresa. Estas paletas son un postre fresco y saludable que podemos comer sin culpa con la excusa perfecta de incorporar más fruta a nuestra dieta.',2.50,20,'assets/images/productos/20230508215512.jpg',3,1),(6,'Tarta de arándanos','Tarta tan cremosa que casi parece un flan con dulce mermelada y trozos de arándanos.',15.00,5,'assets/images/productos/20230508220346.jpg',2,1),(7,'Tarta de durazno','Tarta tan cremosa que casi parece un flan con dulce mermelada y trozos de durazno.',15.00,5,'assets/images/productos/20230508220439.jpg',2,1),(8,'Tarta de fresa','Tarta tan cremosa que casi parece un flan con dulce mermelada y trozos de fresa.',15.00,5,'assets/images/productos/20230508220508.jpg',2,1),(9,'Parfait de durazno','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de durazno.',6.50,20,'assets/images/productos/20230508221217.jpg',1,1),(10,'Parfait de fresa y banana','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de fresa y banana.',6.50,20,'assets/images/productos/20230508221304.jpg',1,1),(11,'Parfait de fresa y arándano','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de fresa y arándano.',6.50,20,'assets/images/productos/20230508221354.jpg',1,1),(12,'Parfait de fresa','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de fresa.',6.50,20,'assets/images/productos/20230508221429.jpg',1,1),(13,'Parfait de kiwi y banana','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de kiwi y banana.',6.50,20,'assets/images/productos/20230508221506.jpg',1,1),(14,'Parfait de manzana','Exquisito postre que sirve de desayuno dentro de un vaso repartido por capas, las cuales incluyen granola, yogurt griego y trozos de manzana.',6.50,20,'assets/images/productos/20230508221539.jpg',1,1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `perfil` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Mariela Jennifer','Campbell Gonzalez','marielakmpbell@gmail.com','$2y$10$1twRNS2qCAd6fz/NDTJ3fuwt9r78l7cb1oq9bjiQP7r5qKIeYGioO',NULL,1),(9,'alondra','indriago','alondra@gmail.com','$2y$10$fFbFPD.F3o6XCe6iJPOxge4AZu9dXWXuEHaMSZLKd1Wz1b7YSdLTS',NULL,0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-31 16:19:33
