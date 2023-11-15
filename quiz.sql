-- phpMyAdmin SQL Dump
--
-- Serverversion: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP-version: 8.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

CREATE TABLE `qresults` (
  `id` int(10) NOT NULL,
  `quiz` int(10) NOT NULL,
  `person` varchar(200) NOT NULL,
  `result` varchar(200) NOT NULL,
  `latest` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `qsrc` (
  `id` int(10) NOT NULL,
  `quiz` int(10) NOT NULL,
  `img` varchar(200) NOT NULL,
  `answerTxt` varchar(200) NOT NULL,
  `answerID` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Example Data dump for tabellen `qsrc`

INSERT INTO `qsrc` (`id`, `quiz`, `img`, `answerTxt`, `answerID`) VALUES
(1, 1, 'example1.jpg', 'example name 1', '1'),
(2, 1, 'example2.png', 'example name 2', '2'),

ALTER TABLE `qresults`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `qsrc`
  ADD UNIQUE KEY `idxid` (`id`);

ALTER TABLE `qresults`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
