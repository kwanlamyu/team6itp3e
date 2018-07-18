-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 09:07 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itp`
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
-- Table structure for table `coupontype`
--

CREATE TABLE `coupontype` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupontype`
--

INSERT INTO `coupontype` (`id`, `type`) VALUES
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
-- Table structure for table `licensepurchased`
--

CREATE TABLE `licensepurchased` (
  `dateOfPurchased` date DEFAULT NULL,
  `expiryDate` date DEFAULT NULL,
  `numberOfAccounts` int(11) DEFAULT NULL,
  `couponUsed` int(11) DEFAULT NULL,
  `user_username` varchar(20) NOT NULL,
  `coupon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `licensepurchased`
--

INSERT INTO `licensepurchased` (`dateOfPurchased`, `expiryDate`, `numberOfAccounts`, `couponUsed`, `user_username`, `coupon_id`) VALUES
('2018-05-25', '2019-05-24', 50, 1, 'phoebe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `main_category`
--

CREATE TABLE `main_category` (
  `company_name` varchar(255) NOT NULL,
  `client_company` varchar(255) NOT NULL,
  `main_account` varchar(255) NOT NULL,
  `account_names` varchar(60000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_category`
--

INSERT INTO `main_category` (`company_name`, `client_company`, `main_account`, `account_names`) VALUES
('Abc Pte. Ltd.', 'VSIG', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Abc Pte. Ltd.', 'VSIG', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses,Bank Charges,Compilation Fee,Depreciation,Entertainment,Freight Charges,Internet Expenses,Late Penalty,Nominee Director Fee,Office Supplies,Postage and Courier,Professional Fee,Secretarial Fee,Taxation Fee,Salaries,Skill Development Levy & SINDA'),
('Abc Pte. Ltd.', 'VSIG', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder'),
('Abc Pte. Ltd.', 'VSIG', 'Both Liabilities', 'Borrowings'),
('Abc Pte. Ltd.', 'VSIG', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Abc Pte. Ltd.', 'VSIG', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Abc Pte. Ltd.', 'VSIG', 'Current Liabilities', 'Trade Payables,GST Payables,Accruals,Amount owing to a Shareholder,Current Income Tax Liabilities'),
('Abc Pte. Ltd.', 'VSIG', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Abc Pte. Ltd.', 'VSIG', 'Exchange Gain - Non Trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Abc Pte. Ltd.', 'VSIG', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Abc Pte. Ltd.', 'VSIG', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses'),
('Abc Pte. Ltd.', 'VSIG', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Abc Pte. Ltd.', 'VSIG', 'Non-current Assets', 'Plant and Equipment'),
('Abc Pte. Ltd.', 'VSIG', 'Non-current Liabilities', ''),
('Abc Pte. Ltd.', 'VSIG', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Abc Pte. Ltd.', 'VSIG', 'Trade and other payables', 'Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables');

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
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `company_name` varchar(255) NOT NULL,
  `client_company` varchar(255) NOT NULL,
  `sub_account` varchar(255) NOT NULL,
  `account_names` varchar(60000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `role_id`, `companyName`) VALUES
('phoebe', 'phoebe@itp.com', '*00A51F3F48415C7D4E8', 1, ''),
('weekokhoe', '1602494@sit.singaporetech.edu.sg', '$2y$10$pwieFM8/HHV2N', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `usermanageaccount`
--

CREATE TABLE `usermanageaccount` (
  `account_UEN` int(11) NOT NULL,
  `account_user_username` varchar(45) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermanageaccount`
--

INSERT INTO `usermanageaccount` (`account_UEN`, `account_user_username`, `user_username`, `user_role_id`) VALUES
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
-- Indexes for table `coupontype`
--
ALTER TABLE `coupontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`,`account_UEN`,`account_user_username`),
  ADD KEY `fk_history_account1_idx` (`account_UEN`,`account_user_username`);

--
-- Indexes for table `licensepurchased`
--
ALTER TABLE `licensepurchased`
  ADD PRIMARY KEY (`user_username`,`coupon_id`),
  ADD KEY `fk_licensePurchased_user1_idx` (`user_username`),
  ADD KEY `fk_licensePurchased_coupon1_idx` (`coupon_id`);

--
-- Indexes for table `main_category`
--
ALTER TABLE `main_category`
  ADD PRIMARY KEY (`company_name`,`client_company`,`main_account`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`company_name`,`client_company`,`sub_account`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`,`role_id`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- Indexes for table `usermanageaccount`
--
ALTER TABLE `usermanageaccount`
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
-- AUTO_INCREMENT for table `coupontype`
--
ALTER TABLE `coupontype`
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
  ADD CONSTRAINT `fk_coupon_couponType1` FOREIGN KEY (`couponType_id`) REFERENCES `coupontype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_account1` FOREIGN KEY (`account_UEN`,`account_user_username`) REFERENCES `account` (`UEN`, `user_username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `licensepurchased`
--
ALTER TABLE `licensepurchased`
  ADD CONSTRAINT `fk_licensePurchased_coupon1` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_licensePurchased_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usermanageaccount`
--
ALTER TABLE `usermanageaccount`
  ADD CONSTRAINT `fk_userManageAccount_account1` FOREIGN KEY (`account_UEN`,`account_user_username`) REFERENCES `account` (`UEN`, `user_username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userManageAccount_user1` FOREIGN KEY (`user_username`,`user_role_id`) REFERENCES `user` (`username`, `role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
