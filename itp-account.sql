-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:‘8889’
-- Generation Time: Jul 19, 2018 at 06:11 AM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itp-3E Accounting`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `UEN` varchar(255) NOT NULL DEFAULT '0',
  `companyName` varchar(100) DEFAULT NULL,
  `fileNumber` varchar(45) DEFAULT NULL,
  `dateOfCreation` datetime DEFAULT NULL,
  `user_username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UEN`, `companyName`, `fileNumber`, `dateOfCreation`, `user_username`) VALUES
('123456789', 'haha photo co', '012345', '2018-07-16 15:47:33', 'Jerome'),
('201120337', '3E accounting', '123456', '2018-07-11 18:34:14', 'Jerome'),
('201220337', '4E accounting', '123456', '2018-07-16 14:58:37', 'Jerome'),
('20180525', 'phoebe pte ltd', '12345', '2018-05-25 00:00:00', 'phoebe'),
('201816715', 'SoulessCreation Co', '000000', '2018-07-16 15:41:15', 'Jerome'),
('201817232E', 'test company', '000001', '2018-07-18 16:31:29', 'Jerome');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`UEN`,`user_username`),
  ADD KEY `fk_account_user1_idx` (`user_username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
