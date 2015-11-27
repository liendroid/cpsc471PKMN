-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: Pokemon
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `HAS`
--

DROP TABLE IF EXISTS `HAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HAS` (
  `pid` int(11) NOT NULL,
  `pokedex` int(11) NOT NULL,
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HAS`
--

LOCK TABLES `HAS` WRITE;
/*!40000 ALTER TABLE `HAS` DISABLE KEYS */;
INSERT INTO `HAS` VALUES (2,2,16),(2,7,17),(2,6,18),(1,19,351),(1,23,352),(1,24,353),(1,160,354),(1,2,355),(1,280,356);
/*!40000 ALTER TABLE `HAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `pid` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,'ali'),(2,'april'),(3,'paul');
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokemon` (
  `pokedex` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `atk` int(11) DEFAULT NULL,
  `def` int(11) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  PRIMARY KEY (`pokedex`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon`
--

LOCK TABLES `pokemon` WRITE;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` VALUES (1,'Bulbasaur',45,49,49,45),(2,'Ivysaur',60,62,63,60),(3,'Venusaur',80,82,83,80),(4,'Charmander',39,52,43,65),(5,'Charmeleon',58,64,58,80),(6,'Charizard',78,84,78,100),(7,'Squirtle',44,48,65,43),(8,'Wartortle',59,63,80,58),(9,'Blastoise',79,83,100,78),(10,'Caterpie',45,30,35,45),(11,'Metapod',50,20,55,30),(12,'Butterfree',60,45,50,70),(13,'Weedle',40,35,30,50),(14,'Kakuna',45,25,50,35),(15,'Beedrill',65,90,40,75),(16,'Pidgey',40,45,40,56),(17,'Pidgeotto',63,60,55,71),(18,'Pidgeot',83,80,75,101),(19,'Rattata',30,56,35,72),(20,'Raticate',55,81,60,97),(21,'Spearow',40,60,30,70),(22,'Fearow',65,90,65,100),(23,'Ekans',35,60,44,55),(24,'Arbok',60,85,69,80),(25,'Pikachu',35,55,40,90),(26,'Raichu',60,90,55,110),(27,'Sandshrew',50,75,85,40),(28,'Sandslash',75,100,110,65),(29,'Nidoran?',55,47,52,41),(30,'Nidorina',70,62,67,56),(31,'Nidoqueen',90,92,87,76),(32,'Nidoran?',46,57,40,50),(33,'Nidorino',61,72,57,65),(34,'Nidoking',81,102,77,85),(35,'Clefairy',70,45,48,35),(36,'Clefable',95,70,73,60),(37,'Vulpix',38,41,40,65),(38,'Ninetales',73,76,75,100),(39,'Jigglypuff',115,45,20,20),(40,'Wigglytuff',140,70,45,45),(41,'Zubat',40,45,35,55),(42,'Golbat',75,80,70,90),(43,'Oddish',45,50,55,30),(44,'Gloom',60,65,70,40),(45,'Vileplume',75,80,85,50),(46,'Paras',35,70,55,25),(47,'Parasect',60,95,80,30),(48,'Venonat',60,55,50,45),(49,'Venomoth',70,65,60,90),(50,'Diglett',10,55,25,95),(51,'Dugtrio',35,80,50,120),(52,'Meowth',40,45,35,90),(53,'Persian',65,70,60,115),(54,'Psyduck',50,52,48,55),(55,'Golduck',80,82,78,85),(56,'Mankey',40,80,35,70),(57,'Primeape',65,105,60,95),(58,'Growlithe',55,70,45,60),(59,'Arcanine',90,110,80,95),(60,'Poliwag',40,50,40,90),(61,'Poliwhirl',65,65,65,90),(62,'Poliwrath',90,95,95,70),(63,'Abra',25,20,15,90),(64,'Kadabra',40,35,30,105),(65,'Alakazam',55,50,45,120),(66,'Machop',70,80,50,35),(67,'Machoke',80,100,70,45),(68,'Machamp',90,130,80,55),(69,'Bellsprout',50,75,35,40),(70,'Weepinbell',65,90,50,55),(71,'Victreebel',80,105,65,70),(72,'Tentacool',40,40,35,70),(73,'Tentacruel',80,70,65,100),(74,'Geodude',40,80,100,20),(75,'Graveler',55,95,115,35),(76,'Golem',80,120,130,45),(77,'Ponyta',50,85,55,90),(78,'Rapidash',65,100,70,105),(79,'Slowpoke',90,65,65,15),(80,'Slowbro',95,75,110,30),(81,'Magnemite',25,35,70,45),(82,'Magneton',50,60,95,70),(83,'Farfetchd',52,65,55,60),(84,'Doduo',35,85,45,75),(85,'Dodrio',60,110,70,100),(86,'Seel',65,45,55,45),(87,'Dewgong',90,70,80,70),(88,'Grimer',80,80,50,25),(89,'Muk',105,105,75,50),(90,'Shellder',30,65,100,40),(91,'Cloyster',50,95,180,70),(92,'Gastly',30,35,30,80),(93,'Haunter',45,50,45,95),(94,'Gengar',60,65,60,110),(95,'Onix',35,45,160,70),(96,'Drowzee',60,48,45,42),(97,'Hypno',85,73,70,67),(98,'Krabby',30,105,90,50),(99,'Kingler',55,130,115,75),(100,'Voltorb',40,30,50,100),(101,'Electrode',60,50,70,140),(102,'Exeggcute',60,40,80,40),(103,'Exeggutor',95,95,85,55),(104,'Cubone',50,50,95,35),(105,'Marowak',60,80,110,45),(106,'Hitmonlee',50,120,53,87),(107,'Hitmonchan',50,105,79,76),(108,'Lickitung',90,55,75,30),(109,'Koffing',40,65,95,35),(110,'Weezing',65,90,120,60),(111,'Rhyhorn',80,85,95,25),(112,'Rhydon',105,130,120,40),(113,'Chansey',250,5,5,50),(114,'Tangela',65,55,115,60),(115,'Kangaskhan',105,95,80,90),(116,'Horsea',30,40,70,60),(117,'Seadra',55,65,95,85),(118,'Goldeen',45,67,60,63),(119,'Seaking',80,92,65,68),(120,'Staryu',30,45,55,85),(121,'Starmie',60,75,85,115),(122,'Mr.Mime',40,45,65,90),(123,'Scyther',70,110,80,105),(124,'Jynx',65,50,35,95),(125,'Electabuzz',65,83,57,105),(126,'Magmar',65,95,57,93),(127,'Pinsir',65,125,100,85),(128,'Tauros',75,100,95,110),(129,'Magikarp',20,10,55,80),(130,'Gyarados',95,125,79,81),(131,'Lapras',130,85,80,60),(132,'Ditto',48,48,48,48),(133,'Eevee',55,55,50,55),(134,'Vaporeon',130,65,60,65),(135,'Jolteon',65,65,60,130),(136,'Flareon',65,130,60,65),(137,'Porygon',65,60,70,40),(138,'Omanyte',35,40,100,35),(139,'Omastar',70,60,125,55),(140,'Kabuto',30,80,90,55),(141,'Kabutops',60,115,105,80),(142,'Aerodactyl',80,105,65,130),(143,'Snorlax',160,110,65,30),(144,'Articuno',90,85,100,85),(145,'Zapdos',90,90,85,100),(146,'Moltres',90,100,90,90),(147,'Dratini',41,64,45,50),(148,'Dragonair',61,84,65,70),(149,'Dragonite',91,134,95,80),(150,'Mewtwo',106,110,90,130),(151,'Mew',100,100,100,100),(152,'Chikorita',45,49,65,45),(153,'Bayleef',60,62,80,60),(154,'Meganium',80,82,100,80),(155,'Cyndaquil',39,52,43,65),(156,'Quilava',58,64,58,80),(157,'Typhlosion',78,84,78,100),(158,'Totodile',50,65,64,43),(159,'Croconaw',65,80,80,58),(160,'Feraligatr',85,105,100,78),(161,'Sentret',35,46,34,20),(162,'Furret',85,76,64,90),(163,'Hoothoot',60,30,30,50),(164,'Noctowl',100,50,50,70),(165,'Ledyba',40,20,30,55),(166,'Ledian',55,35,50,85),(167,'Spinarak',40,60,40,30),(168,'Ariados',70,90,70,40),(169,'Crobat',85,90,80,130),(170,'Chinchou',75,38,38,67),(171,'Lanturn',125,58,58,67),(172,'Pichu',20,40,15,60),(173,'Cleffa',50,25,28,15),(174,'Igglybuff',90,30,15,15),(175,'Togepi',35,20,65,20),(176,'Togetic',55,40,85,40),(177,'Natu',40,50,45,70),(178,'Xatu',65,75,70,95),(179,'Mareep',55,40,40,35),(180,'Flaaffy',70,55,55,45),(181,'Ampharos',90,75,85,55),(182,'Bellossom',75,80,95,50),(183,'Marill',70,20,50,40),(184,'Azumarill',100,50,80,50),(185,'Sudowoodo',70,100,115,30),(186,'Politoed',90,75,75,70),(187,'Hoppip',35,35,40,50),(188,'Skiploom',55,45,50,80),(189,'Jumpluff',75,55,70,110),(190,'Aipom',55,70,55,85),(191,'Sunkern',30,30,30,30),(192,'Sunflora',75,75,55,30),(193,'Yanma',65,65,45,95),(194,'Wooper',55,45,45,15),(195,'Quagsire',95,85,85,35),(196,'Espeon',65,65,60,110),(197,'Umbreon',95,65,110,65),(198,'Murkrow',60,85,42,91),(199,'Slowking',95,75,80,30),(200,'Misdreavus',60,60,60,85),(201,'Unown',48,72,48,48),(202,'Wobbuffet',190,33,58,33),(203,'Girafarig',70,80,65,85),(204,'Pineco',50,65,90,15),(205,'Forretress',75,90,140,40),(206,'Dunsparce',100,70,70,45),(207,'Gligar',65,75,105,85),(208,'Steelix',75,85,200,30),(209,'Snubbull',60,80,50,30),(210,'Granbull',90,120,75,45),(211,'Qwilfish',65,95,75,85),(212,'Scizor',70,130,100,65),(213,'Shuckle',20,10,230,5),(214,'Heracross',80,125,75,85),(215,'Sneasel',55,95,55,115),(216,'Teddiursa',60,80,50,40),(217,'Ursaring',90,130,75,55),(218,'Slugma',40,40,40,20),(219,'Magcargo',50,50,120,30),(220,'Swinub',50,50,40,50),(221,'Piloswine',100,100,80,50),(222,'Corsola',55,55,85,35),(223,'Remoraid',35,65,35,65),(224,'Octillery',75,105,75,45),(225,'Delibird',45,55,45,75),(226,'Mantine',65,40,70,70),(227,'Skarmory',65,80,140,70),(228,'Houndour',45,60,30,65),(229,'Houndoom',75,90,50,95),(230,'Kingdra',75,95,95,85),(231,'Phanpy',90,60,60,40),(232,'Donphan',90,120,120,50),(233,'Porygon2',85,80,90,60),(234,'Stantler',73,95,62,85),(235,'Smeargle',55,20,35,75),(236,'Tyrogue',35,35,35,35),(237,'Hitmontop',50,95,95,70),(238,'Smoochum',45,30,15,65),(239,'Elekid',45,63,37,95),(240,'Magby',45,75,37,83),(241,'Miltank',95,80,105,100),(242,'Blissey',255,10,10,55),(243,'Raikou',90,85,75,115),(244,'Entei',115,115,85,100),(245,'Suicune',100,75,115,85),(246,'Larvitar',50,64,50,41),(247,'Pupitar',70,84,70,51),(248,'Tyranitar',100,134,110,61),(249,'Lugia',106,90,130,110),(250,'Ho-oh',106,130,90,90),(251,'Celebi',100,100,100,100),(252,'Treecko',40,45,35,70),(253,'Grovyle',50,65,45,95),(254,'Sceptile',70,85,65,120),(255,'Torchic',45,60,40,45),(256,'Combusken',60,85,60,55),(257,'Blaziken',80,120,70,80),(258,'Mudkip',50,70,50,40),(259,'Marshtomp',70,85,70,50),(260,'Swampert',100,110,90,60),(261,'Poochyena',35,55,35,35),(262,'Mightyena',70,90,70,70),(263,'Zigzagoon',38,30,41,60),(264,'Linoone',78,70,61,100),(265,'Wurmple',45,45,35,20),(266,'Silcoon',50,35,55,15),(267,'Beautifly',60,70,50,65),(268,'Cascoon',50,35,55,15),(269,'Dustox',60,50,70,65),(270,'Lotad',40,30,30,30),(271,'Lombre',60,50,50,50),(272,'Ludicolo',80,70,70,70),(273,'Seedot',40,40,50,30),(274,'Nuzleaf',70,70,40,60),(275,'Shiftry',90,100,60,80),(276,'Taillow',40,55,30,85),(277,'Swellow',60,85,60,125),(278,'Wingull',40,30,30,85),(279,'Pelipper',60,50,100,65),(280,'Ralts',28,25,25,40),(281,'Kirlia',38,35,35,50),(282,'Gardevoir',68,65,65,80),(283,'Surskit',40,30,32,65),(284,'Masquerain',70,60,62,60),(285,'Shroomish',60,40,60,35),(286,'Breloom',60,130,80,70),(287,'Slakoth',60,60,60,30),(288,'Vigoroth',80,80,80,90),(289,'Slaking',150,160,100,100),(290,'Nincada',31,45,90,40),(291,'Ninjask',61,90,45,160),(292,'Shedinja',1,90,45,40),(293,'Whismur',64,51,23,28),(294,'Loudred',84,71,43,48),(295,'Exploud',104,91,63,68),(296,'Makuhita',72,60,30,25),(297,'Hariyama',144,120,60,50),(298,'Azurill',50,20,40,20);
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'Pokemon'
--

--
-- Dumping routines for database 'Pokemon'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-27 12:41:06
