-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:‘8889’
-- Generation Time: Aug 02, 2018 at 03:31 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `UEN` varchar(11) NOT NULL DEFAULT '0',
  `companyName` varchar(100) DEFAULT NULL,
  `fileNumber` varchar(45) DEFAULT NULL,
  `dateOfCreation` datetime DEFAULT NULL,
  `user_username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`UEN`, `companyName`, `fileNumber`, `dateOfCreation`, `user_username`) VALUES
('239586948', 'Healthcare Pte Ltd', '000000', '2018-07-31 01:19:12', 'Angus'),
('385769483', 'Pocular Pte Ltd', '000000', '2018-07-31 01:35:59', 'Johnathan'),
('385960385', 'Maxicom Pte Ltd', '000000', '2018-07-30 22:22:39', 'Johnathan'),
('485930584', 'Martell Pte Ltd', '000000', '2018-07-30 22:36:25', 'Johnathan'),
('583950284', 'Stingel Pte Ltd', '000000', '2018-07-30 21:48:01', 'Johnathan'),
('839584039', 'VSIG Pte Ltd', '000000', '2018-07-30 22:14:55', 'Johnathan'),
('940385930', 'Alison Pte Ltd', '000000', '2018-07-30 21:28:58', 'Johnathan');

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
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Bank charges', 'Bank Charges'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Depreciation', 'Depreciation'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Office supplies', 'Office Supplies'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Professional fee', 'Professional Fee'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Registered address service', 'Registered address service'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Rental', 'Rental,Rent'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Bank charges', 'Bank Charges'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Depreciation', 'Depreciation'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Office supplies', 'Office Supplies'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Professional fee', 'Professional Fee'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Registered address service', 'Registered address service'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Rental', 'Rental,Rent'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Bank charges', 'Bank Charges'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Depreciation', 'Depreciation'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Office supplies', 'Office Supplies'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Professional fee', 'Professional Fee'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Registered address service', 'Registered address service'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Rental', 'Rental,Rent'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Bank charges', 'Bank Charges'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Depreciation', 'Depreciation'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Office supplies', 'Office Supplies'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Professional fee', 'Professional Fee'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Registered address service', 'Registered address service'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Rental', 'Rental,Rent'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Bank charges', 'Bank Charges'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Depreciation', 'Depreciation'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Office supplies', 'Office Supplies'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Professional fee', 'Professional Fee'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Registered address service', 'Registered address service'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Rental', 'Rental,Rent'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Accounting fee', 'Accounting fee,Accounting Fees,Bookkeeping fee'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Administrative expenses', 'Administrative expenses,Foreign exchange loss,Preliminary expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Bank charges', 'Bank Charges'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Compilation fee', 'Compilation fee,Compilation expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Depreciation', 'Depreciation'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Director\'s remuneration', 'Director\'s Remuneration,Director Remuneration'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Employment pass', 'Employment pass,Staff cost - employment pass'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Entertainment', 'Entertainment,Business entertainment'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Exchange loss - trade', 'Exchange loss - trade,Exchange difference,Unrealised exch - Non trade'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Foreign exchange gain', 'Foreign exchange gain'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Freight charges', 'Freight charges,Freight paid'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Insurance', 'Insurance,Medical Expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Interest on bank borrowings', 'Interest on bank borrowings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Internet expenses', 'Internet expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Inventory', 'Packing materials,Opening stock,Closing stock'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Late penalty', 'Late Fees Paid,Late penalty'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Nominee director fee', 'Nominee director fee,Nominee Director Services'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Office supplies', 'Office Supplies'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Postage and courier', 'Postage and courier'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Printing and stationery', 'Printing and stationery'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Professional fee', 'Professional Fee'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Purchases', 'Returns and Allowances'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Registered address service', 'Registered address service'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Rental', 'Rental,Rent'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Salaries', 'Staff Salaries,Wages & Salaries'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Secretarial fee', 'Secretarial fee,Secretarial services,Secretarial  fee'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Skill development levy & SINDA', 'Skill Development Levy,Skill development levy & SINDA'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Stamp duty', 'Stamp duty'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Subscription charges', 'Software subscriptions'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Taxation fee', 'Taxation fee,Taxation services,Taxation service'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Telephone expenses', 'Telephone expenses,Telephone,Telephone charges'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Transportation', 'Transportation,Transport - Taxi fare'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Travelling expenses', 'Travelling expenses,Travelling'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses');

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
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Non-current Liabilities', ''),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Non-current Liabilities', ''),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Non-current Liabilities', ''),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Non-current Liabilities', ''),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Non-current Liabilities', ''),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Adjustments', 'Depreciation,Interest on bank borrowings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Administrative Expenses', 'Accounting Fee,Administrative Expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Assets', 'Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder,Inventories'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Both Liabilities', 'Borrowings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Capital', 'Share Capital,Retained Profits,Accumulated Losses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Cost of sales', 'Cost of sales'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Current Assets', 'Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Current Liabilities', 'Trade and other payables,Current Income Tax Liabilities'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone Expenses,Transport Expenses,Travel Expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Exchange Gain - Non-trade', 'Unrealised exchange difference,Exchange Gain - Non-trade'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Exchange Gain - Trade', 'Exchange Gain - Trade,Exchange difference'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Expenses', 'Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses,Travelling expenses,Website and mailing expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Income', 'Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Non-current Assets', 'Plant and Equipment'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Non-current Liabilities', ''),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Tax Payable', 'Income Tax Payables,Current Income Tax Liabilities'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Trade and other payables', 'Trade and other payables,Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables');

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
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Accruals', 'Accruals'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Borrowings', 'Borrowings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Cost of Sales', 'Purchases'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Inventories', 'Inventory'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Prepayments', 'Prepayments'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Revenue', 'Sales'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Daikon Pte Ltd', 'Alison Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Accruals', 'Accruals'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Borrowings', 'Borrowings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Cost of Sales', 'Purchases'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Inventories', 'Inventory'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Prepayments', 'Prepayments'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Revenue', 'Sales'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Daikon Pte Ltd', 'Maxicom Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Accruals', 'Accruals'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Borrowings', 'Borrowings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Cost of Sales', 'Purchases'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Inventories', 'Inventory'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Prepayments', 'Prepayments'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Revenue', 'Sales'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Daikon Pte Ltd', 'Pocular Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Accruals', 'Accruals'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Borrowings', 'Borrowings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Cost of Sales', 'Purchases'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Inventories', 'Inventory'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Prepayments', 'Prepayments'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Revenue', 'Sales'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Daikon Pte Ltd', 'Stingel Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Accruals', 'Accruals'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Bank Balances', 'OCBC Bank,OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Borrowings', 'Borrowings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Cost of Sales', 'Purchases'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Inventories', 'Inventory'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Prepayments', 'Prepayments'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Revenue', 'Sales'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Daikon Pte Ltd', 'VSIG Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Accruals', 'Accruals'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Administrative Expenses', 'Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight charges,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Medical Expenses,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial fee,Taxation fee,Taxation service,Registered address service,Subscription charges,Stamp duty,Skill Development Levy,Wages & Salaries'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Amount owing from a Shareholder', 'Amount owing to/(from) SH'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Amount owing to a Shareholder', 'Amount owing to directors,Amount due to a shareholder'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Bank', 'OCBC Bank'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Bank Balances', ',OCBC - USD,OCBC - USD Exchange,OCBC-SGD bank acc,OCBC-USD bank acc,OCBC-USD bank acc Exchange,Cash on hand,Foreign exchange loss,Foreign exchange gain'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Borrowings', 'Borrowings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Cost of Sales', 'Purchases'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Current Income Tax Liabilities', 'Income tax payable'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Deposits', 'Hoiio deposit,Deposits Paid'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Distribution and Marketing Expenses', 'Telephone expenses,Transport - Taxi fare,Travelling'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Exchanges', 'Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Finance Expenses', 'Interest on bank borrowings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'GST Payables', 'GST control,GST Collected'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Income Tax Expense', 'Income tax expense,Income Tax Payables,Income tax expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Inventories', 'Inventory'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Other Income', 'Foreign exchange gain'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Plant and Equipment', 'Office Equipment at Cost,Office Equipment Accum Dep\'n,Softwares at Cost,Softwares Accum Dep\'n,Computer & servers - cost,Computer and servers - acc dep'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Prepayments', 'Prepayments'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Retained Profits', 'Retained Earnings'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Revenue', 'Sales'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Share Capital', 'Paid Up Capital,Owner/Sharehldr Capital'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Trade Payables', 'Trade Creditors,Trade Payables,Trade Payables - USD,Trade Payables - USD Exchange'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Trade Receivables', 'Trade Debtors,Trade Receivables,Trade Receivables - USD,Trade Receivables - USD Exchan'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Travelling expenses', 'Travelling expenses'),
('Werks Pte Ltd', 'Healthcare Pte Ltd', 'Website and mailing expenses', 'Website and mailing expenses');

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
('Aaron', 'Aaron@Daikon.com', '$2y$10$hQl4Q3eKBX522gxG3V0d2.qo9Mrw6m9XzbliGVV5OjqSjD8sw5U7K', 3, 'Daikon Pte Ltd'),
('Angela', 'Angela@Daikon.com', '$2y$10$QcsG1pZlEMxknu28vAw7DO0FOfiTRNzS3DwFNJeOBrAstAP9qjUia', 3, 'Daikon Pte Ltd'),
('Angus', 'angus@Werks.com', '$2y$10$bvzkVC1KLiEQhXmz.J.Qx.Fnk1FQufLJb0oTZZvz5UDmcAxb/U8TG', 2, 'Werks Pte Ltd'),
('Chan De', 'chande@Daikon.com', '$2y$10$HVifvIyiA3t2nByMlPp07u0nqxlQWvbZ350BDyNNO35MR/alGqWbK', 3, 'Daikon Pte Ltd'),
('Jerry', 'Jerry@Daikon.com', '$2y$10$9.ATt8SQibkl2tZHjKxPT.YGd9XSKgZwwJ2C7Ve1E2cNrzuBX4TAa', 3, 'Daikon Pte Ltd'),
('Johnathan', 'johnathan@daikon.com', '$2y$10$9TGMkaf6Ks.xJWLk06ixhugePtUDoNu7nMhsPiB3VbGNkgBo9a.Di', 2, 'Daikon Pte Ltd'),
('Josephine', 'Josephine@Daikon.com', '$2y$10$Rp45O7KoSSA5CQY1uQ75jODapPgNSIYB.gDlpqCT613fx4TAEkl9K', 3, 'Daikon Pte Ltd'),
('Super Admin', 'one@gmail.com', '$2y$10$q8Y7C/1MMMiLB5ZgkixQTev8ESbVB6W5yQ1LTLiIuhn.vG9F5.x3i', 1, 'Super Pte Ltd');

-- --------------------------------------------------------

--
-- Table structure for table `usermanageaccount`
--

CREATE TABLE `usermanageaccount` (
  `account_UEN` varchar(11) NOT NULL,
  `account_user_username` varchar(45) NOT NULL,
  `user_username` varchar(20) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usermanageaccount`
--

INSERT INTO `usermanageaccount` (`account_UEN`, `account_user_username`, `user_username`, `user_role_id`) VALUES
('583950284', 'Johnathan', 'Aaron', 3),
('385960385', 'Johnathan', 'Angela', 3),
('239586948', 'Angus', 'Angus', 2),
('940385930', 'Johnathan', 'Jerry', 3),
('385769483', 'Johnathan', 'Johnathan', 2),
('385960385', 'Johnathan', 'Johnathan', 2),
('485930584', 'Johnathan', 'Johnathan', 2),
('583950284', 'Johnathan', 'Johnathan', 2),
('839584039', 'Johnathan', 'Johnathan', 2);

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
  ADD CONSTRAINT `fk_account_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `usermanageaccount`
--
ALTER TABLE `usermanageaccount`
  ADD CONSTRAINT `fk_userManageAccount_account1` FOREIGN KEY (`account_UEN`,`account_user_username`) REFERENCES `account` (`UEN`, `user_username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userManageAccount_user1` FOREIGN KEY (`user_username`,`user_role_id`) REFERENCES `user` (`username`, `role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
