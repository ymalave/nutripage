-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ad_db
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
INSERT INTO `categorias` VALUES (1,'Agua','assets/images/categorias/20230111175155.jpg',1),(2,'Detergentes','assets/images/categorias/20230111175214.jpg',1),(3,'Envases','assets/images/categorias/20230111175253.jpg',1),(4,'prueba','assets/images/categorias/20230111204317.jpg',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Mariela Campbell','marielakmpbell@gmail.com','$2y$10$B6ubMWW7uNOk/oJcayCM0up.QR7kr0uwE1kyXNVbq8Grwcw73H8rC','default.png',NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
INSERT INTO `detalle_pedidos` VALUES (1,'Agua potable 20L',3.00,1,1,3),(2,'Cloro 1L',1.00,1,1,4),(3,'Agua potable 5L',1.00,3,2,1),(4,'Agua potable 12L',2.00,1,2,2),(5,'Cloro 1L',1.00,1,2,4);
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaccion` varchar(80) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `fecha` datetime NOT NULL,
  `email` varchar(80) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `email_user` varchar(80) NOT NULL,
  `proceso` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'3AX09242EA464744D',4.00,'COMPLETED','2023-01-11 18:26:09','sb-6voxp15194620@personal.example.com','John','Doe','Free Trade Zone','Caracas','marielakmpbell@gmail.com','2'),(2,'5DB51424BN734951M',6.00,'COMPLETED','2023-01-11 20:38:25','sb-6voxp15194620@personal.example.com','John','Doe','Free Trade Zone','Caracas','marielakmpbell@gmail.com','3');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Agua potable 5L','Agua apta para el consumo, puede ser consumida sin restricción para beber o preparar alimentos.​​',1.00,10,'assets/images/productos/20230111175420.jpg',1,1),(2,'Agua potable 12L','Agua apta para el consumo, puede ser consumida sin restricción para beber o preparar alimentos.​​',2.00,20,'assets/images/productos/20230111175558.jpg',1,1),(3,'Agua potable 20L','Agua apta para el consumo, puede ser consumida sin restricción para beber o preparar alimentos.​​',3.00,30,'assets/images/productos/20230111175646.jpg',1,1),(4,'Cloro 1L','De uso doméstico. Es efectivo, económico y conveniente. Perfecto para realizar la limpieza habitual, eliminando así la suciedad de las superficies y los gérmenes.',1.00,5,'assets/images/productos/20230111175731.jpg',2,1),(5,'Cloro 5L','De uso doméstico. Es efectivo, económico y conveniente. Perfecto para realizar la limpieza habitual, eliminando así la suciedad de las superficies y los gérmenes.',2.00,20,'assets/images/productos/20230111175812.jpg',2,1),(6,'Lavaplatos líquido 400mL','Limpiador líquido multisuperficies de uso doméstico, formulado para limpiar y desengrasar todas las superficies lavables de la cocina, hornillas, griferías, vajillas, ollas, utensilios, y cualquier otro lugar en el que se requiera remover sucio y grasa, dejándolos relucientes y sin residuos, además con poder antibacterial.',1.00,10,'assets/images/productos/20230111175940.jpg',2,1),(7,'Lavaplatos líquido 5L','Limpiador líquido multisuperficies de uso doméstico, formulado para limpiar y desengrasar todas las superficies lavables de la cocina, hornillas, griferías, vajillas, ollas, utensilios, y cualquier otro lugar en el que se requiera remover sucio y grasa, dejándolos relucientes y sin residuos, además con poder antibacterial.',2.00,20,'assets/images/productos/20230111180024.jpg',2,1),(8,'Envase para agua potable 1L','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',1.00,5,'assets/images/productos/20230111180214.jpg',3,1),(9,'Envase para agua potable 5L','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',2.00,10,'assets/images/productos/20230111180303.jpg',3,1),(10,'Botellón para agua potable 20L','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',3.00,20,'assets/images/productos/20230111180350.jpg',3,1),(11,'Envase para detergentes 400mL','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',1.00,5,'assets/images/productos/20230111180444.jpg',3,1),(12,'Envase para detergentes 400mL','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',1.00,5,'assets/images/productos/20230111180603.jpg',3,1),(13,'Envase para detergentes 1L','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',2.00,10,'assets/images/productos/20230111180701.jpg',3,1),(14,'Envase para detergentes 5L','Botellas hechas 100% de plástico reciclado que representan una opción sostenible. Estos envases nos invitan a ser más respetuosos y a reciclar para mantener el plástico dentro de nuestro círculo y fuera de la naturaleza.',3.00,15,'assets/images/productos/20230111180804.jpg',3,1),(15,'pruebaa','dsfsdg',1.00,2,'assets/images/productos/20230111204403.jpg',1,1);
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

-- Dump completed on 2023-01-11 21:01:28
