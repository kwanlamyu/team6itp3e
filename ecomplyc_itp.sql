-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2018 at 07:19 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomplyc_itp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `UEN` int(11) NOT NULL DEFAULT '0',
  `companyName` varchar(100) DEFAULT NULL,
  `fileNumber` varchar(45) DEFAULT NULL,
  `dateOfCreation` datetime DEFAULT NULL,
  `user_username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UEN`, `companyName`, `fileNumber`, `dateOfCreation`, `user_username`) VALUES
(20180525, 'phoebe pte ltd', '12345', '2018-05-25 00:00:00', 'phoebe');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `recurring` int(11) DEFAULT NULL,
  `maxUses` int(11) DEFAULT NULL,
  `numberOfUses` int(11) DEFAULT NULL,
  `value` double NOT NULL,
  `couponType_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `recurring`, `maxUses`, `numberOfUses`, `value`, `couponType_id`) VALUES
(1, 'code123', 1, 5, 0, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `couponType`
--

CREATE TABLE `couponType` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `couponType`
--

INSERT INTO `couponType` (`id`, `type`) VALUES
(1, 'Fixed Price'),
(2, 'Percentage'),
(3, 'Price Override');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `fileNumber` varchar(45) DEFAULT NULL,
  `lastEdit` datetime DEFAULT NULL,
  `fileData` longtext,
  `fileType` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `account_UEN` int(11) NOT NULL,
  `account_user_username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `fileNumber`, `lastEdit`, `fileData`, `fileType`, `status`, `account_UEN`, `account_user_username`) VALUES
(1, 'file123', '2018-05-25 03:00:00', 'Test test', 'Financial Statement', 'Latest', 20180525, 'phoebe');

-- --------------------------------------------------------

--
-- Table structure for table `licensePurchased`
--

CREATE TABLE `licensePurchased` (
  `dateOfPurchased` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `numberOfAccounts` int(11) DEFAULT NULL,
  `couponUsed` int(11) DEFAULT NULL,
  `user_username` varchar(20) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licensePurchased`
--

INSERT INTO `licensePurchased` (`dateOfPurchased`, `expiryDate`, `numberOfAccounts`, `couponUsed`, `user_username`, `coupon_id`) VALUES
('2018-05-25', '2019-05-24', 50, 1, 'phoebe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Client Admin'),
(3, 'Standard User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `role_id`) VALUES
('phoebe', 'phoebe@itp.com', '*00A51F3F48415C7D4E8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userManageAccount`
--

CREATE TABLE `userManageAccount` (
  `account_UEN` int(11) NOT NULL,
  `account_user_username` varchar(45) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userManageAccount`
--

INSERT INTO `userManageAccount` (`account_UEN`, `account_user_username`, `user_username`, `user_role_id`) VALUES
(20180525, 'phoebe', 'phoebe', 1);

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
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`,`couponType_id`),
  ADD KEY `fk_coupon_couponType1_idx` (`couponType_id`);

--
-- Indexes for table `couponType`
--
ALTER TABLE `couponType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`,`account_UEN`,`account_user_username`),
  ADD KEY `fk_history_account1_idx` (`account_UEN`,`account_user_username`);

--
-- Indexes for table `licensePurchased`
--
ALTER TABLE `licensePurchased`
  ADD PRIMARY KEY (`user_username`,`coupon_id`),
  ADD KEY `fk_licensePurchased_user1_idx` (`user_username`),
  ADD KEY `fk_licensePurchased_coupon1_idx` (`coupon_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`,`role_id`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- Indexes for table `userManageAccount`
--
ALTER TABLE `userManageAccount`
  ADD PRIMARY KEY (`account_UEN`,`account_user_username`,`user_username`,`user_role_id`),
  ADD KEY `fk_userManageAccount_user1_idx` (`user_username`,`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `couponType`
--
ALTER TABLE `couponType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `fk_coupon_couponType1` FOREIGN KEY (`couponType_id`) REFERENCES `couponType` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_account1` FOREIGN KEY (`account_UEN`,`account_user_username`) REFERENCES `account` (`UEN`, `user_username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licensePurchased`
--
ALTER TABLE `licensePurchased`
  ADD CONSTRAINT `fk_licensePurchased_coupon1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_licensePurchased_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userManageAccount`
--
ALTER TABLE `userManageAccount`
  ADD CONSTRAINT `fk_userManageAccount_account1` FOREIGN KEY (`account_UEN`,`account_user_username`) REFERENCES `account` (`UEN`, `user_username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userManageAccount_user1` FOREIGN KEY (`user_username`,`user_role_id`) REFERENCES `user` (`username`, `role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
