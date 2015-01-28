-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2015 at 07:56 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vote_class_rep2`
--
CREATE DATABASE IF NOT EXISTS `vote_class_rep2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vote_class_rep2`;

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `applicant_names` text NOT NULL,
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_names`, `applicant_id`) VALUES
('Ioan Marius Alba', 1),
('Loredana Nicoleta Albu', 2),
('Simon Christensen', 3),
('Patrick-Stefan Cornestean', 4),
('Gabor Csapo', 5),
('Gabor Csomai', 6),
('Hourieh Nejati Danesh', 7),
('Mariya Tihomirova Dimitrova', 8),
('Jannik Grausen Fischer', 9),
('Lucian Laurentiu Gombos', 10),
('Filip Horvath', 11),
('Vicki Buhl Jørgensen', 12),
('Adomas Kocius', 13),
('Gabor Lukacs', 14),
('Louise Mørkeberg Løngaa', 15),
('Severin Messenbrink', 16),
('Ronnie Torsbjerg Møller', 17),
('Jana Osadtsaja', 18),
('Kasper Ottzen', 19),
('Anders Bach Ovesen', 20),
('Nikolaj Pedersen', 21),
('Virgar Poulsen', 22),
('Aleksander Saar', 23),
('Zachary Jay Sempers', 24),
('Alina Sibechi', 25),
('Kenneth Bovbjerg Thøgersen', 26),
('Patricia Zsofia Toth', 27),
('Valerio Zanibellato', 28);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `voter_ip` varchar(20) NOT NULL DEFAULT '',
  `applicant_id` int(11) NOT NULL,
  PRIMARY KEY (`voter_ip`),
  KEY `applicant_id` (`applicant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`voter_ip`, `applicant_id`) VALUES
('127.3.0.1', 1),
('129.0.0.1', 1),
('127.5.0.1', 2),
('127.0.0.1', 9),
('66.0.0.1', 17),
('77.0.0.1', 18);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
