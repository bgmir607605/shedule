-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 19 2016 г., 15:58
-- Версия сервера: 5.5.50-0+deb8u1
-- Версия PHP: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `backupBPT`
--

-- --------------------------------------------------------

--
-- Структура таблицы `discipline`
--

CREATE TABLE IF NOT EXISTS `discipline` (
`id` int(11) NOT NULL,
  `shortName` varchar(50) DEFAULT NULL,
  `fullName` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(10) DEFAULT NULL,
  `specialtyId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
`id` int(11) NOT NULL,
  `fName` varchar(20) DEFAULT NULL,
  `mName` varchar(20) DEFAULT NULL,
  `lName` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `discipline`
--
ALTER TABLE `discipline`
 ADD PRIMARY KEY (`id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `shedule`
--
ALTER TABLE `shedule`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `teacherLoad`
--
ALTER TABLE `teacherLoad`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
