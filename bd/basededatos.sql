/*
SQLyog Ultimate v8.3 
MySQL - 5.5.16 : Database - cfdata
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cfdata` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `cfdata`;

/*Table structure for table `aimagen` */

DROP TABLE IF EXISTS `aimagen`;

CREATE TABLE `aimagen` (
  `idaimagen` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(125) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `path` varchar(125) NOT NULL,
  `size` bigint(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `imgWidth` int(5) NOT NULL,
  `imgHeight` int(5) NOT NULL,
  `nom_thumb` varchar(125) NOT NULL,
  `thumb_path` varchar(125) NOT NULL,
  `thumbWith` int(5) NOT NULL,
  `thumbHeight` int(5) NOT NULL,
  `fecha` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idaimagen`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `aimagen` */

insert  into `aimagen`(`idaimagen`,`nombre`,`directory`,`path`,`size`,`type`,`imgWidth`,`imgHeight`,`nom_thumb`,`thumb_path`,`thumbWith`,`thumbHeight`,`fecha`) values (1,'fairy-tail-105.jpg','images','/cparty/images/',53086,'image/jpeg',610,458,'3_1346713786_282.jpg','imgthumb',108,90,1346713786);

/*Table structure for table `apostimg` */

DROP TABLE IF EXISTS `apostimg`;

CREATE TABLE `apostimg` (
  `idaimagen` bigint(20) NOT NULL DEFAULT '0',
  `idapost` bigint(20) NOT NULL,
  PRIMARY KEY (`idaimagen`,`idapost`),
  KEY `FK_apostimgm` (`idapost`),
  CONSTRAINT `FK_apostimg` FOREIGN KEY (`idaimagen`) REFERENCES `aimagen` (`idaimagen`),
  CONSTRAINT `FK_apostimgm` FOREIGN KEY (`idapost`) REFERENCES `cfapost` (`idapost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `apostimg` */

/*Table structure for table `cfacoment` */

DROP TABLE IF EXISTS `cfacoment`;

CREATE TABLE `cfacoment` (
  `idacoment` bigint(20) NOT NULL AUTO_INCREMENT,
  `idapost` bigint(20) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idacoment`),
  KEY `FK_cfacoment` (`idapost`),
  CONSTRAINT `FK_cfacoment` FOREIGN KEY (`idapost`) REFERENCES `cfapost` (`idapost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfacoment` */

/*Table structure for table `cfactividad` */

DROP TABLE IF EXISTS `cfactividad`;

CREATE TABLE `cfactividad` (
  `idactividad` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` bigint(20) NOT NULL,
  `idestado` bigint(20) DEFAULT NULL,
  `idnota` bigint(20) DEFAULT NULL,
  `idalbum` bigint(20) DEFAULT NULL,
  `idcomentario` bigint(20) DEFAULT NULL,
  `idamigo` bigint(20) DEFAULT NULL,
  `idamistad` bigint(20) DEFAULT NULL,
  `aceptado` char(1) DEFAULT '0',
  `tipo` varchar(20) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  `mostrado` char(1) DEFAULT '0',
  PRIMARY KEY (`idactividad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cfactividad` */

insert  into `cfactividad`(`idactividad`,`iduser`,`idestado`,`idnota`,`idalbum`,`idcomentario`,`idamigo`,`idamistad`,`aceptado`,`tipo`,`fecha`,`mostrado`) values (1,3,NULL,NULL,NULL,NULL,NULL,1,'0','amistad',1346713760,'0');

/*Table structure for table `cfactualizodato` */

DROP TABLE IF EXISTS `cfactualizodato`;

CREATE TABLE `cfactualizodato` (
  `idupdatedata` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `login` char(1) DEFAULT NULL,
  `clave` char(1) DEFAULT NULL,
  `email` char(1) DEFAULT NULL,
  `claveantigua` varchar(128) DEFAULT NULL,
  `saltantigua` varchar(128) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idupdatedata`),
  KEY `FK_cfactualizodato` (`id_user`),
  CONSTRAINT `FK_cfactualizodato` FOREIGN KEY (`id_user`) REFERENCES `cfusuario` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfactualizodato` */

/*Table structure for table `cfaimgcoment` */

DROP TABLE IF EXISTS `cfaimgcoment`;

CREATE TABLE `cfaimgcoment` (
  `idimgcoment` bigint(20) NOT NULL AUTO_INCREMENT,
  `idaimagen` bigint(20) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`idimgcoment`),
  KEY `FK_cfaimgcoment` (`idaimagen`),
  CONSTRAINT `FK_cfaimgcoment` FOREIGN KEY (`idaimagen`) REFERENCES `aimagen` (`idaimagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfaimgcoment` */

/*Table structure for table `cfamistad` */

DROP TABLE IF EXISTS `cfamistad`;

CREATE TABLE `cfamistad` (
  `idamistad` int(11) NOT NULL AUTO_INCREMENT,
  `id_User` int(11) NOT NULL,
  `idamigo` int(11) DEFAULT NULL,
  `confirmado` char(1) DEFAULT '0',
  `blokeado` char(1) DEFAULT '0',
  `solicitante` char(1) DEFAULT '0',
  `rechazado` char(1) DEFAULT '0',
  `eliminado` char(1) DEFAULT '0',
  `estado` varchar(125) DEFAULT '-----',
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idamistad`),
  KEY `FK_cfamistad` (`id_User`),
  KEY `FK_cfamigo` (`idamigo`),
  CONSTRAINT `FK_cfamigo` FOREIGN KEY (`idamigo`) REFERENCES `cfusuario` (`iduser`),
  CONSTRAINT `FK_cfamistad` FOREIGN KEY (`id_User`) REFERENCES `cfusuario` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cfamistad` */

insert  into `cfamistad`(`idamistad`,`id_User`,`idamigo`,`confirmado`,`blokeado`,`solicitante`,`rechazado`,`eliminado`,`estado`,`fecha`) values (1,3,1,'0','0','1','0','0','-----',1346713760);

/*Table structure for table `cfapost` */

DROP TABLE IF EXISTS `cfapost`;

CREATE TABLE `cfapost` (
  `idapost` bigint(20) NOT NULL AUTO_INCREMENT,
  `anombre` varchar(50) DEFAULT 'anonimo',
  `email` varchar(125) DEFAULT NULL,
  `titulo` varchar(125) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idapost`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cfapost` */

insert  into `cfapost`(`idapost`,`anombre`,`email`,`titulo`,`contenido`,`fecha`) values (1,'anonimo','','pruab 1','<p>sadfasdfasdf</p>',1346713612);

/*Table structure for table `cfccomentario` */

DROP TABLE IF EXISTS `cfccomentario`;

CREATE TABLE `cfccomentario` (
  `idCcomentario` int(11) DEFAULT NULL,
  `id_Comentarios` int(11) DEFAULT NULL,
  KEY `FK_cfCcomentario` (`idCcomentario`),
  KEY `FK_cfCcomentario2` (`id_Comentarios`),
  CONSTRAINT `FK_cfCcomentario` FOREIGN KEY (`idCcomentario`) REFERENCES `cfcomentario` (`idcomentario`),
  CONSTRAINT `FK_cfCcomentario2` FOREIGN KEY (`id_Comentarios`) REFERENCES `cfcomentario` (`idcomentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfccomentario` */

/*Table structure for table `cfcomentario` */

DROP TABLE IF EXISTS `cfcomentario`;

CREATE TABLE `cfcomentario` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idcmendia` int(11) DEFAULT NULL,
  `idnota` bigint(20) DEFAULT NULL,
  `idprivcm` int(11) DEFAULT NULL,
  `contenido` text,
  `fecha` int(11) DEFAULT NULL,
  `tipo` char(15) DEFAULT NULL,
  PRIMARY KEY (`idcomentario`),
  KEY `FK_usercoment` (`idUser`),
  KEY `FK_cfcomentario` (`idcmendia`),
  KEY `FK_cfcompv` (`idprivcm`),
  CONSTRAINT `FK_cfcomentario` FOREIGN KEY (`idcmendia`) REFERENCES `cfmedia` (`idmedia`),
  CONSTRAINT `FK_cfcompv` FOREIGN KEY (`idprivcm`) REFERENCES `cfprivcm` (`idprivacidadcm`),
  CONSTRAINT `FK_usercoment` FOREIGN KEY (`idUser`) REFERENCES `cfusuario` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfcomentario` */

/*Table structure for table `cfestado` */

DROP TABLE IF EXISTS `cfestado`;

CREATE TABLE `cfestado` (
  `idestado` int(11) NOT NULL AUTO_INCREMENT,
  `id_ecomentario` int(11) NOT NULL,
  `enlace` varchar(125) DEFAULT NULL,
  PRIMARY KEY (`idestado`),
  KEY `FK_cfestado` (`id_ecomentario`),
  CONSTRAINT `FK_cfestado` FOREIGN KEY (`id_ecomentario`) REFERENCES `cfcomentario` (`idcomentario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfestado` */

/*Table structure for table `cfimagen` */

DROP TABLE IF EXISTS `cfimagen`;

CREATE TABLE `cfimagen` (
  `idimagen` int(11) NOT NULL AUTO_INCREMENT,
  `id_media` int(11) NOT NULL,
  `imgWidth` int(5) DEFAULT NULL,
  `imgHeight` int(5) DEFAULT NULL,
  `nom_thumb` varchar(200) DEFAULT NULL,
  `thumb_path` varchar(125) DEFAULT NULL,
  `thumbWidth` int(5) DEFAULT NULL,
  `thumbHeight` int(5) DEFAULT NULL,
  `en_perfil` char(1) DEFAULT '0',
  PRIMARY KEY (`idimagen`),
  KEY `FK_cfimagen` (`id_media`),
  CONSTRAINT `FK_cfimagen` FOREIGN KEY (`id_media`) REFERENCES `cfmedia` (`idmedia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cfimagen` */

insert  into `cfimagen`(`idimagen`,`id_media`,`imgWidth`,`imgHeight`,`nom_thumb`,`thumb_path`,`thumbWidth`,`thumbHeight`,`en_perfil`) values (1,1,1280,720,'3_1346713734_0303.jpg','uthumb',224,264,'1');

/*Table structure for table `cfmedia` */

DROP TABLE IF EXISTS `cfmedia`;

CREATE TABLE `cfmedia` (
  `idmedia` int(11) NOT NULL AUTO_INCREMENT,
  `id_mCategoria` int(11) DEFAULT NULL,
  `idPrivcm` int(11) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `directorio` varchar(50) DEFAULT NULL,
  `ruta` varchar(125) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `fecha` double DEFAULT NULL,
  PRIMARY KEY (`idmedia`),
  KEY `FK_cfmedia` (`id_mCategoria`),
  KEY `FK_cfprivaci` (`idPrivcm`),
  CONSTRAINT `FK_cfmedia` FOREIGN KEY (`id_mCategoria`) REFERENCES `cfmediacategoria` (`idmcategoria`),
  CONSTRAINT `FK_cfprivaci` FOREIGN KEY (`idPrivcm`) REFERENCES `cfprivcm` (`idprivacidadcm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `cfmedia` */

insert  into `cfmedia`(`idmedia`,`id_mCategoria`,`idPrivcm`,`nombre`,`directorio`,`ruta`,`size`,`fecha`) values (1,3,1,'ep_299083_3.jpg','uphoto','C:/xampp/htdocs/cparty/uphoto',498874,1346713734.5238);

/*Table structure for table `cfmediacategoria` */

DROP TABLE IF EXISTS `cfmediacategoria`;

CREATE TABLE `cfmediacategoria` (
  `idmcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `portada` int(11) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  `tipo` char(3) DEFAULT NULL COMMENT 'tipo: 1=album perfil',
  PRIMARY KEY (`idmcategoria`),
  KEY `FK_cfmediaCategoria` (`id_perfil`),
  CONSTRAINT `FK_cfmediaCategoria` FOREIGN KEY (`id_perfil`) REFERENCES `cfperfil` (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cfmediacategoria` */

insert  into `cfmediacategoria`(`idmcategoria`,`id_perfil`,`nombre`,`portada`,`fecha`,`tipo`) values (1,1,'Imagenes perfil',NULL,1340739510,'1'),(2,2,'Imagenes perfil',NULL,1346706054,'1'),(3,3,'Imagenes perfil',1,1346713712,'1');

/*Table structure for table `cfnotas` */

DROP TABLE IF EXISTS `cfnotas`;

CREATE TABLE `cfnotas` (
  `idnotas` bigint(20) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `titulo` varchar(120) NOT NULL,
  `contenido` text NOT NULL,
  `etiquetas` varchar(250) NOT NULL,
  `publicado` char(2) DEFAULT NULL,
  `archivado` char(2) DEFAULT NULL,
  `publico` char(1) NOT NULL,
  `fechamodificado` int(11) DEFAULT NULL,
  `fechacreado` int(11) DEFAULT NULL,
  `estado` char(3) DEFAULT NULL,
  PRIMARY KEY (`idnotas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfnotas` */

/*Table structure for table `cfnotasarchivadas` */

DROP TABLE IF EXISTS `cfnotasarchivadas`;

CREATE TABLE `cfnotasarchivadas` (
  `idarchivados` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_notas` bigint(20) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idarchivados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfnotasarchivadas` */

/*Table structure for table `cfnotaspendientes` */

DROP TABLE IF EXISTS `cfnotaspendientes`;

CREATE TABLE `cfnotaspendientes` (
  `idpendientes` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_notas` bigint(20) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpendientes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfnotaspendientes` */

/*Table structure for table `cfnotaspublicadas` */

DROP TABLE IF EXISTS `cfnotaspublicadas`;

CREATE TABLE `cfnotaspublicadas` (
  `idpublicados` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_notas` bigint(20) DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpublicados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfnotaspublicadas` */

/*Table structure for table `cfperfil` */

DROP TABLE IF EXISTS `cfperfil`;

CREATE TABLE `cfperfil` (
  `idPerfil` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `foto` int(11) DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` char(1) NOT NULL,
  `descripcion` text,
  `nextel` char(15) DEFAULT NULL,
  `movil` char(15) DEFAULT NULL,
  `fijo` char(15) DEFAULT NULL,
  `estado_senti` char(1) DEFAULT NULL,
  `paso_uno` char(1) DEFAULT '0',
  `paso_dos` char(1) DEFAULT '0',
  `paso_tres` char(1) DEFAULT '0',
  PRIMARY KEY (`idPerfil`),
  CONSTRAINT `FK_cfperfil` FOREIGN KEY (`idPerfil`) REFERENCES `cfusuario` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfperfil` */

insert  into `cfperfil`(`idPerfil`,`nombre`,`apellidos`,`foto`,`edad`,`fecha_nac`,`sexo`,`descripcion`,`nextel`,`movil`,`fijo`,`estado_senti`,`paso_uno`,`paso_dos`,`paso_tres`) values (1,'fer','prz',NULL,NULL,'1985-08-17','H',NULL,NULL,NULL,NULL,NULL,'0','0','0'),(2,'demo','admin',NULL,21,'1991-04-16','H','','','','','','0','0','1'),(3,'demo','admin',1,22,'1990-07-15','H','','','','','','0','1','1');

/*Table structure for table `cfpresentacion` */

DROP TABLE IF EXISTS `cfpresentacion`;

CREATE TABLE `cfpresentacion` (
  `idpresentacion` int(11) NOT NULL AUTO_INCREMENT,
  `id_eluser` int(11) DEFAULT NULL,
  `idImg` int(11) DEFAULT NULL,
  `mensaje` varchar(500) DEFAULT NULL,
  `contenido` text,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpresentacion`),
  KEY `FK_cfpresentacion` (`id_eluser`),
  KEY `FK_cfpresentimg` (`idImg`),
  CONSTRAINT `FK_cfpresentacion` FOREIGN KEY (`id_eluser`) REFERENCES `cfusuario` (`iduser`),
  CONSTRAINT `FK_cfpresentimg` FOREIGN KEY (`idImg`) REFERENCES `cfmedia` (`idmedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfpresentacion` */

/*Table structure for table `cfprivacidad` */

DROP TABLE IF EXISTS `cfprivacidad`;

CREATE TABLE `cfprivacidad` (
  `idprivacidad` int(11) NOT NULL,
  `id_amistad` int(11) DEFAULT NULL,
  `id_privcm` int(11) DEFAULT NULL,
  PRIMARY KEY (`idprivacidad`),
  KEY `FK_cfprivacidad` (`id_amistad`),
  KEY `FK_cfprivpriv` (`id_privcm`),
  CONSTRAINT `FK_cfprivacidad` FOREIGN KEY (`id_amistad`) REFERENCES `cfamistad` (`idamistad`),
  CONSTRAINT `FK_cfprivpriv` FOREIGN KEY (`id_privcm`) REFERENCES `cfprivcm` (`idprivacidadcm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfprivacidad` */

/*Table structure for table `cfprivcm` */

DROP TABLE IF EXISTS `cfprivcm`;

CREATE TABLE `cfprivcm` (
  `idprivacidadcm` int(11) NOT NULL AUTO_INCREMENT,
  `ver` char(1) DEFAULT NULL,
  `comentar` char(1) DEFAULT NULL,
  PRIMARY KEY (`idprivacidadcm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='esta tabla debe tener un registro con index 1';

/*Data for the table `cfprivcm` */

insert  into `cfprivcm`(`idprivacidadcm`,`ver`,`comentar`) values (1,'1','1');

/*Table structure for table `cfseguridad` */

DROP TABLE IF EXISTS `cfseguridad`;

CREATE TABLE `cfseguridad` (
  `idseguridad` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` bigint(20) DEFAULT NULL,
  `setlogin` char(1) DEFAULT '0',
  `setemail` char(1) DEFAULT '1',
  `setnombre` char(1) DEFAULT '1',
  `setedad` char(1) DEFAULT '1',
  `setdescripcion` char(1) DEFAULT '1',
  `setnextel` char(1) DEFAULT '1',
  `setmovil` char(1) DEFAULT '1',
  `setfijo` char(1) DEFAULT '1',
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`idseguridad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cfseguridad` */

insert  into `cfseguridad`(`idseguridad`,`iduser`,`setlogin`,`setemail`,`setnombre`,`setedad`,`setdescripcion`,`setnextel`,`setmovil`,`setfijo`,`fecha`) values (1,1,'0','1','1','1','1','1','1','1',1340739510),(2,2,'0','1','1','1','1','1','1','1',1346706053),(3,3,'0','1','1','1','1','1','1','1',1346713712);

/*Table structure for table `cfsetuppfl` */

DROP TABLE IF EXISTS `cfsetuppfl`;

CREATE TABLE `cfsetuppfl` (
  `idsetuppfl` int(11) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `fondo` varchar(225) DEFAULT NULL,
  `clr_text` varchar(50) DEFAULT NULL,
  KEY `FK_cfsetuppfl` (`idperfil`),
  CONSTRAINT `FK_cfsetuppfl` FOREIGN KEY (`idperfil`) REFERENCES `cfperfil` (`idPerfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfsetuppfl` */

/*Table structure for table `cfshout` */

DROP TABLE IF EXISTS `cfshout`;

CREATE TABLE `cfshout` (
  `idshout` int(11) NOT NULL AUTO_INCREMENT,
  `enlace` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idshout`),
  CONSTRAINT `FK_cfshout` FOREIGN KEY (`idshout`) REFERENCES `cfestado` (`idestado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cfshout` */

/*Table structure for table `cfubitacora` */

DROP TABLE IF EXISTS `cfubitacora`;

CREATE TABLE `cfubitacora` (
  `idBitacora` bigint(20) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `browser` char(50) DEFAULT NULL,
  `sistema` char(50) DEFAULT NULL,
  `ip` char(15) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`idBitacora`),
  KEY `FK_cfubitacora` (`iduser`),
  CONSTRAINT `FK_cfubitacora` FOREIGN KEY (`iduser`) REFERENCES `cfusuario` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `cfubitacora` */

insert  into `cfubitacora`(`idBitacora`,`iduser`,`fecha`,`hora`,`browser`,`sistema`,`ip`,`last_login`) values (1,1,'2012-06-26','04:38:30','firefox 10.0','windows','127.0.0.1','0000-00-00 00:00:00'),(2,1,'2012-09-03','05:59:07','firefox 11.0','windows','::1','2012-06-26 04:38:30'),(3,2,'2012-09-03','06:00:53','firefox 11.0','windows','::1','0000-00-00 00:00:00'),(4,3,'2012-09-03','08:08:32','firefox 11.0','windows','::1','0000-00-00 00:00:00');

/*Table structure for table `cfusuario` */

DROP TABLE IF EXISTS `cfusuario`;

CREATE TABLE `cfusuario` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `identify` varchar(15) DEFAULT NULL,
  `login` varchar(200) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `salt` varchar(128) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `verificado` char(1) DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cfusuario` */

insert  into `cfusuario`(`iduser`,`identify`,`login`,`password`,`salt`,`email`,`verificado`) values (1,NULL,'ferd9','8d43f9795cbe89eb42085cfbdace3e66','9dref4fea0fb6174b3','elaprendiz@demo.com','0'),(2,NULL,'demo','d7e6bf2e917eca78c2d1a4cfaabdafca','omed50451a85a4389','demo@demo.com','0'),(3,NULL,'test3','11e226a2c2207eb77459a68e2d0643bc','3tset5045387017602','test@demo.com','0');

/*Table structure for table `pruebas` */

DROP TABLE IF EXISTS `pruebas`;

CREATE TABLE `pruebas` (
  `idpruebas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` int(11) DEFAULT NULL,
  `probadas` int(11) DEFAULT NULL,
  `testttt` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idpruebas`),
  KEY `FK_pruebas` (`probadas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pruebas` */

/*Table structure for table `tabla2` */

DROP TABLE IF EXISTS `tabla2`;

CREATE TABLE `tabla2` (
  `tabla2` int(11) NOT NULL AUTO_INCREMENT,
  `idpruebas` int(11) DEFAULT NULL,
  PRIMARY KEY (`tabla2`),
  KEY `FK_tabla2` (`idpruebas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tabla2` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
