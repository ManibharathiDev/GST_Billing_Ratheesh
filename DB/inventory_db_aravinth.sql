-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 06:06 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory_db_aravinth`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE IF NOT EXISTS `tbl_bill` (
`billId` int(11) NOT NULL,
  `billOrderNo` varchar(15) DEFAULT NULL,
  `billType` int(1) DEFAULT NULL,
  `billCusId` int(3) DEFAULT NULL,
  `billDate` date DEFAULT NULL,
  `billAmount` varchar(15) DEFAULT NULL,
  `billPaid` varchar(15) DEFAULT NULL,
  `billBalance` varchar(15) DEFAULT NULL,
  `billModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`billId`, `billOrderNo`, `billType`, `billCusId`, `billDate`, `billAmount`, `billPaid`, `billBalance`, `billModDate`) VALUES
(1, '2018B/06/1', NULL, 3, '2018-06-26', '1265', '0.00', '1265', NULL),
(2, '2018B/06/2', NULL, 3, '2018-06-26', '415', '0.00', '415', NULL),
(3, '2018B/06/3', NULL, 1, '2018-06-26', '1455', '0.00', '1455', NULL),
(4, '2018B/06/4', NULL, 1, '2018-06-26', '830', '0.00', '830', NULL),
(5, '2018B/06/5', NULL, 2, '2018-06-26', '4105', '0.00', '4105', NULL),
(6, '2018B/06/6', NULL, 2, '2018-06-26', '415', '0.00', '415', NULL),
(7, '2018B/06/7', NULL, 4, '2018-06-27', '21092.5', '0.00', '21092.5', NULL),
(8, '2018B/06/8', NULL, 5, '2018-06-29', '2737.6', '0.00', '2737.6', NULL),
(9, '2018B/06/9', NULL, 10, '2018-06-29', '4684.6', '0.00', '4684.6', '2018-06-29'),
(10, '2018B/06/10', NULL, 9, '2018-06-29', '6785', '0.00', '6785', NULL),
(11, '2018B/06/11', NULL, 8, '2018-06-29', '2289.2', '0.00', '2289.2', NULL),
(12, '2018B/06/12', NULL, 7, '2018-06-29', '2737.6', '0.00', '2737.6', NULL),
(13, '2018B/06/13', NULL, 13, '2018-06-29', '19723.7', '0.00', '19723.7', NULL),
(14, '2018B/07/14', NULL, 6, '2018-07-07', '6938.4', '0.00', '6938.4', NULL),
(15, '2018B/07/15', NULL, 8, '2018-07-07', '3935.3', '0.00', '3935.3', NULL),
(16, '2018B/07/16', NULL, 14, '2018-07-09', '5038.6', '0.00', '5038.6', NULL),
(17, '2018B/07/17', NULL, 14, '2018-07-09', '5038.6', '0.00', '5038.6', NULL),
(18, '2018B/07/18', NULL, 15, '2018-07-09', '861.4', '0.00', '861.4', NULL),
(19, '2018B/07/19', NULL, 4, '2018-07-17', '11351.6', '0.00', '11351.6', NULL),
(20, '2018B/07/20', NULL, 4, '2018-07-17', '10431.2', '0.00', '10431.2', NULL),
(21, '2018B/07/21', NULL, 16, '2018-07-27', '2466.2', '0.00', '2466.2', NULL),
(22, '2018B/07/22', NULL, 17, '2018-07-27', '2796.6', '0.00', '2796.6', NULL),
(23, '2018B/08/23', NULL, 1, '2018-08-06', '1115.1', '0.00', '1115.1', '2018-08-06'),
(24, '2018B/08/24', NULL, 2, '2018-08-06', '3687.5', '0.00', '3687.5', NULL),
(25, '2018B/08/25', NULL, 18, '2018-08-06', '1858.5', '0.00', '1858.5', NULL),
(26, '2018B/08/26', NULL, 9, '2018-08-09', '4371.9', '0.00', '4371.9', NULL),
(27, '2018B/08/27', NULL, 19, '2018-08-09', '6265.8', '0.00', '6265.8', NULL),
(28, '2018B/08/28', NULL, 16, '2018-08-17', '3540', '0.00', '3540', NULL),
(29, '2018B/09/29', NULL, 3, '2018-09-03', '6023.9', '0.00', '6023.9', '2018-10-08'),
(30, '2018B/09/30', NULL, 6, '2018-09-07', '3557.7', '0.00', '3557.7', NULL),
(31, '2018B/09/31', NULL, 6, '2018-09-07', '3929.4', '0.00', '3929.4', NULL),
(32, '2018B/09/32', NULL, 20, '2018-09-07', '460.2', '0.00', '460.2', NULL),
(33, '2018B/09/33', NULL, 6, '2018-09-21', '7575.6', '0.00', '7575.6', NULL),
(34, '2018B/09/34', NULL, 9, '2018-09-22', '1770', '0.00', '1770', NULL),
(35, '2018B/10/35', NULL, 16, '2018-10-08', '4926.5', '0.00', '4926.5', NULL),
(36, '2018B/10/36', NULL, 11, '2018-10-08', '3091.6', '0.00', '3091.6', NULL),
(37, '2018B/10/37', NULL, 17, '2018-10-10', '5032.7', '0.00', '5032.7', NULL),
(38, '2018B/10/38', NULL, 19, '2018-10-13', '5286.4', '0.00', '5286.4', NULL),
(39, '2018B/10/39', NULL, 19, '2018-10-27', '4661', '0.00', '4661', NULL),
(40, '2018B/10/40', NULL, 9, '2018-10-27', '3280.4', '0.00', '3280.4', NULL),
(41, '2018B/10/41', NULL, 6, '2018-10-28', '13410.7', '0.00', '13410.7', NULL),
(42, '2018B/10/42', NULL, 8, '2018-10-28', '5451.6', '0.00', '5451.6', '2018-11-08'),
(43, '2018B/10/43', NULL, 8, '2018-10-28', '2448.5', '0.00', '2448.5', '2018-11-08'),
(44, '2018B/10/44', NULL, 12, '2018-10-28', '7221.6', '0.00', '7221.6', NULL),
(45, '2018B/10/45', NULL, 20, '2018-10-29', '5734.8', '0.00', '5734.8', NULL),
(46, '2018B/10/46', NULL, 3, '2018-10-30', '719.8', '0.00', '719.8', NULL),
(47, '2018B/10/47', NULL, 18, '2018-10-30', '13599.5', '0.00', '13599.5', NULL),
(48, '2018B/10/48', NULL, 1, '2018-10-30', '12207.1', '0.00', '12207.1', NULL),
(49, '2018B/11/49', NULL, 16, '2018-11-02', '0', '0.00', '0', '2018-12-10'),
(50, '2018B/11/50', NULL, 9, '2018-11-02', '3534.1', '0.00', '3534.1', NULL),
(51, '2018B/11/51', NULL, 17, '2018-11-02', '7540.2', '0.00', '7540.2', NULL),
(52, '2018B/11/52', NULL, 21, '2018-11-07', '16024.4', '0.00', '16024.4', NULL),
(53, '2018B/11/53', NULL, 22, '2018-11-12', '18868.2', '0.00', '18868.2', NULL),
(54, '2018B/11/54', NULL, 9, '2018-11-20', '2448.5', '0.00', '2448.5', NULL),
(55, '2018B/11/55', NULL, 23, '2018-11-21', '5162.5', '0.00', '5162.5', NULL),
(56, '2018B/11/56', NULL, 19, '2018-11-22', '6667', '0.00', '6667', NULL),
(57, '2018B/11/57', NULL, 6, '2018-11-27', '8614', '0.00', '8614', NULL),
(58, '2018B/12/58', NULL, 9, '2018-12-17', '2312.8', '0.00', '2312.8', NULL),
(59, '2018B/12/59', NULL, 6, '2018-12-17', '5782', '0.00', '5782', NULL),
(60, '2018B/12/60', NULL, 8, '2018-12-17', '3958.9', '0.00', '3958.9', '2018-12-17'),
(61, '2018B/12/61', NULL, 23, '2018-12-17', '6484.1', '0.00', '6484.1', NULL),
(62, '2018B/12/62', NULL, 20, '2018-12-17', '6018', '0.00', '6018', NULL),
(63, '2019B/01/63', NULL, 4, '2019-01-03', '29205', '0.00', '29205', '2019-01-03'),
(64, '2019B/01/64', NULL, 19, '2019-01-08', '902.7', '0.00', '902.7', NULL),
(65, '2019B/01/65', NULL, 23, '2019-01-08', '3817.3', '0.00', '3817.3', NULL),
(66, '2019B/01/66', NULL, 6, '2019-01-08', '4118.2', '0.00', '4118.2', NULL),
(67, '2019B/01/67', NULL, 6, '2019-01-08', '7062.3', '0.00', '7062.3', NULL),
(68, '2019B/01/68', NULL, 4, '2019-01-19', '19440.5', '0.00', '19440.5', NULL),
(69, '2019B/02/69', NULL, 6, '2019-02-02', '4560.7', '0.00', '4560.7', NULL),
(70, '2019B/02/70', NULL, 20, '2019-02-02', '1374.7', '0.00', '1374.7', NULL),
(71, '2019B/02/71', NULL, 8, '2019-02-02', '4218.5', '0.00', '4218.5', '2019-02-02'),
(72, '2019B/02/72', NULL, 24, '2019-02-04', '24585.3', '0.00', '24585.3', NULL),
(73, '2019B/02/73', NULL, 8, '2019-02-27', '2572.4', '0.00', '2572.4', NULL),
(74, '2019B/02/74', NULL, 9, '2019-02-27', '2584.2', '0.00', '2584.2', NULL),
(75, '2019B/02/75', NULL, 17, '2019-02-27', '1947', '0.00', '1947', NULL),
(76, '2019B/02/76', NULL, 20, '2019-02-27', '1227.2', '0.00', '1227.2', '2019-03-11'),
(77, '2019B/03/77', NULL, 20, '2019-03-11', '1380.6', '0.00', '1380.6', NULL),
(78, '2019B/03/78', NULL, 8, '2019-03-11', '3528.2', '0.00', '3528.2', NULL),
(79, '2019B/04/79', NULL, 19, '2019-04-26', '5900', '0.00', '5900', NULL),
(80, '2019B/04/80', NULL, 23, '2019-04-26', '7310.1', '0.00', '7310.1', NULL),
(81, '2019B/04/81', NULL, 23, '2019-04-26', '7310.1', '0.00', '7310.1', NULL),
(82, '2019B/05/82', NULL, 25, '2019-05-14', '2596', '0.00', '2596', NULL),
(83, '2019B/05/83', NULL, 25, '2019-05-14', '2596', '0.00', '2596', NULL),
(84, '2019B/05/84', NULL, 5, '2019-05-14', '3292.2', '0.00', '3292.2', NULL),
(85, '2019B/05/85', NULL, 20, '2019-05-17', '3551.8', '0.00', '3551.8', NULL),
(86, '2019B/05/86', NULL, 6, '2019-05-17', '5900', '0.00', '5900', NULL),
(87, '2019B/06/87', NULL, 1, '2019-06-06', '11351.6', '0.00', '11351.6', NULL),
(88, '2019B/06/88', NULL, 4, '2019-06-10', '30149', '0.00', '30149', NULL),
(89, '2019B/06/89', NULL, 4, '2019-06-12', '26319.9', '0.00', '26319.9', NULL),
(90, '2019B/06/90', NULL, 8, '2019-06-24', '4607.9', '0.00', '4607.9', NULL),
(91, '2019B/06/91', NULL, 20, '2019-06-24', '3068', '0.00', '3068', NULL),
(92, '2019B/06/92', NULL, 6, '2019-06-24', '4000.2', '0.00', '4000.2', NULL),
(93, '2019B/07/93', NULL, 23, '2019-07-15', '2961.8', '0.00', '2961.8', NULL),
(94, '2019B/07/94', NULL, 22, '2019-07-15', '2584.2', '0.00', '2584.2', '2019-07-15'),
(95, '2019B/07/95', NULL, 17, '2019-07-15', '9912', '0.00', '9912', NULL),
(96, '2019B/07/96', NULL, 6, '2019-07-30', '9298.4', '0.00', '9298.4', NULL),
(97, '2019B/07/97', NULL, 17, '2019-07-30', '3014.9', '0.00', '3014.9', NULL),
(98, '2019B/07/98', NULL, 18, '2019-07-30', '9858.9', '0.00', '9858.9', NULL),
(99, '2019B/08/99', NULL, 17, '2019-08-08', '11210', '0.00', '11210', NULL),
(100, '2019B/09/100', NULL, 6, '2019-09-03', '12390', '0.00', '12390', NULL),
(101, '2019B/09/101', NULL, 6, '2019-09-13', '9150.9', '0.00', '9150.9', NULL),
(102, '2019B/09/102', NULL, 16, '2019-09-13', '6436.9', '0.00', '6436.9', NULL),
(103, '2019B/10/103', NULL, 26, '2019-10-09', '13316.3', '0.00', '13316.3', NULL),
(104, '2019B/10/104', NULL, 26, '2019-10-17', '10861.9', '0.00', '10861.9', NULL),
(105, '2019B/10/105', NULL, 17, '2019-10-24', '4956', '0.00', '4956', NULL),
(106, '2019B/10/106', NULL, 6, '2019-10-24', '5870.5', '0.00', '5870.5', NULL),
(107, '2019B/10/107', NULL, 3, '2019-10-24', '1256.7', '0.00', '1256.7', NULL),
(108, '2019B/10/108', NULL, 18, '2019-10-24', '11428.3', '0.00', '11428.3', NULL),
(109, '2019B/12/109', NULL, 8, '2019-12-06', '8295.4', '0.00', '8295.4', NULL),
(110, '2019B/12/110', NULL, 6, '2019-12-06', '7805.7', '0.00', '7805.7', NULL),
(111, '2020B/01/111', NULL, 18, '2020-01-16', '26685.7', '0.00', '26685.7', NULL),
(112, '2020B/02/112', NULL, 17, '2020-02-17', '17346', '0.00', '17346', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
`brandId` int(11) NOT NULL,
  `brandName` varchar(50) DEFAULT NULL,
  `brandShort` varchar(25) DEFAULT NULL,
  `brandDescription` varchar(150) DEFAULT NULL,
  `brandStatus` int(1) DEFAULT NULL,
  `brandAddDate` date DEFAULT NULL,
  `brandModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`, `brandShort`, `brandDescription`, `brandStatus`, `brandAddDate`, `brandModDate`) VALUES
(1, 'MOON CERA', 'MC', 'Ceramic', 1, '2018-06-25', '2018-06-25'),
(2, 'OPPO', 'OPPO', 'Ceramic', 1, '2018-06-25', NULL),
(3, 'flush tank', 'ft', 'plastic', 1, '2018-06-25', NULL),
(4, 'seat cover ', 'sc', 'plastic', 1, '2018-06-25', NULL),
(5, 'PUPA', 'PUPA', 'CERAMICS', 1, '2020-07-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cashmode`
--

CREATE TABLE IF NOT EXISTS `tbl_cashmode` (
`cid` int(11) NOT NULL,
  `cashMode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cashmode`
--

INSERT INTO `tbl_cashmode` (`cid`, `cashMode`) VALUES
(1, 'CASH'),
(2, 'CHECK'),
(3, 'BANK TRNSFER');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
`catId` int(11) NOT NULL,
  `catName` varchar(50) DEFAULT NULL,
  `catShort` varchar(25) DEFAULT NULL,
  `catDescription` varchar(100) DEFAULT NULL,
  `catStatus` int(1) DEFAULT NULL,
  `catAddDate` date DEFAULT NULL,
  `catModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`, `catShort`, `catDescription`, `catStatus`, `catAddDate`, `catModDate`) VALUES
(1, 'Water Closets', 'EWC', 'Ceramic', 1, '2018-06-25', NULL),
(2, 'One Piece Closets', '1pc', 'Ceramic', 1, '2018-06-25', NULL),
(3, 'Wash Basins', 'WB', 'Ceramic', 1, '2018-06-25', '2018-10-27'),
(4, 'Indian Closets', 'IC', 'Ceramic', 1, '2018-06-25', NULL),
(5, 'P Trap', 'P Trap', 'Ceramic', 1, '2018-06-25', NULL),
(6, 'Flush Tank', 'FT', 'Plastic', 1, '2018-06-25', NULL),
(7, 'Seat Cover', 'SC', 'Plastic', 1, '2018-06-25', NULL),
(8, 'BOLT SET', 'W.B.BOLT', 'BOLD', 1, '2020-07-01', NULL),
(9, 'BROSS SCREW SET', 'B.S.S', 'BROSS', 1, '2020-07-01', NULL),
(10, 'RACK BOLT', 'W.M.R B', 'BROSS', 1, '2020-07-01', '2020-07-01'),
(11, 'URINAL BRACKET', 'U.B', 'BROSS', 1, '2020-07-01', NULL),
(12, 'KITCHEN SINK', 'SINK', 'STEEL', 1, '2020-07-01', NULL),
(13, 'TILO BOND', 'T.B', 'LIME', 1, '2020-07-01', NULL),
(14, 'TILO GROUT', 'T.G', 'GROUT', 1, '2020-07-01', NULL),
(15, 'TILO ADMIX', 'T.A', 'ADMIX', 1, '2020-07-01', NULL),
(16, 'FAUCET CLEANER', 'CLEANER', 'LIQUID', 1, '2020-07-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE IF NOT EXISTS `tbl_client` (
`clientId` int(11) NOT NULL,
  `clientName` varchar(50) DEFAULT NULL,
  `clientcontactName` varchar(50) DEFAULT NULL,
  `clientPhone` varchar(12) DEFAULT NULL,
  `clientEmail` varchar(25) DEFAULT NULL,
  `clientGSTIN` varchar(25) DEFAULT NULL,
  `clientGroup` int(2) DEFAULT NULL,
  `clientBillingAdd` varchar(200) DEFAULT NULL,
  `clientBillingCity` varchar(25) DEFAULT NULL,
  `clientBillingState` varchar(25) DEFAULT NULL,
  `clientBillingPincode` varchar(6) DEFAULT NULL,
  `clientBillingCountry` varchar(25) DEFAULT NULL,
  `clientShipping` int(1) DEFAULT NULL,
  `clientShippingAdd` varchar(200) DEFAULT NULL,
  `clientShippingCity` varchar(25) DEFAULT NULL,
  `clientShippingState` varchar(25) DEFAULT NULL,
  `clientShippingPincode` varchar(6) DEFAULT NULL,
  `clientShippingCountry` varchar(25) DEFAULT NULL,
  `clientType` int(1) DEFAULT NULL,
  `clientStatus` int(1) DEFAULT NULL,
  `clientAddDate` date DEFAULT NULL,
  `clientModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`clientId`, `clientName`, `clientcontactName`, `clientPhone`, `clientEmail`, `clientGSTIN`, `clientGroup`, `clientBillingAdd`, `clientBillingCity`, `clientBillingState`, `clientBillingPincode`, `clientBillingCountry`, `clientShipping`, `clientShippingAdd`, `clientShippingCity`, `clientShippingState`, `clientShippingPincode`, `clientShippingCountry`, `clientType`, `clientStatus`, `clientAddDate`, `clientModDate`) VALUES
(1, 'PRANESH TRADERS', 'NARAYANAN SELVAKUMARI', '9791701617', NULL, '33DPEPS1412G1Z8', NULL, 'KANYAKUMARI', 'Nagercoil', '33', '629002', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-25', '2018-11-09'),
(2, 'E.J.TRADERS', 'E.J.', '9629842878', NULL, '33ABHPE5743L1ZM', NULL, 'PUNGULATHU VILAI ROAD,KANYAKUMARI.', 'KANYA KUMARI', '33', '629702', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-25', NULL),
(3, 'A S TRADERS', 'A.S.', '9442714639', NULL, '33GHLPS8518F1ZW', NULL, 'THUCKALAY', 'THUCKALAY', '33', '629175', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-25', '2018-06-25'),
(4, 'SUYAMBU TRADERS', 'SUYAMBULINGAM', '8220940828', 'munshiceramic@gmail.com', '33DIQPS6371P1Z7', NULL, '192,GREAT COTTON ROAD,THOOTHUKUDI', 'TUTICORIN', '33', '628001', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-27', NULL),
(5, 'C.Ebanezer', 'Thangam Hardwares', '9894465163', NULL, '33AASPE5973A1ZS', NULL, 'Thangam hardwares,\r\n6-45A6,\r\nColachel Road,\r\nPalapallam-629159.', 'kerunkel', '33', '629159', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(6, 'C.SIVA ANAND ANAND HARDWARES AND ELECTRICALS', 'C.SIVA ANAND ANAND HARDWARES AND ELECTRICALS', '9487925491', NULL, '33CUMPS7718F1Z8', NULL, 'NEAR NEDUNKULAM JUNCTION,\r\nMAIN ROAD,\r\nARUMANAI.', 'ARUMANAI', '33', '629151', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', '2018-09-07'),
(7, 'Annai S.A.K.Hardwares and Elecricals', 'Sasi Ajin kumar', '8675081903', NULL, '33BNBPA2851A1ZY', NULL, 'Annai S.A.K.Hardwares,\r\n8-108/1,\r\nVadasery vilai,\r\nPayanam,\r\nUnnamalai kadai.', 'Marthandam', '33', '629179', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(8, 'Gopika Traders', 'Gopika Traders', '9446180200', NULL, '33CXYPS7283N1Z5', NULL, 'Gopika Traders\r\nRajee Building 4-66\r\nHigh School Road,\r\nKannumamoodu.', 'Kannumamoodu', '33', '629170', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(9, 'George Hardwares', 'George Hardwares', '9659644429', NULL, '33BMSPA4354C1ZD', NULL, 'George Hardwares,\r\n4-124/2\r\nColachel Road\r\nUdayar vilai.', 'Colachel', '33', '629251', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(10, 'J.J.Hardwares', 'J.J.Hardwares', '9487412220', NULL, '33ARDPJ1962E1Z6', NULL, 'J.J.Hardwares,\r\n3-134E\r\nOPP.Tamilnadu Mercntile Bank\r\nVerkilambi.', 'Verkilambi', '33', '629166', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(11, 'Jothi Electrical', 'Jothi Electrical', '9489285285', NULL, '33AMZPV6144P1ZV', NULL, 'Jothi Electrical,\r\nMarket Junction 15/20\r\nNear Canara Bank\r\nKulasekharam.', 'Kulasekharam', '33', '629161', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(12, 'Matha hardwares and electricals', 'Ajin', '9787640727', NULL, NULL, NULL, 'kumarankudi \r\nveeyannoor ', 'Kumarankudi', '33', '629177', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(13, 'Annai Velakanni Hardwares', 'Annai Velakanni Hardwares', '7708940036', NULL, '33ATLPA2872N1ZH', NULL, 'Annai Velakanni Hardwares,\r\nAmsi,\r\nThengapattanam.', 'Thengapattanam.', '33', '629173', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-06-29', NULL),
(14, 'Abi Traders', 'Abi Traders', '9944210662', NULL, '33BBSPA7671R1ZV', NULL, 'Kadaikadu\r\nAmmandi vilai\r\nkanyakumari disrict', 'ammandi vilai', '33', '629204', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-07-09', NULL),
(15, 'Nathan Hardware', 'Nathan Hardware', '9443449355', NULL, '33AIHPJ4021B1Z2', NULL, 'Palace road\r\nthuckalay', 'THUCKALAY', '33', '629175', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-07-09', NULL),
(16, 'siva electricals and hardware  ', 'siva electricals and hardware  ', '9150638873', NULL, '33FAKPS9180J1ZZ', NULL, 'Depo road\r\nsree raman konam\r\nthiruvattar.', 'thiruvattar.', '33', '629177', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-07-27', NULL),
(17, 'Fayas', 'Fayas', '9443607543', NULL, '33ALWPM1763H1R', NULL, 'Main road\r\ncolachal', 'colachal', '33', '629251', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-07-27', NULL),
(18, 'L.K.Hardwares', 'L.K.Hardwares', '9367547387', NULL, '33BGRPK6010JZD', NULL, 'L.K.Hardwares\r\nkanyakumari', 'kanyakumari', '33', '629702', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-08-06', NULL),
(19, 'Gandhimathi Tiles & Hardwares', 'Gandhimathi Tiles & Hardwares', '9443692643', NULL, '33ALLPN6636K1ZO', NULL, 'Near Kunelumoodu \r\nKarungal', 'karungal', '33', '629157', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-08-09', NULL),
(20, 'S.R.PLYWOOD GLASSES', 'S.R.PLYWOOD GLASSES', '9487023217', NULL, '33AOCPR2234K1Z1', NULL, 'MELPURAM JUNCTION,\r\nPACODE (P.O)', 'MARTHADAM', '33', '629168', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-09-07', NULL),
(21, 'Bharath Electrical', 'Bharath Electrical', '9600072880', NULL, '33AXUPP1343C1ZK', NULL, '28,Ghandhi Vedhi(Kottai)\r\nKalakadu', 'Kalakadu', '33', '627501', 'india', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-11-07', '2018-11-07'),
(22, 'Nelson Building Materials', 'Nelson Building Materials', '9442831377', NULL, '33DTUPR5647J1ZT', NULL, '4-57B, Cherottukonam\r\nNattalam (p.o.)-629165', 'MARTHANDAM', '33', '629165', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-11-09', NULL),
(23, 'M.JOHN GLASTON,MATHA HARDWARES', 'M.JOHN GLASTON,MATHA HARDWARES', '9444701922', NULL, '33AORPJ3133N1ZO', NULL, ' 10-106B\r\n MIDALAKADU\r\nPALAPALLAM,', 'kerunkel', '33', '629159', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2018-11-21', NULL),
(24, 'Modern Tiles and Sanitarywares', 'Abdul Saleem Malicka Pillai', '9791666378', 'moderntiles2019@gmail.com', '33DROPM0724D1Z1', NULL, '100D, Beach road\r\nKottar.\r\n', 'Nagercoil', '33', '629002', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-02-02', NULL),
(25, 'Amalraj Hardwares', 'Amalraj', '9677969717', 'amalrajhardwares@mail.com', '33AVZPJ1154E1ZK', NULL, '2-40A, Main Road,\r\nNear Radhakrishnancoil,\r\nMonday Market,\r\nNeyyoor-629802', 'Monday Market', '33', '629802', 'India', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-05-09', NULL),
(26, 'Makam Traders', 'Ratheesh', '9995775389', NULL, '32LXVPS3066F1ZT', NULL, 'Makam traders\r\nPlumping & Sanitaries\r\nNear Petrol Pump\r\nKarakonam', 'Karakonam', '32', '695504', 'india', 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '2019-10-08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE IF NOT EXISTS `tbl_company` (
`compId` int(11) NOT NULL,
  `compName` varchar(25) DEFAULT NULL,
  `compAddress` varchar(200) DEFAULT NULL,
  `compCity` varchar(25) DEFAULT NULL,
  `compState` int(2) DEFAULT NULL,
  `compPin` varchar(25) DEFAULT NULL,
  `compPhone` varchar(12) DEFAULT NULL,
  `compEmail` varchar(25) DEFAULT NULL,
  `compWeb` varchar(25) DEFAULT NULL,
  `compGSTIN` varchar(25) DEFAULT NULL,
  `compPAN` varchar(25) DEFAULT NULL,
  `compAddDate` date DEFAULT NULL,
  `compModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`compId`, `compName`, `compAddress`, `compCity`, `compState`, `compPin`, `compPhone`, `compEmail`, `compWeb`, `compGSTIN`, `compPAN`, `compAddDate`, `compModDate`) VALUES
(1, 'S.V.R TRADERS', '5-226/1, CHETTICHAR VILAI, VEEYANOOR POST', 'MARTHANDAM', 33, '629177', '7373593779', 'svrtraders2018@gmail.com', 'www.svrtraders.com', '33CLPPR5722N2ZE', 'CLPPR5722N', '2018-06-19', '2018-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cusreceipt`
--

CREATE TABLE IF NOT EXISTS `tbl_cusreceipt` (
`crid` int(11) NOT NULL,
  `rRef` varchar(15) DEFAULT NULL,
  `rCusId` int(11) DEFAULT NULL,
  `rCusAmount` int(11) DEFAULT NULL,
  `rCusMode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE IF NOT EXISTS `tbl_group` (
`groupId` int(11) NOT NULL,
  `groupName` varchar(25) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
`itemId` int(11) NOT NULL,
  `itemName` varchar(25) DEFAULT NULL,
  `itemShort` varchar(10) DEFAULT NULL,
  `itemDescription` varchar(25) DEFAULT NULL,
  `itemHSN` varchar(16) DEFAULT NULL,
  `itemStatus` int(1) DEFAULT NULL,
  `itemAddDate` date DEFAULT NULL,
  `itemModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item`
--

INSERT INTO `tbl_item` (`itemId`, `itemName`, `itemShort`, `itemDescription`, `itemHSN`, `itemStatus`, `itemAddDate`, `itemModDate`) VALUES
(1, 'EWC ''S'' Trap White', 'EWC', 'Ceramic', '69101000', NULL, '2018-06-25', '2019-04-25'),
(2, 'OP White 20"', 'OP', 'Ceramic', '69101000', NULL, '2018-06-25', '2019-04-25'),
(3, 'OP A.B 20"', 'OP AB', 'Ceramic', '69101000', NULL, '2018-06-25', '2018-06-25'),
(4, 'OP IV 20"', 'OP IV', 'Ceramic', '69101000', NULL, '2018-06-25', '2018-06-25'),
(5, 'OP pink 20"', 'OP pink', 'Ceramic', '69101000', NULL, '2018-06-25', '2018-06-25'),
(6, 'OP blue 20"', 'OP blue', 'Ceramic', '69101000', NULL, '2018-06-25', '2018-06-25'),
(7, 'Wash Basin', 'WB', 'Ceramic', '69101000', NULL, '2018-06-25', NULL),
(8, 'P Trap', 'P Trap', 'Ceramic', '69101000', NULL, '2018-06-25', NULL),
(9, 'Flush Tank White', 'Tank White', 'Plastic', '39222000', NULL, '2018-06-25', '2018-06-25'),
(10, 'Flush Tank A B', 'Tank A B', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(11, 'Flush Tank I V', 'Tank I V', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(12, 'Flush Tank O B', 'Tank O B', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(13, 'Flush Tank Pink', 'Tank Pink', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(14, 'Seat Cover White', 'S.C s\\w', 'Plastic', '39222000', NULL, '2018-06-25', '2018-06-25'),
(15, 'Seat Cover A B', 'S.C A B', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(16, 'Seat Cover O B', 'S.C O B', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(17, 'Seat Cover I V', 'S.C I V', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(18, 'Seat Cover Pink', 'S.C Pink', 'Plastic', '39222000', NULL, '2018-06-25', NULL),
(19, 'One Pice', '1pc', 'Ceramic', '69101000', NULL, '2018-06-26', NULL),
(20, 'Flush Tank Green', 'Tank green', 'Plastic', '39222000', NULL, '2018-06-26', NULL),
(21, 'Seat Cover green', 'S.C green', 'Plastic', '39222000', NULL, '2018-06-26', NULL),
(22, 'Vitrosa set ', 'VS', 'Ceramic', '69101000', NULL, '2018-10-27', NULL),
(23, 'OP magenta 20"', 'OP MG', 'Ceramic', '69101000', NULL, '2018-10-27', '2018-10-27'),
(24, 'OP red brown 20"', 'OP RB', 'Ceramic', '69101000', NULL, '2018-10-27', '2018-10-27'),
(25, 'OP Coffee Brown 20"', 'OP CB', 'Ceramic', '69101000', NULL, '2018-10-27', '2018-10-27'),
(26, 'OP Green 20"', 'OP green', 'Ceramic', '69101000', NULL, '2018-10-27', '2018-10-27'),
(27, 'OP Gry 20"', 'OP gry', 'Ceramic', '69101000', NULL, '2018-10-27', '2018-10-27'),
(28, 'Wash Basin 20*16', 'Prime', 'Ceramic', '69101000', NULL, '2018-10-27', NULL),
(29, 'Wash Basin 14*11', 'Siegel', 'Ceramic', '69101000', NULL, '2018-10-27', NULL),
(30, 'ONE PIECE POLO WHITE', 'POLO', 'CERAMICS', '6910', NULL, '2020-07-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_itembill`
--

CREATE TABLE IF NOT EXISTS `tbl_itembill` (
`itemBillId` int(11) NOT NULL,
  `itemBillNo` varchar(25) DEFAULT NULL,
  `itemId` int(3) DEFAULT NULL,
  `itemPurchasePrice` decimal(10,2) DEFAULT NULL,
  `itemPrice` decimal(10,2) DEFAULT NULL,
  `itemSupplier` int(3) DEFAULT NULL,
  `itemQuantity` varchar(15) DEFAULT NULL,
  `itemDiscount` varchar(15) DEFAULT NULL,
  `itemGST` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=710 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_itembill`
--

INSERT INTO `tbl_itembill` (`itemBillId`, `itemBillNo`, `itemId`, `itemPurchasePrice`, `itemPrice`, `itemSupplier`, `itemQuantity`, `itemDiscount`, `itemGST`) VALUES
(1, '2018B/06/1', 5, '155.00', '315.00', 1, '1', '0', '56.7'),
(2, '2018B/06/1', 4, '70.00', '130.00', 1, '5', '0', '117'),
(3, '2018B/06/1', 17, '60.00', '60.00', 1, '5', '0', '54'),
(4, '2018B/06/2', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(5, '2018B/06/2', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(6, '2018B/06/3', 13, '90.00', '215.00', 1, '1', '0', '38.7'),
(7, '2018B/06/3', 14, '90.00', '215.00', 1, '1', '0', '38.7'),
(8, '2018B/06/3', 15, '90.00', '215.00', 1, '1', '0', '38.7'),
(9, '2018B/06/3', 17, '60.00', '60.00', 1, '3', '0', '32.4'),
(10, '2018B/06/3', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(11, '2018B/06/4', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(12, '2018B/06/4', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(13, '2018B/06/4', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(14, '2018B/06/4', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(15, '2018B/06/5', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(16, '2018B/06/5', 12, '85.00', '205.00', 1, '1', '0', '36.9'),
(17, '2018B/06/5', 13, '90.00', '215.00', 1, '1', '0', '38.7'),
(18, '2018B/06/5', 14, '90.00', '215.00', 1, '1', '0', '38.7'),
(19, '2018B/06/5', 15, '90.00', '215.00', 1, '1', '0', '38.7'),
(20, '2018B/06/5', 16, '90.00', '215.00', 1, '1', '0', '38.7'),
(21, '2018B/06/5', 4, '70.00', '130.00', 1, '4', '0', '93.6'),
(22, '2018B/06/6', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(23, '2018B/06/6', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(24, '2018B/06/7', 12, '85.00', '205.00', 1, '15', '0', '553.5'),
(25, '2018B/06/7', 13, '90.00', '215.00', 1, '3', '0', '116.1'),
(26, '2018B/06/7', 14, '90.00', '215.00', 1, '3', '0', '116.1'),
(27, '2018B/06/7', 15, '90.00', '215.00', 1, '3', '0', '116.1'),
(28, '2018B/06/7', 16, '90.00', '215.00', 1, '3', '0', '116.1'),
(29, '2018B/06/7', 17, '60.00', '60.00', 1, '10', '0', '108'),
(30, '2018B/06/7', 7, '140.00', '290.00', 1, '8', '0', '417.6'),
(31, '2018B/06/7', 8, '140.00', '290.00', 1, '5', '0', '261'),
(32, '2018B/06/7', 9, '140.00', '290.00', 1, '5', '0', '261'),
(33, '2018B/06/7', 10, '140.00', '290.00', 1, '5', '0', '261'),
(34, '2018B/06/7', 11, '140.00', '290.00', 1, '5', '0', '261'),
(35, '2018B/06/7', 20, '60.00', '125.00', 1, '8', '0', '180'),
(36, '2018B/06/7', 21, '60.00', '125.00', 1, '5', '0', '112.5'),
(37, '2018B/06/7', 22, '60.00', '125.00', 1, '5', '0', '112.5'),
(38, '2018B/06/7', 23, '60.00', '125.00', 1, '5', '0', '112.5'),
(39, '2018B/06/7', 24, '60.00', '125.00', 1, '5', '0', '112.5'),
(40, '2018B/06/8', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(41, '2018B/06/8', 4, '70.00', '130.00', 1, '1', '0', '23.4'),
(42, '2018B/06/8', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(43, '2018B/06/8', 8, '140.00', '290.00', 1, '2', '0', '104.4'),
(44, '2018B/06/8', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(45, '2018B/06/8', 21, '60.00', '125.00', 1, '2', '0', '45'),
(46, '2018B/06/9', 16, '90.00', '215.00', 1, '2', '0', '77.4'),
(47, '2018B/06/9', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(48, '2018B/06/9', 14, '90.00', '215.00', 1, '1', '0', '38.7'),
(49, '2018B/06/9', 13, '90.00', '215.00', 1, '1', '0', '38.7'),
(50, '2018B/06/9', 4, '70.00', '130.00', 1, '3', '0', '70.2'),
(51, '2018B/06/9', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(52, '2018B/06/9', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(53, '2018B/06/9', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(54, '2018B/06/9', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(55, '2018B/06/9', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(56, '2018B/06/9', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(57, '2018B/06/9', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(58, '2018B/06/9', 21, '60.00', '125.00', 1, '1', '0', '22.5'),
(59, '2018B/06/9', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(60, '2018B/06/10', 12, '85.00', '205.00', 1, '2', '0', '73.8'),
(61, '2018B/06/10', 14, '90.00', '215.00', 1, '2', '0', '77.4'),
(62, '2018B/06/10', 16, '90.00', '215.00', 1, '2', '0', '77.4'),
(63, '2018B/06/10', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(64, '2018B/06/10', 17, '60.00', '60.00', 1, '5', '0', '54'),
(65, '2018B/06/10', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(66, '2018B/06/10', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(67, '2018B/06/10', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(68, '2018B/06/10', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(69, '2018B/06/10', 23, '60.00', '125.00', 1, '2', '0', '45'),
(70, '2018B/06/10', 22, '60.00', '125.00', 1, '2', '0', '45'),
(71, '2018B/06/10', 24, '60.00', '125.00', 1, '2', '0', '45'),
(72, '2018B/06/11', 12, '85.00', '205.00', 1, '2', '0', '73.8'),
(73, '2018B/06/11', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(74, '2018B/06/11', 14, '90.00', '215.00', 1, '2', '0', '77.4'),
(75, '2018B/06/11', 16, '90.00', '215.00', 1, '2', '0', '77.4'),
(76, '2018B/06/11', 17, '60.00', '60.00', 1, '4', '0', '43.2'),
(77, '2018B/06/12', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(78, '2018B/06/12', 4, '70.00', '130.00', 1, '1', '0', '23.4'),
(79, '2018B/06/12', 8, '140.00', '290.00', 1, '3', '0', '156.6'),
(80, '2018B/06/12', 21, '60.00', '125.00', 1, '3', '0', '67.5'),
(81, '2018B/06/13', 5, '155.00', '315.00', 1, '25', '0', '1417.5'),
(82, '2018B/06/13', 7, '140.00', '290.00', 1, '6', '0', '313.2'),
(83, '2018B/06/13', 8, '140.00', '290.00', 1, '4', '0', '208.8'),
(84, '2018B/06/13', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(85, '2018B/06/13', 10, '140.00', '290.00', 1, '4', '0', '208.8'),
(86, '2018B/06/13', 11, '140.00', '290.00', 1, '4', '0', '208.8'),
(87, '2018B/06/13', 20, '60.00', '125.00', 1, '5', '0', '112.5'),
(88, '2018B/06/13', 21, '60.00', '125.00', 1, '4', '0', '90'),
(89, '2018B/06/13', 22, '60.00', '125.00', 1, '5', '0', '112.5'),
(90, '2018B/06/13', 23, '60.00', '125.00', 1, '4', '0', '90'),
(91, '2018B/06/13', 24, '60.00', '125.00', 1, '4', '0', '90'),
(92, '2018B/07/14', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(93, '2018B/07/14', 4, '70.00', '130.00', 1, '8', '0', '187.2'),
(94, '2018B/07/14', 10, '140.00', '290.00', 1, '3', '0', '156.6'),
(95, '2018B/07/14', 11, '140.00', '290.00', 1, '3', '0', '156.6'),
(96, '2018B/07/14', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(97, '2018B/07/15', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(98, '2018B/07/15', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(99, '2018B/07/15', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(100, '2018B/07/15', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(101, '2018B/07/15', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(102, '2018B/07/15', 20, '60.00', '125.00', 1, '2', '0', '45'),
(103, '2018B/07/15', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(104, '2018B/07/15', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(105, '2018B/07/15', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(106, '2018B/07/16', 5, '155.00', '315.00', 1, '10', '0', '567'),
(107, '2018B/07/16', 17, '60.00', '60.00', 1, '5', '0', '54'),
(108, '2018B/07/16', 12, '85.00', '205.00', 1, '4', '0', '147.6'),
(109, '2018B/07/17', 5, '155.00', '315.00', 1, '10', '0', '567'),
(110, '2018B/07/17', 17, '60.00', '60.00', 1, '5', '0', '54'),
(111, '2018B/07/17', 12, '85.00', '205.00', 1, '4', '0', '147.6'),
(112, '2018B/07/18', 5, '155.00', '315.00', 1, '1', '0', '56.7'),
(113, '2018B/07/18', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(114, '2018B/07/18', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(115, '2018B/07/19', 5, '155.00', '315.00', 1, '15', '0', '850.5'),
(116, '2018B/07/19', 12, '85.00', '205.00', 1, '2', '0', '73.8'),
(117, '2018B/07/19', 13, '90.00', '215.00', 1, '3', '0', '116.1'),
(118, '2018B/07/19', 14, '90.00', '215.00', 1, '3', '0', '116.1'),
(119, '2018B/07/19', 15, '90.00', '215.00', 1, '3', '0', '116.1'),
(120, '2018B/07/19', 4, '70.00', '130.00', 1, '15', '0', '351'),
(121, '2018B/07/19', 17, '60.00', '60.00', 1, '10', '0', '108'),
(122, '2018B/07/20', 7, '140.00', '290.00', 1, '5', '0', '261'),
(123, '2018B/07/20', 8, '140.00', '290.00', 1, '4', '0', '208.8'),
(124, '2018B/07/20', 9, '140.00', '290.00', 1, '4', '0', '208.8'),
(125, '2018B/07/20', 10, '140.00', '290.00', 1, '4', '0', '208.8'),
(126, '2018B/07/20', 11, '140.00', '290.00', 1, '4', '0', '208.8'),
(127, '2018B/07/20', 20, '60.00', '125.00', 1, '5', '0', '112.5'),
(128, '2018B/07/20', 21, '60.00', '125.00', 1, '5', '0', '112.5'),
(129, '2018B/07/20', 22, '60.00', '125.00', 1, '4', '0', '90'),
(130, '2018B/07/20', 23, '60.00', '125.00', 1, '4', '0', '90'),
(131, '2018B/07/20', 24, '60.00', '125.00', 1, '4', '0', '90'),
(132, '2018B/07/21', 12, '85.00', '205.00', 1, '2', '0', '73.8'),
(133, '2018B/07/21', 13, '90.00', '215.00', 1, '2', '0', '77.4'),
(134, '2018B/07/21', 14, '90.00', '215.00', 1, '2', '0', '77.4'),
(135, '2018B/07/21', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(136, '2018B/07/21', 4, '70.00', '130.00', 1, '3', '0', '70.2'),
(137, '2018B/07/22', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(138, '2018B/07/22', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(139, '2018B/07/22', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(140, '2018B/07/22', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(141, '2018B/07/22', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(142, '2018B/07/22', 4, '70.00', '130.00', 1, '7', '0', '163.8'),
(143, '2018B/08/23', 13, '90.00', '215.00', 1, '3', '0', '116.1'),
(144, '2018B/08/24', 17, '60.00', '60.00', 1, '15', '0', '162'),
(145, '2018B/08/24', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(146, '2018B/08/24', 13, '90.00', '215.00', 1, '2', '0', '77.4'),
(147, '2018B/08/24', 14, '90.00', '215.00', 1, '1', '0', '38.7'),
(148, '2018B/08/24', 12, '85.00', '205.00', 1, '1', '0', '36.9'),
(149, '2018B/08/24', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(150, '2018B/08/25', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(151, '2018B/08/23', 17, NULL, '60.00', NULL, '5', '0', '54'),
(152, '2018B/08/26', 5, '155.00', '315.00', 1, '7', '0', '396.9'),
(153, '2018B/08/26', 18, '900.00', '1500.00', 1, '1', '0', '270'),
(154, '2018B/08/27', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(155, '2018B/08/27', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(156, '2018B/08/27', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(157, '2018B/08/27', 11, '140.00', '290.00', 1, '5', '0', '261'),
(158, '2018B/08/27', 24, '60.00', '125.00', 1, '5', '0', '112.5'),
(159, '2018B/08/27', 23, '60.00', '125.00', 1, '2', '0', '45'),
(160, '2018B/08/27', 20, '60.00', '125.00', 1, '2', '0', '45'),
(161, '2018B/08/28', 18, '900.00', '1500.00', 1, '2', '0', '540'),
(162, '2018B/09/29', 5, '155.00', '315.00', 1, '10', '0', '567'),
(163, '2018B/09/29', 12, '85.00', '205.00', 1, '2', '0', '73.8'),
(164, '2018B/09/29', 14, '90.00', '215.00', 1, '3', '0', '116.1'),
(165, '2018B/09/29', 17, '60.00', '60.00', 1, '15', '0', '162'),
(166, '2018B/09/30', 12, '85.00', '205.00', 1, '4', '0', '147.6'),
(167, '2018B/09/30', 14, '90.00', '215.00', 1, '3', '0', '116.1'),
(168, '2018B/09/30', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(169, '2018B/09/30', 4, '70.00', '130.00', 1, '4', '0', '93.6'),
(170, '2018B/09/30', 17, '60.00', '60.00', 1, '10', '0', '108'),
(171, '2018B/09/31', 12, '85.00', '205.00', 1, '3', '0', '110.7'),
(172, '2018B/09/31', 15, '90.00', '215.00', 1, '3', '0', '116.1'),
(173, '2018B/09/31', 14, '90.00', '215.00', 1, '2', '0', '77.4'),
(174, '2018B/09/31', 4, '70.00', '130.00', 1, '8', '0', '187.2'),
(175, '2018B/09/31', 17, '60.00', '60.00', 1, '10', '0', '108'),
(176, '2018B/09/32', 4, '70.00', '130.00', 1, '3', '0', '70.2'),
(177, '2018B/09/33', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(178, '2018B/09/33', 7, '140.00', '290.00', 1, '8', '0', '417.6'),
(179, '2018B/09/33', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(180, '2018B/09/33', 20, '60.00', '125.00', 1, '6', '0', '135'),
(181, '2018B/09/33', 23, '60.00', '125.00', 1, '2', '0', '45'),
(182, '2018B/09/34', 18, '900.00', '1500.00', 1, '1', '0', '270'),
(183, '2018B/10/35', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(184, '2018B/10/35', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(185, '2018B/10/35', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(186, '2018B/10/35', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(187, '2018B/10/35', 17, '60.00', '60.00', 1, '13', '0', '140.4'),
(188, '2018B/10/35', 12, '85.00', '205.00', 1, '4', '0', '147.6'),
(189, '2018B/10/35', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(190, '2018B/10/35', 14, '90.00', '215.00', 1, '3', '0', '116.1'),
(191, '2018B/10/36', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(192, '2018B/10/36', 15, '90.00', '215.00', 1, '2', '0', '77.4'),
(193, '2018B/10/36', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(194, '2018B/10/36', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(195, '2018B/10/36', 20, '60.00', '125.00', 1, '2', '0', '45'),
(196, '2018B/10/36', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(197, '2018B/10/37', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(198, '2018B/10/37', 12, '85.00', '205.00', 1, '3', '0', '110.7'),
(199, '2018B/10/37', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(200, '2018B/10/37', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(201, '2018B/10/37', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(202, '2018B/10/37', 20, '60.00', '125.00', 1, '2', '0', '45'),
(203, '2018B/10/37', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(204, '2018B/10/37', 24, '60.00', '125.00', 1, '2', '0', '45'),
(205, '2018B/10/38', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(206, '2018B/10/38', 11, '140.00', '290.00', 1, '5', '0', '261'),
(207, '2018B/10/38', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(208, '2018B/10/38', 22, '60.00', '125.00', 1, '2', '0', '45'),
(209, '2018B/10/38', 24, '60.00', '125.00', 1, '5', '0', '112.5'),
(210, '2018B/10/39', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(211, '2018B/10/39', 12, '85.00', '205.00', 1, '5', '0', '184.5'),
(212, '2018B/10/39', 4, '70.00', '130.00', 1, '4', '0', '93.6'),
(213, '2018B/10/39', 8, '140.00', '290.00', 1, '2', '0', '104.4'),
(214, '2018B/10/39', 21, '60.00', '125.00', 1, '2', '0', '45'),
(215, '2018B/10/40', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(216, '2018B/10/40', 4, '70.00', '130.00', 1, '2', '0', '46.8'),
(217, '2018B/10/41', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(218, '2018B/10/41', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(219, '2018B/10/41', 8, '140.00', '290.00', 1, '2', '0', '104.4'),
(220, '2018B/10/41', 25, '60.00', '125.00', 1, '2', '0', '45'),
(221, '2018B/10/41', 21, '60.00', '125.00', 1, '2', '0', '45'),
(222, '2018B/10/41', 15, '100.00', '215.00', 1, '5', '0', '193.5'),
(223, '2018B/10/41', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(224, '2018B/10/41', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(225, '2018B/10/41', 28, '100.00', '215.00', 1, '3', '0', '116.1'),
(226, '2018B/10/41', 18, '900.00', '1500.00', 1, '1', '0', '270'),
(227, '2018B/10/41', 26, '450.00', '700.00', 1, '3', '0', '378'),
(228, '2018B/10/41', 33, '100.00', '175.00', 1, '3', '0', '94.5'),
(229, '2018B/10/41', 17, '60.00', '60.00', 1, '8', '0', '86.4'),
(230, '2018B/10/42', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(231, '2018B/10/42', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(232, '2018B/10/42', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(233, '2018B/10/42', 30, '100.00', '215.00', 1, '1', '0', '38.7'),
(234, '2018B/10/42', 29, '100.00', '215.00', 1, '1', '0', '38.7'),
(235, '2018B/10/42', 12, '90.00', '205.00', 1, '1', '0', '36.9'),
(236, '2018B/10/42', 17, '60.00', '60.00', 1, '2', '0', '21.6'),
(237, '2018B/10/42', 26, '450.00', '700.00', 1, '1', '0', '126'),
(238, '2018B/10/42', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(239, '2018B/10/42', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(240, '2018B/10/42', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(241, '2018B/10/42', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(242, '2018B/10/42', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(243, '2018B/10/42', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(244, '2018B/10/42', 25, '60.00', '125.00', 1, '2', '0', '45'),
(245, '2018B/10/42', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(246, '2018B/10/43', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(247, '2018B/10/43', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(248, '2018B/10/43', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(249, '2018B/10/43', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(250, '2018B/10/43', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(251, '2018B/10/43', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(252, '2018B/10/43', 25, '60.00', '125.00', 1, '2', '0', '45'),
(253, '2018B/10/43', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(254, '2018B/10/44', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(255, '2018B/10/44', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(256, '2018B/10/44', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(257, '2018B/10/44', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(258, '2018B/10/44', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(259, '2018B/10/44', 12, '90.00', '205.00', 1, '1', '0', '36.9'),
(260, '2018B/10/44', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(261, '2018B/10/44', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(262, '2018B/10/44', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(263, '2018B/10/44', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(264, '2018B/10/44', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(265, '2018B/10/44', 26, '450.00', '700.00', 1, '3', '0', '378'),
(266, '2018B/10/44', 17, '60.00', '60.00', 1, '7', '0', '75.6'),
(267, '2018B/10/45', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(268, '2018B/10/45', 26, '450.00', '700.00', 1, '5', '0', '630'),
(269, '2018B/10/45', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(270, '2018B/10/45', 21, '60.00', '125.00', 1, '1', '0', '22.5'),
(271, '2018B/10/46', 33, '100.00', '175.00', 1, '2', '0', '63'),
(272, '2018B/10/46', 4, '90.00', '130.00', 1, '2', '0', '46.8'),
(273, '2018B/10/47', 5, '155.00', '315.00', 1, '16', '0', '907.2'),
(274, '2018B/10/47', 26, '450.00', '700.00', 1, '6', '0', '756'),
(275, '2018B/10/47', 8, '140.00', '290.00', 1, '2', '0', '104.4'),
(276, '2018B/10/47', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(277, '2018B/10/47', 22, '60.00', '125.00', 1, '5', '0', '112.5'),
(278, '2018B/10/47', 21, '60.00', '125.00', 1, '2', '0', '45'),
(279, '2018B/10/47', 25, '60.00', '125.00', 1, '2', '0', '45'),
(280, '2018B/10/48', 5, '155.00', '315.00', 1, '15', '0', '850.5'),
(281, '2018B/10/48', 12, '90.00', '205.00', 1, '3', '0', '110.7'),
(282, '2018B/10/48', 15, '100.00', '215.00', 1, '1', '0', '38.7'),
(283, '2018B/10/48', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(284, '2018B/10/48', 16, '100.00', '215.00', 1, '1', '0', '38.7'),
(285, '2018B/10/48', 27, '100.00', '215.00', 1, '4', '0', '154.8'),
(286, '2018B/10/48', 4, '90.00', '130.00', 1, '3', '0', '70.2'),
(287, '2018B/10/48', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(288, '2018B/10/48', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(289, '2018B/10/48', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(290, '2018B/10/48', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(291, '2018B/10/48', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(292, '2018B/10/48', 19, '140.00', '290.00', 1, '1', '0', '52.2'),
(293, '2018B/10/48', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(294, '2018B/10/48', 21, '60.00', '125.00', 1, '2', '0', '45'),
(295, '2018B/10/48', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(296, '2018B/10/48', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(297, '2018B/10/48', 25, '60.00', '125.00', 1, '1', '0', '22.5'),
(298, '2018B/10/48', 17, '60.00', '60.00', 1, '8', '0', '86.4'),
(299, '2018B/11/49', 5, '155.00', '315.00', 1, '12', '0', '680.4'),
(300, '2018B/11/49', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(301, '2018B/11/49', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(302, '2018B/11/49', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(303, '2018B/11/49', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(304, '2018B/11/49', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(305, '2018B/11/49', 19, '140.00', '290.00', 1, '1', '0', '52.2'),
(306, '2018B/11/49', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(307, '2018B/11/49', 21, '60.00', '125.00', 1, '1', '0', '22.5'),
(308, '2018B/11/49', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(309, '2018B/11/49', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(310, '2018B/11/49', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(311, '2018B/11/49', 25, '60.00', '125.00', 1, '1', '0', '22.5'),
(312, '2018B/11/50', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(313, '2018B/11/50', 26, '450.00', '700.00', 1, '2', '0', '252'),
(314, '2018B/11/50', 4, '90.00', '130.00', 1, '5', '0', '117'),
(315, '2018B/11/51', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(316, '2018B/11/51', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(317, '2018B/11/51', 23, '60.00', '125.00', 1, '3', '0', '67.5'),
(318, '2018B/11/51', 26, '450.00', '700.00', 1, '6', '0', '756'),
(319, '2018B/11/52', 5, '155.00', '315.00', 1, '10', '0', '567'),
(320, '2018B/11/52', 7, '140.00', '290.00', 1, '3', '0', '156.6'),
(321, '2018B/11/52', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(322, '2018B/11/52', 19, '140.00', '290.00', 1, '3', '0', '156.6'),
(323, '2018B/11/52', 10, '140.00', '290.00', 1, '3', '0', '156.6'),
(324, '2018B/11/52', 11, '140.00', '290.00', 1, '3', '0', '156.6'),
(325, '2018B/11/52', 20, '60.00', '125.00', 1, '3', '0', '67.5'),
(326, '2018B/11/52', 22, '60.00', '125.00', 1, '3', '0', '67.5'),
(327, '2018B/11/52', 23, '60.00', '125.00', 1, '3', '0', '67.5'),
(328, '2018B/11/52', 24, '60.00', '125.00', 1, '3', '0', '67.5'),
(329, '2018B/11/52', 25, '60.00', '125.00', 1, '3', '0', '67.5'),
(330, '2018B/11/52', 17, '60.00', '60.00', 1, '4', '0', '43.2'),
(331, '2018B/11/52', 33, '100.00', '175.00', 1, '7', '0', '220.5'),
(332, '2018B/11/52', 4, '90.00', '130.00', 1, '8', '0', '187.2'),
(333, '2018B/11/52', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(334, '2018B/11/52', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(335, '2018B/11/52', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(336, '2018B/11/52', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(337, '2018B/11/53', 5, '155.00', '315.00', 1, '10', '0', '567'),
(338, '2018B/11/53', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(339, '2018B/11/53', 8, '140.00', '290.00', 1, '2', '0', '104.4'),
(340, '2018B/11/53', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(341, '2018B/11/53', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(342, '2018B/11/53', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(343, '2018B/11/53', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(344, '2018B/11/53', 20, '60.00', '125.00', 1, '2', '0', '45'),
(345, '2018B/11/53', 21, '60.00', '125.00', 1, '2', '0', '45'),
(346, '2018B/11/53', 22, '60.00', '125.00', 1, '2', '0', '45'),
(347, '2018B/11/53', 24, '60.00', '125.00', 1, '2', '0', '45'),
(348, '2018B/11/53', 25, '60.00', '125.00', 1, '2', '0', '45'),
(349, '2018B/11/53', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(350, '2018B/11/53', 13, '100.00', '215.00', 1, '1', '0', '38.7'),
(351, '2018B/11/53', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(352, '2018B/11/53', 15, '100.00', '215.00', 1, '1', '0', '38.7'),
(353, '2018B/11/53', 16, '100.00', '215.00', 1, '1', '0', '38.7'),
(354, '2018B/11/53', 27, '100.00', '215.00', 1, '1', '0', '38.7'),
(355, '2018B/11/53', 17, '60.00', '60.00', 1, '10', '0', '108'),
(356, '2018B/11/53', 32, '100.00', '175.00', 1, '5', '0', '157.5'),
(357, '2018B/11/53', 33, '100.00', '175.00', 1, '10', '0', '315'),
(358, '2018B/11/53', 26, '450.00', '700.00', 1, '3', '0', '378'),
(359, '2018B/11/53', 4, '90.00', '130.00', 1, '10', '0', '234'),
(360, '2018B/11/54', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(361, '2018B/11/54', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(362, '2018B/11/54', 26, '450.00', '700.00', 1, '1', '0', '126'),
(363, '2018B/11/55', 5, '155.00', '315.00', 1, '7', '0', '396.9'),
(364, '2018B/11/55', 19, '140.00', '290.00', 1, '1', '0', '52.2'),
(365, '2018B/11/55', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(366, '2018B/11/55', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(367, '2018B/11/55', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(368, '2018B/11/55', 25, '60.00', '125.00', 1, '1', '0', '22.5'),
(369, '2018B/11/55', 32, '100.00', '175.00', 1, '6', '0', '189'),
(370, '2018B/11/56', 5, '155.00', '315.00', 1, '6', '0', '340.2'),
(371, '2018B/11/56', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(372, '2018B/11/56', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(373, '2018B/11/56', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(374, '2018B/11/56', 22, '60.00', '125.00', 1, '2', '0', '45'),
(375, '2018B/11/56', 24, '60.00', '125.00', 1, '2', '0', '45'),
(376, '2018B/11/56', 25, '60.00', '125.00', 1, '2', '0', '45'),
(377, '2018B/11/56', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(378, '2018B/11/56', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(379, '2018B/11/56', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(380, '2018B/11/57', 18, '900.00', '1500.00', 1, '3', '0', '810'),
(381, '2018B/11/57', 26, '450.00', '700.00', 1, '4', '0', '504'),
(382, '2018B/11/49', 4, NULL, '130.00', NULL, '0', '0', '0'),
(383, '2018B/12/58', 26, '450.00', '700.00', 1, '1', '0', '126'),
(384, '2018B/12/58', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(385, '2018B/12/59', 26, '450.00', '700.00', 1, '7', '0', '882'),
(386, '2018B/12/60', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(387, '2018B/12/60', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(388, '2018B/12/60', 10, '140.00', '290.00', 1, '1', '0', '52.2'),
(389, '2018B/12/60', 22, '60.00', '125.00', 1, '1', '0', '22.5'),
(390, '2018B/12/60', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(391, '2018B/12/60', 17, '60.00', '60.00', 1, '5', '0', '54'),
(392, '2018B/12/60', 31, NULL, '215.00', NULL, '1', '0', '38.7'),
(393, '2018B/12/60', 28, NULL, '215.00', NULL, '1', '0', '38.7'),
(394, '2018B/12/60', 29, NULL, '215.00', NULL, '1', '0', '38.7'),
(395, '2018B/12/60', 16, NULL, '215.00', NULL, '1', '0', '38.7'),
(396, '2018B/12/60', 30, NULL, '215.00', NULL, '1', '0', '38.7'),
(397, '2018B/12/60', 12, NULL, '205.00', NULL, '1', '0', '36.9'),
(398, '2018B/12/61', 26, '450.00', '700.00', 1, '2', '0', '252'),
(399, '2018B/12/61', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(400, '2018B/12/61', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(401, '2018B/12/61', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(402, '2018B/12/61', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(403, '2018B/12/61', 19, '140.00', '290.00', 1, '1', '0', '52.2'),
(404, '2018B/12/61', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(405, '2018B/12/61', 22, '60.00', '125.00', 1, '2', '0', '45'),
(406, '2018B/12/61', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(407, '2018B/12/61', 25, '60.00', '125.00', 1, '1', '0', '22.5'),
(408, '2018B/12/62', 5, '155.00', '315.00', 1, '10', '0', '567'),
(409, '2018B/12/62', 8, '140.00', '290.00', 1, '1', '0', '52.2'),
(410, '2018B/12/62', 10, '140.00', '290.00', 1, '2', '0', '104.4'),
(411, '2018B/12/62', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(412, '2018B/12/62', 22, '60.00', '125.00', 1, '2', '0', '45'),
(413, '2018B/12/62', 24, '60.00', '125.00', 1, '2', '0', '45'),
(414, '2019B/01/63', 5, '155.00', '315.00', 1, '37', '0', '2097.9'),
(415, '2019B/01/63', 26, '450.00', '700.00', 1, '3', '0', '378'),
(416, '2019B/01/63', 7, '140.00', '290.00', 1, '15', '0', '783'),
(417, '2019B/01/63', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(418, '2019B/01/63', 11, '140.00', '290.00', 1, '5', '0', '261'),
(419, '2019B/01/63', 19, '140.00', '290.00', 1, '3', '0', '156.6'),
(420, '2019B/01/63', 10, '140.00', '290.00', 1, '3', '0', '156.6'),
(421, '2019B/01/63', 20, '60.00', '125.00', 1, '15', '0', '337.5'),
(422, '2019B/01/63', 23, '60.00', '125.00', 1, '2', '0', '45'),
(423, '2019B/01/63', 24, '60.00', '125.00', 1, '5', '0', '112.5'),
(424, '2019B/01/63', 25, '60.00', '125.00', 1, '1', '0', '22.5'),
(425, '2019B/01/64', 16, '100.00', '215.00', 1, '3', '0', '116.1'),
(426, '2019B/01/64', 17, '60.00', '60.00', 1, '2', '0', '21.6'),
(427, '2019B/01/65', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(428, '2019B/01/65', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(429, '2019B/01/65', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(430, '2019B/01/65', 23, '60.00', '125.00', 1, '2', '0', '45'),
(431, '2019B/01/65', 24, '60.00', '125.00', 1, '2', '0', '45'),
(432, '2019B/01/66', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(433, '2019B/01/66', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(434, '2019B/01/66', 27, '100.00', '215.00', 1, '2', '0', '77.4'),
(435, '2019B/01/66', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(436, '2019B/01/66', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(437, '2019B/01/66', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(438, '2019B/01/66', 31, '100.00', '215.00', 1, '2', '0', '77.4'),
(439, '2019B/01/66', 17, '60.00', '60.00', 1, '8', '0', '86.4'),
(440, '2019B/01/67', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(441, '2019B/01/67', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(442, '2019B/01/67', 24, '60.00', '125.00', 1, '2', '0', '45'),
(443, '2019B/01/67', 16, '100.00', '215.00', 1, '1', '0', '38.7'),
(444, '2019B/01/67', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(445, '2019B/01/67', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(446, '2019B/01/67', 17, '60.00', '60.00', 1, '3', '0', '32.4'),
(447, '2019B/01/67', 26, '450.00', '700.00', 1, '2', '0', '252'),
(448, '2019B/01/68', 32, '100.00', '175.00', 1, '10', '0', '315'),
(449, '2019B/01/68', 33, '100.00', '175.00', 1, '18', '0', '567'),
(450, '2019B/01/68', 4, '90.00', '130.00', 1, '30', '0', '702'),
(451, '2019B/01/68', 12, '90.00', '205.00', 1, '10', '0', '369'),
(452, '2019B/01/68', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(453, '2019B/01/68', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(454, '2019B/01/68', 16, '100.00', '215.00', 1, '3', '0', '116.1'),
(455, '2019B/01/68', 27, '100.00', '215.00', 1, '2', '0', '77.4'),
(456, '2019B/01/68', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(457, '2019B/01/68', 30, '100.00', '215.00', 1, '3', '0', '116.1'),
(458, '2019B/01/68', 31, '100.00', '215.00', 1, '2', '0', '77.4'),
(459, '2019B/01/68', 17, '60.00', '60.00', 1, '40', '0', '432'),
(460, '2019B/02/69', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(461, '2019B/02/69', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(462, '2019B/02/69', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(463, '2019B/02/69', 7, '140.00', '290.00', 1, '5', '0', '261'),
(464, '2019B/02/70', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(465, '2019B/02/70', 33, '100.00', '175.00', 1, '5', '0', '157.5'),
(466, '2019B/02/71', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(467, '2019B/02/71', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(468, '2019B/02/71', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(469, '2019B/02/71', 7, '140.00', '290.00', 1, '3', '0', '156.6'),
(470, '2019B/02/71', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(471, '2019B/02/72', 5, '155.00', '315.00', 1, '12', '0', '680.4'),
(472, '2019B/02/72', 7, '140.00', '290.00', 1, '5', '0', '261'),
(473, '2019B/02/72', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(474, '2019B/02/72', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(475, '2019B/02/72', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(476, '2019B/02/72', 20, '60.00', '125.00', 1, '5', '0', '112.5'),
(477, '2019B/02/72', 23, '60.00', '125.00', 1, '3', '0', '67.5'),
(478, '2019B/02/72', 24, '60.00', '125.00', 1, '2', '0', '45'),
(479, '2019B/02/72', 25, '60.00', '125.00', 1, '2', '0', '45'),
(480, '2019B/02/72', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(481, '2019B/02/72', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(482, '2019B/02/72', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(483, '2019B/02/72', 16, '100.00', '215.00', 1, '1', '0', '38.7'),
(484, '2019B/02/72', 27, '100.00', '215.00', 1, '2', '0', '77.4'),
(485, '2019B/02/72', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(486, '2019B/02/72', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(487, '2019B/02/72', 31, '100.00', '215.00', 1, '2', '0', '77.4'),
(488, '2019B/02/72', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(489, '2019B/02/72', 17, '60.00', '60.00', 1, '16', '0', '172.8'),
(490, '2019B/02/72', 33, '100.00', '175.00', 1, '9', '0', '283.5'),
(491, '2019B/02/72', 18, '900.00', '1500.00', 1, '1', '0', '270'),
(492, '2019B/02/72', 32, '100.00', '175.00', 1, '8', '0', '252'),
(493, '2019B/02/72', 26, '450.00', '700.00', 1, '2', '0', '252'),
(494, '2019B/02/72', 4, '90.00', '130.00', 1, '14', '0', '327.6'),
(495, '2019B/02/73', 13, '100.00', '215.00', 1, '1', '0', '38.7'),
(496, '2019B/02/73', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(497, '2019B/02/73', 31, '100.00', '215.00', 1, '1', '0', '38.7'),
(498, '2019B/02/73', 30, '100.00', '215.00', 1, '1', '0', '38.7'),
(499, '2019B/02/73', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(500, '2019B/02/73', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(501, '2019B/02/73', 17, '60.00', '60.00', 1, '8', '0', '86.4'),
(502, '2019B/02/74', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(503, '2019B/02/74', 7, '140.00', '290.00', 1, '3', '0', '156.6'),
(504, '2019B/02/74', 20, '60.00', '125.00', 1, '3', '0', '67.5'),
(505, '2019B/02/75', 16, '100.00', '215.00', 1, '3', '0', '116.1'),
(506, '2019B/02/75', 30, '100.00', '215.00', 1, '3', '0', '116.1'),
(507, '2019B/02/75', 17, '60.00', '60.00', 1, '6', '0', '64.8'),
(508, '2019B/02/76', 4, '90.00', '130.00', 1, '8', '0', '187.2'),
(509, '2019B/03/77', 4, '90.00', '130.00', 1, '9', '0', '210.6'),
(510, '2019B/03/78', 13, '100.00', '215.00', 1, '1', '0', '38.7'),
(511, '2019B/03/78', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(512, '2019B/03/78', 31, '100.00', '215.00', 1, '2', '0', '77.4'),
(513, '2019B/03/78', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(514, '2019B/03/78', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(515, '2019B/03/78', 14, '100.00', '215.00', 1, '1', '0', '38.7'),
(516, '2019B/03/78', 17, '60.00', '60.00', 1, '10', '0', '108'),
(517, '2019B/03/78', 4, '90.00', '130.00', 1, '2', '0', '46.8'),
(518, '2019B/04/79', 34, '705.00', '1100.00', 1, '2', '0', '396'),
(519, '2019B/04/79', 26, '450.00', '700.00', 1, '4', '0', '504'),
(520, '2019B/04/80', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(521, '2019B/04/80', 26, '450.00', '700.00', 1, '5', '0', '630'),
(522, '2019B/04/80', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(523, '2019B/04/80', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(524, '2019B/04/80', 24, '60.00', '125.00', 1, '2', '0', '45'),
(525, '2019B/04/81', 5, '155.00', '315.00', 1, '5', '0', '283.5'),
(526, '2019B/04/81', 26, '450.00', '700.00', 1, '5', '0', '630'),
(527, '2019B/04/81', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(528, '2019B/04/81', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(529, '2019B/04/81', 24, '60.00', '125.00', 1, '2', '0', '45'),
(530, '2019B/05/82', 34, '705.00', '1100.00', 1, '2', '0', '396'),
(531, '2019B/05/83', 34, '705.00', '1100.00', 1, '2', '0', '396'),
(532, '2019B/05/84', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(533, '2019B/05/84', 26, '450.00', '700.00', 1, '1', '0', '126'),
(534, '2019B/05/84', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(535, '2019B/05/84', 24, '60.00', '125.00', 1, '2', '0', '45'),
(536, '2019B/05/85', 33, '100.00', '175.00', 1, '12', '0', '378'),
(537, '2019B/05/85', 4, '90.00', '130.00', 1, '7', '0', '163.8'),
(538, '2019B/05/86', 34, '705.00', '1100.00', 1, '2', '0', '396'),
(539, '2019B/05/86', 26, '450.00', '700.00', 1, '4', '0', '504'),
(540, '2019B/06/87', 5, '155.00', '315.00', 1, '20', '0', '1134'),
(541, '2019B/06/87', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(542, '2019B/06/87', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(543, '2019B/06/87', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(544, '2019B/06/87', 19, '140.00', '290.00', 1, '2', '0', '104.4'),
(545, '2019B/06/87', 20, '60.00', '125.00', 1, '2', '0', '45'),
(546, '2019B/06/87', 23, '60.00', '125.00', 1, '2', '0', '45'),
(547, '2019B/06/87', 24, '60.00', '125.00', 1, '2', '0', '45'),
(548, '2019B/06/87', 25, '60.00', '125.00', 1, '2', '0', '45'),
(549, '2019B/06/88', 5, '155.00', '315.00', 1, '35', '0', '1984.5'),
(550, '2019B/06/88', 7, '140.00', '290.00', 1, '35', '0', '1827'),
(551, '2019B/06/88', 20, '60.00', '125.00', 1, '35', '0', '787.5'),
(552, '2019B/06/89', 12, '90.00', '205.00', 1, '50', '0', '1845'),
(553, '2019B/06/89', 14, '100.00', '215.00', 1, '5', '0', '193.5'),
(554, '2019B/06/89', 16, '100.00', '215.00', 1, '5', '0', '193.5'),
(555, '2019B/06/89', 13, '100.00', '215.00', 1, '5', '0', '193.5'),
(556, '2019B/06/89', 15, '100.00', '215.00', 1, '5', '0', '193.5'),
(557, '2019B/06/89', 17, '60.00', '60.00', 1, '53', '0', '572.4'),
(558, '2019B/06/89', 32, '100.00', '175.00', 1, '10', '0', '315'),
(559, '2019B/06/89', 4, '90.00', '130.00', 1, '15', '0', '351'),
(560, '2019B/06/89', 33, '100.00', '175.00', 1, '5', '0', '157.5'),
(561, '2019B/06/90', 26, '450.00', '700.00', 1, '2', '0', '252'),
(562, '2019B/06/90', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(563, '2019B/06/90', 7, '140.00', '290.00', 1, '2', '0', '104.4'),
(564, '2019B/06/90', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(565, '2019B/06/90', 20, '60.00', '125.00', 1, '2', '0', '45'),
(566, '2019B/06/90', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(567, '2019B/06/91', 4, '90.00', '130.00', 1, '20', '0', '468'),
(568, '2019B/06/92', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(569, '2019B/06/92', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(570, '2019B/06/92', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(571, '2019B/06/92', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(572, '2019B/06/92', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(573, '2019B/06/92', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(574, '2019B/07/93', 33, '100.00', '175.00', 1, '6', '0', '189'),
(575, '2019B/07/93', 5, '155.00', '315.00', 1, '2', '0', '113.4'),
(576, '2019B/07/93', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(577, '2019B/07/93', 24, '60.00', '125.00', 1, '2', '0', '45'),
(578, '2019B/07/94', 33, '100.00', '175.00', 1, '6', '0', '189'),
(579, '2019B/07/94', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(580, '2019B/07/94', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(581, '2019B/07/94', 24, '60.00', '125.00', 1, '2', '0', '45'),
(582, '2019B/07/94', 7, NULL, '290.00', NULL, '3', '0', '156.6'),
(583, '2019B/07/94', 20, NULL, '125.00', NULL, '3', '0', '67.5'),
(584, '2019B/07/95', 12, '90.00', '205.00', 1, '5', '0', '184.5'),
(585, '2019B/07/95', 16, '100.00', '215.00', 1, '5', '0', '193.5'),
(586, '2019B/07/95', 26, '450.00', '700.00', 1, '9', '0', '1134'),
(587, '2019B/07/96', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(588, '2019B/07/96', 12, '90.00', '205.00', 1, '2', '0', '73.8'),
(589, '2019B/07/96', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(590, '2019B/07/96', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(591, '2019B/07/96', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(592, '2019B/07/96', 26, '450.00', '700.00', 1, '2', '0', '252'),
(593, '2019B/07/96', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(594, '2019B/07/96', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(595, '2019B/07/96', 33, '100.00', '175.00', 1, '8', '0', '252'),
(596, '2019B/07/97', 5, '155.00', '315.00', 1, '6', '0', '340.2'),
(597, '2019B/07/97', 19, '140.00', '290.00', 1, '1', '0', '52.2'),
(598, '2019B/07/97', 25, '60.00', '125.00', 1, '3', '0', '67.5'),
(599, '2019B/07/98', 5, '155.00', '315.00', 1, '12', '0', '680.4'),
(600, '2019B/07/98', 33, '100.00', '175.00', 1, '3', '0', '94.5'),
(601, '2019B/07/98', 4, '90.00', '130.00', 1, '15', '0', '351'),
(602, '2019B/07/98', 12, '90.00', '205.00', 1, '5', '0', '184.5'),
(603, '2019B/07/98', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(604, '2019B/07/98', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(605, '2019B/07/98', 28, '100.00', '215.00', 1, '1', '0', '38.7'),
(606, '2019B/08/99', 5, '155.00', '315.00', 1, '15', '0', '850.5'),
(607, '2019B/08/99', 7, '140.00', '290.00', 1, '4', '0', '208.8'),
(608, '2019B/08/99', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(609, '2019B/08/99', 11, '140.00', '290.00', 1, '3', '0', '156.6'),
(610, '2019B/08/99', 20, '60.00', '125.00', 1, '6', '0', '135'),
(611, '2019B/08/99', 24, '60.00', '125.00', 1, '5', '0', '112.5'),
(612, '2019B/08/99', 23, '60.00', '125.00', 1, '4', '0', '90'),
(613, '2019B/09/100', 18, '900.00', '1500.00', 1, '7', '0', '1890'),
(614, '2019B/09/101', 5, '155.00', '315.00', 1, '7', '0', '396.9'),
(615, '2019B/09/101', 7, '140.00', '290.00', 1, '7', '0', '365.4'),
(616, '2019B/09/101', 20, '60.00', '125.00', 1, '7', '0', '157.5'),
(617, '2019B/09/101', 33, '100.00', '175.00', 1, '3', '0', '94.5'),
(618, '2019B/09/101', 4, '90.00', '130.00', 1, '10', '0', '234'),
(619, '2019B/09/101', 12, '90.00', '205.00', 1, '4', '0', '147.6'),
(620, '2019B/09/102', 4, '90.00', '130.00', 1, '7', '0', '163.8'),
(621, '2019B/09/102', 12, '90.00', '205.00', 1, '1', '0', '36.9'),
(622, '2019B/09/102', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(623, '2019B/09/102', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(624, '2019B/09/102', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(625, '2019B/09/102', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(626, '2019B/09/102', 27, '100.00', '215.00', 1, '2', '0', '77.4'),
(627, '2019B/09/102', 5, '155.00', '315.00', 1, '3', '0', '170.1'),
(628, '2019B/09/102', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(629, '2019B/09/102', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(630, '2019B/09/102', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(631, '2019B/09/102', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(632, '2019B/09/102', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(633, '2019B/09/102', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(634, '2019B/10/103', 5, '155.00', '315.00', 1, '8', '0', '453.6'),
(635, '2019B/10/103', 4, '90.00', '130.00', 1, '7', '0', '163.8'),
(636, '2019B/10/103', 33, '100.00', '175.00', 1, '2', '0', '63'),
(637, '2019B/10/103', 26, '450.00', '700.00', 1, '3', '0', '378'),
(638, '2019B/10/103', 13, '100.00', '215.00', 1, '2', '0', '77.4'),
(639, '2019B/10/103', 14, '100.00', '215.00', 1, '2', '0', '77.4'),
(640, '2019B/10/103', 15, '100.00', '215.00', 1, '2', '0', '77.4'),
(641, '2019B/10/103', 16, '100.00', '215.00', 1, '2', '0', '77.4'),
(642, '2019B/10/103', 27, '100.00', '215.00', 1, '2', '0', '77.4'),
(643, '2019B/10/103', 28, '100.00', '215.00', 1, '2', '0', '77.4'),
(644, '2019B/10/103', 29, '100.00', '215.00', 1, '2', '0', '77.4'),
(645, '2019B/10/103', 30, '100.00', '215.00', 1, '2', '0', '77.4'),
(646, '2019B/10/103', 31, '100.00', '215.00', 1, '2', '0', '77.4'),
(647, '2019B/10/103', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(648, '2019B/10/103', 9, '140.00', '290.00', 1, '1', '0', '52.2'),
(649, '2019B/10/103', 11, '140.00', '290.00', 1, '2', '0', '104.4'),
(650, '2019B/10/103', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(651, '2019B/10/103', 23, '60.00', '125.00', 1, '1', '0', '22.5'),
(652, '2019B/10/103', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(653, '2019B/10/104', 26, '450.00', '700.00', 1, '3', '0', '378'),
(654, '2019B/10/104', 34, '705.00', '1100.00', 1, '4', '0', '792'),
(655, '2019B/10/104', 12, '90.00', '205.00', 1, '3', '0', '110.7'),
(656, '2019B/10/104', 5, '155.00', '315.00', 1, '4', '0', '226.8'),
(657, '2019B/10/104', 7, '140.00', '290.00', 1, '1', '0', '52.2'),
(658, '2019B/10/104', 11, '140.00', '290.00', 1, '1', '0', '52.2'),
(659, '2019B/10/104', 20, '60.00', '125.00', 1, '1', '0', '22.5'),
(660, '2019B/10/104', 24, '60.00', '125.00', 1, '1', '0', '22.5'),
(661, '2019B/10/105', 26, '450.00', '700.00', 1, '6', '0', '756'),
(662, '2019B/10/106', 26, '450.00', '700.00', 1, '4', '0', '504'),
(663, '2019B/10/106', 33, '100.00', '175.00', 1, '5', '0', '157.5'),
(664, '2019B/10/106', 4, '90.00', '130.00', 1, '10', '0', '234'),
(665, '2019B/10/107', 12, '90.00', '205.00', 1, '1', '0', '36.9'),
(666, '2019B/10/107', 13, '100.00', '215.00', 1, '1', '0', '38.7'),
(667, '2019B/10/107', 16, '100.00', '215.00', 1, '1', '0', '38.7'),
(668, '2019B/10/107', 27, '100.00', '215.00', 1, '1', '0', '38.7'),
(669, '2019B/10/107', 30, '100.00', '215.00', 1, '1', '0', '38.7'),
(670, '2019B/10/108', 4, '90.00', '130.00', 1, '4', '0', '93.6'),
(671, '2019B/10/108', 15, '100.00', '215.00', 1, '4', '0', '154.8'),
(672, '2019B/10/108', 16, '100.00', '215.00', 1, '4', '0', '154.8'),
(673, '2019B/10/108', 28, '100.00', '215.00', 1, '4', '0', '154.8'),
(674, '2019B/10/108', 5, '155.00', '315.00', 1, '13', '0', '737.1'),
(675, '2019B/10/108', 7, '140.00', '290.00', 1, '4', '0', '208.8'),
(676, '2019B/10/108', 9, '140.00', '290.00', 1, '2', '0', '104.4'),
(677, '2019B/10/108', 20, '60.00', '125.00', 1, '4', '0', '90'),
(678, '2019B/10/108', 23, '60.00', '125.00', 1, '2', '0', '45'),
(679, '2019B/12/109', 5, '155.00', '315.00', 1, '7', '0', '396.9'),
(680, '2019B/12/109', 7, '140.00', '290.00', 1, '7', '0', '365.4'),
(681, '2019B/12/109', 20, '60.00', '125.00', 1, '7', '0', '157.5'),
(682, '2019B/12/109', 26, '450.00', '700.00', 1, '2', '0', '252'),
(683, '2019B/12/109', 4, '90.00', '130.00', 1, '4', '0', '93.6'),
(684, '2019B/12/110', 5, '155.00', '315.00', 1, '9', '0', '510.3'),
(685, '2019B/12/110', 9, '140.00', '290.00', 1, '3', '0', '156.6'),
(686, '2019B/12/110', 11, '140.00', '290.00', 1, '3', '0', '156.6'),
(687, '2019B/12/110', 23, '60.00', '125.00', 1, '3', '0', '67.5'),
(688, '2019B/12/110', 24, '60.00', '125.00', 1, '3', '0', '67.5'),
(689, '2019B/12/110', 15, '100.00', '215.00', 1, '3', '0', '116.1'),
(690, '2019B/12/110', 13, '100.00', '215.00', 1, '3', '0', '116.1'),
(691, '2020B/01/111', 5, '155.00', '315.00', 1, '10', '0', '567'),
(692, '2020B/01/111', 4, '90.00', '130.00', 1, '18', '0', '421.2'),
(693, '2020B/01/111', 34, '705.00', '1100.00', 1, '7', '0', '1386'),
(694, '2020B/01/111', 12, '90.00', '205.00', 1, '7', '0', '258.3'),
(695, '2020B/01/111', 14, '100.00', '215.00', 1, '7', '0', '270.9'),
(696, '2020B/01/111', 16, '100.00', '215.00', 1, '7', '0', '270.9'),
(697, '2020B/01/111', 7, '140.00', '290.00', 1, '7', '0', '365.4'),
(698, '2020B/01/111', 9, '140.00', '290.00', 1, '5', '0', '261'),
(699, '2020B/01/111', 20, '60.00', '125.00', 1, '7', '0', '157.5'),
(700, '2020B/01/111', 23, '60.00', '125.00', 1, '5', '0', '112.5'),
(701, '2020B/02/112', 13, '100.00', '215.00', 1, '5', '0', '193.5'),
(702, '2020B/02/112', 14, '100.00', '215.00', 1, '5', '0', '193.5'),
(703, '2020B/02/112', 27, '100.00', '215.00', 1, '5', '0', '193.5'),
(704, '2020B/02/112', 4, '90.00', '130.00', 1, '20', '0', '468'),
(705, '2020B/02/112', 5, '155.00', '315.00', 1, '15', '0', '850.5'),
(706, '2020B/02/112', 9, '140.00', '290.00', 1, '5', '0', '261'),
(707, '2020B/02/112', 11, '140.00', '290.00', 1, '5', '0', '261'),
(708, '2020B/02/112', 23, '60.00', '125.00', 1, '5', '0', '112.5'),
(709, '2020B/02/112', 24, '60.00', '125.00', 1, '5', '0', '112.5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
`paymentId` int(11) NOT NULL,
  `billId` int(11) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`paymentId`, `billId`, `paymentDate`, `paymentAmount`) VALUES
(1, 1, '2018-06-26', '0.00'),
(2, 2, '2018-06-26', '0.00'),
(3, 3, '2018-06-26', '0.00'),
(4, 4, '2018-06-26', '0.00'),
(5, 5, '2018-06-26', '0.00'),
(6, 6, '2018-06-26', '0.00'),
(7, 7, '2018-06-27', '0.00'),
(8, 8, '2018-06-29', '0.00'),
(9, 9, '2018-06-29', '0.00'),
(10, 10, '2018-06-29', '0.00'),
(11, 11, '2018-06-29', '0.00'),
(12, 12, '2018-06-29', '0.00'),
(13, 13, '2018-06-29', '0.00'),
(14, 14, '2018-07-07', '0.00'),
(15, 15, '2018-07-07', '0.00'),
(16, 16, '2018-07-09', '0.00'),
(17, 17, '2018-07-09', '0.00'),
(18, 18, '2018-07-09', '0.00'),
(19, 19, '2018-07-17', '0.00'),
(20, 20, '2018-07-17', '0.00'),
(21, 21, '2018-07-27', '0.00'),
(22, 22, '2018-07-27', '0.00'),
(23, 23, '2018-08-06', '0.00'),
(24, 24, '2018-08-06', '0.00'),
(25, 25, '2018-08-06', '0.00'),
(26, 26, '2018-08-09', '0.00'),
(27, 27, '2018-08-09', '0.00'),
(28, 28, '2018-08-17', '0.00'),
(29, 29, '2018-09-03', '0.00'),
(30, 30, '2018-09-07', '0.00'),
(31, 31, '2018-09-07', '0.00'),
(32, 32, '2018-09-07', '0.00'),
(33, 33, '2018-09-21', '0.00'),
(34, 34, '2018-09-22', '0.00'),
(35, 35, '2018-10-08', '0.00'),
(36, 36, '2018-10-08', '0.00'),
(37, 37, '2018-10-10', '0.00'),
(38, 38, '2018-10-13', '0.00'),
(39, 39, '2018-10-27', '0.00'),
(40, 40, '2018-10-27', '0.00'),
(41, 41, '2018-10-28', '0.00'),
(42, 42, '2018-10-28', '0.00'),
(43, 43, '2018-10-28', '0.00'),
(44, 44, '2018-10-28', '0.00'),
(45, 45, '2018-10-29', '0.00'),
(46, 46, '2018-10-30', '0.00'),
(47, 47, '2018-10-30', '0.00'),
(48, 48, '2018-10-30', '0.00'),
(49, 49, '2018-11-02', '0.00'),
(50, 50, '2018-11-02', '0.00'),
(51, 51, '2018-11-02', '0.00'),
(52, 52, '2018-11-07', '0.00'),
(53, 53, '2018-11-12', '0.00'),
(54, 54, '2018-11-20', '0.00'),
(55, 55, '2018-11-21', '0.00'),
(56, 56, '2018-11-22', '0.00'),
(57, 57, '2018-11-27', '0.00'),
(58, 58, '2018-12-17', '0.00'),
(59, 59, '2018-12-17', '0.00'),
(60, 60, '2018-12-17', '0.00'),
(61, 61, '2018-12-17', '0.00'),
(62, 62, '2018-12-17', '0.00'),
(63, 63, '2019-01-03', '0.00'),
(64, 64, '2019-01-08', '0.00'),
(65, 65, '2019-01-08', '0.00'),
(66, 66, '2019-01-08', '0.00'),
(67, 67, '2019-01-08', '0.00'),
(68, 68, '2019-01-19', '0.00'),
(69, 69, '2019-02-02', '0.00'),
(70, 70, '2019-02-02', '0.00'),
(71, 71, '2019-02-02', '0.00'),
(72, 72, '2019-02-04', '0.00'),
(73, 73, '2019-02-27', '0.00'),
(74, 74, '2019-02-27', '0.00'),
(75, 75, '2019-02-27', '0.00'),
(76, 76, '2019-02-27', '0.00'),
(77, 77, '2019-03-11', '0.00'),
(78, 78, '2019-03-11', '0.00'),
(79, 79, '2019-04-26', '0.00'),
(80, 80, '2019-04-26', '0.00'),
(81, 81, '2019-04-26', '0.00'),
(82, 82, '2019-05-14', '0.00'),
(83, 83, '2019-05-14', '0.00'),
(84, 84, '2019-05-14', '0.00'),
(85, 85, '2019-05-17', '0.00'),
(86, 86, '2019-05-17', '0.00'),
(87, 87, '2019-06-06', '0.00'),
(88, 88, '2019-06-10', '0.00'),
(89, 89, '2019-06-12', '0.00'),
(90, 90, '2019-06-24', '0.00'),
(91, 91, '2019-06-24', '0.00'),
(92, 92, '2019-06-24', '0.00'),
(93, 93, '2019-07-15', '0.00'),
(94, 94, '2019-07-15', '0.00'),
(95, 95, '2019-07-15', '0.00'),
(96, 96, '2019-07-30', '0.00'),
(97, 97, '2019-07-30', '0.00'),
(98, 98, '2019-07-30', '0.00'),
(99, 99, '2019-08-08', '0.00'),
(100, 100, '2019-09-03', '0.00'),
(101, 101, '2019-09-13', '0.00'),
(102, 102, '2019-09-13', '0.00'),
(103, 103, '2019-10-09', '0.00'),
(104, 104, '2019-10-17', '0.00'),
(105, 105, '2019-10-24', '0.00'),
(106, 106, '2019-10-24', '0.00'),
(107, 107, '2019-10-24', '0.00'),
(108, 108, '2019-10-24', '0.00'),
(109, 109, '2019-12-06', '0.00'),
(110, 110, '2019-12-06', '0.00'),
(111, 111, '2020-01-16', '0.00'),
(112, 112, '2020-02-17', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
`productId` int(11) NOT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `productShort` varchar(25) DEFAULT NULL,
  `productDescription` varchar(150) DEFAULT NULL,
  `productHSN` varchar(25) DEFAULT NULL,
  `productTaxId` int(2) DEFAULT NULL,
  `productUnitPrice` varchar(15) DEFAULT NULL,
  `productQuantity` int(6) DEFAULT NULL,
  `productCat` int(6) DEFAULT NULL,
  `productBrand` int(6) DEFAULT NULL,
  `productSupplier` int(2) DEFAULT NULL,
  `productStatus` int(1) DEFAULT NULL,
  `productAddDate` date DEFAULT NULL,
  `productModDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_history`
--

CREATE TABLE IF NOT EXISTS `tbl_purchase_history` (
`purchaseId` int(11) NOT NULL,
  `stockId` int(2) DEFAULT NULL,
  `purchaseQty` int(5) DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `purchasePrice` decimal(10,2) DEFAULT NULL,
  `sellingPrice` int(10) DEFAULT NULL,
  `catId` int(3) DEFAULT NULL,
  `brandId` int(3) DEFAULT NULL,
  `purchaseSupplier` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_history`
--

INSERT INTO `tbl_purchase_history` (`purchaseId`, `stockId`, `purchaseQty`, `purchaseDate`, `purchasePrice`, `sellingPrice`, `catId`, `brandId`, `purchaseSupplier`) VALUES
(1, 2, 450, '2018-06-25', '155.00', 315, 1, 1, 1),
(2, 3, 450, '2018-06-25', '155.00', 315, 1, 1, 1),
(3, 4, 130, '2018-06-25', '70.00', 130, 3, 1, 1),
(4, 5, 450, '2018-06-25', '155.00', 315, 1, 1, 1),
(5, 6, 150, '2018-06-25', '85.00', 205, 4, 1, 1),
(6, 7, 202, '2018-06-25', '140.00', 290, 6, 3, 1),
(7, 8, 32, '2018-06-25', '140.00', 290, 6, 3, 1),
(8, 9, 69, '2018-06-25', '140.00', 290, 6, 3, 1),
(9, 10, 42, '2018-06-25', '140.00', 290, 6, 3, 1),
(10, 11, 95, '2018-06-25', '140.00', 290, 6, 3, 1),
(11, 12, 150, '2018-06-25', '85.00', 205, 4, 1, 1),
(12, 13, 25, '2018-06-26', '90.00', 215, 4, 1, 1),
(13, 14, 40, '2018-06-26', '90.00', 215, 4, 1, 1),
(14, 15, 35, '2018-06-26', '90.00', 215, 4, 1, 1),
(15, 16, 25, '2018-06-26', '90.00', 215, 4, 1, 1),
(16, 17, 110, '2018-06-26', '60.00', 60, 5, 1, 1),
(17, 18, 33, '2018-06-26', '900.00', 1500, 2, 2, 1),
(18, 19, 27, '2018-06-26', '140.00', 290, 6, 3, 1),
(19, 20, 225, '2018-06-26', '60.00', 125, 7, 4, 1),
(20, 21, 32, '2018-06-26', '60.00', 125, 7, 4, 1),
(21, 22, 42, '2018-06-26', '60.00', 125, 7, 4, 1),
(22, 23, 74, '2018-06-26', '60.00', 125, 7, 4, 1),
(23, 24, 95, '2018-06-26', '60.00', 125, 7, 4, 1),
(24, 25, 27, '2018-06-26', '60.00', 125, 7, 4, 1),
(25, 7, 121, '2018-06-28', '70.00', 130, 3, 1, 1),
(26, 1, 439, '2018-06-28', '155.00', 315, 1, 1, 1),
(27, 2, 200, '2018-10-27', '90.00', 205, 4, 1, 1),
(28, 3, 40, '2018-10-27', '100.00', 215, 4, 1, 1),
(29, 4, 25, '2018-10-27', '90.00', 215, 4, 1, 1),
(30, 5, 15, '2018-10-27', '100.00', 215, 4, 1, 1),
(31, 6, 20, '2018-10-27', '100.00', 215, 4, 1, 1),
(32, 7, 482, '2018-10-27', '90.00', 130, 3, 1, 1),
(33, 8, 190, '2018-10-27', '60.00', 60, 5, 1, 1),
(34, 1, 450, '2018-10-27', '155.00', 315, 1, 1, 1),
(35, 26, 69, '2018-10-27', '450.00', 700, 3, 1, 1),
(36, 27, 25, '2018-10-27', '100.00', 215, 4, 1, 1),
(37, 28, 25, '2018-10-27', '100.00', 215, 4, 1, 1),
(38, 29, 25, '2018-10-27', '100.00', 215, 4, 1, 1),
(39, 30, 25, '2018-10-27', '100.00', 215, 4, 1, 1),
(40, 31, 25, '2018-10-27', '100.00', 215, 4, 1, 1),
(41, 32, 50, '2018-10-27', '100.00', 175, 3, 1, 1),
(42, 33, 50, '2018-10-27', '100.00', 175, 3, 1, 1),
(43, 1, 200, '2019-04-25', '155.00', 315, 1, 1, 1),
(44, 1, 157, '2019-04-25', '155.00', 315, 1, 1, 1),
(45, 2, 200, '2019-04-25', '90.00', 205, 4, 1, 1),
(46, 29, 54, '2019-04-25', '100.00', 175, 3, 1, 1),
(47, 28, 50, '2019-04-25', '100.00', 175, 3, 1, 1),
(48, 22, 107, '2019-04-25', '450.00', 700, 3, 1, 1),
(49, 34, 82, '2019-04-25', '705.00', 1100, 2, 1, 1),
(50, 7, 450, '2019-04-25', '90.00', 130, 3, 1, 1),
(51, 3, 25, '2019-04-25', '100.00', 215, 4, 1, 1),
(52, 4, 25, '2019-04-25', '100.00', 215, 4, 1, 1),
(53, 5, 35, '2019-04-25', '100.00', 215, 4, 1, 1),
(54, 6, 40, '2019-04-25', '100.00', 215, 4, 1, 1),
(55, 23, 28, '2019-04-25', '100.00', 215, 4, 1, 1),
(56, 26, 30, '2019-04-25', '100.00', 215, 4, 1, 1),
(57, 24, 22, '2019-04-25', '100.00', 215, 4, 1, 1),
(58, 25, 20, '2019-04-25', '100.00', 215, 4, 1, 1),
(59, 35, 2, '2020-07-01', '6540.00', 8575, 2, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

CREATE TABLE IF NOT EXISTS `tbl_receipt` (
`rid` int(11) NOT NULL,
  `rRef` varchar(15) DEFAULT NULL,
  `rDate` date DEFAULT NULL,
  `rAmount` text,
  `mode` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salesman`
--

CREATE TABLE IF NOT EXISTS `tbl_salesman` (
`smId` int(11) NOT NULL,
  `smName` varchar(25) DEFAULT NULL,
  `smMobile` varchar(12) DEFAULT NULL,
  `smEmail` varchar(20) DEFAULT NULL,
  `smStatus` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
`sid` int(11) NOT NULL,
  `stateName` varchar(50) DEFAULT NULL,
  `stateCode` varchar(2) DEFAULT NULL,
  `stateDigit` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`sid`, `stateName`, `stateCode`, `stateDigit`) VALUES
(1, 'Tamil Nadu', 'TN', 33),
(2, 'Kerala', 'KL', 32);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
`stockId` int(11) NOT NULL,
  `itemId` int(2) DEFAULT NULL,
  `supplierId` int(2) DEFAULT NULL,
  `stockQty` int(6) DEFAULT NULL,
  `purchasedPrice` decimal(10,2) DEFAULT NULL,
  `sellingPrice` decimal(10,2) DEFAULT NULL,
  `stockTax` int(1) DEFAULT NULL,
  `catId` int(2) DEFAULT NULL,
  `brandId` int(2) DEFAULT NULL,
  `damageItems` int(14) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stockId`, `itemId`, `supplierId`, `stockQty`, `purchasedPrice`, `sellingPrice`, `stockTax`, `catId`, `brandId`, `damageItems`) VALUES
(4, 7, 1, 491, '90.00', '130.00', 3, 3, 1, 0),
(5, 1, 1, 691, '155.00', '315.00', 3, 1, 1, 0),
(6, 0, 1, 150, '85.00', '205.00', 3, 4, 1, NULL),
(7, 9, 1, 51, '140.00', '290.00', 3, 6, 3, NULL),
(8, 10, 1, 0, '140.00', '290.00', 3, 6, 3, NULL),
(9, 11, 1, 1, '140.00', '290.00', 3, 6, 3, NULL),
(10, 12, 1, 0, '140.00', '290.00', 3, 6, 3, NULL),
(11, 13, 1, 3, '140.00', '290.00', 3, 6, 3, NULL),
(12, 2, 1, 183, '90.00', '205.00', 3, 4, 1, 200),
(13, 3, 1, 39, '100.00', '215.00', 3, 4, 1, NULL),
(14, 4, 1, 26, '100.00', '215.00', 3, 4, 1, NULL),
(15, 5, 1, 27, '100.00', '215.00', 3, 4, 1, NULL),
(16, 6, 1, 16, '100.00', '215.00', 3, 4, 1, NULL),
(17, 8, 1, 0, '60.00', '60.00', 3, 5, 1, NULL),
(18, 19, 1, 17, '900.00', '1500.00', 3, 2, 2, NULL),
(19, 20, 1, 0, '140.00', '290.00', 3, 6, 3, NULL),
(20, 14, 1, 83, '60.00', '125.00', 3, 7, 4, NULL),
(21, 15, 1, 0, '60.00', '125.00', 3, 7, 4, NULL),
(22, 16, 1, 0, '60.00', '125.00', 3, 7, 4, NULL),
(23, 17, 1, 13, '60.00', '125.00', 3, 7, 4, NULL),
(24, 18, 1, 7, '60.00', '125.00', 3, 7, 4, NULL),
(25, 21, 1, 0, '60.00', '125.00', 3, 7, 4, NULL),
(26, 22, 1, 75, '450.00', '700.00', 3, 3, 1, NULL),
(27, 23, 1, 32, '100.00', '215.00', 3, 4, 1, NULL),
(28, 24, 1, 27, '100.00', '215.00', 3, 4, 1, NULL),
(29, 25, 1, 28, '100.00', '215.00', 3, 4, 1, NULL),
(30, 26, 1, 30, '100.00', '215.00', 3, 4, 1, NULL),
(31, 27, 1, 14, '100.00', '215.00', 3, 4, 1, NULL),
(32, 28, 1, 61, '100.00', '175.00', 3, 3, 1, NULL),
(33, 29, 1, 0, '100.00', '175.00', 3, 3, 1, NULL),
(34, 19, 1, 63, '705.00', '1100.00', 3, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
`supplierId` int(11) NOT NULL,
  `supplierName` varchar(50) DEFAULT NULL,
  `supplierContactName` varchar(50) DEFAULT NULL,
  `supplierPhone` varchar(12) DEFAULT NULL,
  `supplierEmail` varchar(50) DEFAULT NULL,
  `supplierGSTIN` varchar(25) DEFAULT NULL,
  `supplierPAN` varchar(25) DEFAULT NULL,
  `supplierAadhar` varchar(16) DEFAULT NULL,
  `supplierAdd` varchar(25) DEFAULT NULL,
  `supplierCity` varchar(25) DEFAULT NULL,
  `supplierState` int(2) DEFAULT NULL,
  `supplierPin` varchar(6) DEFAULT NULL,
  `supplierCountry` varchar(15) DEFAULT NULL,
  `supplierStatus` int(2) DEFAULT NULL,
  `supplierAddDate` date DEFAULT NULL,
  `supplierModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplierId`, `supplierName`, `supplierContactName`, `supplierPhone`, `supplierEmail`, `supplierGSTIN`, `supplierPAN`, `supplierAadhar`, `supplierAdd`, `supplierCity`, `supplierState`, `supplierPin`, `supplierCountry`, `supplierStatus`, `supplierAddDate`, `supplierModDate`) VALUES
(1, 'MUNSHI ENTERPRICES', 'MUNSHI', '9033381250', 'munshiceramic@gmail.com', '24AVCPM3945M1ZB', 'AVCPM3945M', 'Nill', 'Munshi Enterprices,Nr.Mar', 'Thangadh', 33, '363530', 'India', 1, '2018-06-23', '2018-06-25'),
(2, 'PUPA CERAMICS', 'PUSHPARAJAN', '9965559414', 'admin.tnvl@puahomecare.com', '33AAGFP3696R1ZF', '', '', '17,GANDHIMATHI NAGAR, SEE', 'TIRUNELVELI.', 33, '627011', 'India', 1, '2020-07-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE IF NOT EXISTS `tbl_tax` (
`taxId` int(11) NOT NULL,
  `taxName` varchar(50) DEFAULT NULL,
  `taxDescription` varchar(100) DEFAULT NULL,
  `taxPercentage` int(2) DEFAULT NULL,
  `taxStatus` int(1) DEFAULT NULL,
  `taxAddDate` date DEFAULT NULL,
  `taxModDate` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`taxId`, `taxName`, `taxDescription`, `taxPercentage`, `taxStatus`, `taxAddDate`, `taxModDate`) VALUES
(1, '5 GST', '5 GST', 5, 1, '2017-08-24', '2018-01-22'),
(2, '12 GST', '12 GST', 12, 1, '2017-08-24', NULL),
(3, '18 GST', '18 GST', 18, 1, '2017-08-24', '2018-06-21'),
(4, '28 GST', '28 GST', 28, 1, '2017-08-24', NULL),
(7, '0%', 'NO GST', 0, 1, '2018-01-22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_template`
--

CREATE TABLE IF NOT EXISTS `tbl_template` (
`tempid` int(11) NOT NULL,
  `tempName` text,
  `fileName` text,
  `imgPath` text,
  `tempStatus` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_template`
--

INSERT INTO `tbl_template` (`tempid`, `tempName`, `fileName`, `imgPath`, `tempStatus`) VALUES
(1, 'Basic', 'billpdf-basic', 'images/basic.png', 1),
(2, 'Classic', 'billpdf-classic', 'images/classic.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id` int(11) NOT NULL,
  `userName` text,
  `userId` varchar(50) DEFAULT NULL,
  `userPassWord` varchar(100) DEFAULT NULL,
  `userStatus` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `userName`, `userId`, `userPassWord`, `userStatus`) VALUES
(1, NULL, 'sratheeshmba', '$2y$10$oPCju5nOn7.4KY2SwFYTQONiDV0MTy53Yuf0YfAcCvgq1vwhTVIT6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
 ADD PRIMARY KEY (`billId`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
 ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `tbl_cashmode`
--
ALTER TABLE `tbl_cashmode`
 ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
 ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
 ADD PRIMARY KEY (`compId`);

--
-- Indexes for table `tbl_cusreceipt`
--
ALTER TABLE `tbl_cusreceipt`
 ADD PRIMARY KEY (`crid`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
 ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `tbl_item`
--
ALTER TABLE `tbl_item`
 ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `tbl_itembill`
--
ALTER TABLE `tbl_itembill`
 ADD PRIMARY KEY (`itemBillId`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
 ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
 ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tbl_purchase_history`
--
ALTER TABLE `tbl_purchase_history`
 ADD PRIMARY KEY (`purchaseId`);

--
-- Indexes for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
 ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tbl_salesman`
--
ALTER TABLE `tbl_salesman`
 ADD PRIMARY KEY (`smId`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
 ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
 ADD PRIMARY KEY (`stockId`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
 ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
 ADD PRIMARY KEY (`taxId`);

--
-- Indexes for table `tbl_template`
--
ALTER TABLE `tbl_template`
 ADD PRIMARY KEY (`tempid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
MODIFY `billId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_cashmode`
--
ALTER TABLE `tbl_cashmode`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
MODIFY `compId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_cusreceipt`
--
ALTER TABLE `tbl_cusreceipt`
MODIFY `crid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_item`
--
ALTER TABLE `tbl_item`
MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_itembill`
--
ALTER TABLE `tbl_itembill`
MODIFY `itemBillId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=710;
--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_purchase_history`
--
ALTER TABLE `tbl_purchase_history`
MODIFY `purchaseId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tbl_receipt`
--
ALTER TABLE `tbl_receipt`
MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_salesman`
--
ALTER TABLE `tbl_salesman`
MODIFY `smId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
MODIFY `stockId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
MODIFY `taxId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_template`
--
ALTER TABLE `tbl_template`
MODIFY `tempid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
