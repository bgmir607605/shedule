-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 14 2016 г., 08:39
-- Версия сервера: 5.5.52-0+deb8u1
-- Версия PHP: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bpt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
`id` int(11) NOT NULL,
  `shortName` varchar(50) DEFAULT NULL,
  `fullName` varchar(150) DEFAULT NULL,
  `shared` tinyint(1) NOT NULL,
  `specialtyId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `discipline`
--

INSERT INTO `discipline` (`id`, `shortName`, `fullName`, `shared`, `specialtyId`) VALUES
(1, 'по специальности', 'Бред', 0, 1),
(2, 'Общий', 'Бред', 1, NULL),
(3, 'ОАиП', 'Основы алгоритмизации и программирования', 0, 1),
(4, 'ОСй', 'Операционные системы и среды', 0, 1),
(5, 'Для мех', 'Для мех', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `specialtyId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `specialtyId`) VALUES
(1, '1 - 2 ТП', 1),
(2, '3 - 4 ТП', 1),
(3, '5 - 6 ДП', 1),
(4, '1 - 2 АМ', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `shedule`
--

CREATE TABLE IF NOT EXISTS `shedule` (
`id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `number` int(1) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  `teacherLoadId` int(11) DEFAULT NULL,
  `h` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE IF NOT EXISTS `specialty` (
`id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specialty`
--

INSERT INTO `specialty` (`id`, `code`, `name`) VALUES
(1, '09.02.05', 'Прикладная информатика (по отраслям)'),
(2, 'dad', 'Механники');

-- --------------------------------------------------------

--
-- Структура таблицы `teacherLoad`
--

CREATE TABLE IF NOT EXISTS `teacherLoad` (
`id` int(11) NOT NULL,
  `teacherId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  `disciplineId` int(11) DEFAULT NULL,
  `hLoad` int(11) DEFAULT NULL,
  `hPrLoad` int(11) DEFAULT NULL,
  `hConsLoad` int(11) DEFAULT NULL,
  `doneHLoad` int(11) DEFAULT NULL,
  `doneHPrLoad` int(11) DEFAULT NULL,
  `doneHConsLoad` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teacherLoad`
--

INSERT INTO `teacherLoad` (`id`, `teacherId`, `groupId`, `disciplineId`, `hLoad`, `hPrLoad`, `hConsLoad`, `doneHLoad`, `doneHPrLoad`, `doneHConsLoad`) VALUES
(1, 2, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 4, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
`id` int(11) NOT NULL,
  `fName` varchar(20) DEFAULT NULL,
  `mName` varchar(20) DEFAULT NULL,
  `lName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `fName`, `mName`, `lName`) VALUES
(1, 'Андрей', 'Алексеевич', 'Миронов'),
(2, 'Алексей', 'Валерьевич', 'Колотилов'),
(3, 'Дмитрий', 'Владимирович', 'Люлин');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `discipline`
--
ALTER TABLE `discipline`
 ADD PRIMARY KEY (`id`), ADD KEY `specialtyId` (`specialtyId`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`), ADD KEY `groups_fk1` (`specialtyId`);

--
-- Индексы таблицы `shedule`
--
ALTER TABLE `shedule`
 ADD PRIMARY KEY (`id`), ADD KEY `shedule_fk1` (`teacherLoadId`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `teacherLoad`
--
ALTER TABLE `teacherLoad`
 ADD PRIMARY KEY (`id`), ADD KEY `teacherLoad_fk1` (`teacherId`), ADD KEY `teacherLoad_fk2` (`groupId`), ADD KEY `teacherLoad_fk3` (`disciplineId`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `discipline`
--
ALTER TABLE `discipline`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `shedule`
--
ALTER TABLE `shedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `teacherLoad`
--
ALTER TABLE `teacherLoad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
