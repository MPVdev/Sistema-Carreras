CREATE DATABASE  IF NOT EXISTS `carreras` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `carreras`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: carreras
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrera` (
  `car_id` int NOT NULL AUTO_INCREMENT,
  `car_nombre` varchar(45) NOT NULL,
  `car_fecha` date NOT NULL,
  `car_hora` time NOT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'Fast','2024-02-20','15:00:00'),(10,'dsds','2024-02-28','05:00:00'),(11,'dsdsds','2024-02-21','01:00:00');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `eliminarPcontrol` BEFORE DELETE ON `carrera` FOR EACH ROW BEGIN
	DELETE FROM puntodecontrol WHERE car_id = OLD.car_id;
    DELETE FROM participantescarreras WHERE car_id = OLD.car_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `jueces`
--

DROP TABLE IF EXISTS `jueces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jueces` (
  `juez_cedula` int NOT NULL,
  `juez_nombre` varchar(45) NOT NULL,
  `juez_apellido` varchar(45) NOT NULL,
  `juez_usuario` varchar(45) NOT NULL,
  `juez_clave` varchar(300) NOT NULL,
  PRIMARY KEY (`juez_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jueces`
--

LOCK TABLES `jueces` WRITE;
/*!40000 ALTER TABLE `jueces` DISABLE KEYS */;
INSERT INTO `jueces` VALUES (1,'juez','1','juez','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),(1004405054,'Paul','Diaz','admin','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),(1478526994,'Henry','Diaz','henry1','e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855');
/*!40000 ALTER TABLE `jueces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantes`
--

DROP TABLE IF EXISTS `participantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participantes` (
  `par_cedula` int NOT NULL,
  `par_nombre` varchar(45) NOT NULL,
  `par_apellido` varchar(45) NOT NULL,
  `par_telefono` varchar(45) NOT NULL,
  `par_equipo` varchar(45) NOT NULL,
  PRIMARY KEY (`par_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participantes`
--

LOCK TABLES `participantes` WRITE;
/*!40000 ALTER TABLE `participantes` DISABLE KEYS */;
INSERT INTO `participantes` VALUES (1,'Participante','1','0967957361','Software'),(2,'Participante','2','0967957361','MPV'),(3,'Henry','Diaz','0990823423','Software');
/*!40000 ALTER TABLE `participantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participantescarreras`
--

DROP TABLE IF EXISTS `participantescarreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participantescarreras` (
  `par_cedula` int NOT NULL,
  `car_id` int NOT NULL,
  PRIMARY KEY (`par_cedula`,`car_id`),
  KEY `fk_car_id` (`car_id`),
  CONSTRAINT `fk_car_id` FOREIGN KEY (`car_id`) REFERENCES `carrera` (`car_id`),
  CONSTRAINT `fk_par_cedula` FOREIGN KEY (`par_cedula`) REFERENCES `participantes` (`par_cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participantescarreras`
--

LOCK TABLES `participantescarreras` WRITE;
/*!40000 ALTER TABLE `participantescarreras` DISABLE KEYS */;
INSERT INTO `participantescarreras` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `participantescarreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntodecontrol`
--

DROP TABLE IF EXISTS `puntodecontrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puntodecontrol` (
  `pcon_id` int NOT NULL AUTO_INCREMENT,
  `pcon_nombre` varchar(45) NOT NULL,
  `pcon_distancia` int NOT NULL,
  `juez_cedula` int DEFAULT NULL,
  `car_id` int NOT NULL,
  PRIMARY KEY (`pcon_id`),
  KEY `juez_cedula_idx` (`juez_cedula`),
  KEY `car_id_idx` (`car_id`),
  CONSTRAINT `car_id` FOREIGN KEY (`car_id`) REFERENCES `carrera` (`car_id`),
  CONSTRAINT `juez_cedula` FOREIGN KEY (`juez_cedula`) REFERENCES `jueces` (`juez_cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntodecontrol`
--

LOCK TABLES `puntodecontrol` WRITE;
/*!40000 ALTER TABLE `puntodecontrol` DISABLE KEYS */;
INSERT INTO `puntodecontrol` VALUES (8,'e111',111,NULL,10),(9,'dsd',111,NULL,11),(10,'dsd11',1111,NULL,11);
/*!40000 ALTER TABLE `puntodecontrol` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `puntodecontrol_BEFORE_DELETE` BEFORE DELETE ON `puntodecontrol` FOR EACH ROW BEGIN
	delete from registro where pcon_id = old.pcon_id;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `registro`
--

DROP TABLE IF EXISTS `registro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registro` (
  `reg_id` int NOT NULL AUTO_INCREMENT,
  `reg_tiempo` time NOT NULL,
  `par_cedula` int NOT NULL,
  `pcon_id` int NOT NULL,
  PRIMARY KEY (`reg_id`),
  KEY `par_cedula_idx` (`par_cedula`),
  KEY `pcon_id_idx` (`pcon_id`),
  CONSTRAINT `par_cedula` FOREIGN KEY (`par_cedula`) REFERENCES `participantes` (`par_cedula`),
  CONSTRAINT `pcon_id` FOREIGN KEY (`pcon_id`) REFERENCES `puntodecontrol` (`pcon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro`
--

LOCK TABLES `registro` WRITE;
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'carreras'
--

--
-- Dumping routines for database 'carreras'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_Carreras` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Carreras`(in op int,in id int, in nombre varchar(50), in fecha date, in hora time)
BEGIN
if (op = 1) then
if exists(select * from carrera where car_id=id) then 
	update carrera set car_nombre = nombre, car_fecha=fecha, car_hora=hora where car_id=id;
		select 0;
    else
		Insert into carrera(car_nombre, car_fecha, car_hora) values (nombre,fecha,hora);
		select 1, last_insert_id();
end if;
end if;
if (op = 2) then
SELECT c.*, 
       CASE 
           WHEN c.car_fecha > DATE(NOW()) THEN 0
           WHEN c.car_fecha = DATE(NOW()) AND c.car_hora > TIME(NOW()) THEN 1
           ELSE 2
       END AS car_estado, 
       (
           SELECT concat(par.par_nombre, " ", par.par_apellido)
           FROM registro r
           INNER JOIN participantes par on par.par_cedula = r.par_cedula
           INNER JOIN puntodecontrol pc ON pc.pcon_id = r.pcon_id
           INNER JOIN carrera car ON car.car_id = pc.car_id
           WHERE car.car_id = c.car_id
           AND pc.pcon_id = (
               SELECT p.pcon_id 
               FROM puntodecontrol p 
               WHERE p.car_id = c.car_id 
               ORDER BY p.pcon_id DESC 
               LIMIT 1
           )
           ORDER BY r.reg_tiempo
           LIMIT 1
       ) AS Ganador
FROM carrera c;
end if;
if (op = 3) then
if not(exists( select * from carrera where car_id = id)) then 
		select 0;
    else
		delete from carrera where car_id = id;
		select 1;
end if;
end if;
if (op = 4) then
	select pcon_id, concat(juez_nombre, " ", juez_apellido) as juez, pcon_distancia from puntodecontrol 
inner join jueces on jueces.juez_cedula = puntodecontrol.juez_cedula
where car_id = id
order by pcon_distancia;
END if;
if (op = 5) then
SELECT concat(par_nombre, " ", par_apellido, "-", reg_tiempo) as participante
FROM participantes
inner join registro on registro.par_cedula = participantes.par_cedula
WHERE pcon_id = id;
end if;
if (op = 6) then
select * from puntodecontrol where car_id = id;
end if;
if (op = 7) then
select * from jueces;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Jueces` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Jueces`(in op int,in cedula int, in nombre varchar(45), in apellido varchar(45), in usuario varchar(45), in clave varchar(300))
BEGIN
if (op = 0) then
SELECT
  CASE 
    WHEN juez_cedula = 1004405054 THEN 0
    WHEN EXISTS (SELECT * FROM jueces WHERE juez_usuario = usuario AND juez_clave = clave) THEN 1
    ELSE 2
  END AS resultado, 
  juez_nombre, 
  juez_apellido,
  juez_cedula
FROM jueces
WHERE juez_usuario = usuario AND juez_clave = clave;

end if;
if (op = 1) then
if exists(select * from jueces where juez_cedula=cedula) then 
	update jueces set juez_nombre = nombre, juez_apellido=apellido, juez_usuario=usuario, juez_clave = clave where juez_cedula=cedula;
		select 0;
    else
		Insert into jueces values (cedula, nombre, apellido, usuario, clave);
		select 1;
end if;
end if;
if (op = 2) then
select * from jueces;
end if;
if (op = 3) then
if not(exists( select * from jueces where juez_cedula=cedula)) then 
		select 0;
    else
		delete from jueces where juez_cedula = cedula;
		select 1;
end if;
end if;
if (op = 4) then
select  pcon_nombre,pcon_distancia,car_nombre,car_fecha, car_hora, carrera.car_id, pcon_id from puntodecontrol 
inner join carrera on carrera.car_id = puntodecontrol.car_id
where juez_cedula = cedula
order by car_fecha;
end if;
if (op = 5) then
SELECT participantes.par_cedula, pcon_ID, concat(par_nombre, " ", par_apellido) as participante
FROM participantescarreras
INNER JOIN participantes ON participantes.par_cedula = participantescarreras.par_cedula
inner join carrera on carrera.car_ID = participantescarreras.car_ID
inner join puntodecontrol on puntodecontrol.car_ID = carrera.car_ID
WHERE pcon_id = cedula;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Participantes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Participantes`(in op int,in cedula int, in nombre varchar(45), in apellido varchar(45), in telefono varchar(45), in equipo varchar(45))
BEGIN
if (op = 1) then
if exists(select * from participantes where par_cedula=cedula) then 
	update participantes set par_nombre = nombre, par_apellido=apellido, par_telefono=telefono, par_equipo=equipo where par_cedula=cedula;
		select 0;
    else
		Insert into participantes values (cedula, nombre, apellido, telefono, equipo);
		select 1;
end if;
end if;
if (op = 2) then
select * from participantes;
end if;
if (op = 3) then
if not(exists( select * from participantes where par_cedula=cedula)) then 
		select 0;
    else
		delete from participantes where par_cedula = cedula;
		select 1;
end if;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PControl` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PControl`(in op int,in id int, in nombre varchar(45), in distancia int, in juez int, in carrera int)
BEGIN
if (op = 1) then
if exists(select * from puntodecontrol where pcon_id=id) then 
	update puntodecontrol set pcon_nombre = nombre, pcon_distancia=distancia, juez_cedula=juez, car_id=carrera where pcon_id=id;
		select 0;
    else
		Insert into puntodecontrol (pcon_nombre, pcon_distancia, car_id) values (nombre, distancia, carrera);
		select 1;
end if;
end if;
if (op = 2) then
select * from puntodecontrol;
end if;
if (op = 3) then
if not(exists( select * from puntodecontrol where pcon_id=id)) then 
		select 0;
    else
		delete from puntodecontrol where pcon_id = id;
		select 1;
end if;
end if;
if (op = 4) then
delete from puntodecontrol where car_id = carrera;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Registro` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Registro`(in op int,in id int, in tiempo TIME, in participante int, in pcontrol int)
BEGIN
if (op = 1) then
if exists(select * from registro where pcon_id = pcontrol and par_cedula = participante) then 
		select 0;
    else
		Insert into registro values (id, time(now()), participante, pcontrol);
		select 1;
end if;
end if;
if (op = 2) then
select * from registro;
end if;
if (op = 3) then
if not(exists( select * from registro where reg_id=id)) then 
		select 0;
    else
		delete from registro where reg_id = id;
		select 1;
end if;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-20  3:27:02
