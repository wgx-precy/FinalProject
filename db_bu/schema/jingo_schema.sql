-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2013 at 08:10 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jingo`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `district` text NOT NULL,
  `a_city` text,
  `a_state` text,
  `a_line1` text NOT NULL,
  `a_line2` text NOT NULL,
  `a_x` int(6) NOT NULL,
  `a_y` int(6) NOT NULL,
  `zip` int(6) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`aid`, `district`, `a_city`, `a_state`, `a_line1`, `a_line2`, `a_x`, `a_y`, `zip`) VALUES
(1, '5098 Shady Gardens', 'Many Islands', 'New Jersey', '5098', 'Shady Gardens', 10, 10, 8655),
(2, '2975 Amber Freeway', 'Ohathlockhouchy', 'Virginia', '2975', 'Amber Freeway', 20, 20, 22299),
(3, '3196 	', 'Little Hope', 'North Carolina', '3196', 'Jagged Cider Parkway', 30, 30, 27966),
(4, '3074 Blue Fox Landing', 'Alligator', 'New York', '3074', 'Blue Fox Landing', 40, 40, 10313),
(5, '1457 Cozy Limits', 'Boos', 'New York', '1457', 'Cozy Limits', 50, 50, 14938),
(6, '75 Wall Street', 'New York', 'New York', '75', 'Wall Street', 60, 60, 10005),
(7, '422 Fulton Street', 'Brooklyn', 'New York', '422', 'Fulton Street', 70, 70, 11201);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cnote` text NOT NULL,
  PRIMARY KEY (`cid`),
  KEY `nid` (`nid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `nid`, `uid`, `ctime`, `cnote`) VALUES
(1, 2, 5, '2013-04-05 15:11:11', 'user5comment'),
(2, 2, 1, '2013-04-05 15:11:25', 'user1comment'),
(3, 4, 4, '2013-04-11 15:11:10', 'user4comment'),
(4, 4, 5, '2013-04-12 15:15:25', 'user5comment'),
(5, 7, 3, '2013-04-05 15:11:25', 'user3comment'),
(6, 1, 2, '0000-00-00 00:00:00', 'Thanks for the tip!');

-- --------------------------------------------------------

--
-- Table structure for table `filters_tags`
--

CREATE TABLE IF NOT EXISTS `filters_tags` (
  `fid` int(10) NOT NULL,
  `tag` text NOT NULL,
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filters_tags`
--

INSERT INTO `filters_tags` (`fid`, `tag`) VALUES
(1, '#me'),
(2, '#food'),
(2, '#restaurant'),
(2, '#drinks'),
(3, '#food'),
(3, '#restaurant'),
(3, '#delicious'),
(3, '#luxury'),
(4, '#me'),
(4, '#food'),
(4, '#BBQ'),
(5, '#shopping'),
(5, '#store'),
(6, '#shopping'),
(6, '#store'),
(7, '#bar'),
(7, '#drink'),
(7, '#wine');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `uid` int(10) unsigned NOT NULL,
  `fid` int(10) unsigned NOT NULL,
  KEY `uid` (`uid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`uid`, `fid`) VALUES
(1, 2),
(1, 4),
(1, 5),
(2, 1),
(2, 4),
(3, 4),
(3, 5),
(4, 1),
(4, 3),
(5, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `nid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `nloc_x` int(6) NOT NULL,
  `nloc_y` int(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ntype` enum('public','follow','friend') NOT NULL DEFAULT 'public',
  `ncomment` tinyint(1) NOT NULL DEFAULT '0',
  `nradius` int(4) NOT NULL DEFAULT '1000',
  `note` text NOT NULL,
  `like_value` int(6) NOT NULL DEFAULT '0',
  `link` varchar(30) DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `repeat1` tinyint(1) NOT NULL DEFAULT '0',
  `week1` enum('1','2','3','4','5','6','7','0') NOT NULL DEFAULT '0',
  `week2` enum('1','2','3','4','5','6','7','0') NOT NULL DEFAULT '0',
  `repeat2` tinyint(1) NOT NULL DEFAULT '0',
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  PRIMARY KEY (`nid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`nid`, `uid`, `nloc_x`, `nloc_y`, `time`, `ntype`, `ncomment`, `nradius`, `note`, `like_value`, `link`, `startdate`, `enddate`, `repeat1`, `week1`, `week2`, `repeat2`, `starttime`, `endtime`) VALUES
(1, 1, 30, 30, '2013-04-20 23:11:07', 'public', 0, 15, 'this is user1''s note1', 2, 'www.user1note.com', '2013-04-01', '2013-04-15', 0, '0', '0', 0, '10:10:10', '13:13:13'),
(2, 2, 38, 38, '2013-04-20 23:11:07', 'public', 1, 15, 'this is user2''s note1', 3, 'www.user2note.com', '2013-04-05', '2013-04-05', 1, '0', '0', 0, '10:10:10', '12:12:12'),
(3, 1, 19, 19, '2013-04-20 23:11:07', 'public', 1, 15, 'this is user1''s note2', 2, 'www.user1note.com', '2013-04-07', '2013-04-11', 0, '0', '0', 0, '10:10:10', '13:13:13'),
(4, 3, 64, 64, '2013-04-20 23:11:07', 'friend', 1, 15, 'this is user3''s note1', 0, 'www.user3note.com', '2013-04-11', '2013-04-12', 1, '0', '0', 0, '10:10:10', '13:13:13'),
(5, 4, 60, 60, '2013-04-20 23:11:07', 'follow', 0, 15, 'this is user4''s note1', 4, 'www.user4note.com', '0000-00-00', '0000-00-00', 0, '1', '5', 1, '10:10:10', '13:13:13'),
(6, 2, 51, 51, '2013-04-20 23:11:07', 'public', 1, 15, 'this is user2''s note2', 1, 'www.user2note.com', '0000-00-00', '0000-00-00', 0, '1', '3', 1, '10:10:10', '13:13:13'),
(7, 4, 60, 60, '2013-04-20 23:11:07', 'public', 1, 15, 'this is user4''s note2', 2, 'www.user4note.com', '0000-00-00', '0000-00-00', 0, '6', '7', 1, '10:10:10', '13:13:13'),
(8, 5, 72, 72, '2013-04-20 23:11:07', 'friend', 1, 15, 'this is user5''s note1', 7, 'www.user5note.com', '2013-04-17', '2013-04-18', 0, '1', '5', 1, '10:10:10', '13:13:13'),
(9, 1, 55, 55, '2013-04-20 23:11:07', 'public', 1, 15, 'this is user1''s note3', 9, 'www.user1note.com', '2013-04-20', '2013-04-20', 1, '1', '5', 1, '10:10:10', '13:13:13'),
(10, 1, 55, 55, '2013-04-21 01:59:03', 'public', 1, 15, 'note this is user1''s note3', 5, 'www.user1-2-note.com', '2013-04-20', '2013-04-20', 1, '1', '5', 1, '10:10:10', '13:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `notes_addresses`
--

CREATE TABLE IF NOT EXISTS `notes_addresses` (
  `nid` int(10) NOT NULL,
  `aid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes_addresses`
--

INSERT INTO `notes_addresses` (`nid`, `aid`) VALUES
(1, 1),
(2, 4),
(2, 5),
(4, 6),
(5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `fid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `status` enum('completed','follow') DEFAULT 'follow',
  KEY `uid` (`uid`),
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`fid`, `uid`, `status`) VALUES
(1, 2, 'completed'),
(3, 2, 'follow'),
(1, 5, 'completed'),
(3, 1, 'follow'),
(2, 4, 'completed'),
(4, 3, 'completed'),
(4, 1, 'completed'),
(5, 3, 'completed'),
(4, 5, 'follow');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `nid` int(10) unsigned NOT NULL,
  `tag` varchar(30) NOT NULL,
  KEY `nid` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`nid`, `tag`) VALUES
(1, '#me'),
(2, '#me'),
(2, '#food'),
(2, '#mrestaurant'),
(3, '#me'),
(4, '#me'),
(5, '#restaurant'),
(5, '#luxury'),
(6, '#drink'),
(6, '#bar'),
(7, '#restaurant'),
(7, '#luxury'),
(7, '#me'),
(8, '#macy'),
(8, '#shopping'),
(9, '#me');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `uemail` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `credit` int(10) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `uemail`, `first_name`, `last_name`, `credit`, `create_time`) VALUES
(1, 'claud@jingo.com', '123', 'claud@jingo.com', 'Claud', 'xie', 1, '2013-04-20 23:08:55'),
(2, 'joi@jingo.com', '123', 'joi@jingo.com', 'Joi', 'Jinks', 2, '2013-04-20 23:08:55'),
(3, 'tennie@jingo.com', '123', 'tennie@jingo.com', 'Tennie', 'Tiggs', 3, '2013-04-20 23:08:55'),
(4, 'jerold@jingo.com', '123', 'jerold@jingo.com', 'Jerold', 'Juan', 4, '2013-04-20 23:08:55'),
(5, 'lizabeth@jingo.com', '123', 'lizabeth@jingo.com', 'Lizabeth', 'Lowell', 5, '2013-04-20 23:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `users_addresses`
--

CREATE TABLE IF NOT EXISTS `users_addresses` (
  `uid` int(10) NOT NULL,
  `aid` int(10) NOT NULL,
  `atag` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_addresses`
--

INSERT INTO `users_addresses` (`uid`, `aid`, `atag`) VALUES
(1, 1, 'mother home'),
(1, 2, 'friend home'),
(1, 3, 'my home'),
(2, 4, 'good restaurant'),
(2, 5, 'good drink bar'),
(4, 6, 'luxury restaurant'),
(5, 7, 'macy shopping');

-- --------------------------------------------------------

--
-- Table structure for table `users_filters`
--

CREATE TABLE IF NOT EXISTS `users_filters` (
  `fid` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `repeat1` tinyint(1) NOT NULL DEFAULT '0',
  `week1` enum('1','2','3','4','5','6','7','0') NOT NULL DEFAULT '0',
  `week2` enum('1','2','3','4','5','6','7','0') NOT NULL DEFAULT '0',
  `repeat2` tinyint(1) NOT NULL DEFAULT '0',
  `timestart` time DEFAULT NULL,
  `timeend` time DEFAULT NULL,
  `state` enum('at work','at school','at home','lunch break','other') NOT NULL DEFAULT 'other',
  `district` text,
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users_filters`
--

INSERT INTO `users_filters` (`fid`, `uid`, `datestart`, `dateend`, `repeat1`, `week1`, `week2`, `repeat2`, `timestart`, `timeend`, `state`, `district`) VALUES
(1, 1, '2013-04-01', '2013-04-15', 0, '0', '0', 0, '10:10:10', '13:13:13', 'at home', '2975 Amber Freeway'),
(2, 1, '2013-04-01', '2013-04-15', 0, '0', '0', 0, '10:10:10', '13:13:13', '', '75 Wall Street'),
(3, 2, '0000-00-00', '0000-00-00', 0, '1', '5', 1, '10:10:10', '13:13:13', '', '75 Wall Street'),
(4, 3, '2013-04-15', '2013-04-20', 1, '0', '0', 0, '10:10:10', '13:13:13', '', '3074 Blue Fox Landing'),
(5, 3, '2013-04-15', '2013-04-20', 1, '0', '0', 0, '10:10:10', '13:13:13', '', '422 Fulton Street'),
(6, 4, '0000-00-00', '0000-00-00', 0, '1', '7', 1, '10:10:10', '13:13:13', '', '422 Fulton Street'),
(7, 4, '0000-00-00', '0000-00-00', 0, '1', '7', 1, '10:10:10', '13:13:13', '', '1457 Cozy Limits');

-- --------------------------------------------------------

--
-- Table structure for table `users_locations`
--

CREATE TABLE IF NOT EXISTS `users_locations` (
  `uid` int(10) unsigned NOT NULL,
  `location_x` int(6) NOT NULL,
  `location_y` int(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_locations`
--

INSERT INTO `users_locations` (`uid`, `location_x`, `location_y`, `time`) VALUES
(1, 30, 30, '2013-04-01 14:10:10'),
(2, 38, 38, '2013-04-05 14:10:10'),
(1, 7, 7, '2013-04-07 14:10:10'),
(1, 19, 19, '2013-04-10 14:10:10'),
(3, 64, 64, '2013-04-11 14:10:10'),
(4, 60, 60, '2013-04-12 14:10:10'),
(2, 51, 51, '2013-04-14 14:10:10'),
(4, 60, 60, '2013-04-15 14:10:10'),
(5, 72, 72, '2013-04-17 14:10:10'),
(5, 42, 42, '2013-04-18 14:10:10'),
(1, 20, 20, '2013-04-19 14:10:10'),
(1, 55, 55, '2013-04-20 14:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `zips`
--

CREATE TABLE IF NOT EXISTS `zips` (
  `zip` int(6) NOT NULL,
  `district` text NOT NULL,
  `z_x1` int(6) NOT NULL,
  `z_x2` int(6) NOT NULL,
  `z_y1` int(6) NOT NULL,
  `z_y2` int(6) NOT NULL,
  PRIMARY KEY (`zip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zips`
--

INSERT INTO `zips` (`zip`, `district`, `z_x1`, `z_x2`, `z_y1`, `z_y2`) VALUES
(8655, 'Shady Gardens', 5, 15, 5, 15),
(10005, 'Wall Streat', 48, 65, 48, 65),
(10313, 'BLue Fox Landing', 35, 45, 35, 45),
(11201, 'Fulton Street', 65, 85, 65, 85),
(11204, 'Bensonhurst', 100, 130, 100, 130),
(14938, 'Cozy Limits', 45, 55, 45, 55),
(22299, 'Amber Freeway', 15, 25, 15, 25),
(27966, 'Jagged Cider Parkway', 25, 35, 25, 35);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `notes` (`nid`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `filters_tags`
--
ALTER TABLE `filters_tags`
  ADD CONSTRAINT `filters_tags_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `users_filters` (`fid`);

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`fid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`nid`) REFERENCES `notes` (`nid`);

--
-- Constraints for table `users_locations`
--
ALTER TABLE `users_locations`
  ADD CONSTRAINT `users_locations_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
