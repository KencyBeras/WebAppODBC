-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: bdsistemaclub
-- ------------------------------------------------------
-- Server version	5.6.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cancha`
--

DROP TABLE IF EXISTS `cancha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cancha` (
  `idcancha` int(11) NOT NULL AUTO_INCREMENT,
  `idfilial` int(11) NOT NULL,
  `num_cancha` int(11) DEFAULT NULL,
  `deporte` varchar(45) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`idcancha`,`idfilial`),
  KEY `fk_cancha_filial1_idx` (`idfilial`),
  CONSTRAINT `fk_cancha_filial1` FOREIGN KEY (`idfilial`) REFERENCES `filial` (`idfilial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancha`
--

LOCK TABLES `cancha` WRITE;
/*!40000 ALTER TABLE `cancha` DISABLE KEYS */;
INSERT INTO `cancha` VALUES (1,1,1,'Futbol','Sintetico'),(2,1,2,'Futbol','Sintetico'),(3,1,3,'Futbol','Cemento'),(4,1,1,'Tenis','Polvo de ladrillo'),(5,2,1,'Futbol','Sintetico'),(6,2,1,'Tenis','Cemento'),(7,2,2,'Tenis','Cemento'),(8,3,1,'Futbol','Sintetico'),(9,3,1,'Tenis','Polvo de ladrillo'),(10,3,2,'Tenis','Cemento'),(11,4,1,'Futbol','Sintetico'),(12,4,1,'Tenis','Cesped'),(13,4,2,'Futbol','Sintetico'),(14,4,1,'Basquet','Madera');
/*!40000 ALTER TABLE `cancha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filial`
--

DROP TABLE IF EXISTS `filial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filial` (
  `idfilial` int(11) NOT NULL AUTO_INCREMENT,
  `localidad` varchar(60) NOT NULL,
  `horario_apertura` time DEFAULT NULL,
  `horario_cierre` time DEFAULT NULL,
  `diames_mantenimiento` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idfilial`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filial`
--

LOCK TABLES `filial` WRITE;
/*!40000 ALTER TABLE `filial` DISABLE KEYS */;
INSERT INTO `filial` VALUES (1,'Lanus','11:00:00','23:00:00',15),(2,'Banfield','13:00:00','23:00:00',28),(3,'Lomas de Zamora','11:00:00','22:00:00',20),(4,'Adrogue','09:00:00','21:00:00',20);
/*!40000 ALTER TABLE `filial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socio`
--

DROP TABLE IF EXISTS `socio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `socio` (
  `idsocio` int(11) NOT NULL AUTO_INCREMENT,
  `num_afiliado` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsocio`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  UNIQUE KEY `num_afiliado_UNIQUE` (`num_afiliado`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socio`
--

LOCK TABLES `socio` WRITE;
/*!40000 ALTER TABLE `socio` DISABLE KEYS */;
INSERT INTO `socio` VALUES (1,1,'afiloso','123456','Andres','Filoso','Falsa 123','1145443356','andresfilosok@gmail.com'),(2,2,'jfederico','1234567','Juan','Federico','Cervantes 124','1157191956','juanpfederico@gmail.com');
/*!40000 ALTER TABLE `socio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turno`
--

DROP TABLE IF EXISTS `turno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turno` (
  `idturno` int(11) NOT NULL AUTO_INCREMENT,
  `idfilial` int(11) NOT NULL,
  `idcancha` int(11) NOT NULL,
  `idsocio` int(11) NOT NULL,
  `fechahora` datetime NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idturno`,`idfilial`,`idcancha`),
  KEY `fk_turno_socio_idx` (`idsocio`),
  KEY `fk_turno_cancha1_idx` (`idcancha`,`idfilial`),
  CONSTRAINT `fk_turno_cancha1` FOREIGN KEY (`idcancha`, `idfilial`) REFERENCES `cancha` (`idcancha`, `idfilial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno_socio` FOREIGN KEY (`idsocio`) REFERENCES `socio` (`idsocio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turno`
--

LOCK TABLES `turno` WRITE;
/*!40000 ALTER TABLE `turno` DISABLE KEYS */;
INSERT INTO `turno` VALUES (1,4,13,2,'2018-09-13 15:56:04','Reservada'),(3,4,13,2,'2018-09-13 16:07:44','reservada');
/*!40000 ALTER TABLE `turno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_canchas_detalle`
--

DROP TABLE IF EXISTS `v_canchas_detalle`;
/*!50001 DROP VIEW IF EXISTS `v_canchas_detalle`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_canchas_detalle` (
  `idfilial` tinyint NOT NULL,
  `localidad` tinyint NOT NULL,
  `num_cancha` tinyint NOT NULL,
  `deporte` tinyint NOT NULL,
  `categoria` tinyint NOT NULL,
  `horario_apertura` tinyint NOT NULL,
  `horario_cierre` tinyint NOT NULL,
  `diames_mantenimiento` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'bdsistemaclub'
--

--
-- Dumping routines for database 'bdsistemaclub'
--
/*!50003 DROP PROCEDURE IF EXISTS `REGISTRAR_SOCIO` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `REGISTRAR_SOCIO`(
	IN s_user VARCHAR(25),
	IN s_pass VARCHAR(20),
    IN s_nombre VARCHAR(45),
    IN s_apellido VARCHAR(50),
    IN s_direccion VARCHAR(70),
    IN s_telefono VARCHAR(15),
    IN s_email VARCHAR(45),
    OUT respuesta INT
)
    COMMENT 'Da de alta un socio con un numero de afiliado único'
BEGIN
	-- Declaraciones
	DECLARE error_registro CONDITION FOR SQLSTATE '22012';
	DECLARE s_numafiliado INT DEFAULT 0; -- NUM_AFILIADO QUE SE OTORGA AL NUEVO USUARIO
    SET respuesta = 0;
    -- Validaciones
    SELECT IFNULL(MAX(num_afiliado)+1, 1) INTO s_numafiliado from socio;
    IF(s_numafiliado>=1) THEN
		INSERT INTO socio (num_afiliado, user, pass, nombre, apellido, direccion, telefono, email)
		VALUES (s_numafiliado, s_user, s_pass, s_nombre, s_apellido, s_direccion, s_telefono, s_email);
        SET respuesta = ROW_COUNT(); -- EN ESTE CASO SE ESPERA 1 COMO RESPUESTA EXITOSA
	ELSE
		SIGNAL SQLSTATE '45000'
		SET MESSAGE_TEXT = 'Error al dar de alta el socio';
	END IF;
    
COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RESERVAR_CANCHA` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RESERVAR_CANCHA`(
	IN r_localidad VARCHAR(60),
	IN r_numcancha INT,
    IN r_deporte VARCHAR(45),
    IN r_numafiliado INT,
    IN r_fechahora DATETIME,
    OUT respuesta INT
)
    COMMENT 'Da de alta un turno en una filial y cancha determinada'
BEGIN
	-- Declaraciones
	DECLARE error_reserva CONDITION FOR SQLSTATE '22013';
    DECLARE r_idfilial INT DEFAULT 0;
    DECLARE r_idcancha INT DEFAULT 0;
    DECLARE r_idsocio INT DEFAULT 0;
    DECLARE fechahora_valida BOOLEAN DEFAULT 0; -- Si no se está sobre el día de mantenimiento la cancha está abierta a esa hora
    DECLARE turno_existente BOOLEAN DEFAULT 0; -- Para saber que no exista un turno activo en esa cancha a esa hora
    -- Validaciones
    SELECT IFNULL(SUM(f.idfilial), 0) INTO r_idfilial FROM filial f WHERE f.localidad=r_localidad;
    SELECT IFNULL(SUM(c.idcancha), 0) INTO r_idcancha FROM cancha c WHERE c.idfilial=r_idfilial AND c.num_cancha=r_numcancha AND c.deporte=r_deporte;
    SELECT IFNULL(SUM(s.idsocio), 0) INTO r_idsocio FROM socio s WHERE s.num_afiliado=r_numafiliado;
    
    IF(r_idfilial>0 AND r_idcancha>0 AND r_idsocio>0) THEN
		SELECT IFNULL(SUM(1), 0) INTO fechahora_valida-- Si encuentra cancha retorna 1, sino 0 
		FROM V_CANCHAS_DETALLE
		WHERE idfilial=r_idfilial AND num_cancha=r_numcancha AND deporte=r_deporte
		AND (TIME(r_fechahora) between horario_apertura AND horario_cierre)
        AND (DAY(r_fechahora) != diames_mantenimiento);
        IF(fechahora_valida) THEN
			SELECT IFNULL(SUM(1), 0) INTO turno_existente FROM turno WHERE idcancha=r_idcancha AND fechahora=r_fechahora;
            IF(!turno_existente) THEN -- Se puede reservar la cancha correctamente
				INSERT INTO turno (idfilial, idcancha, idsocio, fechahora, estado)
				VALUES (r_idfilial, r_idcancha, r_idsocio, r_fechahora, 'reservada');
				SET respuesta = ROW_COUNT();
			ELSE
            SIGNAL SQLSTATE '22014'
			SET MESSAGE_TEXT = 'Error al reservar la cancha: ya existe una reserva activa';
            END IF;
		END IF;
	ELSE
		SIGNAL SQLSTATE '22013'
		SET MESSAGE_TEXT = 'Error al reservar la cancha: datos invalidos';
	END IF;
    
COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `v_canchas_detalle`
--

/*!50001 DROP TABLE IF EXISTS `v_canchas_detalle`*/;
/*!50001 DROP VIEW IF EXISTS `v_canchas_detalle`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_canchas_detalle` AS select `f`.`idfilial` AS `idfilial`,`f`.`localidad` AS `localidad`,`c`.`num_cancha` AS `num_cancha`,`c`.`deporte` AS `deporte`,`c`.`categoria` AS `categoria`,`f`.`horario_apertura` AS `horario_apertura`,`f`.`horario_cierre` AS `horario_cierre`,`f`.`diames_mantenimiento` AS `diames_mantenimiento` from (`cancha` `c` join `filial` `f` on((`c`.`idfilial` = `f`.`idfilial`))) order by `f`.`idfilial`,`c`.`deporte`,`c`.`num_cancha` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-14 23:53:07
