-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-07-2013 a las 10:57:52
-- Versión del servidor: 5.5.31-0ubuntu0.13.04.1
-- Versión de PHP: 5.4.9-4ubuntu2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `biblioteca_virtual`
--
CREATE DATABASE IF NOT EXISTS `biblioteca_virtual` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biblioteca_virtual`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `idauthor` int(12) NOT NULL AUTO_INCREMENT,
  `author_name` char(120) DEFAULT NULL,
  `author_surname` char(120) DEFAULT NULL,
  `author_enabled` int(1) DEFAULT NULL,
  PRIMARY KEY (`idauthor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `author`
--

INSERT INTO `author` (`idauthor`, `author_name`, `author_surname`, `author_enabled`) VALUES
(2, 'Eddy Oscar', 'Lecca Ricra', 1),
(3, 'José', 'Arce Helberg', 1),
(4, 'Dante', 'González', 1),
(5, 'Juan', 'Perez Cordova', 1),
(6, 'Davis', 'Leon', 1),
(7, 'William', 'Cicerone Bernal', 1),
(8, 'Blas', 'Villegas', NULL),
(9, 'Carla', 'Acosta', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `idbook` int(12) NOT NULL AUTO_INCREMENT,
  `book_data` text,
  `book_enabled` int(1) DEFAULT NULL,
  PRIMARY KEY (`idbook`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`idbook`, `book_data`, `book_enabled`) VALUES
(31, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2010</year_pub>\n<title>sdf</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sdf</ISBN>\n<CallNumber>sdf</CallNumber>\n<publication>sdf</publication>\n<edition>sdf</edition>\n<subject>sdf</subject>\n<description_physical>sdf</description_physical>\n<summary>dsf</summary>\n</book>\n', 1),
(32, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2009</year_pub>\n<title>dsfdsf</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sdf</ISBN>\n<CallNumber>sdf</CallNumber>\n<publication>sdf</publication>\n<edition>sdf</edition>\n<subject>dsf</subject>\n<description_physical>sdf</description_physical>\n<summary>sdf</summary>\n</book>\n', 1),
(33, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2013</year_pub>\n<title>sdfdsf</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dsf</ISBN>\n<CallNumber>sd</CallNumber>\n<publication>sdf</publication>\n<edition>sdf</edition>\n<subject>sdf</subject>\n<description_physical>dsf</description_physical>\n<summary>dsf</summary>\n</book>\n', 1),
(34, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2011</year_pub>\n<title>sad</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sad</ISBN>\n<CallNumber>sad</CallNumber>\n<publication>sad</publication>\n<edition>asd</edition>\n<subject>sad</subject>\n<description_physical>asd</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(35, '<book><authorPRI><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorPRI>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2011</year_pub>\n<title>dfgdsssss</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>ffddddd</ISBN>\n<CallNumber>ssssdf</CallNumber>\n<publication>dsf</publication>\n<edition>dsf</edition>\n<subject>dsf</subject>\n<description_physical>dsf</description_physical>\n<summary>dfs</summary>\n</book>\n', 1),
(36, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2011</year_pub>\n<title>sds</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dsf</ISBN>\n<CallNumber>sdf</CallNumber>\n<publication>sdf</publication>\n<edition>dsf</edition>\n<subject>dsf</subject>\n<description_physical>sdf</description_physical>\n<summary>dsf</summary>\n</book>\n', 1),
(37, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2012</year_pub>\n<title>asds</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sad</ISBN>\n<CallNumber>asd</CallNumber>\n<publication>asd</publication>\n<edition>asd</edition>\n<subject>asd</subject>\n<description_physical>sad</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(38, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>4</idauthor0>\n<author_surname0>sdfsdf</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2012</year_pub>\n<title>assssssssss</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>saxxx</ISBN>\n<CallNumber>assssssss</CallNumber>\n<publication>saaaaax</publication>\n<edition>aaaaaaa</edition>\n<subject>aaaadssx</subject>\n<description_physical>aaaaaaaaaaaaadssss</description_physical>\n<summary>aasdxsa</summary>\n</book>\n', 1),
(47, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>4</month_pub>\n<year_pub>2010</year_pub>\n<title>sa</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>asss</ISBN>\n<CallNumber>as</CallNumber>\n<publication>ccccc</publication>\n<edition>asss</edition>\n<subject>as</subject>\n<description_physical>sa</description_physical>\n<summary>asss</summary>\n</book>\n', 1),
(48, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2011</year_pub>\n<title>dssssss</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dsf</ISBN>\n<CallNumber>sdf</CallNumber>\n<publication>sdff</publication>\n<edition>sdf</edition>\n<subject>sdf</subject>\n<description_physical>sdf</description_physical>\n<summary>sdf</summary>\n</book>\n', 1),
(49, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>4</idauthor0>\n<author_surname0>sdfsdf</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2012</year_pub>\n<title>ssssss</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dddddd</ISBN>\n<CallNumber>sdf</CallNumber>\n<publication>dsf</publication>\n<edition>sdf</edition>\n<subject>dsf</subject>\n<description_physical>sdf</description_physical>\n<summary>dsf</summary>\n</book>\n', 1),
(50, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2010</year_pub>\n<title>dfg</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dfg</ISBN>\n<CallNumber>dfg</CallNumber>\n<publication>fdg</publication>\n<edition>dfg</edition>\n<subject>dfg</subject>\n<description_physical>fdg</description_physical>\n<summary>dfg</summary>\n</book>\n', 1),
(51, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2011</year_pub>\n<title>sad</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sad</ISBN>\n<CallNumber>sad</CallNumber>\n<publication>ssss</publication>\n<edition>c</edition>\n<subject>v</subject>\n<description_physical>d</description_physical>\n<summary>v</summary>\n</book>\n', 1),
(52, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>4</idauthor0>\n<author_surname0>sdfsdf</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-11</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2012</year_pub>\n<title>sdfds</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>ghgh</ISBN>\n<CallNumber>gfhhhg</CallNumber>\n<publication>gfh</publication>\n<edition>fghg</edition>\n<subject>fgh</subject>\n<description_physical>fghgf</description_physical>\n<summary>fghhfg</summary>\n</book>\n', 1),
(53, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-12</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2012</year_pub>\n<title>xsdc</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dscc</ISBN>\n<CallNumber>sdc</CallNumber>\n<publication>sdc</publication>\n<edition>csd</edition>\n<subject>dsc</subject>\n<description_physical>sdc</description_physical>\n<summary>sdcc</summary>\n</book>\n', 1),
(54, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<file><file-controls>controls.png</file-controls>\n</file>\n<areaPRI></areaPRI>\n<date_ing>2013-07-12</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2012</year_pub>\n<title>sdsad</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sadsa</ISBN>\n<CallNumber>asd</CallNumber>\n<publication>asd</publication>\n<edition>asd</edition>\n<subject>asd</subject>\n<description_physical>asd</description_physical>\n<summary>sadsa</summary>\n</book>\n', 1),
(55, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<file>controls1.png</file>\n<areaPRI></areaPRI>\n<date_ing>2013-07-12</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2010</year_pub>\n<title>sadd</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sad</ISBN>\n<CallNumber>aaaaaaaad</CallNumber>\n<publication>asd</publication>\n<edition>asd</edition>\n<subject>asd</subject>\n<description_physical>asd</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(56, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>4</idauthor0>\n<author_surname0>sdfsdf</author_surname0>\n</authorSEC>\n<files><img-115857442>115857442.png</img-115857442>\n<img-border>border.png</img-border>\n</files>\n<areaPRI></areaPRI>\n<date_ing>2013-07-12</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2011</year_pub>\n<title>sdddddddddddd</title>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dsfsdf</ISBN>\n<CallNumber>sdfdsf</CallNumber>\n<publication>sdfdsf</publication>\n<edition>sdfsdf</edition>\n<subject>sdfsdf</subject>\n<description_physical>sdfdsf</description_physical>\n<summary>sdfsdf</summary>\n</book>\n', 1),
(57, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2009</year_pub>\n<title>Nuevo </title>\n<idfbook>3</idfbook>\n<formatbook>Nuevo Formato</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sdf</ISBN>\n<CallNumber>df</CallNumber>\n<publication>dsf</publication>\n<edition>sdf</edition>\n<subject>sdf</subject>\n<description_physical>dsf</description_physical>\n<summary>sd</summary>\n</book>\n', 1),
(58, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2011</year_pub>\n<title>dddddddddddd</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sdf</ISBN>\n<CallNumber>dsf</CallNumber>\n<publication>sdf</publication>\n<edition>dsf</edition>\n<subject>sdf</subject>\n<description_physical>sdf</description_physical>\n<summary>sdf</summary>\n</book>\n', 1),
(59, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>4</month_pub>\n<year_pub>2010</year_pub>\n<title>sda</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>asd</ISBN>\n<CallNumber>asd</CallNumber>\n<publication>sad</publication>\n<edition>sda</edition>\n<subject>sad</subject>\n<description_physical>sad</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(60, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2012</year_pub>\n<title>s</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sd</ISBN>\n<CallNumber>sd</CallNumber>\n<publication>sd</publication>\n<edition>sad</edition>\n<subject>sad</subject>\n<description_physical>sd</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(61, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<idauthor1>6</idauthor1>\n<author_first_name0>Juan</author_first_name0>\n<author_first_name1>Pepe</author_first_name1>\n<author_surname0>Perez</author_surname0>\n<author_surname1>Leon</author_surname1>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2012</year_pub>\n<title>aaaaa</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>az</ISBN>\n<CallNumber>a</CallNumber>\n<publication>a</publication>\n<edition>a</edition>\n<subject>a</subject>\n<description_physical>a</description_physical>\n<summary>a</summary>\n</book>\n', 1),
(62, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing></date_ing>\n<month_pub>1</month_pub>\n<year_pub>2009</year_pub>\n<title>sadsd</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>as</ISBN>\n<CallNumber>asd</CallNumber>\n<publication>sd</publication>\n<edition>sd</edition>\n<subject>sad</subject>\n<description_physical>sad</description_physical>\n<summary>sad</summary>\n</book>\n', 1),
(63, '<book><authorPRI><idauthor0>3</idauthor0>\r\n<author_surname0>apellido demo</author_surname0>\r\n</authorPRI>\r\n<authorSEC><idauthor0>2</idauthor0>\r\n<author_first_name0>Eddy Oscar</author_first_name0>\r\n<author_surname0>Lecca Ricra</author_surname0>\r\n</authorSEC>\r\n<areaPRI></areaPRI>\r\n<date_ing></date_ing>\r\n<month_pub>2</month_pub>\r\n<year_pub>2007</year_pub>\r\n<title>ssssssssssddddddddddddddddd</title>\r\n<idfbook>1</idfbook>\r\n<formatbook>Libros</formatbook>\r\n<idtipoPonencia></idtipoPonencia>\r\n<ISBN>sdf</ISBN>\r\n<CallNumber>dsf</CallNumber>\r\n<publication>sads</publication>\r\n<edition>dsf</edition>\r\n<subject>dsf</subject>\r\n<description_physical>sdf</description_physical>\r\n<summary>dsf</summary>\r\n</book>\r\n', 1),
(64, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>hhhhhhhhh</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>5</idauthor0>\n<author_first_name0>Juan</author_first_name0>\n<author_surname0>Perez</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-25</date_ing>\n<month_pub>3</month_pub>\n<year_pub>2010</year_pub>\n<title>dfgfd</title>\n<idfbook>2</idfbook>\n<formatbook>Mapas</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dfg</ISBN>\n<CallNumber>fdg</CallNumber>\n<publication>fdg</publication>\n<edition>fdg</edition>\n<subject>fdg</subject>\n<description_physical>fdg</description_physical>\n<summary>dfg</summary>\n</book>\n', 1),
(65, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>apellido demo</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Pepe</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-26</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2013</year_pub>\n<title>nuevo</title>\n<idfbook>3</idfbook>\n<formatbook>nuevo</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>543212</ISBN>\n<CallNumber>sds</CallNumber>\n<publication>sd</publication>\n<edition>sd</edition>\n<subject>sd</subject>\n<description_physical>sd</description_physical>\n<summary>sdsd</summary>\n</book>\n', 1),
(66, '<book><authorPRI><idauthor0>3</idauthor0>\n<author_surname0>Arce Helberg</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>4</idauthor0>\n<idauthor1>6</idauthor1>\n<author_first_name0>Dante</author_first_name0>\n<author_first_name1>Davis</author_first_name1>\n<author_surname0>González</author_surname0>\n<author_surname1>Leon</author_surname1>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-26</date_ing>\n<month_pub>2</month_pub>\n<year_pub>2011</year_pub>\n<title>ssssssss</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>sd</ISBN>\n<CallNumber>sd</CallNumber>\n<publication>sd</publication>\n<edition>sd</edition>\n<subject>sd</subject>\n<description_physical>sd</description_physical>\n<summary>sd</summary>\n</book>\n', 1),
(67, '<book><authorPRI><idauthor0>7</idauthor0>\n<author_surname0>Cicerone Bernal</author_surname0>\n</authorPRI>\n<authorSEC><idauthor0>6</idauthor0>\n<author_first_name0>Davis</author_first_name0>\n<author_surname0>Leon</author_surname0>\n</authorSEC>\n<areaPRI></areaPRI>\n<date_ing>2013-07-26</date_ing>\n<month_pub>1</month_pub>\n<year_pub>2012</year_pub>\n<title>sddddddd</title>\n<idfbook>1</idfbook>\n<formatbook>Libros</formatbook>\n<idtipoPonencia></idtipoPonencia>\n<ISBN>dsf</ISBN>\n<CallNumber>dsf</CallNumber>\n<publication>sdf</publication>\n<edition>d</edition>\n<subject>sdf</subject>\n<description_physical>f</description_physical>\n<summary>df</summary>\n</book>\n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `ideditorial` int(12) NOT NULL,
  `editorial_name` char(120) DEFAULT NULL,
  `editorial_enabled` int(1) DEFAULT NULL,
  PRIMARY KEY (`ideditorial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exemplary`
--

CREATE TABLE IF NOT EXISTS `exemplary` (
  `idexemplary` int(12) NOT NULL,
  `exemplary_number` int(6) DEFAULT NULL,
  `exemplary_status` int(1) DEFAULT NULL,
  `idbook` int(12) NOT NULL,
  PRIMARY KEY (`idexemplary`,`idbook`),
  KEY `fk_exemplary_book1` (`idbook`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languaje`
--

CREATE TABLE IF NOT EXISTS `languaje` (
  `idlanguaje` int(12) NOT NULL,
  `languaje_description` char(120) DEFAULT NULL,
  PRIMARY KEY (`idlanguaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `idloan` int(12) NOT NULL,
  `loan_date` datetime DEFAULT NULL,
  `loan_time` time DEFAULT NULL,
  `loan_theoretical` date DEFAULT NULL,
  `loan_real` date DEFAULT NULL,
  `loan_datereturn` date DEFAULT NULL,
  `loan_datemaxim` date DEFAULT NULL,
  `idusers` int(12) NOT NULL,
  `idexemplary` int(12) NOT NULL,
  PRIMARY KEY (`idloan`,`idusers`,`idexemplary`),
  KEY `fk_loan_users` (`idusers`),
  KEY `fk_loan_exemplary1` (`idexemplary`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `idtheme` int(12) NOT NULL,
  `theme_description` char(120) DEFAULT NULL,
  `theme_enabled` int(1) DEFAULT NULL,
  PRIMARY KEY (`idtheme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(12) NOT NULL AUTO_INCREMENT,
  `users_name` char(100) DEFAULT NULL,
  `users_password` char(100) DEFAULT NULL,
  `users_email` char(210) DEFAULT NULL,
  `users_dni` char(8) DEFAULT NULL,
  `users_telefono` char(21) DEFAULT NULL,
  `users_domicilio` char(210) DEFAULT NULL,
  `users_state` int(1) DEFAULT NULL,
  `users_type` int(1) NOT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idusers`, `users_name`, `users_password`, `users_email`, `users_dni`, `users_telefono`, `users_domicilio`, `users_state`, `users_type`) VALUES
(1, 'admin', '0752234ed7ebb2cb55ab48d3746fc300', 'eddy.lecca3@gmail.com', '44285882', '3271447', 'calle cucarda 399', 1, 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `exemplary`
--
ALTER TABLE `exemplary`
  ADD CONSTRAINT `fk_exemplary_book1` FOREIGN KEY (`idbook`) REFERENCES `book` (`idbook`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_loan_exemplary1` FOREIGN KEY (`idexemplary`) REFERENCES `exemplary` (`idexemplary`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_loan_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
