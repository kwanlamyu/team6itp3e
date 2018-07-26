-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 09:15 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
(123, 'jp company', '234', '2018-07-17 00:00:00', 'jpjp'),
(20180525, 'phoebe pte ltd', '12345', '2018-05-25 00:00:00', 'phoebe'),
(123456789, 'mama company', '123', '2018-07-26 13:20:49', 'mama');

-- --------------------------------------------------------

--
-- Table structure for table `account_category`
--

CREATE TABLE `account_category` (
  `company_name` varchar(255) NOT NULL,
  `client_company` varchar(255) NOT NULL,
  `account` varchar(255) NOT NULL,
  `account_names` varchar(60000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_category`
--

INSERT INTO `account_category` (`company_name`, `client_company`, `account`, `account_names`) VALUES
('Abc Pte. Ltd.', 'mama company', 'A', 'Office Equipment at Cost'),
('Abc Pte. Ltd.', 'mama company', 'Administrative expenses', 'Accounting fee,Administrative expenses,Bank charges,Compilation fee,Depreciation,Directorâ€™s remuneration,Entertainment,Employment pass,Exchange loss - trade,Freight charges,Insurance,Internet expenses,Late penalty,Nominee director fee,Office supplies,Postage and courier,Professional fee,Printing and stationery,Rental,Salaries,Secretarial fee,Skill development levy & SINDA,Taxation fee,Skill Development Levy,OCBC Bank'),
('Abc Pte. Ltd.', 'mama company', 'B', 'Trade Receivables - USD Exchan,Trade Receivables - USD Exchan'),
('Abc Pte. Ltd.', 'mama company', 'D', 'OCBC - USD Exchange'),
('Abc Pte. Ltd.', 'mama company', 'Distribution and marketing expenses', 'Travelling expenses,Transportation,Telephone expenses'),
('Abc Pte. Ltd.', 'mama company', 'Finance expenses', 'Interest on bank borrowings'),
('Abc Pte. Ltd.', 'mama company', 'G', 'OCBC - USD,OCBC - USD');

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
('Abc Pte. Ltd.', 'mama company', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Abc Pte. Ltd.', 'mama company', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Abc Pte. Ltd.', 'mama company', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder'),
('Abc Pte. Ltd.', 'mama company', 'Both Liabilities', 'Borrowings'),
('Abc Pte. Ltd.', 'mama company', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Abc Pte. Ltd.', 'mama company', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Abc Pte. Ltd.', 'mama company', 'Current Liabilities', 'Trade Payables,GST Payables,Accruals,Amount owing to a Shareholder,Current Income Tax Liabilities'),
('Abc Pte. Ltd.', 'mama company', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Abc Pte. Ltd.', 'mama company', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Abc Pte. Ltd.', 'mama company', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Abc Pte. Ltd.', 'mama company', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses'),
('Abc Pte. Ltd.', 'mama company', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Abc Pte. Ltd.', 'mama company', 'Non-current Assets', 'Plant and Equipment'),
('Abc Pte. Ltd.', 'mama company', 'Non-current Liabilities', ''),
('Abc Pte. Ltd.', 'mama company', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Abc Pte. Ltd.', 'mama company', 'Trade and other payables', 'Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables');

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

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`company_name`, `client_company`, `sub_account`, `account_names`) VALUES
('Abc Pte. Ltd.', 'mama company', 'Accruals', 'Accruals'),
('Abc Pte. Ltd.', 'mama company', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial  fee,Taxation services,Skill Development Levy,Wages & Salaries'),
('Abc Pte. Ltd.', 'mama company', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Abc Pte. Ltd.', 'mama company', 'Amount owing to a Shareholder', 'Amount owing to directors'),
('Abc Pte. Ltd.', 'mama company', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange'),
('Abc Pte. Ltd.', 'mama company', 'Borrowings', 'Borrowings'),
('Abc Pte. Ltd.', 'mama company', 'Cost of Sales', 'Purchases'),
('Abc Pte. Ltd.', 'mama company', 'Current Income Tax Liabilities', 'Income tax payable'),
('Abc Pte. Ltd.', 'mama company', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Abc Pte. Ltd.', 'mama company', 'Distribution and Marketing Expenses', 'Telephone,Transport - Taxi fare,Travelling'),
('Abc Pte. Ltd.', 'mama company', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Abc Pte. Ltd.', 'mama company', 'Finance Expenses', 'Interest on bank borrowings'),
('Abc Pte. Ltd.', 'mama company', 'GST Payables', 'GST control'),
('Abc Pte. Ltd.', 'mama company', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Abc Pte. Ltd.', 'mama company', 'Other Income', 'Unrealised exchange difference'),
('Abc Pte. Ltd.', 'mama company', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Abc Pte. Ltd.', 'mama company', 'Prepayments', 'Prepayments'),
('Abc Pte. Ltd.', 'mama company', 'Retained Profits', 'Retained Earnings'),
('Abc Pte. Ltd.', 'mama company', 'Revenue', 'Sales'),
('Abc Pte. Ltd.', 'mama company', 'Share Capital', 'Paid Up Capital'),
('Abc Pte. Ltd.', 'mama company', 'Telephone Expenses', 'Telephone charges,Telephone'),
('Abc Pte. Ltd.', 'mama company', 'Trade Payables', 'Trade Payables - USD,Trade Payables - USD Exchange'),
('Abc Pte. Ltd.', 'mama company', 'Trade Receivables', 'Trade Receivables - USD,Trade Receivables - USD Exchan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`, `role_id`, `companyName`) VALUES
('accountant 1', 'one@gmail.com', '$2y$10$q8Y7C/1MMMiLB5ZgkixQTev8ESbVB6W5yQ1LTLiIuhn.vG9F5.x3i', 3, 'jp company'),
('accountant 2', 'two@gmail.com', '$2y$10$QVcifteZeGGew4OGfmtbbupbIQrMmtrVJx5TVK1rkJX4O6Hs0r.dO', 3, 'mama company'),
('accountant 3', 'three@gmail.com', '$2y$10$k1kG05HhHj6h/TmuRucT.OipWlglGqxVNJzqoCeytXeNQ4WrN7fWe', 3, 'mama company'),
('accountant 5', 'five@gmail.com', '$2y$10$r70JcpDnWXFwYHRZj7M8rOeYuRbL7yUhY/5/I/qWT.rLoCTTcLmui', 3, 'mama company'),
('ebe', 'ebe@gmail.com', '$2y$10$O4MLBEl9kC.FY', 2, 'phoebe company'),
('eight', 'eight@gmail.com', '$2y$10$oZLV3xZhZ/38OWVk5ZoKRO.IuvDfuzhyymg9FaOS5vYZwYbtT5TJy', 3, 'mama company'),
('jingpei', 'jp@gmail.com', '12345678', 2, 'jp '),
('jpjp', 'jp@gmail.com', '$2y$10$D1SYJpoycdS.Qi6wTxAA4u8Riz743Dn/ZdrpO87AKd3dGK1wzG9Y6', 2, 'jp company'),
('lala', 'lala@gmail.com', '$2y$10$b9p3Vixza27bU', 2, 'lala company'),
('mama', 'mama@gmail.com', '$2y$10$.SYEPz06oUyxvbpC1I65duyTieas5LFLLuEQTxo.lPJxXvozsEq4u', 2, 'mama company'),
('nine', 'nine@gmail.com', '$2y$10$QnznRIjv/R2sWb4BUGnutugFMKncma52N1h5GW.GkJsvjBN2Lyvym', 3, 'mama company'),
('phoebe', 'phoebe@itp.com', '*00A51F3F48415C7D4E8', 1, ''),
('seven', 'seven@gmail.com', '$2y$10$h4ac82x/zDhdIzD40i1TMeTKG0nSZphMGSHALMoGq9LIOeuBn9w6G', 3, 'mama company'),
('six', 'six@gmail.com', '$2y$10$gUU9SGNjVBuPqZR78Sus/e6fZ891BRX4TXMVe1DaN3l/62r39PTUa', 3, 'mama company'),
('ten', 'ten@gmail.com', '$2y$10$/1/kCJaWDUJbBYtETkoDau7YFqyjMj5RKJKsxbSRff5HC7yWJ2wRq', 3, 'mama company'),
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
(123, 'jpjp', 'jpjp', 2),
(20180525, 'phoebe', 'phoebe', 1),
(123456789, 'mama', 'mama', 2);

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
-- Indexes for table `account_category`
--
ALTER TABLE `account_category`
  ADD PRIMARY KEY (`company_name`,`client_company`,`account`);

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
