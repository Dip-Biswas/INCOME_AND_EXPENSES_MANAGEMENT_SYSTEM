-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 06:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `date`, `item`, `price`, `email`) VALUES
(127, '2022-04-13', 'Lost', '5000', 'dipb8738@gmail.com'),
(128, '2022-04-13', 'Eat', '5000', 'dipb8738@gmail.com'),
(129, '2022-04-14', 'Eat', '10000', 'dipb8738@gmail.com'),
(130, '2022-04-14', 'Office Salary', '500000', 'shuvojshdiuwef09@gmail.com'),
(131, '2022-04-17', 'Total', '10000', 'anysha@gmail1.com'),
(134, '2022-04-17', 'B1', '7000', 'anysha@gmail.com'),
(135, '2022-04-17', 'B2', '5000', 'anysha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `date`, `item`, `price`, `email`) VALUES
(130, '2022-04-07', 'Eat', '5000', 'hridoy@gmail.com'),
(131, '2022-04-12', 'Lost', '50000', 'hridoy@gmail.com'),
(132, '2022-04-13', 'Lost', '12345', 'hridoy@gmail.com'),
(133, '2022-04-04', 'Lost', '12345', 'hridoy@gmail.com'),
(134, '2022-04-14', 'Lost', '24500', 't@gmail.com'),
(135, '2022-04-14', 'Lost', '24000', 't@gmail.com'),
(136, '2022-04-13', 'Eat', '90000', 't@gmail.com'),
(137, '2022-04-13', 'Travel', '50000', 't@gmail.com'),
(138, '2022-04-13', 'Donate', '100000', 't@gmail.com'),
(141, '2022-04-13', 'Lost', '123', 'dipb8738@gmail.com'),
(142, '2022-04-13', 'Treat', '50000', 'dipb8738@gmail.com'),
(144, '2022-04-14', 'Lost', '500', 'dipb8738@gmail.com'),
(145, '2022-04-16', 'Eat', '5000', 'dipb8738@gmail.com'),
(146, '2022-04-16', 'Lost', '5000', 'anysha@gmail1.com'),
(147, '2022-04-17', 'Iphone', '19000', 'dipb8738@gmail.com'),
(150, '2022-04-17', 'Travel', '5000', 'anysha@gmail.com'),
(151, '2022-04-17', 'Eat', '2000', 'anysha@gmail.com'),
(153, '2022-04-18', 'Food', '50', 'anysha@gmail.com'),
(154, '2022-04-18', 'Travel', '100', 'anysha@gmail.com'),
(155, '2022-04-18', 'Iphone', '1000', 'anysha@gmail.com'),
(156, '2022-04-18', 'Donation', '500', 'anysha@gmail.com'),
(157, '2022-04-18', 'Dress', '2000', 'anysha@gmail.com'),
(159, '2022-04-17', 'Eat', '5000', 'hridoy@gmail.com'),
(161, '2022-04-18', 'Travel', '5000', 'dip@gmail.com'),
(162, '2022-04-22', 'Food', '5000', 'dipb8738@gmail.com'),
(163, '2022-04-24', 'Food', '2000', 'dipb8738@gmail.com'),
(164, '2022-04-24', 'Transportation', '900', 'dipb8738@gmail.com'),
(165, '2022-04-24', 'Gifts', '5000', 'dipb8738@gmail.com'),
(166, '2022-04-24', 'Phone Bills', '3000', 'dipb8738@gmail.com');

--
-- Triggers `expenses`
--
DELIMITER $$
CREATE TRIGGER `before_delete_expense` BEFORE DELETE ON `expenses` FOR EACH ROW BEGIN 
INSERT into expenses_archive(date,item,price,email)
VALUES(old.date,old.item,old.price,old.email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `expenses_archive`
--

CREATE TABLE `expenses_archive` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `item` varchar(30) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses_archive`
--

INSERT INTO `expenses_archive` (`id`, `date`, `item`, `price`, `email`) VALUES
(1, '2022-04-13', 'Lost', 5000, 'dipb8738@gmail.com'),
(2, '2022-04-13', 'Eat', 5000, 'dipb8738@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `date`, `item`, `price`, `email`) VALUES
(126, '2022-04-12', 'Office Salary', '50000', 'hridoy@gmail.com'),
(127, '2022-04-13', 'Tution', '1345', 't@gmail.com'),
(128, '2022-04-14', 'Lost', '1345', 't@gmail.com'),
(129, '2022-04-14', 'Treat', '2000', 'hridoy@gmail.com'),
(130, '2022-04-15', 'Tution', '2346', 'hridoy@gmail.com'),
(131, '2022-04-13', 'Tution', '15000', 't@gmail.com'),
(132, '2022-04-13', 'Tution', '10000', 'dipb8738@gmail.com'),
(133, '2022-04-14', 'Tution', '10000', 'dipb8738@gmail.com'),
(134, '2022-02-14', 'Eat', '132', 'dipb8738@gmail.com'),
(135, '2022-04-14', 'Lost', '500', 'dipb8738@gmail.com'),
(136, '2022-04-22', 'Eat', '500', 'dipb8738@gmail.com'),
(137, '2022-05-06', '692', '20', 'dipb8738@gmail.com'),
(138, '2022-05-06', 'Lost', '100', 'dipb8738@gmail.com'),
(140, '2022-04-14', 'Tution', '5000', 't@gmail.com'),
(141, '2022-04-15', 'Tution', '500', 'dipb8738@gmail.com'),
(142, '2022-04-15', 'Office Salary', '1000', 'dipb8738@gmail.com'),
(143, '2022-04-16', 'Tution', '5000', 'alve@gmail.com'),
(144, '2022-04-16', 'Tution', '100000', 'riven.khan@northsouth.edu'),
(145, '2022-04-17', 'Salary', '10000', 'anysha@gmail1.com'),
(146, '2022-04-09', 'Salary', '1000', 'dipb8738@gmail.com'),
(148, '2022-04-18', 'Tution', '20000', 'anysha@gmail.com'),
(149, '2022-04-19', 'Salary', '10000', 'dip@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `id` int(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dp` varchar(255) NOT NULL,
  `reset_link_token` varchar(50) DEFAULT NULL,
  `exp_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dob`, `email`, `password`, `dp`, `reset_link_token`, `exp_date`) VALUES
(10, 'tanvir', '2022-03-14', 't@gmail.com', '12345', '', NULL, NULL),
(11, 'tanvir', '2022-04-09', 't1@gmail.com', '', '', 'bf75cae71b3ed9e1f6804b44c716be8d5694', '2022-04-24 06:37:11'),
(12, 'hridoy', '2022-04-12', 'hridoy@gmail.com', '12345', '', NULL, NULL),
(13, 'Dip Biswas', '2004-01-13', 'dipb8738@gmail.com', '987456', '', '', ''),
(14, 'Dip Biswas', '2022-04-13', 'i@gmail.com', '6789', '', NULL, NULL),
(16, 'alve', '2022-04-16', 'alve@gmail.com', '123456', '', NULL, NULL),
(17, 'riven khan', '1998-04-19', 'riven.khan@northsouth.edu', '123456', '', NULL, NULL),
(18, 'anysha sharif', '2022-04-17', 'anysha@gmail1.com', '98765', '', NULL, NULL),
(19, 'anysha sharif', '2022-04-17', 'anysha@gmail.com', '12345', '', NULL, NULL),
(20, 'dip', '2022-04-19', 'dip@gmail.com', '654321', '', NULL, NULL),
(21, 'coc', '2022-04-25', 'cocrushh01@gmail.com', '', '', '5e614fb48b611c3232145c65e0832ffb3019', '2022-04-26 18:36:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_archive`
--
ALTER TABLE `expenses_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `constr_ID` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `expenses_archive`
--
ALTER TABLE `expenses_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
